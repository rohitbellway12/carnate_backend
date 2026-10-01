<div class="carnate-accessory-page">

    <style>
        /* =========================================================
           CARNATE ACCESSORY PAGE
        ========================================================= */

        .carnate-accessory-page {
            --carnate-red: #e53935;
            --carnate-red-dark: #d92f2b;
            --carnate-red-soft: #fff5f5;

            --carnate-text: #111827;
            --carnate-heading: #1e293b;
            --carnate-muted: #64748b;
            --carnate-light: #94a3b8;

            --carnate-border: #e2e8f0;
            --carnate-border-light: #edf1f5;

            --carnate-bg: #f7f8fa;
            --carnate-white: #ffffff;

            color: var(--carnate-text);
        }


        /* =========================================================
           GLOBAL
        ========================================================= */

        .carnate-accessory-page .card {
            border: 1px solid var(--carnate-border) !important;

            border-radius: 14px !important;

            background: var(--carnate-white) !important;

            box-shadow:
                0 4px 16px rgba(15, 23, 42, 0.035) !important;

            overflow: hidden;

            margin-bottom: 0;
        }


        .carnate-accessory-page .card-body {
            padding: 20px;
        }


        /* =========================================================
           SUCCESS MESSAGE
        ========================================================= */

        .carnate-accessory-page .carnate-success {
            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 18px;

            padding: 12px 15px;

            border: 1px solid #bbf7d0;

            border-radius: 10px;

            background: #f0fdf4;

            color: #166534;

            font-size: 13px;

            font-weight: 500;
        }


        .carnate-accessory-page .carnate-success i {
            font-size: 18px;
        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .carnate-accessory-page .page-header-card {
            margin-bottom: 18px;
        }


        .carnate-accessory-page .page-header-content {
            min-height: 72px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;
        }


        .carnate-accessory-page .page-heading {
            display: flex;

            align-items: center;

            gap: 13px;
        }


        .carnate-accessory-page .page-heading-icon {
            width: 42px;

            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 11px;

            background: var(--carnate-red-soft);

            color: var(--carnate-red);

            font-size: 20px;
        }


        .carnate-accessory-page .page-title {
            margin: 0;

            color: var(--carnate-heading);

            font-size: 21px;

            font-weight: 700;

            line-height: 1.3;

            letter-spacing: -0.3px;
        }


        .carnate-accessory-page .page-subtitle {
            margin: 3px 0 0;

            color: var(--carnate-light);

            font-size: 12px;
        }


        /* =========================================================
           PRIMARY BUTTON
        ========================================================= */

        .carnate-accessory-page .primary-btn {
            min-height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 0 17px;

            border: 1px solid var(--carnate-red);

            border-radius: 9px;

            background: var(--carnate-red);

            color: #ffffff;

            font-size: 13px;

            font-weight: 600;

            text-decoration: none;

            box-shadow:
                0 5px 14px rgba(229, 57, 53, 0.14);

            transition: all .2s ease;
        }


        .carnate-accessory-page .primary-btn:hover {
            background: var(--carnate-red-dark);

            border-color: var(--carnate-red-dark);

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 8px 18px rgba(229, 57, 53, 0.18);
        }


        .carnate-accessory-page .primary-btn i {
            font-size: 17px;
        }


        /* =========================================================
           FILTER CARD
        ========================================================= */

        .carnate-accessory-page .filter-card {
            margin-bottom: 18px;
        }


        .carnate-accessory-page .filter-content {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;
        }


        .carnate-accessory-page .search-wrapper {
            position: relative;

            width: 320px;

            max-width: 100%;
        }


        .carnate-accessory-page .search-wrapper i {
            position: absolute;

            left: 13px;

            top: 50%;

            transform: translateY(-50%);

            color: var(--carnate-light);

            font-size: 18px;

            pointer-events: none;
        }


        .carnate-accessory-page .search-input {
            width: 100%;

            height: 43px;

            padding: 0 14px 0 40px;

            border: 1px solid var(--carnate-border);

            border-radius: 9px;

            background: #ffffff;

            color: var(--carnate-text);

            font-size: 13px;

            outline: none;

            box-shadow: none;

            transition: all .2s ease;
        }


        .carnate-accessory-page .search-input::placeholder {
            color: #a1aab7;
        }


        .carnate-accessory-page .search-input:hover {
            border-color: #cbd5e1;
        }


        .carnate-accessory-page .search-input:focus {
            border-color: var(--carnate-red);

            box-shadow:
                0 0 0 3px rgba(229, 57, 53, 0.07);
        }


        .carnate-accessory-page .clear-btn {
            min-height: 40px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            padding: 0 15px;

            border: 1px solid var(--carnate-border);

            border-radius: 8px;

            background: #ffffff;

            color: #475569;

            font-size: 12px;

            font-weight: 600;

            transition: all .2s ease;
        }


        .carnate-accessory-page .clear-btn:hover {
            border-color: var(--carnate-red);

            background: var(--carnate-red-soft);

            color: var(--carnate-red);
        }


        /* =========================================================
           TABLE CARD
        ========================================================= */

        .carnate-accessory-page .table-card {
            overflow: hidden;
        }


        .carnate-accessory-page .table-card-header {
            min-height: 68px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 16px 20px;

            border-bottom: 1px solid var(--carnate-border-light);
        }


        .carnate-accessory-page .table-card-title {
            margin: 0;

            color: var(--carnate-heading);

            font-size: 15px;

            font-weight: 700;
        }


        .carnate-accessory-page .table-card-subtitle {
            margin: 3px 0 0;

            color: var(--carnate-light);

            font-size: 11px;
        }


        .carnate-accessory-page .record-count {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 6px 9px;

            border-radius: 7px;

            background: #f8fafc;

            color: #64748b;

            font-size: 11px;

            font-weight: 600;
        }


        /* =========================================================
           TABLE
        ========================================================= */

        .carnate-accessory-page .table-responsive {
            overflow-x: auto;

            -webkit-overflow-scrolling: touch;
        }


        .carnate-accessory-page .accessory-table {
            width: 100%;

            min-width: 1050px;

            margin: 0;

            border-collapse: separate;

            border-spacing: 0;
        }


        .carnate-accessory-page .accessory-table thead th {
            padding: 13px 15px;

            background: #f8fafc;

            border: 0;

            border-bottom: 1px solid var(--carnate-border);

            color: #64748b;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: .5px;

            text-transform: uppercase;

            white-space: nowrap;
        }


        .carnate-accessory-page .accessory-table tbody td {
            padding: 13px 15px;

            border: 0;

            border-bottom: 1px solid var(--carnate-border-light);

            color: #475569;

            font-size: 12px;

            vertical-align: middle;
        }


        .carnate-accessory-page .accessory-table tbody tr {
            transition: background .15s ease;
        }


        .carnate-accessory-page .accessory-table tbody tr:hover {
            background: #fafbfc;
        }


        .carnate-accessory-page .accessory-table tbody tr:last-child td {
            border-bottom: 0;
        }


        /* =========================================================
           SERIAL NUMBER
        ========================================================= */

        .carnate-accessory-page .serial-number {
            color: #94a3b8;

            font-size: 11px;

            font-weight: 600;
        }


        /* =========================================================
           PRODUCT IMAGE
        ========================================================= */

        .carnate-accessory-page .product-image {
            width: 46px;

            height: 46px;

            display: block;

            object-fit: cover;

            border: 1px solid var(--carnate-border);

            border-radius: 9px;

            background: #f8fafc;
        }


        /* =========================================================
           PRODUCT NAME
        ========================================================= */

        .carnate-accessory-page .product-name {
            color: #334155;

            font-weight: 600;
        }


        .carnate-accessory-page .brand-text {
            color: #64748b;

            font-weight: 500;
        }


        .carnate-accessory-page .part-number {
            display: inline-flex;

            padding: 5px 8px;

            border-radius: 6px;

            background: #f1f5f9;

            color: #64748b;

            font-size: 10px;

            font-weight: 600;
        }


        /* =========================================================
           PRICE
        ========================================================= */

        .carnate-accessory-page .price {
            color: #334155;

            font-weight: 600;

            white-space: nowrap;
        }


        .carnate-accessory-page .price-online {
            color: var(--carnate-red);

            font-weight: 700;
        }


        /* =========================================================
           TAX
        ========================================================= */

        .carnate-accessory-page .tax-badge {
            display: inline-flex;

            align-items: center;

            padding: 5px 8px;

            border-radius: 6px;

            background: #f8fafc;

            color: #64748b;

            font-size: 10px;

            font-weight: 600;

            white-space: nowrap;
        }


        /* =========================================================
           STOCK
        ========================================================= */

        .carnate-accessory-page .stock-badge {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 42px;

            padding: 5px 8px;

            border-radius: 6px;

            background: #f0fdf4;

            color: #15803d;

            font-size: 10px;

            font-weight: 700;
        }


        /* =========================================================
           RACK
        ========================================================= */

        .carnate-accessory-page .rack-number {
            color: #64748b;

            font-size: 11px;

            font-weight: 600;
        }


        /* =========================================================
           ACTIONS
        ========================================================= */

        .carnate-accessory-page .action-buttons {
            display: flex;

            align-items: center;

            gap: 5px;
        }


        .carnate-accessory-page .action-btn {
            width: 31px;

            height: 31px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border: 1px solid transparent;

            border-radius: 7px;

            background: transparent;

            font-size: 16px;

            cursor: pointer;

            transition: all .2s ease;
        }


        .carnate-accessory-page .edit-btn {
            color: #64748b;
        }


        .carnate-accessory-page .edit-btn:hover {
            border-color: #dbeafe;

            background: #eff6ff;

            color: #2563eb;
        }


        .carnate-accessory-page .delete-btn {
            color: #94a3b8;
        }


        .carnate-accessory-page .delete-btn:hover {
            border-color: #fecaca;

            background: #fef2f2;

            color: #dc2626;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .carnate-accessory-page .empty-state {
            padding: 55px 20px;

            text-align: center;
        }


        .carnate-accessory-page .empty-icon {
            width: 54px;

            height: 54px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin: 0 auto 13px;

            border-radius: 13px;

            background: #f1f5f9;

            color: #94a3b8;

            font-size: 24px;
        }


        .carnate-accessory-page .empty-title {
            margin: 0 0 5px;

            color: #475569;

            font-size: 14px;

            font-weight: 600;
        }


        .carnate-accessory-page .empty-description {
            margin: 0;

            color: #94a3b8;

            font-size: 12px;
        }


        /* =========================================================
           PAGINATION
        ========================================================= */

        .carnate-accessory-page .pagination-wrapper {
            padding: 16px 20px;

            border-top: 1px solid var(--carnate-border-light);

            background: #ffffff;
        }


        .carnate-accessory-page .pagination-wrapper nav {
            margin: 0;
        }


        /* =========================================================
           MODAL BACKDROP
        ========================================================= */

        .carnate-accessory-page .carnate-modal {
            position: fixed !important;

            inset: 0 !important;

            z-index: 1080 !important;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background: rgba(15, 23, 42, 0.55) !important;

            opacity: 1 !important;

            overflow-y: auto;

            backdrop-filter: blur(3px);

            -webkit-backdrop-filter: blur(3px);
        }


        .carnate-accessory-page .carnate-modal.show {
            display: flex !important;
        }


        /* =========================================================
           MODAL DIALOG
        ========================================================= */

        .carnate-accessory-page .carnate-modal .modal-dialog {
            width: 100%;

            max-width: 900px;

            margin: auto;

            transform: none !important;
        }


        .carnate-accessory-page .carnate-modal.modal-md .modal-dialog {
            max-width: 520px;
        }


        .carnate-accessory-page .carnate-modal .modal-content {
            max-height: calc(100vh - 40px);

            display: flex;

            flex-direction: column;

            border: 1px solid rgba(226, 232, 240, .9);

            border-radius: 16px;

            background: #ffffff;

            box-shadow:
                0 25px 70px rgba(15, 23, 42, 0.18);

            overflow: hidden;
        }


        /* =========================================================
           MODAL HEADER
        ========================================================= */

        .carnate-accessory-page .carnate-modal .modal-header {
            flex: 0 0 auto;

            min-height: 68px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 17px 22px;

            border-bottom: 1px solid var(--carnate-border-light);

            background: #ffffff;
        }


        .carnate-accessory-page .modal-title-wrapper {
            display: flex;

            align-items: center;

            gap: 11px;
        }


        .carnate-accessory-page .modal-title-icon {
            width: 36px;

            height: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 9px;

            background: var(--carnate-red-soft);

            color: var(--carnate-red);

            font-size: 17px;
        }


        .carnate-accessory-page .carnate-modal .modal-title {
            margin: 0;

            color: var(--carnate-heading);

            font-size: 16px;

            font-weight: 700;
        }


        .carnate-accessory-page .modal-close {
            width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 0;

            border: 0;

            border-radius: 8px;

            background: #f8fafc;

            color: #64748b;

            font-size: 18px;

            transition: all .2s ease;
        }


        .carnate-accessory-page .modal-close:hover {
            background: #fef2f2;

            color: var(--carnate-red);
        }


        /* =========================================================
           MODAL BODY
        ========================================================= */

        .carnate-accessory-page .carnate-modal .modal-body {
            flex: 1 1 auto;

            padding: 22px;

            overflow-y: auto;

            overflow-x: hidden;

            scrollbar-width: thin;

            scrollbar-color: #cbd5e1 transparent;
        }


        .carnate-accessory-page .carnate-modal .modal-body::-webkit-scrollbar {
            width: 6px;
        }


        .carnate-accessory-page .carnate-modal .modal-body::-webkit-scrollbar-track {
            background: transparent;
        }


        .carnate-accessory-page .carnate-modal .modal-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;

            border-radius: 10px;
        }


        /* =========================================================
           FORM SECTION
        ========================================================= */

        .carnate-accessory-page .form-section {
            margin-bottom: 22px;

            padding-bottom: 18px;

            border-bottom: 1px solid var(--carnate-border-light);
        }


        .carnate-accessory-page .form-section:last-child {
            margin-bottom: 0;

            padding-bottom: 0;

            border-bottom: 0;
        }


        .carnate-accessory-page .form-section-title {
            margin: 0 0 15px;

            color: #334155;

            font-size: 13px;

            font-weight: 700;
        }


        .carnate-accessory-page .form-label {
            display: block;

            margin-bottom: 7px;

            color: #475569;

            font-size: 12px;

            font-weight: 600;
        }


        .carnate-accessory-page .form-label .required {
            color: var(--carnate-red);

            margin-left: 2px;
        }


        /* =========================================================
           MODAL FORM CONTROLS
        ========================================================= */

        .carnate-accessory-page .modal-body .form-control,
        .carnate-accessory-page .modal-body .form-select {
            min-height: 43px;

            border: 1px solid #dbe2ea;

            border-radius: 8px;

            background: #ffffff;

            color: #1e293b;

            font-size: 13px;

            box-shadow: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .carnate-accessory-page .modal-body textarea.form-control {
            min-height: 95px;

            padding-top: 11px;

            resize: vertical;
        }


        .carnate-accessory-page .modal-body .form-control::placeholder {
            color: #a1aab7;
        }


        .carnate-accessory-page .modal-body .form-control:hover,
        .carnate-accessory-page .modal-body .form-select:hover {
            border-color: #cbd5e1;
        }


        .carnate-accessory-page .modal-body .form-control:focus,
        .carnate-accessory-page .modal-body .form-select:focus {
            border-color: var(--carnate-red);

            box-shadow:
                0 0 0 3px rgba(229, 57, 53, 0.07);

            outline: none;
        }


        .carnate-accessory-page .modal-body .form-control.bg-light {
            background: #f8fafc !important;

            color: #64748b;
        }


        /* =========================================================
           NAME + ADD LABEL
        ========================================================= */

        .carnate-accessory-page .name-select-row {
            display: flex;

            gap: 8px;
        }


        .carnate-accessory-page .name-select-row .select-area {
            flex: 1;
        }


        .carnate-accessory-page .add-label-btn {
            width: 43px;

            height: 43px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 0;

            border: 1px solid var(--carnate-red);

            border-radius: 8px;

            background: var(--carnate-red);

            color: #ffffff;

            font-size: 18px;

            transition: all .2s ease;
        }


        .carnate-accessory-page .add-label-btn:hover {
            background: var(--carnate-red-dark);

            border-color: var(--carnate-red-dark);
        }


        /* =========================================================
           INPUT GROUP
        ========================================================= */

        .carnate-accessory-page .custom-input-group {
            display: flex;
        }


        .carnate-accessory-page .custom-input-group .form-control {
            border-radius: 8px 0 0 8px;
        }


        .carnate-accessory-page .custom-input-group .input-group-text {
            min-width: 43px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid #dbe2ea;

            border-left: 0;

            border-radius: 0 8px 8px 0;

            background: #f8fafc;

            color: #64748b;

            font-size: 12px;

            font-weight: 600;
        }


        .carnate-accessory-page .discount-group {
            display: flex;

            gap: 0;
        }


        .carnate-accessory-page .discount-group .form-control {
            border-radius: 8px 0 0 8px;
        }


        .carnate-accessory-page .discount-type {
            width: 70px;

            border-left: 0 !important;

            border-radius: 0 8px 8px 0 !important;
        }


        /* =========================================================
           IMAGE UPLOAD
        ========================================================= */

        .carnate-accessory-page .image-upload-row {
            display: flex;

            align-items: center;

            gap: 18px;
        }


        .carnate-accessory-page .image-upload-input {
            flex: 1;
        }


        .carnate-accessory-page .image-preview {
            width: 76px;

            height: 76px;

            padding: 5px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid var(--carnate-border);

            border-radius: 10px;

            background: #f8fafc;

            overflow: hidden;
        }


        .carnate-accessory-page .image-preview img {
            width: 100%;

            height: 100%;

            object-fit: contain;

            border-radius: 6px;
        }


        /* =========================================================
           CHECKBOX
        ========================================================= */

        .carnate-accessory-page .custom-check {
            display: flex;

            align-items: center;

            gap: 9px;

            padding: 11px 13px;

            border: 1px solid var(--carnate-border);

            border-radius: 9px;

            background: #ffffff;
        }


        .carnate-accessory-page .custom-check .form-check-input {
            width: 18px;

            height: 18px;

            margin: 0;

            border: 1px solid #cbd5e1;

            border-radius: 5px;

            box-shadow: none;

            cursor: pointer;
        }


        .carnate-accessory-page .custom-check .form-check-input:checked {
            background-color: var(--carnate-red);

            border-color: var(--carnate-red);
        }


        .carnate-accessory-page .custom-check .form-check-label {
            margin: 0;

            color: #475569;

            font-size: 12px;

            font-weight: 600;

            cursor: pointer;
        }


        /* =========================================================
           VEHICLE SELECTOR
        ========================================================= */

        .carnate-accessory-page .vehicle-selector-wrapper {
            padding: 15px;

            border: 1px solid var(--carnate-border);

            border-radius: 10px;

            background: #fafbfc;
        }


        .carnate-accessory-page .vehicle-section-label {
            display: block;

            margin-bottom: 8px;

            color: #64748b;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: .3px;
        }


        .carnate-accessory-page .selected-vehicles {
            display: flex;

            flex-wrap: wrap;

            gap: 7px;

            margin-top: 10px;
        }


        .carnate-accessory-page .vehicle-badge {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 9px;

            border: 1px solid #fecaca;

            border-radius: 7px;

            background: var(--carnate-red-soft);

            color: #991b1b;

            font-size: 11px;

            font-weight: 500;
        }


        .carnate-accessory-page .vehicle-remove {
            width: 18px;

            height: 18px;

            padding: 0;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border: 0;

            border-radius: 5px;

            background: rgba(229, 57, 53, .10);

            color: var(--carnate-red);

            font-size: 11px;

            cursor: pointer;
        }


        .carnate-accessory-page .vehicle-remove:hover {
            background: var(--carnate-red);

            color: #ffffff;
        }


        .carnate-accessory-page .no-vehicles {
            color: #94a3b8;

            font-size: 11px;
        }


        /* =========================================================
           ERROR
        ========================================================= */

        .carnate-accessory-page .field-error {
            display: block;

            margin-top: 5px;

            color: #dc2626;

            font-size: 11px;

            line-height: 1.4;
        }


        /* =========================================================
           LOADING
        ========================================================= */

        .carnate-accessory-page .fetch-loader {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            margin-top: 6px;

            color: var(--carnate-muted);

            font-size: 11px;
        }


        .carnate-accessory-page .spinner-border {
            width: 14px;

            height: 14px;

            border-width: 2px;
        }


        /* =========================================================
           MODAL FOOTER
        ========================================================= */

        .carnate-accessory-page .carnate-modal .modal-footer {
            flex: 0 0 auto;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 8px;

            padding: 15px 22px;

            border-top: 1px solid var(--carnate-border-light);

            background: #ffffff;
        }


        .carnate-accessory-page .cancel-btn {
            min-height: 40px;

            padding: 0 15px;

            border: 1px solid var(--carnate-border);

            border-radius: 8px;

            background: #ffffff;

            color: #64748b;

            font-size: 12px;

            font-weight: 600;

            transition: all .2s ease;
        }


        .carnate-accessory-page .cancel-btn:hover {
            background: #f8fafc;

            border-color: #cbd5e1;

            color: #334155;
        }


        .carnate-accessory-page .submit-btn {
            min-height: 40px;

            min-width: 100px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 0 17px;

            border: 1px solid var(--carnate-red);

            border-radius: 8px;

            background: var(--carnate-red);

            color: #ffffff;

            font-size: 12px;

            font-weight: 600;

            transition: all .2s ease;
        }


        .carnate-accessory-page .submit-btn:hover {
            background: var(--carnate-red-dark);

            border-color: var(--carnate-red-dark);
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 767px) {

            .carnate-accessory-page .page-header-content {
                align-items: flex-start;

                flex-direction: column;
            }


            .carnate-accessory-page .filter-content {
                align-items: stretch;

                flex-direction: column;
            }


            .carnate-accessory-page .search-wrapper {
                width: 100%;
            }


            .carnate-accessory-page .clear-btn {
                width: 100%;
            }


            .carnate-accessory-page .carnate-modal {
                padding: 10px;
            }


            .carnate-accessory-page .carnate-modal .modal-content {
                max-height: calc(100vh - 20px);

                border-radius: 13px;
            }


            .carnate-accessory-page .carnate-modal .modal-body {
                padding: 17px;
            }


            .carnate-accessory-page .carnate-modal .modal-header {
                padding: 14px 17px;
            }


            .carnate-accessory-page .carnate-modal .modal-footer {
                padding: 13px 17px;
            }


            .carnate-accessory-page .image-upload-row {
                align-items: flex-start;

                flex-direction: column;
            }


            .carnate-accessory-page .image-upload-input {
                width: 100%;
            }
        }


        @media (max-width: 575px) {

            .carnate-accessory-page .card-body {
                padding: 15px;
            }


            .carnate-accessory-page .page-title {
                font-size: 19px;
            }


            .carnate-accessory-page .page-heading-icon {
                width: 38px;

                height: 38px;

                font-size: 18px;
            }


            .carnate-accessory-page .primary-btn {
                width: 100%;
            }


            .carnate-accessory-page .page-header-content {
                width: 100%;
            }


            .carnate-accessory-page .page-heading {
                width: 100%;
            }


            .carnate-accessory-page .modal-title {
                font-size: 14px !important;
            }
        }
    </style>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================= --}}

    @if (session()->has('message'))

        <div class="carnate-success">

            <i class="bx bx-check-circle"></i>

            <span>
                {{ session('message') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
         SPARE PART VENDOR
    ========================================================= --}}

    @php
        $sparePart = App\Models\SparePartVendor::where('id', $sparepartId)->first();
    @endphp


    {{-- =========================================================
         ADD / EDIT ACCESSORY MODAL
    ========================================================= --}}

    <div
        class="carnate-modal @if ($showModal) show @endif"
        tabindex="-1"
        aria-hidden="{{ $showModal ? 'false' : 'true' }}"
    >

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">


                    {{-- =================================================
                         MODAL HEADER
                    ================================================== --}}

                    <div class="modal-header">

                        <div class="modal-title-wrapper">

                            <div class="modal-title-icon">

                                <i class="bx bx-package"></i>

                            </div>

                            <h4 class="modal-title">

                                {{ $isEdit ? 'Edit Accessory' : 'Create Accessory' }}

                            </h4>

                        </div>


                        <button
                            type="button"
                            class="modal-close"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    {{-- =================================================
                         MODAL BODY
                    ================================================== --}}

                    <div class="modal-body">

                        @csrf


                        {{-- =================================================
                             BASIC INFORMATION
                        ================================================== --}}

                        <div class="form-section">

                            <h5 class="form-section-title">
                                Basic Information
                            </h5>


                            <div class="row g-3">


                                {{-- Name --}}

                                <div class="col-md-6">

                                    <label class="form-label">

                                        Name

                                        <span class="required">*</span>

                                    </label>


                                    <div class="name-select-row">

                                        <div class="select-area">

                                            <select
                                                class="form-select"
                                                wire:model="name"
                                                id="name"
                                            >

                                                <option value="">
                                                    Select a Name or Add New One
                                                </option>

                                                @foreach ($sparePartLabels as $sparePartLabel)

                                                    <option value="{{ $sparePartLabel->title }}">

                                                        {{ $sparePartLabel->title }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>


                                        <button
                                            type="button"
                                            class="add-label-btn"
                                            wire:click="addAccessoryLabel"
                                            title="Add accessory label"
                                        >

                                            +

                                        </button>

                                    </div>


                                    @error('name')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- Supplier --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Supplier
                                    </label>


                                    <select
                                        class="form-select searchable-select"
                                        data-placeholder="Select Supplier"
                                        wire:model="supplier_id"
                                    >

                                        <option value="">
                                            Select Supplier
                                        </option>

                                        @foreach ($suppliers as $supplier)

                                            <option value="{{ $supplier->id }}">

                                                {{ $supplier->owner_first_name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                {{-- Brand --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Brand
                                    </label>


                                    <input
                                        type="text"
                                        wire:model="brand"
                                        class="form-control"
                                        placeholder="Enter Brand"
                                    >


                                    @error('brand')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- Part Number --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Part Number
                                    </label>


                                    <input
                                        type="text"
                                        wire:model="part_number"
                                        class="form-control"
                                        placeholder="Enter Part Number"
                                    >


                                    <div
                                        wire:loading
                                        wire:target="part_number"
                                        class="fetch-loader"
                                    >

                                        <span
                                            class="spinner-border spinner-border-sm"
                                            role="status"
                                            aria-hidden="true"
                                        ></span>

                                        Fetching details...

                                    </div>


                                    @error('part_number')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                             PRICING
                        ================================================== --}}

                        <div class="form-section">

                            <h5 class="form-section-title">
                                Pricing & Tax
                            </h5>


                            <div class="row g-3">


                                {{-- Purchase Price --}}

                                <div class="col-md-6">

                                    <label class="form-label">

                                        Purchase Price

                                        <span class="required">*</span>

                                    </label>


                                    <input
                                        type="number"
                                        wire:model.live="purchase_amount"
                                        id="purchase_amount"
                                        class="form-control"
                                        placeholder="Enter Purchase Price"
                                    >


                                    @error('purchase_amount')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- Selling Price --}}

                                <div class="col-md-6">

                                    <label class="form-label">

                                        Selling Price

                                        <span class="required">*</span>

                                    </label>


                                    <input
                                        type="number"
                                        wire:model.live="selling_amount"
                                        id="selling_amount"
                                        class="form-control"
                                        placeholder="Enter Selling Price"
                                    >


                                    @error('selling_amount')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- Online Price --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Online Price (Auto)
                                    </label>


                                    <input
                                        type="text"
                                        wire:model="online_price"
                                        class="form-control bg-light"
                                        readonly
                                    >

                                </div>


                                {{-- Offline Price --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Offline Price (Auto)
                                    </label>


                                    <input
                                        type="text"
                                        wire:model="offline_price"
                                        class="form-control bg-light"
                                        readonly
                                    >

                                </div>


                                {{-- Tax Type --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Tax Type
                                    </label>


                                    <select
                                        id="tax_type"
                                        class="form-select"
                                        wire:model.live="tax_type"
                                    >

                                        <option value="">
                                            Select Tax Type
                                        </option>

                                        <option value="include">
                                            Include All Taxes
                                        </option>

                                        <option value="exclude">
                                            Exclude All Taxes
                                        </option>

                                    </select>


                                    @error('tax_type')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- Tax Percentage --}}

                                @if ($tax_type == 'include' || $tax_type == 'exclude')

                                    <div class="col-md-6">

                                        <label class="form-label">

                                            {{ $tax_type == 'include' ? 'Include Tax Percentage' : 'Exclude Tax Percentage' }}

                                        </label>


                                        <div class="custom-input-group">

                                            <input
                                                type="number"
                                                wire:model.live="tax_percentage"
                                                class="form-control"
                                                placeholder="Enter Percentage"
                                                id="tax_percentage"
                                            >

                                            <span class="input-group-text">
                                                %
                                            </span>

                                        </div>


                                        @error('tax_percentage')

                                            <span class="field-error">
                                                {{ $message }}
                                            </span>

                                        @enderror

                                    </div>

                                @endif


                                {{-- Online Discount --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Online Discount
                                    </label>


                                    <div class="discount-group">

                                        <input
                                            type="number"
                                            wire:model.live="discount"
                                            class="form-control"
                                            placeholder="Enter Discount"
                                        >


                                        <select
                                            id="discount_type"
                                            class="form-select discount-type"
                                            wire:model.live="discount_type"
                                        >

                                            <option value="1">
                                                ₹
                                            </option>

                                            <option value="2">
                                                %
                                            </option>

                                        </select>

                                    </div>


                                    @error('discount')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror


                                    @error('discount_type')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                             INVENTORY
                        ================================================== --}}

                        <div class="form-section">

                            <h5 class="form-section-title">
                                Inventory Details
                            </h5>


                            <div class="row g-3">


                                {{-- Unit --}}

                                <div class="col-md-6">

                                    <label class="form-label">

                                        Unit

                                        <span class="required">*</span>

                                    </label>


                                    <select
                                        id="unit"
                                        class="form-select"
                                        wire:model="unit"
                                    >

                                        <option value="">
                                            Select Unit
                                        </option>

                                        @foreach ($units as $unit)

                                            <option value="{{ $unit->id }}">

                                                {{ $unit->title }}

                                            </option>

                                        @endforeach

                                    </select>


                                    @error('unit')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- Stock --}}

                                <div class="col-md-6">

                                    <label class="form-label">

                                        Stock

                                        <span class="required">*</span>

                                    </label>


                                    <input
                                        type="number"
                                        wire:model="stock"
                                        class="form-control"
                                        id="stock"
                                        placeholder="Enter Stock"
                                    >


                                    @error('stock')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- Rack --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Rack No.
                                    </label>


                                    <input
                                        type="text"
                                        wire:model="rack_no"
                                        class="form-control"
                                        id="rack_no"
                                        placeholder="Enter Rack No."
                                    >


                                    @error('rack_no')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- Category --}}

                                <div class="col-md-6">

                                    <label class="form-label">

                                        Category

                                        <span class="required">*</span>

                                    </label>


                                    <select
                                        class="form-select searchable-select"
                                        data-placeholder="Select Category"
                                        wire:model="category"
                                        id="category"
                                    >

                                        <option value="">
                                            Select Category
                                        </option>

                                        @foreach ($categories as $category)

                                            <option value="{{ $category['categoryId'] }}">

                                                {{ $category['categoryName'] }}

                                            </option>

                                        @endforeach

                                    </select>


                                    @error('category')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                             IMAGE
                        ================================================== --}}

                        <div class="form-section">

                            <h5 class="form-section-title">
                                Product Image
                            </h5>


                            <div class="image-upload-row">


                                <div class="image-upload-input">

                                    <label class="form-label">
                                        Image
                                    </label>


                                    <input
                                        type="file"
                                        class="form-control"
                                        wire:model="image"
                                    >

                                </div>


                                <div>

                                    @if ($part_image_url)

                                        <div class="image-preview">

                                            <img
                                                src="{{ $part_image_url }}"
                                                alt="Accessory image"
                                            >

                                        </div>

                                    @elseif (!empty($imageName))

                                        <div class="image-preview">

                                            <img
                                                src="{{ asset($imageName) }}"
                                                alt="Accessory image"
                                            >

                                        </div>

                                    @else

                                        @if ($isEdit)

                                            <div class="image-preview">

                                                <img
                                                    src="{{ asset($imageImage) }}"
                                                    alt="Accessory image"
                                                >

                                            </div>

                                        @endif

                                    @endif

                                </div>

                            </div>


                            @error('image')

                                <span class="field-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        {{-- =================================================
                             DESCRIPTION
                        ================================================== --}}

                        <div class="form-section">

                            <h5 class="form-section-title">
                                Additional Information
                            </h5>


                            <div class="row g-3">


                                <div class="col-md-12">

                                    <label class="form-label">
                                        Description
                                    </label>


                                    <textarea
                                        wire:model="description"
                                        class="form-control"
                                        placeholder="Enter Description"
                                    ></textarea>


                                    @error('description')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                             COMPATIBLE VEHICLES
                        ================================================== --}}

                        <div class="form-section">

                            <h5 class="form-section-title">
                                Compatible Vehicles
                            </h5>


                            <div class="custom-check mb-3">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    wire:model="forAllVehicles"
                                    id="forAllVehicles"
                                >


                                <label
                                    class="form-check-label"
                                    for="forAllVehicles"
                                >

                                    For All Vehicles

                                </label>

                            </div>


                            @if (!$forAllVehicles)

                                {{-- =================================================
                                     VEHICLE SELECTOR
                                ================================================== --}}

                                <div class="mb-3">

                                    <span class="vehicle-section-label">
                                        Add Vehicle from Vehicle Selector
                                    </span>


                                    <div class="vehicle-selector-wrapper">

                                        @livewire('workshop.vehicle-selector')

                                    </div>

                                </div>


                                {{-- =================================================
                                     EXISTING VEHICLES
                                ================================================== --}}

                                <div class="mb-3">

                                    <label class="form-label">

                                        Or Select from Existing Saved Vehicles

                                    </label>


                                    <select
                                        id="suitable_for"
                                        class="form-select searchable-select"
                                        multiple
                                        data-placeholder="Select vehicle"
                                        wire:model="suitable_for"
                                    >

                                        @foreach ($modifications as $modification)

                                            <option
                                                value="{{ $modification->id }}"
                                                @if (is_array($suitable_for) && in_array($modification->id, $suitable_for)) selected @endif
                                            >

                                                @php

                                                    $data = array_filter([
                                                        $modification->brand_name ?? '',
                                                        $modification->variant_name ?? '',
                                                        $modification->year ?? '',
                                                        $modification->title ?? '',
                                                    ]);

                                                @endphp

                                                {{ implode(' ', $data) }}

                                            </option>

                                        @endforeach

                                    </select>


                                    @error('suitable_for')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- =================================================
                                     SELECTED VEHICLES
                                ================================================== --}}

                                <div>

                                    <label class="form-label">

                                        Selected Compatible Vehicles

                                        ({{ is_array($suitable_for) ? count($suitable_for) : 0 }})

                                    </label>


                                    <div class="selected-vehicles">

                                        @if (empty($suitable_for))

                                            <span class="no-vehicles">
                                                No vehicles selected yet.
                                            </span>

                                        @else

                                            @foreach ($suitable_for as $index => $modId)

                                                @php

                                                    $localMod = $modifications->firstWhere('id', $modId);

                                                @endphp


                                                @if ($localMod)

                                                    <span class="vehicle-badge">

                                                        <span>

                                                            {{ $localMod->brand_name }}

                                                            {{ $localMod->variant_name }}

                                                            ({{ $localMod->year }})

                                                            -

                                                            {{ $localMod->title }}

                                                        </span>


                                                        <button
                                                            type="button"
                                                            class="vehicle-remove"
                                                            wire:click="removeCompatibleVehicle({{ $index }})"
                                                            aria-label="Remove vehicle"
                                                        >

                                                            <i class="bx bx-x"></i>

                                                        </button>

                                                    </span>

                                                @endif

                                            @endforeach

                                        @endif

                                    </div>

                                </div>

                            @endif

                        </div>


                    </div>


                    {{-- =================================================
                         MODAL FOOTER
                    ================================================== --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="cancel-btn"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                        >

                            Cancel

                        </button>


                        <button
                            type="submit"
                            class="submit-btn"
                        >

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i
                                class="spinner-border spinner-border-sm"
                                wire:loading
                            ></i>

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         CREATE ACCESSORY LABEL MODAL
    ========================================================= --}}

    <div
        class="carnate-modal @if ($showAccessoryModel) show @endif"
        tabindex="-1"
        aria-hidden="{{ $showAccessoryModel ? 'false' : 'true' }}"
    >

        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <form wire:submit.prevent="accessoryLabelStore">


                    {{-- Header --}}

                    <div class="modal-header">

                        <div class="modal-title-wrapper">

                            <div class="modal-title-icon">

                                <i class="bx bx-tag"></i>

                            </div>

                            <h4 class="modal-title">
                                Create Accessory
                            </h4>

                        </div>


                        <button
                            type="button"
                            class="modal-close"
                            wire:click="$set('showAccessoryModel', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    {{-- Body --}}

                    <div class="modal-body">

                        @csrf


                        <div class="form-section">

                            <div class="row g-3">

                                <div class="col-md-12">

                                    <label class="form-label">
                                        Accessory Label
                                    </label>


                                    <input
                                        type="text"
                                        wire:model="accessory_label"
                                        class="form-control"
                                        placeholder="Enter Accessory Label"
                                    >


                                    @error('accessory_label')

                                        <span class="field-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="cancel-btn"
                            wire:click="$set('showAccessoryModel', false)"
                            data-bs-dismiss="modal"
                        >

                            Cancel

                        </button>


                        <button
                            type="submit"
                            class="submit-btn"
                        >

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i
                                class="spinner-border spinner-border-sm"
                                wire:loading
                            ></i>

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         PAGE HEADER
    ========================================================= --}}

    <div class="card page-header-card">

        <div class="card-body page-header-content">

            <div class="page-heading">

                <div class="page-heading-icon">

                    <i class="bx bx-package"></i>

                </div>


                <div>

                    <h1 class="page-title">
                        Accessory
                    </h1>

                    <p class="page-subtitle">
                        Manage accessories, pricing, stock and compatibility
                    </p>

                </div>

            </div>


            @if (@$sparePart->hasPermissionTo('accessory-add'))

                <div>

                    <a
                        href="javascript:;"
                        wire:click="create"
                        class="primary-btn"
                    >

                        <i class="bx bx-plus"></i>

                        Add Accessory

                    </a>

                </div>

            @endif

        </div>

    </div>


    {{-- =========================================================
         SEARCH / FILTER
    ========================================================= --}}

    <div class="card filter-card">

        <div class="card-body">

            <div class="filter-content">


                <div class="search-wrapper">

                    <i class="bx bx-search"></i>


                    <input
                        type="text"
                        class="search-input"
                        placeholder="Search accessories..."
                        wire:model.live="searchfilter"
                    >

                </div>


                <button
                    type="button"
                    class="clear-btn"
                    wire:click="resetFilter"
                >

                    <i class="bx bx-refresh"></i>

                    Clear

                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
         ACCESSORY TABLE
    ========================================================= --}}

    <div class="card table-card">


        @if (!empty($accessories) && $accessories->count())


            {{-- =================================================
                 TABLE HEADER
            ================================================== --}}

            <div class="table-card-header">

                <div>

                    <h2 class="table-card-title">
                        Accessories
                    </h2>

                    <p class="table-card-subtitle">
                        View and manage your accessory inventory
                    </p>

                </div>


                <span class="record-count">

                    <i class="bx bx-list-ul"></i>

                    {{ $accessories->total() }} Records

                </span>

            </div>


            {{-- =================================================
                 TABLE
            ================================================== --}}

            <div class="table-responsive">

                <table class="accessory-table">

                    <thead>

                        <tr>

                            <th>
                                S.No.
                            </th>

                            <th>
                                Image
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Brand
                            </th>

                            <th>
                                Part Number
                            </th>

                            <th>
                                Unit
                            </th>

                            {{-- <th>Suitable For</th> --}}

                            <th>
                                Online Price
                            </th>

                            <th>
                                Offline Price
                            </th>

                            <th>
                                Tax
                            </th>

                            <th>
                                Stock
                            </th>

                            <th>
                                Rack No.
                            </th>


                            @if (@$sparePart->hasPermissionTo('accessory-edit') || @$sparePart->hasPermissionTo('accessory-delete'))

                                <th>
                                    Actions
                                </th>

                            @endif

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($accessories as $index => $accessory)

                            <tr>


                                {{-- =================================================
                                     SERIAL
                                ================================================== --}}

                                <td>

                                    <span class="serial-number">

                                        {{ $accessories->total() - ($accessories->firstItem() + $index) + 1 }}

                                    </span>

                                </td>


                                {{-- =================================================
                                     IMAGE
                                ================================================== --}}

                                <td>

                                    @if (!empty($accessory->Image->file))

                                        <img
                                            src="{{ asset($accessory->Image->file) }}"
                                            alt="accessory image"
                                            class="product-image"
                                        >

                                    @else

                                        <img
                                            src="{{ asset('img/accessory.png') }}"
                                            alt="accessory image"
                                            class="product-image"
                                        >

                                    @endif

                                </td>


                                {{-- =================================================
                                     NAME
                                ================================================== --}}

                                <td>

                                    <span class="product-name">
                                        {{ $accessory->name }}
                                    </span>

                                </td>


                                {{-- =================================================
                                     BRAND
                                ================================================== --}}

                                <td>

                                    <span class="brand-text">
                                        {{ $accessory->brand }}
                                    </span>

                                </td>


                                {{-- =================================================
                                     PART NUMBER
                                ================================================== --}}

                                <td>

                                    <span class="part-number">

                                        {{ $accessory->part_number }}

                                    </span>

                                </td>


                                {{-- =================================================
                                     UNIT
                                ================================================== --}}

                                <td>

                                    {{ $accessory->unit?->title ?? '' }}

                                </td>


                                {{-- =================================================
                                     ONLINE PRICE
                                ================================================== --}}

                                <td>

                                    @php

                                        $onlinePrice = $accessory->selling_amount;

                                        if (
                                            $accessory->tax_type == 'exclude' &&
                                            $accessory->tax_percentage
                                        ) {

                                            $onlinePrice +=
                                                ($onlinePrice * $accessory->tax_percentage) / 100;

                                        }

                                        if ($accessory->discount) {

                                            if ($accessory->discount_type == 1) {

                                                $onlinePrice -= $accessory->discount;

                                            } elseif ($accessory->discount_type == 2) {

                                                $onlinePrice -=
                                                    ($onlinePrice * $accessory->discount) / 100;

                                            }

                                        }

                                        echo number_format($onlinePrice, 2);

                                    @endphp

                                </td>


                                {{-- =================================================
                                     OFFLINE PRICE
                                ================================================== --}}

                                <td>

                                    @php

                                        $offlinePrice = $accessory->selling_amount;

                                        if (
                                            $accessory->tax_type == 'exclude' &&
                                            $accessory->tax_percentage
                                        ) {

                                            $offlinePrice +=
                                                ($offlinePrice * $accessory->tax_percentage) / 100;

                                        }

                                        echo number_format($offlinePrice, 2);

                                    @endphp

                                </td>


                                {{-- =================================================
                                     TAX
                                ================================================== --}}

                                <td>

                                    @if ($accessory->tax_percentage)

                                        <span class="tax-badge">

                                            {{ $accessory->tax_type == 'include' ? 'Include' : 'Exclude' }}

                                            {{ $accessory->tax_percentage }}%

                                        </span>

                                    @else

                                        —

                                    @endif

                                </td>


                                {{-- =================================================
                                     STOCK
                                ================================================== --}}

                                <td>

                                    <span class="stock-badge">

                                        {{ $accessory->stock }}

                                    </span>

                                </td>


                                {{-- =================================================
                                     RACK
                                ================================================== --}}

                                <td>

                                    <span class="rack-number">

                                        {{ $accessory->rack_no }}

                                    </span>

                                </td>


                                {{-- =================================================
                                     ACTIONS
                                ================================================== --}}

                                @if (@$sparePart->hasPermissionTo('accessory-edit') || @$sparePart->hasPermissionTo('accessory-delete'))

                                    <td>

                                        <div class="action-buttons">


                                            @if (@$sparePart->hasPermissionTo('accessory-edit'))

                                                <button
                                                    type="button"
                                                    wire:click="edit({{ $accessory->id }})"
                                                    class="action-btn edit-btn"
                                                    title="Edit"
                                                >

                                                    <i class="bx bxs-edit"></i>

                                                </button>

                                            @endif


                                            @if (@$sparePart->hasPermissionTo('accessory-delete'))

                                                <button
                                                    type="button"
                                                    wire:click="confirmDelete({{ $accessory->id }})"
                                                    class="action-btn delete-btn"
                                                    title="Delete"
                                                >

                                                    <i class="bx bx-trash"></i>

                                                </button>

                                            @endif


                                        </div>

                                    </td>

                                @endif

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                 PAGINATION
            ================================================== --}}

            <div class="pagination-wrapper">

                {{ $accessories->links() }}

            </div>


        @else


            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div class="empty-state">

                <div class="empty-icon">

                    <i class="bx bx-package"></i>

                </div>


                <h3 class="empty-title">
                    No Accessory Found
                </h3>


                <p class="empty-description">
                    There are currently no accessories matching your search.
                </p>

            </div>


        @endif

    </div>

</div>


@section('footerscript')

    <script>

        document.addEventListener('livewire:init', function() {

            // Re-initialize select2 when modal opens
            Livewire.hook('morphed', () => {

                window.initSearchableSelects();

            });

        });

    </script>

@endsection