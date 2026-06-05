<script>
    (function() {
        function addSearchableSelectStyles() {
            if (document.getElementById('searchable-select-global-style')) {
                return;
            }

            let style = document.createElement('style');
            style.id = 'searchable-select-global-style';
            style.innerHTML = '.select2-container--open{z-index:999999}.select2-dropdown{z-index:999999}';
            document.head.appendChild(style);
        }

        function getWireModelName(element) {
            return element.getAttribute('wire:model') ||
                element.getAttribute('wire:model.live') ||
                element.getAttribute('wire:model.defer') ||
                element.getAttribute('wire:model.lazy');
        }

        function getLivewireComponent(element) {
            let componentRoot = element.closest('[wire\\:id]');

            if (!componentRoot || !window.Livewire) {
                return null;
            }

            return window.Livewire.find(componentRoot.getAttribute('wire:id'));
        }

        function forceSearchableSelectDropdownBelow() {
            if (!window.jQuery || !jQuery.fn.select2 || !jQuery.fn.select2.amd || window.searchableSelectPositionPatched) {
                return;
            }

            let AttachBody = jQuery.fn.select2.amd.require('select2/dropdown/attachBody');

            if (!AttachBody || !AttachBody.prototype || !AttachBody.prototype._positionDropdown) {
                return;
            }

            let originalPositionDropdown = AttachBody.prototype._positionDropdown;

            AttachBody.prototype._positionDropdown = function() {
                originalPositionDropdown.apply(this, arguments);

                if (!this.$element || !this.$element.hasClass('searchable-select')) {
                    return;
                }

                let selectOffset = this.$container.offset();
                let dropdownCss = {
                    top: selectOffset.top + this.$container.outerHeight(false),
                    bottom: 'auto',
                    left: selectOffset.left
                };

                if (this.$dropdownParent && this.$dropdownParent.length && !this.$dropdownParent.is('body')) {
                    let parentOffset = this.$dropdownParent.offset();

                    dropdownCss.top -= parentOffset.top;
                    dropdownCss.left -= parentOffset.left;
                }

                this.$dropdownContainer.css(dropdownCss);
                this.$dropdown
                    .removeClass('select2-dropdown--above')
                    .addClass('select2-dropdown--below');
                this.$container
                    .removeClass('select2-container--above')
                    .addClass('select2-container--below');
            };

            window.searchableSelectPositionPatched = true;
        }

        function positionSearchableSelectDropdownBelow(element) {
            let select = jQuery(element);
            let instance = select.data('select2');

            if (!instance || !instance.$container || !instance.dropdown) {
                return;
            }

            let dropdownContainer = instance.dropdown.$dropdownContainer;
            let dropdown = instance.dropdown.$dropdown;

            if (!dropdownContainer || !dropdownContainer.length) {
                dropdownContainer = jQuery('.select2-container--open .select2-dropdown').last().parent();
            }

            if (!dropdown || !dropdown.length) {
                dropdown = dropdownContainer.find('.select2-dropdown');
            }

            if (!dropdownContainer.length || !dropdown.length) {
                return;
            }

            let containerOffset = instance.$container.offset();
            let dropdownParent = instance.dropdown.$dropdownParent || select.closest('.modal');
            let dropdownCss = {
                top: containerOffset.top + instance.$container.outerHeight(false),
                bottom: 'auto',
                left: containerOffset.left
            };

            if (dropdownParent && dropdownParent.length && !dropdownParent.is('body')) {
                let parentOffset = dropdownParent.offset();

                dropdownCss.top -= parentOffset.top;
                dropdownCss.left -= parentOffset.left;
            }

            dropdownContainer.css(dropdownCss);
            dropdown
                .removeClass('select2-dropdown--above')
                .addClass('select2-dropdown--below');
            instance.$container
                .removeClass('select2-container--above')
                .addClass('select2-container--below');
        }

        function parseWireChangeValue(token, value) {
            token = token.trim();

            if (!token || token.indexOf('$event') !== -1) {
                return value;
            }

            if ((token.charAt(0) === "'" && token.charAt(token.length - 1) === "'") ||
                (token.charAt(0) === '"' && token.charAt(token.length - 1) === '"')) {
                return token.substring(1, token.length - 1);
            }

            if (token === 'true') {
                return true;
            }

            if (token === 'false') {
                return false;
            }

            if (token === 'null') {
                return null;
            }

            if (!isNaN(token)) {
                return Number(token);
            }

            return value;
        }

        function callWireChange(component, expression, value) {
            if (!component || !expression) {
                return;
            }

            let method = expression.split('(')[0].trim();

            if (!method || method.charAt(0) === '$') {
                return;
            }

            if (expression.indexOf('(') === -1) {
                component.call(method, value);
                return;
            }

            let argsText = expression.substring(expression.indexOf('(') + 1, expression.lastIndexOf(')')).trim();
            let args = argsText ? argsText.split(',').map(function(token) {
                return parseWireChangeValue(token, value);
            }) : [];

            component.call.apply(component, [method].concat(args));
        }

        function hasRealOptions(select) {
            return select.find('option').filter(function() {
                return String(this.value).length > 0;
            }).length > 0;
        }

        function getSelect2DataFromOptions(select) {
            return select.find('option').map(function() {
                return {
                    id: this.value,
                    text: this.textContent.trim(),
                    disabled: this.disabled,
                    selected: this.selected
                };
            }).get();
        }

        window.initSearchableSelects = function(root) {
            if (!window.jQuery || !jQuery.fn.select2) {
                return;
            }

            addSearchableSelectStyles();
            forceSearchableSelectDropdownBelow();

            jQuery(root || document).find('select.searchable-select').addBack('select.searchable-select').each(function() {
                let select = jQuery(this);
                let optionSignature = select.find('option').map(function() {
                    return this.value + ':' + this.textContent.trim();
                }).get().join('|');
                let options = {
                    placeholder: select.data('placeholder') || 'Select option',
                    width: '100%',
                    data: getSelect2DataFromOptions(select)
                };

                let instance = select.data('select2');

                if (!hasRealOptions(select)) {
                    return;
                }

                if (instance && select.data('searchable-select-options') !== optionSignature) {
                    let selectedValue = select.val();

                    select.select2('destroy');
                    select.val(selectedValue);
                }

                if (!select.hasClass('select2-hidden-accessible')) {
                    select.select2(options);
                }

                select.data('searchable-select-options', optionSignature);

                select.off('change.searchable-select').on('change.searchable-select', function() {
                    let component = getLivewireComponent(this);
                    let model = getWireModelName(this);
                    let changeMethod = this.getAttribute('wire:change');

                    if (component && model) {
                        component.set(model, jQuery(this).val());
                    }

                    callWireChange(component, changeMethod, jQuery(this).val());
                });

                select.off('select2:open.searchable-select').on('select2:open.searchable-select', function() {
                    let element = this;

                    window.setTimeout(function() {
                        positionSearchableSelectDropdownBelow(element);
                    }, 0);
                    window.setTimeout(function() {
                        positionSearchableSelectDropdownBelow(element);
                    }, 50);
                });
            });
        };

        document.addEventListener('livewire:init', function() {
            window.initSearchableSelects();

            Livewire.hook('morphed', function() {
                window.initSearchableSelects();
                window.setTimeout(function() {
                    window.initSearchableSelects();
                }, 100);
                window.setTimeout(function() {
                    window.initSearchableSelects();
                }, 300);
            });
        });

        document.addEventListener('shown.bs.modal', function(event) {
            window.setTimeout(function() {
                window.initSearchableSelects(event.target);
            }, 0);
            window.setTimeout(function() {
                window.initSearchableSelects(event.target);
            }, 100);
        });

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                window.initSearchableSelects();
            });
        } else {
            window.initSearchableSelects();
        }
    })();
</script>
