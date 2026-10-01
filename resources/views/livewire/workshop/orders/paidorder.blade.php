<div class="carnate-paid-order-page">

    <style>
        /* =========================================================
           CARNATE PAID ORDER PAGE
           UI ONLY — NO FUNCTIONAL CHANGES
        ========================================================== */

        .carnate-paid-order-page {
            --carnate-red: #e53935;
            --carnate-red-dark: #d32f2f;
            --carnate-red-soft: #fff5f5;

            --carnate-green: #16a34a;
            --carnate-green-soft: #f0fdf4;

            --carnate-blue: #2563eb;
            --carnate-blue-soft: #eff6ff;

            --carnate-orange: #d97706;
            --carnate-orange-soft: #fffbeb;

            --carnate-cyan: #0891b2;
            --carnate-cyan-soft: #ecfeff;

            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-light: #94a3b8;

            --carnate-border: #e2e8f0;
            --carnate-border-light: #eef2f7;

            --carnate-bg: #f7f8fa;
            --carnate-white: #ffffff;

            --carnate-shadow:
                0 4px 20px rgba(15, 23, 42, 0.045);

            --carnate-shadow-hover:
                0 8px 26px rgba(15, 23, 42, 0.08);

            color: var(--carnate-text);
        }

        .carnate-paid-order-page *,
        .carnate-paid-order-page *::before,
        .carnate-paid-order-page *::after {
            box-sizing: border-box;
        }

        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .carnate-paid-order-page .cpo-page-header {
            margin-bottom: 22px;
        }

        .carnate-paid-order-page .cpo-header-card {
            background: var(--carnate-white);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: var(--carnate-shadow);
            padding: 20px 22px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-paid-order-page .cpo-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-paid-order-page .cpo-heading-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;

            border-radius: 13px;

            background: var(--carnate-red-soft);
            color: var(--carnate-red);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 22px;
        }

        .carnate-paid-order-page .cpo-heading h3 {
            margin: 0;

            font-size: 23px;
            line-height: 1.3;

            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-paid-order-page .cpo-heading p {
            margin: 5px 0 0;

            color: var(--carnate-muted);
            font-size: 13px;
        }

        /* =========================================================
           CARD
        ========================================================== */

        .carnate-paid-order-page .cpo-card {
            background: var(--carnate-white);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;

            box-shadow: var(--carnate-shadow);

            overflow: hidden;
        }

        .carnate-paid-order-page .cpo-card + .cpo-card {
            margin-top: 18px;
        }

        .carnate-paid-order-page .cpo-card-header {
            padding: 19px 22px;

            border-bottom: 1px solid var(--carnate-border);

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;
        }

        .carnate-paid-order-page .cpo-card-title {
            margin: 0;

            font-size: 17px;
            font-weight: 700;

            color: var(--carnate-text);
        }

        .carnate-paid-order-page .cpo-card-description {
            margin: 4px 0 0;

            font-size: 13px;
            color: var(--carnate-muted);
        }

        .carnate-paid-order-page .cpo-card-body {
            padding: 22px;
        }

        /* =========================================================
           FILTERS
        ========================================================== */

        .carnate-paid-order-page .cpo-filter-card {
            padding: 20px 22px;
        }

        .carnate-paid-order-page .cpo-filter-grid {
            display: grid;

            grid-template-columns:
                minmax(220px, 1fr)
                minmax(220px, 1fr)
                auto;

            gap: 12px;

            align-items: center;
        }

        .carnate-paid-order-page .cpo-field {
            position: relative;
        }

        .carnate-paid-order-page .cpo-field-icon {
            position: absolute;

            left: 13px;
            top: 50%;

            transform: translateY(-50%);

            color: var(--carnate-light);

            font-size: 17px;

            pointer-events: none;

            z-index: 2;
        }

        .carnate-paid-order-page .cpo-input {
            width: 100%;

            min-height: 43px;

            border: 1px solid var(--carnate-border);

            border-radius: 10px;

            background: #ffffff;

            color: var(--carnate-text);

            font-size: 13px;

            padding: 0 13px;
        }

        .carnate-paid-order-page .cpo-input.has-icon {
            padding-left: 39px;
        }

        .carnate-paid-order-page .cpo-input::placeholder {
            color: #94a3b8;
        }

        .carnate-paid-order-page .cpo-input:focus {
            border-color: rgba(229, 57, 53, .45);

            outline: none;

            box-shadow:
                0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-paid-order-page .cpo-clear-btn {
            min-height: 43px;

            border-radius: 10px;

            border: 1px solid var(--carnate-border);

            background: #f8fafc;

            color: #475569;

            padding: 0 17px;

            font-size: 13px;
            font-weight: 600;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            cursor: pointer;

            transition: all .2s ease;
        }

        .carnate-paid-order-page .cpo-clear-btn:hover {
            background: #f1f5f9;
            color: var(--carnate-text);
            border-color: #cbd5e1;
        }

        /* =========================================================
           TABLE
        ========================================================== */

        .carnate-paid-order-page .cpo-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .carnate-paid-order-page .cpo-table {
            width: 100%;

            min-width: 1200px;

            margin: 0;

            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-paid-order-page .cpo-table thead th {
            padding: 14px 15px;

            background: #f8fafc;

            border-bottom: 1px solid var(--carnate-border);

            color: #64748b;

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .045em;

            white-space: nowrap;

            vertical-align: middle;
        }

        .carnate-paid-order-page .cpo-table tbody td {
            padding: 15px;

            background: #fff;

            border-bottom: 1px solid var(--carnate-border-light);

            color: #334155;

            font-size: 13px;

            vertical-align: middle;
        }

        .carnate-paid-order-page .cpo-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-paid-order-page .cpo-table tbody tr {
            transition: background .18s ease;
        }

        .carnate-paid-order-page .cpo-table tbody tr:hover td {
            background: #fcfcfd;
        }

        /* =========================================================
           ORDER NUMBER
        ========================================================== */

        .carnate-paid-order-page .cpo-order-number {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            font-weight: 700;

            color: var(--carnate-text);

            white-space: nowrap;
        }

        .carnate-paid-order-page .cpo-order-icon {
            width: 30px;
            height: 30px;

            border-radius: 8px;

            background: var(--carnate-red-soft);

            color: var(--carnate-red);

            display: inline-flex;

            align-items: center;
            justify-content: center;

            font-size: 15px;
        }

        /* =========================================================
           DATE
        ========================================================== */

        .carnate-paid-order-page .cpo-date {
            color: #475569;

            white-space: nowrap;

            font-weight: 500;
        }

        /* =========================================================
           AMOUNT
        ========================================================== */

        .carnate-paid-order-page .cpo-amount {
            color: var(--carnate-text);

            font-weight: 700;

            white-space: nowrap;
        }

        .carnate-paid-order-page .cpo-currency {
            color: var(--carnate-red);

            margin-right: 2px;
        }

        /* =========================================================
           ITEMS COUNT
        ========================================================== */

        .carnate-paid-order-page .cpo-item-count {
            display: inline-flex;

            align-items: center;

            padding: 6px 10px;

            border-radius: 8px;

            background: #f1f5f9;

            color: #475569;

            font-weight: 600;

            white-space: nowrap;
        }

        /* =========================================================
           STATUS BADGES
        ========================================================== */

        .carnate-paid-order-page .cpo-status {
            display: inline-flex;

            align-items: center;

            gap: 5px;

            padding: 6px 10px;

            border-radius: 999px;

            font-size: 11px;

            line-height: 1.2;

            font-weight: 700;

            white-space: nowrap;

            border: 1px solid transparent;
        }

        .carnate-paid-order-page .cpo-status i {
            font-size: 13px;
        }

        .carnate-paid-order-page .cpo-status-warning {
            color: #b45309;

            background: var(--carnate-orange-soft);

            border-color: #fde68a;
        }

        .carnate-paid-order-page .cpo-status-success {
            color: #15803d;

            background: var(--carnate-green-soft);

            border-color: #bbf7d0;
        }

        .carnate-paid-order-page .cpo-status-danger {
            color: #dc2626;

            background: var(--carnate-red-soft);

            border-color: #fecaca;
        }

        .carnate-paid-order-page .cpo-status-primary {
            color: #1d4ed8;

            background: var(--carnate-blue-soft);

            border-color: #bfdbfe;
        }

        .carnate-paid-order-page .cpo-status-info {
            color: #0e7490;

            background: var(--carnate-cyan-soft);

            border-color: #a5f3fc;
        }

        /* =========================================================
           REASON LINK
        ========================================================== */

        .carnate-paid-order-page .cpo-reason-link {
            margin-top: 5px;

            border: 0;

            text-decoration: none;

            cursor: pointer;
        }

        /* =========================================================
           ACTIONS
        ========================================================== */

        .carnate-paid-order-page .cpo-actions {
            display: flex;

            align-items: center;

            gap: 7px;

            white-space: nowrap;
        }

        .carnate-paid-order-page .cpo-action {
            width: 35px;
            height: 35px;

            padding: 0;

            border-radius: 9px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border: 1px solid var(--carnate-border);

            background: #ffffff;

            color: #64748b;

            text-decoration: none;

            cursor: pointer;

            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .carnate-paid-order-page .cpo-action:hover {
            transform: translateY(-1px);

            text-decoration: none;
        }

        .carnate-paid-order-page .cpo-action-view:hover {
            background: var(--carnate-red-soft);

            border-color: #fecaca;

            color: var(--carnate-red);
        }

        .carnate-paid-order-page .cpo-action-pdf:hover {
            background: var(--carnate-blue-soft);

            border-color: #bfdbfe;

            color: var(--carnate-blue);
        }

        .carnate-paid-order-page .cpo-action-print:hover {
            background: #f1f5f9;

            border-color: #cbd5e1;

            color: #334155;
        }

        .carnate-paid-order-page .cpo-action i {
            font-size: 16px;
        }

        /* =========================================================
           DETAIL PAGE
        ========================================================== */

        .carnate-paid-order-page .cpo-detail-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding: 20px 22px;
        }

        .carnate-paid-order-page .cpo-detail-heading {
            display: flex;

            align-items: center;

            gap: 12px;
        }

        .carnate-paid-order-page .cpo-detail-icon {
            width: 42px;
            height: 42px;

            border-radius: 11px;

            background: var(--carnate-red-soft);

            color: var(--carnate-red);

            display: inline-flex;

            align-items: center;
            justify-content: center;

            font-size: 20px;
        }

        .carnate-paid-order-page .cpo-detail-heading h4 {
            margin: 0;

            color: var(--carnate-text);

            font-size: 18px;

            font-weight: 700;
        }

        .carnate-paid-order-page .cpo-detail-heading span {
            display: block;

            margin-top: 3px;

            color: var(--carnate-muted);

            font-size: 12px;
        }

        .carnate-paid-order-page .cpo-back-btn {
            min-height: 40px;

            border-radius: 9px;

            border: 1px solid var(--carnate-border);

            background: #fff;

            color: #475569;

            padding: 0 14px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            font-size: 13px;

            font-weight: 600;

            text-decoration: none;

            cursor: pointer;

            transition: .2s ease;
        }

        .carnate-paid-order-page .cpo-back-btn:hover {
            background: #f8fafc;

            color: var(--carnate-text);

            border-color: #cbd5e1;

            text-decoration: none;
        }

        /* =========================================================
           ITEM IMAGE
        ========================================================== */

        .carnate-paid-order-page .cpo-item-cell {
            display: flex;

            align-items: center;

            gap: 10px;

            min-width: 190px;
        }

        .carnate-paid-order-page .cpo-item-image-link {
            display: inline-flex;

            flex: 0 0 auto;

            text-decoration: none;

            cursor: pointer;
        }

        .carnate-paid-order-page .cpo-item-image {
            width: 48px;
            height: 48px;

            object-fit: cover;

            border-radius: 10px;

            border: 1px solid var(--carnate-border);

            background: #f8fafc;

            transition: .2s ease;
        }

        .carnate-paid-order-page .cpo-item-image:hover {
            border-color: #fca5a5;

            transform: scale(1.03);
        }

        .carnate-paid-order-page .cpo-item-name {
            color: var(--carnate-text);

            font-size: 13px;

            font-weight: 600;
        }

        /* =========================================================
           TAX
        ========================================================== */

        .carnate-paid-order-page .cpo-price {
            font-weight: 600;

            color: var(--carnate-text);

            white-space: nowrap;
        }

        .carnate-paid-order-page .cpo-tax-info {
            color: #475569;

            white-space: nowrap;
        }

        .carnate-paid-order-page .cpo-tax-info small {
            display: block;

            margin-top: 3px;

            color: var(--carnate-light);

            font-size: 10px;
        }

        .carnate-paid-order-page .cpo-total {
            color: var(--carnate-text);

            font-weight: 700;

            white-space: nowrap;
        }

        /* =========================================================
           IMAGE MODAL
        ========================================================== */

        .carnate-paid-order-page .cpo-image-modal {
            background: rgba(15, 23, 42, .65) !important;
        }

        .carnate-paid-order-page .cpo-image-modal .modal-dialog {
            max-width: 720px;
        }

        .carnate-paid-order-page .cpo-image-modal .modal-content {
            border: 0;

            border-radius: 17px;

            overflow: hidden;

            box-shadow:
                0 24px 70px rgba(15, 23, 42, .22);
        }

        .carnate-paid-order-page .cpo-modal-header {
            padding: 17px 20px;

            border-bottom: 1px solid var(--carnate-border);

            background: #fff;

            display: flex;

            align-items: center;

            justify-content: space-between;
        }

        .carnate-paid-order-page .cpo-modal-title {
            display: flex;

            align-items: center;

            gap: 8px;

            margin: 0;

            font-size: 17px;

            font-weight: 700;

            color: var(--carnate-text);
        }

        .carnate-paid-order-page .cpo-modal-title i {
            color: var(--carnate-red);

            font-size: 19px;
        }

        .carnate-paid-order-page .cpo-modal-close {
            border: 0;

            background: #f1f5f9;

            width: 34px;
            height: 34px;

            border-radius: 9px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            color: #64748b;

            cursor: pointer;
        }

        .carnate-paid-order-page .cpo-modal-close:hover {
            background: var(--carnate-red-soft);

            color: var(--carnate-red);
        }

        .carnate-paid-order-page .cpo-image-body {
            padding: 22px;

            background: #f8fafc;
        }

        .carnate-paid-order-page .cpo-large-image {
            display: block;

            width: 100%;

            max-height: 620px;

            object-fit: contain;

            border-radius: 12px;

            background: #fff;

            border: 1px solid var(--carnate-border);
        }

        /* =========================================================
           REASON MODAL
        ========================================================== */

        .carnate-paid-order-page .cpo-reason-modal {
            background: rgba(15, 23, 42, .65) !important;
        }

        .carnate-paid-order-page .cpo-reason-modal .modal-dialog {
            max-width: 760px;
        }

        .carnate-paid-order-page .cpo-reason-modal .modal-content {
            border: 0;

            border-radius: 17px;

            overflow: hidden;

            box-shadow:
                0 24px 70px rgba(15, 23, 42, .22);
        }

        .carnate-paid-order-page .cpo-reason-body {
            padding: 22px;
        }

        .carnate-paid-order-page .cpo-reason-label {
            display: block;

            margin-bottom: 8px;

            color: var(--carnate-text);

            font-size: 13px;

            font-weight: 700;
        }

        .carnate-paid-order-page .cpo-reason-required {
            color: var(--carnate-red);
        }

        .carnate-paid-order-page .cpo-textarea {
            width: 100%;

            min-height: 125px;

            border: 1px solid var(--carnate-border);

            border-radius: 11px;

            padding: 13px 14px;

            resize: vertical;

            font-size: 13px;

            color: var(--carnate-text);

            outline: none;

            transition: .2s ease;
        }

        .carnate-paid-order-page .cpo-textarea:focus {
            border-color: rgba(229, 57, 53, .45);

            box-shadow:
                0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-paid-order-page .cpo-modal-footer {
            padding: 15px 20px;

            border-top: 1px solid var(--carnate-border);

            background: #fff;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 8px;
        }

        .carnate-paid-order-page .cpo-secondary-btn {
            min-height: 40px;

            padding: 0 15px;

            border-radius: 9px;

            border: 1px solid var(--carnate-border);

            background: #f8fafc;

            color: #475569;

            font-size: 13px;

            font-weight: 600;

            cursor: pointer;
        }

        .carnate-paid-order-page .cpo-secondary-btn:hover {
            background: #f1f5f9;

            color: var(--carnate-text);
        }

        .carnate-paid-order-page .cpo-primary-btn {
            min-height: 40px;

            padding: 0 17px;

            border-radius: 9px;

            border: 1px solid var(--carnate-red);

            background: var(--carnate-red);

            color: #fff;

            font-size: 13px;

            font-weight: 600;

            cursor: pointer;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;
        }

        .carnate-paid-order-page .cpo-primary-btn:hover {
            background: var(--carnate-red-dark);

            color: #fff;
        }

        /* =========================================================
           PAGINATION
        ========================================================== */

        .carnate-paid-order-page .cpo-pagination {
            padding: 17px 22px;

            border-top: 1px solid var(--carnate-border);

            background: #fff;
        }

        .carnate-paid-order-page .cpo-pagination .pagination {
            margin: 0;
        }

        /* =========================================================
           EMPTY
        ========================================================== */

        .carnate-paid-order-page .cpo-empty {
            padding: 55px 20px !important;

            text-align: center;

            color: var(--carnate-muted);
        }

        .carnate-paid-order-page .cpo-empty-icon {
            width: 52px;
            height: 52px;

            margin: 0 auto 12px;

            border-radius: 14px;

            background: #f1f5f9;

            color: #94a3b8;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 24px;
        }

        .carnate-paid-order-page .cpo-empty-text {
            font-size: 13px;

            font-weight: 600;

            color: #64748b;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 991px) {

            .carnate-paid-order-page .cpo-filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .carnate-paid-order-page .cpo-filter-grid > :last-child {
                grid-column: span 2;
            }

            .carnate-paid-order-page .cpo-clear-btn {
                width: 100%;
            }

        }

        @media (max-width: 767px) {

            .carnate-paid-order-page .cpo-header-card {
                padding: 17px;

                align-items: flex-start;
            }

            .carnate-paid-order-page .cpo-heading h3 {
                font-size: 20px;
            }

            .carnate-paid-order-page .cpo-filter-grid {
                grid-template-columns: 1fr;
            }

            .carnate-paid-order-page .cpo-filter-grid > :last-child {
                grid-column: auto;
            }

            .carnate-paid-order-page .cpo-card-body {
                padding: 15px;
            }

            .carnate-paid-order-page .cpo-detail-header {
                align-items: flex-start;

                flex-direction: column;
            }

            .carnate-paid-order-page .cpo-back-btn {
                width: 100%;
            }

        }

        @media (max-width: 575px) {

            .carnate-paid-order-page .cpo-heading-icon {
                width: 40px;
                height: 40px;
                min-width: 40px;

                font-size: 19px;
            }

            .carnate-paid-order-page .cpo-heading h3 {
                font-size: 18px;
            }

            .carnate-paid-order-page .cpo-heading p {
                font-size: 12px;
            }

            .carnate-paid-order-page .cpo-filter-card {
                padding: 15px;
            }

        }
    </style>


    {{-- =========================================================
        IMAGE MODAL
        FUNCTIONAL CODE PRESERVED
    ========================================================== --}}

    <div class="modal @if ($shoImageModel) show @endif cpo-image-modal"
         tabindex="-1"
         style="opacity:1; background-color:#0606068c; display:@if ($shoImageModel) block @endif">

        <div class="modal-dialog modal-s">

            <div class="modal-content">

                <div class="cpo-modal-header">

                    <h4 class="cpo-modal-title">
                        <i class="bx bx-image"></i>
                        Image
                    </h4>

                    <button
                        type="button"
                        class="cpo-modal-close"
                        wire:click="clodeImageModel"
                        data-bs-dismiss="modal"
                        aria-label="Close">

                        <i class="bx bx-x"></i>

                    </button>

                </div>


                <div class="cpo-image-body">

                    <div class="row g-3">

                        <div class="col-md-12">

                            <div class="form-group">

                                @if(!empty($imageitem))

                                    @if (!empty($imageitem->SpareParts->Image->file))

                                        <img
                                            src="{{ asset($imageitem->SpareParts->Image->file) }}"
                                            alt="Maintenance Service Parts"
                                            class="cpo-large-image">

                                    @else

                                        @if($imageitem->SpareParts->spare_part_type ==1)

                                            <img
                                                src="{{ asset('img/accessory.png') }}"
                                                alt="Maintenance Service Parts"
                                                class="cpo-large-image">

                                        @elseif($imageitem->SpareParts->spare_part_type ==2)

                                            <img
                                                src="{{ asset('img/spareparts.jpg') }}"
                                                alt="Maintenance Service Parts"
                                                class="cpo-large-image">

                                        @elseif($imageitem->SpareParts->spare_part_type ==3)

                                            <img
                                                src="{{ asset('img/tools.jpg') }}"
                                                alt="Maintenance Service Parts"
                                                class="cpo-large-image">

                                        @else

                                            <img
                                                src="{{ asset('img/lubricant.jpg') }}"
                                                alt="Maintenance Service Parts"
                                                class="cpo-large-image">

                                        @endif

                                    @endif

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        REASON MODAL
        FUNCTIONAL CODE PRESERVED
    ========================================================== --}}

    <div class="modal @if ($showReasonModel) show @endif cpo-reason-modal"
         tabindex="-1"
         style="opacity:1; background-color:#0606068c; display:@if ($showReasonModel) block @endif">

        <div class="modal-dialog modal-xl">

            <div class="modal-content">

                <form wire:submit.prevent="declinereasonStore">

                    <div class="cpo-modal-header">

                        <h4 class="cpo-modal-title">

                            <i class="bx bx-message-square-error"></i>

                            {{$statusReason}} Reason

                        </h4>

                        <button
                            type="button"
                            class="cpo-modal-close"
                            wire:click="clodeReasonModel"
                            data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    <div class="cpo-reason-body">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label class="cpo-reason-label">

                                        {{$statusReason}} Reason

                                        <sup class="cpo-reason-required">*</sup>

                                    </label>

                                    <textarea
                                        wire:model="decline_reason"
                                        class="cpo-textarea"
                                        rows="4"
                                        placeholder="Enter Reason"></textarea>

                                </div>

                                @error('decline_reason')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>

                        </div>

                    </div>


                    @if(empty($decline_reason))

                        <div class="cpo-modal-footer">

                            <button
                                type="button"
                                class="cpo-secondary-btn"
                                wire:click="clodeReasonModel"
                                data-bs-dismiss="modal">

                                Cancel

                            </button>


                            <button
                                type="submit"
                                class="cpo-primary-btn">

                                Create

                                <i
                                    class="spinner-border spinner-border-sm"
                                    wire:loading>
                                </i>

                            </button>

                        </div>

                    @endif

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
        ORDER DETAIL
        ALL ORIGINAL LIVEWIRE METHODS PRESERVED
    ========================================================== --}}

    @if ($showOrderItem)

        <div class="cpo-page-header">

            <div class="cpo-card">

                <div class="cpo-detail-header">

                    <div class="cpo-detail-heading">

                        <div class="cpo-detail-icon">

                            <i class="bx bx-package"></i>

                        </div>

                        <div>

                            <h4>
                                Order Item
                            </h4>

                            <span>
                                View the items included in this order
                            </span>

                        </div>

                    </div>


                    <div>

                        <a
                            href="javascript:void(0);"
                            wire:click="back"
                            class="cpo-back-btn">

                            <i class="bx bx-arrow-back"></i>

                            Back

                        </a>

                    </div>

                </div>

            </div>

        </div>


        <div class="cpo-card">

            @if (!empty($orders->orderItem) && count($orders->orderItem))

                <div class="cpo-table-wrap">

                    <table class="cpo-table">

                        <thead>

                            <tr>

                                <th>S.No.</th>

                                <th>Spare Part</th>

                                <th>Category</th>

                                <th>Rack No.</th>

                                <th>Part Number</th>

                                <th>Quantity</th>

                                <th>Price</th>

                                <th>GST Rate</th>

                                <th>GST Amount</th>

                                <th>Total Amount</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($orders->orderItem as $index => $order_item)

                                <tr>

                                    <td>

                                        <span class="cpo-item-count">

                                            {{ $loop->iteration }}

                                        </span>

                                    </td>


                                    {{-- SPARE PART --}}

                                    <td>

                                        <div class="cpo-item-cell">

                                            <a
                                                href="javascript:void(0);"
                                                wire:click="shoImage({{$order_item->id}})"
                                                class="cpo-item-image-link">

                                                @if (!empty($order_item->SpareParts->Image->file))

                                                    <img
                                                        src="{{ asset($order_item->SpareParts->Image->file) }}"
                                                        alt="Maintenance Service Parts"
                                                        class="cpo-item-image">

                                                @else

                                                    @if($order_item->SpareParts->spare_part_type ==1)

                                                        <img
                                                            src="{{ asset('img/accessory.png') }}"
                                                            alt="Maintenance Service Parts"
                                                            class="cpo-item-image">

                                                    @elseif($order_item->SpareParts->spare_part_type ==2)

                                                        <img
                                                            src="{{ asset('img/spareparts.jpg') }}"
                                                            alt="Maintenance Service Parts"
                                                            class="cpo-item-image">

                                                    @elseif($order_item->SpareParts->spare_part_type ==3)

                                                        <img
                                                            src="{{ asset('img/tools.jpg') }}"
                                                            alt="Maintenance Service Parts"
                                                            class="cpo-item-image">

                                                    @else

                                                        <img
                                                            src="{{ asset('img/lubricant.jpg') }}"
                                                            alt="Maintenance Service Parts"
                                                            class="cpo-item-image">

                                                    @endif

                                                @endif

                                            </a>


                                            <span class="cpo-item-name">

                                                {{ $order_item?->SpareParts?->name ?? '-' }}

                                            </span>

                                        </div>

                                    </td>


                                    {{-- CATEGORY --}}

                                    <td>

                                        @switch($order_item->category)

                                            @case(1)

                                                <span class="cpo-status cpo-status-primary">

                                                    <i class="bx bx-package"></i>

                                                    Accessory

                                                </span>

                                            @break


                                            @case(2)

                                                <span class="cpo-status cpo-status-success">

                                                    <i class="bx bx-cog"></i>

                                                    Parts

                                                </span>

                                            @break


                                            @case(3)

                                                <span class="cpo-status cpo-status-warning">

                                                    <i class="bx bx-wrench"></i>

                                                    Tools

                                                </span>

                                            @break


                                            @case(4)

                                                <span class="cpo-status cpo-status-info">

                                                    <i class="bx bx-droplet"></i>

                                                    Lubricants

                                                </span>

                                            @break


                                            @default

                                        @endswitch

                                    </td>


                                    {{-- RACK --}}

                                    <td>

                                        <span class="cpo-price">

                                            {{ $order_item->SpareParts->rack_no ?? 'Null'}}

                                        </span>

                                    </td>


                                    {{-- PART NUMBER --}}

                                    <td>

                                        <span class="cpo-price">

                                            {{ $order_item->SpareParts->part_number ?? 'Null' }}

                                        </span>

                                    </td>


                                    {{-- QUANTITY --}}

                                    <td>

                                        <span class="cpo-item-count">

                                            {{ $order_item->quantity }}

                                        </span>

                                    </td>


                                    @php

                                        $tax_type = $order_item->SpareParts?->tax_type ?? 'include';

                                        $tax_percentage = (float)($order_item->SpareParts?->tax_percentage ?? 0);

                                        $total_amount = (float)$order_item->total_amount;

                                        if ($tax_type === 'include') {

                                            // Tax is included in the total amount

                                            $taxableVal = $total_amount / (1 + ($tax_percentage / 100));

                                            $gstVal = $total_amount - $taxableVal;

                                            $payableVal = $total_amount;

                                        } else {

                                            // Tax is excluded from the total amount

                                            $taxableVal = $total_amount;

                                            $gstVal = $total_amount * ($tax_percentage / 100);

                                            $payableVal = $total_amount + $gstVal;

                                        }

                                    @endphp


                                    {{-- PRICE --}}

                                    <td>

                                        <span class="cpo-price">

                                            ₹ {{ number_format($taxableVal, 2) }}

                                        </span>

                                    </td>


                                    {{-- GST RATE --}}

                                    <td>

                                        <span class="cpo-tax-info">

                                            {{ $order_item->SpareParts?->tax_percentage ?? 0 }}%

                                            <small>

                                                ({{ ucfirst($order_item->SpareParts?->tax_type ?? 'include') }})

                                            </small>

                                        </span>

                                    </td>


                                    {{-- GST AMOUNT --}}

                                    <td>

                                        <span class="cpo-price">

                                            ₹ {{ number_format($gstVal, 2) }}

                                        </span>

                                    </td>


                                    {{-- TOTAL AMOUNT --}}

                                    <td>

                                        <span class="cpo-total">

                                            ₹ {{ number_format($payableVal, 2) }}

                                        </span>

                                    </td>


                                    {{-- STATUS --}}

                                    <td>

                                        @if ($order_item->status == 0 )

                                            <p
                                                class="cpo-status cpo-status-warning mb-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Awaiting acceptance/rejection from Spare Part Vendor">

                                                <i class="bx bx-time-five"></i>

                                                Pending

                                            </p>


                                        @elseif($order_item->status == 1)

                                            <p
                                                class="cpo-status cpo-status-success mb-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Item accepted by Spare Part Vendor; awaiting Handover">

                                                <i class="bx bx-check-circle"></i>

                                                Accepted

                                            </p>


                                        @elseif($order_item->status == 2)

                                            <p
                                                class="cpo-status cpo-status-danger mb-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Item declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">

                                                <i class="bx bx-x-circle"></i>

                                                Declined

                                            </p>


                                            <a
                                                class="cpo-status cpo-status-danger cpo-reason-link"
                                                href="javascript:void(0);"
                                                wire:click="showdeclineorder({{ $order_item->id }},2)"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Item declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">

                                                <i class="bx bx-message-square-detail"></i>

                                                Declined Reason

                                            </a>


                                        @elseif($order_item->status == 3)

                                            <p
                                                class="cpo-status cpo-status-success mb-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Items handed over by Spare Part Vendor; awaiting your receipt">

                                                <i class="bx bx-package"></i>

                                                Handover

                                            </p>


                                        @elseif($order_item->status == 4)

                                            <p
                                                class="cpo-status cpo-status-primary mb-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Items successfully received by Workshop">

                                                <i class="bx bx-check-double"></i>

                                                Received

                                            </p>


                                        @elseif($order_item->status == 5)

                                            <p
                                                class="cpo-status cpo-status-info mb-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}">

                                                <i class="bx bx-time"></i>

                                                Delayed

                                            </p>


                                            <a
                                                class="cpo-status cpo-status-info cpo-reason-link"
                                                href="javascript:void(0);"
                                                wire:click="showdeclineorder({{ $order_item->id }},5)"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}">

                                                <i class="bx bx-message-square-detail"></i>

                                                Delayed Reason

                                            </a>

                                        @endif

                                    </td>


                                    {{-- ACTIONS --}}

                                    <td>

                                        <div class="cpo-actions">

                                            @if ($order_item->status == 3 && $order_item->payment_status == 1)

                                                <button
                                                    type="button"
                                                    wire:click="received({{ $order_item->id }},4)"
                                                    class="cpo-primary-btn">

                                                    <i class="bx bx-check"></i>

                                                    Received

                                                </button>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>


                    <div class="pagination-wrapper">

                        {{-- {{ $orders->links() }} --}}

                    </div>

                </div>

            @else

                <div class="cpo-card-body">

                    <div class="cpo-empty">

                        <div class="cpo-empty-icon">

                            <i class="bx bx-package"></i>

                        </div>

                        <div class="cpo-empty-text">

                            No Order found!

                        </div>

                    </div>

                </div>

            @endif

        </div>


    @else


        {{-- =========================================================
            DECLINE REASON MODAL
            ORIGINAL FUNCTIONAL CODE PRESERVED
        ========================================================== --}}

        <div
            class="modal @if ($showReasonModel) show @endif cpo-reason-modal"
            tabindex="-1"
            style="opacity:1; background-color:#0606068c; display:@if ($showReasonModel) block @endif">

            <div class="modal-dialog modal-xl">

                <div class="modal-content">

                    <form wire:submit.prevent="declinereasonStore">

                        <div class="cpo-modal-header">

                            <h4 class="cpo-modal-title">

                                <i class="bx bx-message-square-error"></i>

                                Decline Reason

                            </h4>


                            <button
                                type="button"
                                class="cpo-modal-close"
                                wire:click="$set('showReasonModel', false)"
                                data-bs-dismiss="modal"
                                aria-label="Close">

                                <i class="bx bx-x"></i>

                            </button>

                        </div>


                        <div class="cpo-reason-body">

                            @csrf

                            <div class="row g-3">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label class="cpo-reason-label">

                                            Decline Reason

                                            <sup class="cpo-reason-required">*</sup>

                                        </label>


                                        <textarea
                                            wire:model="decline_reason"
                                            class="cpo-textarea"
                                            rows="4"
                                            placeholder="Enter Reason"></textarea>

                                    </div>


                                    @error('decline_reason')

                                        <span class="text-danger error">

                                            {{ $message }}

                                        </span>

                                    @enderror

                                </div>

                            </div>

                        </div>


                        @if (empty($decline_reason))

                            <div class="cpo-modal-footer">

                                <button
                                    type="button"
                                    class="cpo-secondary-btn"
                                    wire:click="$set('showReasonModel', false)"
                                    data-bs-dismiss="modal">

                                    Cancel

                                </button>


                                <button
                                    type="submit"
                                    class="cpo-primary-btn">

                                    Create

                                    <i
                                        class="spinner-border spinner-border-sm"
                                        wire:loading>
                                    </i>

                                </button>

                            </div>

                        @endif

                    </form>

                </div>

            </div>

        </div>


        {{-- =========================================================
            ORDER LIST HEADER
        ========================================================== --}}

        <div class="cpo-page-header">

            <div class="cpo-header-card">

                <div class="cpo-heading">

                    <div class="cpo-heading-icon">

                        <i class="bx bx-receipt"></i>

                    </div>

                    <div>

                        <h3>
                            Order List
                        </h3>

                        <p>
                            View and manage paid workshop orders.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            FILTER CARD
        ========================================================== --}}

        <div class="cpo-card">

            <div class="cpo-filter-card">

                <div class="cpo-filter-grid">

                    {{-- SEARCH --}}

                    <div class="cpo-field">

                        <i class="bx bx-search cpo-field-icon"></i>

                        <input
                            type="text"
                            class="cpo-input has-icon"
                            placeholder="Search Order No."
                            wire:model.live="searchfilter"
                            fdprocessedid="blgf5">

                    </div>


                    {{-- DATE --}}

                    <div class="cpo-field">

                        <i class="bx bx-calendar cpo-field-icon"></i>

                        <input
                            class="cpo-input has-icon"
                            placeholder="Pick Dates"
                            id="kt_daterangepicker_1"/>

                    </div>


                    {{-- CLEAR --}}

                    <div>

                        <button
                            type="button"
                            class="cpo-clear-btn"
                            wire:click="resetFilter"
                            fdprocessedid="orntg">

                            <i class="bx bx-reset"></i>

                            Clear

                        </button>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            ORDER TABLE
        ========================================================== --}}

        <div class="cpo-card" style="margin-top:18px;">

            @if (!empty($items) && $items->count())

                <div class="cpo-table-wrap">

                    <table class="cpo-table">

                        <thead>

                            <tr>

                                <th>Order No.</th>

                                <th>Order Date</th>

                                <th>Total Amount</th>

                                <th>Total Items</th>

                                <th>Dealer Pending</th>

                                <th>Ready to Receive</th>

                                <th>Payment Status</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <tbody>

                            @php
                                $visible = false;
                            @endphp


                            @foreach ($items as $index => $order)

                                <tr>

                                    {{-- ORDER NO --}}

                                    <td>

                                        <span class="cpo-order-number">

                                            <span class="cpo-order-icon">

                                                <i class="bx bx-receipt"></i>

                                            </span>

                                            #{{ $order->id }}

                                        </span>

                                    </td>


                                    {{-- ORDER DATE --}}

                                    <td>

                                        <span class="cpo-date">

                                            {{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y h:i A') }}

                                        </span>

                                    </td>


                                    {{-- TOTAL AMOUNT --}}

                                    <td>

                                        <span class="cpo-amount">

                                            <span class="cpo-currency">₹</span>

                                            {{ number_format($order->total_amount, 2) }}

                                        </span>

                                    </td>


                                    {{-- TOTAL ITEMS --}}

                                    <td>

                                        <span class="cpo-item-count">

                                            <i class="bx bx-package me-1"></i>

                                            {{ $order->total_item }} Items

                                        </span>

                                    </td>


                                    {{-- DEALER PENDING --}}

                                    <td>

                                        <span class="cpo-status cpo-status-warning">

                                            <i class="bx bx-time-five"></i>

                                            {{ $order->orderItem->where('status',1)->count() }}

                                            Items

                                        </span>

                                    </td>


                                    {{-- READY TO RECEIVE --}}

                                    <td>

                                        <span class="cpo-status cpo-status-primary">

                                            <i class="bx bx-package"></i>

                                            {{ $order->orderItem->where('status',3)->count() }}

                                            Items

                                        </span>

                                    </td>


                                    {{-- PAYMENT STATUS --}}

                                    <td>

                                        @switch($order->payment_status)

                                            @case(0)

                                                <p
                                                    class="cpo-status cpo-status-danger mb-0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Awaiting payment from Workshop">

                                                    <i class="bx bx-time-five"></i>

                                                    Payment Pending

                                                </p>

                                            @break


                                            @case(1)

                                                <p
                                                    class="cpo-status cpo-status-success mb-0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Payment received successfully from Workshop">

                                                    <i class="bx bx-check-circle"></i>

                                                    Payment Success

                                                </p>

                                            @break


                                            @case(2)

                                                <p
                                                    class="cpo-status cpo-status-success mb-0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Partially paid by Workshop">

                                                    <i class="bx bx-adjust"></i>

                                                    Partially Paid

                                                </p>

                                            @break

                                        @endswitch

                                    </td>


                                    {{-- ORDER STATUS --}}

                                    <td>

                                        @switch($order->order_status)

                                            @case(1)

                                                <p
                                                    class="cpo-status cpo-status-success mb-0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Order accepted by Spare Part Vendor; awaiting Handover">

                                                    <i class="bx bx-check-circle"></i>

                                                    Accepted

                                                </p>

                                            @break


                                            @case(0)

                                                <p
                                                    class="cpo-status cpo-status-danger mb-0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Awaiting acceptance/rejection from Spare Part Vendor">

                                                    <i class="bx bx-time-five"></i>

                                                    Pending

                                                </p>

                                            @break


                                            @case(3)

                                                <p
                                                    class="cpo-status cpo-status-primary mb-0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Items handed over by Spare Part Vendor; awaiting receipt by Workshop">

                                                    <i class="bx bx-package"></i>

                                                    Handover

                                                </p>

                                            @break


                                            @case(4)

                                                <p
                                                    class="cpo-status cpo-status-info mb-0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Items successfully received by Workshop">

                                                    <i class="bx bx-check-double"></i>

                                                    Received

                                                </p>

                                            @break


                                            @case(2)

                                                <p
                                                    class="cpo-status cpo-status-danger mb-0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{ $order->decline_reason }}">

                                                    <i class="bx bx-x-circle"></i>

                                                    Decline

                                                </p>


                                                <a
                                                    class="cpo-status cpo-status-info cpo-reason-link"
                                                    href="javascript:void(0);"
                                                    wire:click="declineorder({{ $order->id }},2)"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{ $order->decline_reason }}">

                                                    <i class="bx bx-message-square-detail"></i>

                                                    Declined Reason

                                                </a>

                                            @break

                                        @endswitch

                                    </td>


                                    {{-- ACTIONS --}}
                                    {{-- EXACT ORIGINAL LIVEWIRE ACTIONS PRESERVED --}}

                                    <td>

                                        <div class="cpo-actions">

                                            <a
                                                href="javascript:void(0);"
                                                class="cpo-action cpo-action-view"
                                                wire:click="viewItem({{ $order->id }})"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="View Item">

                                                <i class="bx bx-show"></i>

                                            </a>


                                            <a
                                                href="{{route('getWorkshopinvoPdf',[encrypt($order->id),encrypt(0)])}}"
                                                target="_blank"
                                                class="cpo-action cpo-action-pdf"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Download Invoice">

                                                <i class="fa fa-file-pdf"></i>

                                            </a>


                                            <a
                                                href="{{route('getWorkshopinvoPdf',[encrypt($order->id),encrypt(1)])}}"
                                                target="_blank"
                                                class="cpo-action cpo-action-print"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Print Invoice">

                                                <i
                                                    class="fa fa-print"
                                                    style="font-size: small;">
                                                </i>

                                            </a>


                                            {{-- ORIGINAL DELETE FUNCTIONALITY --}}

                                            {{-- @if ($order->order_status == 2)

                                                <a
                                                    wire:click="confirmDelete({{ $order->id }})"
                                                    class="btn btn-sm btn-danger">

                                                    Delete

                                                    <span class="small"></span>

                                                </a>

                                            @endif --}}


                                            {{-- ORIGINAL PAY NOW FUNCTIONALITY --}}

                                            {{-- @if (array_sum($totalAmounts) > 0)

                                                <button
                                                    href="javascript:void(0);"
                                                    class="btn btn-primary "

                                                    @if (in_array(0, $orderStatus) || in_array(2, $orderStatus))
                                                        disabled
                                                    @endif

                                                    wire:click="createOrder('{{ implode(',', $orderIds) }}','{{ implode(',', $totalAmounts) }}')">

                                                    Pay Now
                                                    (₹{{ array_sum($totalAmounts) }})

                                                </button>

                                            @endif --}}

                                        </div>

                                    </td>

                                </tr>


                                @php

                                    $orderIds[] = $order->id;

                                    $totalAmounts[] = $order->total_amount;

                                    $orderStatus[] = $order->order_status;

                                @endphp

                            @endforeach


                            @unless($visible)

                                <tr>

                                    <td
                                        colspan="10"
                                        class="cpo-empty">

                                        <div class="cpo-empty-icon">

                                            <i class="bx bx-receipt"></i>

                                        </div>

                                        <div class="cpo-empty-text">

                                            No pending orders found.

                                        </div>

                                    </td>

                                </tr>

                            @endunless

                        </tbody>

                    </table>


                    {{-- PAGINATION --}}

                    <div class="cpo-pagination">

                        {{ $items->links() }}

                    </div>

                </div>

            @else

                <div class="cpo-card-body">

                    <div class="cpo-empty">

                        <div class="cpo-empty-icon">

                            <i class="bx bx-shopping-bag"></i>

                        </div>

                        <div class="cpo-empty-text">

                            No Order Cart Found!

                        </div>

                    </div>

                </div>

            @endif

        </div>

    @endif


    {{-- =========================================================
        ORIGINAL FOOTER SCRIPT
        FUNCTIONAL LOGIC PRESERVED
    ========================================================== --}}

    @section('footerscript')

        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        <script>

            function validateMaxQuantity(input) {

                // Get the max quantity value
                var maxQuantity = parseInt(input.getAttribute('max'));

                // If the current value exceeds max quantity, reset it to max
                if (parseInt(input.value) > maxQuantity) {

                    input.value = maxQuantity;

                }

            }


            document.addEventListener('razorpay-show', (event) => {

                // Access event data using event.detail

                amount = event.__livewire.params[0].amount;

                orderId = event.__livewire.params[0].orderId;

                order_id = event.__livewire.params[0].order_id;


                var options = {

                    //  "key": "{{ env('RAZORPAY_KEY') }}",

                    "key": "{{ config('services.razorpay.key') }}",

                    "amount": amount * 100,

                    "currency": "INR",

                    "order_id": orderId,

                    "name": "Test Payment",

                    "description": "Payment for product/service",

                    "image": "https://example.com/your-logo.png",

                    "handler": function(response) {

                        console.log(response)

                        // Example data to send

                        const paymentResponse = {

                            razorpay_payment_id:
                                response.razorpay_payment_id,

                            razorpay_order_id:
                                response.razorpay_order_id,

                            amount: amount,

                            order_id: order_id,

                        };


                        Livewire.dispatch('storePayment', {

                            paymentResponse: paymentResponse

                        });

                    },

                    "prefill": {

                        "name":
                            @json(Auth::guard('workshop')->user()->name),

                        "email":
                            @json(Auth::guard('workshop')->user()->email),

                        "contact":
                            @json(Auth::guard('workshop')->user()->mobile_no)

                    },

                    "theme": {

                        "color": "#009dec"

                    }

                };


                var rzp1 = new Razorpay(options);

                rzp1.open();

                event.preventDefault();

            });


            document.addEventListener('livewire:init', function () {

                $("#kt_daterangepicker_1").daterangepicker({

                    locale: {

                        cancelLabel: 'Clear',

                    },

                    ranges: {

                        'Today':
                            [moment(), moment()],

                        'Yesterday':
                            [
                                moment().subtract(1, 'days'),
                                moment().subtract(1, 'days')
                            ],

                        'Last 7 Days':
                            [
                                moment().subtract(6, 'days'),
                                moment()
                            ],

                        'Last 30 Days':
                            [
                                moment().subtract(29, 'days'),
                                moment()
                            ],

                        'This Month':
                            [
                                moment().startOf('month'),
                                moment().endOf('month')
                            ],

                        'Last Month':
                            [
                                moment().subtract(1, 'month').startOf('month'),
                                moment().subtract(1, 'month').endOf('month')
                            ],

                    },

                });


                $('#kt_daterangepicker_1').on(
                    'apply.daterangepicker',
                    function(ev, picker) {

                        let startDate =
                            picker.startDate.format('YYYY-MM-DD');

                        let endDate =
                            picker.endDate.format('YYYY-MM-DD');


                        @this.set('startDate', startDate);

                        @this.set('endDate', endDate);

                    }
                );


                $('#kt_daterangepicker_1').on(
                    'cancel.daterangepicker',
                    function(ev, picker) {

                        @this.set('startDate', null);

                        @this.set('endDate', null);

                    }
                );


                tooltipLivewire();


                Livewire.hook('morphed', (message, component) => {

                    tooltipLivewire();

                });

            });


            // Re-initialize tooltips after Livewire updates

            document.addEventListener(
                'livewire:navigated',
                function () {

                    tooltipLivewire();

                }
            );


            function tooltipLivewire() {

                var tooltipTriggerList =
                    [].slice.call(
                        document.querySelectorAll(
                            '[data-bs-toggle="tooltip"]'
                        )
                    );


                tooltipTriggerList.forEach(function(tooltipTriggerEl) {

                    var tooltipInstance =
                        bootstrap.Tooltip.getInstance(
                            tooltipTriggerEl
                        );


                    if (tooltipInstance) {

                        tooltipInstance.dispose();

                    }

                });


                tooltipTriggerList.map(function(tooltipTriggerEl) {

                    return new bootstrap.Tooltip(
                        tooltipTriggerEl
                    );

                });

            }

        </script>

    @endsection

</div>