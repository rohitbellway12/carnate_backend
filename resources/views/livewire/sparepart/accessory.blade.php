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

            --c-bg: #f7f8fa;
            --c-white: #ffffff;
            --c-text: #111827;
            --c-muted: #64748b;
            --c-border: #e2e8f0;
            --c-red: #e53935;
            --c-red-dark: #cf302d;
            --c-red-soft: #fff5f5;
            --c-icon: #f1f5f9;

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


        /* =====================================================
           MODAL
        ====================================================== */

        .carnate-modal {
            border: 0 !important;
            border-radius: 14px !important;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .22);
        }

        .carnate-modal-header {
            padding: 17px 20px;
            background: #fff;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-modal-title {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .carnate-modal-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--c-red-soft);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .carnate-modal-title h4 {
            margin: 0 0 2px;
            color: var(--c-text);
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-modal-title p {
            margin: 0;
            color: var(--c-muted);
            font-size: 11px;
        }

        .carnate-close {
            width: 34px;
            height: 34px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
        }

        .carnate-close:hover {
            background: var(--c-red-soft);
            color: var(--c-red);
            border-color: rgba(229, 57, 53, .2);
        }

        .carnate-modal-body {
            padding: 21px 20px;
            background: #fff;
            max-height: calc(100vh - 190px);
            overflow-y: auto;
        }

        .carnate-modal-footer {
            padding: 13px 20px;
            background: #fafbfc;
            border-top: 1px solid var(--c-border);
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }


        /* =====================================================
           FORM FIELDS
        ====================================================== */

        .carnate-field {
            margin-bottom: 2px;
        }

        .carnate-field > label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-field > label span:not(.carnate-auto-label) {
            color: var(--c-red);
        }

        .carnate-input-wrap {
            min-height: 43px;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 11px;
            background: #fff;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            transition: .18s ease;
        }

        .carnate-input-wrap:focus-within {
            border-color: rgba(229, 57, 53, .4);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .06);
        }

        .carnate-input-wrap > i {
            color: #94a3b8;
            font-size: 17px;
            flex-shrink: 0;
        }

        .carnate-input-wrap input,
        .carnate-input-wrap select {
            width: 100%;
            min-width: 0;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            background: transparent;
            color: var(--c-text);
            font-size: 13px;
        }

        .carnate-input-wrap select {
            padding-left: 0;
        }

        .carnate-input-wrap input::placeholder {
            color: #94a3b8;
        }

        .carnate-readonly {
            background: #f8fafc;
        }

        .carnate-currency {
            color: #64748b;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-input-suffix {
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-auto-label {
            display: inline-block;
            margin-left: 5px;
            padding: 2px 5px;
            border-radius: 4px;
            background: #f1f5f9;
            color: #64748b !important;
            font-size: 8px;
            font-weight: 750;
            vertical-align: middle;
        }

        .carnate-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-loading-text {
            margin-top: 5px;
            color: #64748b;
            font-size: 10px;
        }


        /* =====================================================
           NAME FIELD
        ====================================================== */

        .carnate-name-row {
            display: flex;
            gap: 7px;
        }

        .carnate-select-wrap {
            flex: 1;
            min-width: 0;
            height: 43px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 11px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
        }

        .carnate-select-wrap > i {
            color: #94a3b8;
            font-size: 17px;
        }

        .carnate-select-wrap select {
            width: 100%;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            font-size: 13px;
            background: transparent;
        }

        .carnate-add-small {
            width: 43px;
            height: 43px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            transition: .16s ease;
            flex-shrink: 0;
        }

        .carnate-add-small:hover {
            background: var(--c-red-soft);
            border-color: rgba(229, 57, 53, .25);
        }


        /* =====================================================
           DISCOUNT
        ====================================================== */

        .carnate-discount-wrap {
            height: 43px;
            display: flex;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .carnate-discount-wrap:focus-within {
            border-color: rgba(229, 57, 53, .4);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .06);
        }

        .carnate-discount-wrap input {
            flex: 1;
            min-width: 0;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            padding: 0 11px;
            font-size: 13px;
        }

        .carnate-discount-wrap select {
            width: 65px;
            border: 0;
            border-left: 1px solid var(--c-border);
            outline: 0;
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }


        /* =====================================================
           IMAGE
        ====================================================== */

        .carnate-image-section {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 100px;
            gap: 15px;
            align-items: end;
            padding: 14px;
            background: #f8fafc;
            border: 1px solid #edf1f5;
            border-radius: 10px;
        }

        .carnate-image-upload label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-image-upload .form-control {
            border: 1px solid var(--c-border);
            border-radius: 8px;
            font-size: 12px;
            background: #fff;
        }

        .carnate-image-preview {
            width: 90px;
            height: 90px;
            border: 1px solid var(--c-border);
            border-radius: 10px;
            background: #fff;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .carnate-no-image {
            color: #cbd5e1;
            font-size: 30px;
        }


        /* =====================================================
           ALL VEHICLES
        ====================================================== */

        .carnate-all-vehicles {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            border-radius: 9px;
        }

        .carnate-all-vehicles .form-check-input {
            margin: 0;
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--c-red);
        }

        .carnate-all-vehicles label {
            display: block;
            margin: 0 0 2px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .carnate-all-vehicles p {
            margin: 0;
            color: var(--c-muted);
            font-size: 10px;
        }


        /* =====================================================
           VEHICLE SECTION
        ====================================================== */

        .carnate-vehicle-section {
            padding: 15px;
            background: #fafbfc;
            border: 1px solid var(--c-border);
            border-radius: 10px;
        }

        .carnate-section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 13px;
        }

        .carnate-section-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--c-icon);
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .carnate-section-title h6 {
            margin: 0 0 2px;
            color: #334155;
            font-size: 12px;
            font-weight: 750;
        }

        .carnate-section-title p {
            margin: 0;
            color: var(--c-muted);
            font-size: 10px;
        }

        .carnate-vehicle-selector {
            background: #fff;
            border-radius: 8px;
        }


        /* =====================================================
           MULTI SELECT
        ====================================================== */

        .carnate-multi-select {
            min-height: 43px;
        }


        /* =====================================================
           SELECTED VEHICLES
        ====================================================== */

        .carnate-selected-section {
            padding: 14px;
            background: #f8fafc;
            border: 1px solid #edf1f5;
            border-radius: 9px;
        }

        .carnate-selected-title {
            margin-bottom: 10px;
            color: #334155;
            font-size: 12px;
            font-weight: 750;
        }

        .carnate-selected-title span {
            display: inline-flex;
            min-width: 20px;
            height: 20px;
            align-items: center;
            justify-content: center;
            margin-left: 4px;
            padding: 0 5px;
            border-radius: 10px;
            background: #e2e8f0;
            color: #475569;
            font-size: 10px;
        }

        .carnate-selected-list {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .carnate-no-selection {
            color: #94a3b8;
            font-size: 11px;
        }

        .carnate-vehicle-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            max-width: 100%;
            padding: 7px 9px;
            border: 1px solid var(--c-border);
            border-radius: 7px;
            background: #fff;
            color: #475569;
            font-size: 10px;
        }

        .carnate-vehicle-badge > span {
            word-break: break-word;
        }

        .carnate-vehicle-badge button {
            width: 20px;
            height: 20px;
            padding: 0;
            border: 0;
            border-radius: 5px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-vehicle-badge button:hover {
            background: #fef2f2;
            color: #dc2626;
        }


        /* =====================================================
           TEXTAREA
        ====================================================== */

        .carnate-textarea {
            width: 100%;
            min-height: 90px;
            padding: 11px 12px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            resize: vertical;
            outline: 0;
            color: var(--c-text);
            font-size: 13px;
            transition: .18s ease;
        }

        .carnate-textarea:focus {
            border-color: rgba(229, 57, 53, .4);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .06);
        }

        .carnate-textarea::placeholder {
            color: #94a3b8;
        }

        .carnate-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 15px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
            text-decoration: none;
            transition: .16s ease;
        }

        .carnate-btn-primary {
            background: var(--c-red);
            color: #fff;
        }

        .carnate-btn-primary:hover {
            background: var(--c-red-dark);
            color: #fff;
        }

        .carnate-btn-light {
            background: #fff;
            border-color: var(--c-border);
            color: #475569;
        }

        .carnate-btn-light:hover {
            background: #f8fafc;
            color: #1e293b;
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


            .carnate-modal {
                margin: 10px;
            }

            .carnate-modal-body {
                max-height: calc(100vh - 170px);
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

    {{-- =========================================================
        CREATE / EDIT ACCESSORY MODAL
    ========================================================== --}}
    <div class="modal @if ($showModal) show @endif"
        tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content carnate-modal">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    {{-- Modal Header --}}
                    <div class="carnate-modal-header">

                        <div class="carnate-modal-title">

                            <div class="carnate-modal-icon">
                                <i class="bx {{ $isEdit ? 'bx-edit' : 'bx-plus' }}"></i>
                            </div>

                            <div>
                                <h4>
                                    {{ $isEdit ? 'Edit Accessory' : 'Create Accessory' }}
                                </h4>

                                <p>
                                    {{ $isEdit ? 'Update accessory information' : 'Add a new accessory to inventory' }}
                                </p>
                            </div>

                        </div>

                        <button type="button"
                            class="carnate-close"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    {{-- Modal Body --}}
                    <div class="carnate-modal-body">

                        @csrf

                        <div class="row g-3">


                            {{-- =================================================
                                NAME
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Name
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-name-row">

                                        <div class="carnate-select-wrap">

                                            <i class="bx bx-purchase-tag"></i>

                                            <select class="form-select"
                                                wire:model="name"
                                                id="name">

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

                                        <button type="button"
                                            class="carnate-add-small"
                                            wire:click="addAccessoryLabel"
                                            title="Add Accessory Label">

                                            <i class="bx bx-plus"></i>

                                        </button>

                                    </div>

                                    @error('name')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                SUPPLIER
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Supplier
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-user"></i>

                                        <select class="form-select searchable-select"
                                            data-placeholder="Select Supplier"
                                            wire:model="supplier_id">

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

                                    @error('supplier_id')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                BRAND
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Brand
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-purchase-tag-alt"></i>

                                        <input type="text"
                                            wire:model="brand"
                                            placeholder="Enter Brand">

                                    </div>

                                    @error('brand')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                PART NUMBER
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Part Number
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-barcode"></i>

                                        <input type="text"
                                            wire:model="part_number"
                                            placeholder="Enter Part Number">

                                    </div>

                                    <div wire:loading wire:target="part_number"
                                        class="carnate-loading-text">

                                        <span class="spinner-border spinner-border-sm"></span>
                                        Fetching details...

                                    </div>

                                    @error('part_number')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                PURCHASE PRICE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Purchase Price
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <span class="carnate-currency">
                                            ₹
                                        </span>

                                        <input type="number"
                                            wire:model.live="purchase_amount"
                                            placeholder="Enter Purchase Price">

                                    </div>

                                    @error('purchase_amount')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                SELLING PRICE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Selling Price
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <span class="carnate-currency">
                                            ₹
                                        </span>

                                        <input type="number"
                                            wire:model.live="selling_amount"
                                            placeholder="Enter Selling Price">

                                    </div>

                                    @error('selling_amount')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                ONLINE PRICE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Online Price
                                        <span class="carnate-auto-label">AUTO</span>
                                    </label>

                                    <div class="carnate-input-wrap carnate-readonly">

                                        <span class="carnate-currency">
                                            ₹
                                        </span>

                                        <input type="text"
                                            wire:model="online_price"
                                            readonly>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                OFFLINE PRICE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Offline Price
                                        <span class="carnate-auto-label">AUTO</span>
                                    </label>

                                    <div class="carnate-input-wrap carnate-readonly">

                                        <span class="carnate-currency">
                                            ₹
                                        </span>

                                        <input type="text"
                                            wire:model="offline_price"
                                            readonly>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                TAX TYPE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Tax Type
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-receipt"></i>

                                        <select id="tax_type"
                                            class="form-select"
                                            wire:model.live="tax_type">

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

                                    </div>

                                    @error('tax_type')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                TAX PERCENTAGE
                            ================================================== --}}
                            @if ($tax_type == 'include' || $tax_type == 'exclude')

                                <div class="col-md-6">

                                    <div class="carnate-field">

                                        <label>
                                            {{ $tax_type == 'include' ? 'Include Tax Percentage' : 'Exclude Tax Percentage' }}
                                        </label>

                                        <div class="carnate-input-wrap">

                                            <input type="number"
                                                wire:model.live="tax_percentage"
                                                placeholder="Enter Percentage">

                                            <span class="carnate-input-suffix">
                                                %
                                            </span>

                                        </div>

                                        @error('tax_percentage')
                                            <span class="carnate-error">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>

                                </div>

                            @endif


                            {{-- =================================================
                                DISCOUNT
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Online Discount
                                    </label>

                                    <div class="carnate-discount-wrap">

                                        <input type="number"
                                            wire:model.live="discount"
                                            placeholder="Enter Discount">

                                        <select id="discount_type"
                                            wire:model.live="discount_type">

                                            <option value="1">
                                                ₹
                                            </option>

                                            <option value="2">
                                                %
                                            </option>

                                        </select>

                                    </div>

                                    @error('discount')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    @error('discount_type')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                UNIT
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Unit
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-ruler"></i>

                                        <select class="form-select"
                                            wire:model="unit">

                                            <option value="">
                                                Select Unit
                                            </option>

                                            @foreach ($units as $unit)

                                                <option value="{{ $unit->id }}">
                                                    {{ $unit->title }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('unit')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                STOCK
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Stock
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-package"></i>

                                        <input type="number"
                                            wire:model="stock"
                                            placeholder="Enter Stock">

                                    </div>

                                    @error('stock')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                RACK NUMBER
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Rack No.
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-grid-alt"></i>

                                        <input type="text"
                                            wire:model="rack_no"
                                            placeholder="Enter Rack Number">

                                    </div>

                                    @error('rack_no')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                CATEGORY
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Category
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-category"></i>

                                        <select class="form-select searchable-select"
                                            data-placeholder="Select Category"
                                            wire:model="category"
                                            id="category">

                                            <option value="">
                                                Select Category
                                            </option>

                                            @foreach ($categories as $cat)

                                                <option value="{{ $cat['categoryId'] }}">
                                                    {{ $cat['categoryName'] }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('category')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                IMAGE
                            ================================================== --}}
                            <div class="col-md-12">

                                <div class="carnate-image-section">

                                    <div class="carnate-image-upload">

                                        <label>
                                            Product Image
                                        </label>

                                        <input type="file"
                                            class="form-control"
                                            wire:model="image">

                                        @error('image')
                                            <span class="carnate-error">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>


                                    <div class="carnate-image-preview">

                                        @if ($part_image_url)

                                            <img src="{{ $part_image_url }}"
                                                alt="accessory image">

                                        @elseif (!empty($imageName))

                                            <img src="{{ asset($imageName) }}"
                                                alt="accessory image">

                                        @else

                                            @if ($isEdit && !empty($imageImage))

                                                <img src="{{ asset($imageImage) }}"
                                                    alt="accessory image">

                                            @else

                                                <div class="carnate-no-image">
                                                    <i class="bx bx-image"></i>
                                                </div>

                                            @endif

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                FOR ALL VEHICLES
                            ================================================== --}}
                            <div class="col-md-12">

                                <div class="carnate-all-vehicles">

                                    <input class="form-check-input"
                                        type="checkbox"
                                        wire:model.live="forAllVehicles"
                                        id="forAllVehicles">

                                    <div>

                                        <label for="forAllVehicles">
                                            For All Vehicles
                                        </label>

                                        <p>
                                            Make this accessory compatible with every vehicle.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            @if (!$forAllVehicles)

                                {{-- =================================================
                                    VEHICLE SELECTOR
                                ================================================== --}}
                                <div class="col-md-12">

                                    <div class="carnate-vehicle-section">

                                        <div class="carnate-section-title">

                                            <div class="carnate-section-icon">
                                                <i class="bx bx-car"></i>
                                            </div>

                                            <div>

                                                <h6>
                                                    Compatible Vehicles
                                                </h6>

                                                <p>
                                                    Select vehicles compatible with this accessory
                                                </p>

                                            </div>

                                        </div>


                                        <div class="carnate-vehicle-selector">

                                            @livewire('workshop.vehicle-selector')

                                        </div>

                                    </div>

                                </div>


                                {{-- =================================================
                                    EXISTING VEHICLES
                                ================================================== --}}
                                <div class="col-md-12">

                                    <div class="carnate-field">

                                        <label>
                                            Or Select from Existing Saved Vehicles
                                        </label>

                                        <div class="carnate-input-wrap carnate-multi-select">

                                            <select id="suitable_for"
                                                class="form-select searchable-select"
                                                multiple
                                                data-placeholder="Select vehicle"
                                                wire:model="suitable_for">

                                                @foreach ($modifications as $modification)

                                                    <option value="{{ $modification->id }}"
                                                        @if (is_array($suitable_for) && in_array($modification->id, $suitable_for)) selected @endif>

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

                                        </div>

                                        @error('suitable_for')
                                            <span class="carnate-error">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>

                                </div>


                                {{-- =================================================
                                    SELECTED VEHICLES
                                ================================================== --}}
                                <div class="col-md-12">

                                    <div class="carnate-selected-section">

                                        <div class="carnate-selected-title">

                                            Selected Compatible Vehicles

                                            <span>
                                                {{ is_array($suitable_for) ? count($suitable_for) : 0 }}
                                            </span>

                                        </div>


                                        <div class="carnate-selected-list">

                                            @if (empty($suitable_for))

                                                <span class="carnate-no-selection">
                                                    No vehicles selected yet.
                                                </span>

                                            @else

                                                @foreach ($suitable_for as $index => $modId)

                                                    @php
                                                        $localMod = $modifications->firstWhere('id', $modId);
                                                    @endphp

                                                    @if ($localMod)

                                                        <span class="carnate-vehicle-badge">

                                                            <span>
                                                                {{ $localMod->brand_name }}
                                                                {{ $localMod->variant_name }}
                                                                ({{ $localMod->year }})
                                                                -
                                                                {{ $localMod->title }}
                                                            </span>

                                                            <button type="button"
                                                                wire:click="removeCompatibleVehicle({{ $index }})">

                                                                <i class="bx bx-x"></i>

                                                            </button>

                                                        </span>

                                                    @endif

                                                @endforeach

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- =================================================
                                DESCRIPTION
                            ================================================== --}}
                            <div class="col-md-12">

                                <div class="carnate-field">

                                    <label>
                                        Description
                                    </label>

                                    <textarea wire:model="description"
                                        class="carnate-textarea"
                                        placeholder="Enter Description"></textarea>

                                    @error('description')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Modal Footer --}}
                    <div class="carnate-modal-footer">

                        <button type="button"
                            class="carnate-btn carnate-btn-light"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit"
                            class="carnate-btn carnate-btn-primary">

                            <i class="bx {{ $isEdit ? 'bx-save' : 'bx-plus' }}"></i>

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <span class="spinner-border spinner-border-sm"
                                wire:loading>
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
        CREATE ACCESSORY LABEL MODAL
    ========================================================== --}}
    <div class="modal @if ($showAccessoryModel) show @endif"
        tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showAccessoryModel) block @endif">

        <div class="modal-dialog modal-md modal-dialog-centered">

            <div class="modal-content carnate-modal">

                <form wire:submit.prevent="accessoryLabelStore">

                    <div class="carnate-modal-header">

                        <div class="carnate-modal-title">

                            <div class="carnate-modal-icon">
                                <i class="bx bx-purchase-tag"></i>
                            </div>

                            <div>
                                <h4>Create Accessory</h4>
                                <p>Add a new accessory label</p>
                            </div>

                        </div>

                        <button type="button"
                            class="carnate-close"
                            wire:click="$set('showAccessoryModel', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    <div class="carnate-modal-body">

                        @csrf

                        <div class="carnate-field">

                            <label>
                                Accessory Name
                                <span>*</span>
                            </label>

                            <div class="carnate-input-wrap">

                                <i class="bx bx-purchase-tag"></i>

                                <input type="text"
                                    wire:model="accessory_label"
                                    placeholder="Enter Accessory Name">

                            </div>

                            @error('accessory_label')
                                <span class="carnate-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>

                    <div class="carnate-modal-footer">

                        <button type="button"
                            class="carnate-btn carnate-btn-light"
                            wire:click="$set('showAccessoryModel', false)"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit"
                            class="carnate-btn carnate-btn-primary">

                            <i class="bx bx-plus"></i>

                            Create

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