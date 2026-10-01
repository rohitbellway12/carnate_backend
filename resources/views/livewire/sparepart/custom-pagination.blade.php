<div class="carnate-pagination-wrapper">

    <style>
        .carnate-pagination-wrapper {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            padding: 4px 0;
        }

        .carnate-pagination-wrapper .pagination {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 0;
            padding: 0;
        }

        .carnate-pagination-wrapper .page-item {
            margin: 0;
        }

        .carnate-pagination-wrapper .page-link {
            min-width: 36px;
            height: 36px;
            padding: 0 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #e2e8f0;
            border-radius: 8px !important;

            background: #ffffff;
            color: #475569;

            font-size: 13px;
            font-weight: 600;
            line-height: 1;

            text-decoration: none;
            box-shadow: none;

            transition:
                background-color .18s ease,
                border-color .18s ease,
                color .18s ease,
                box-shadow .18s ease;
        }

        .carnate-pagination-wrapper .page-link:hover {
            background: #fff5f5;
            border-color: rgba(229, 57, 53, .25);
            color: #e53935;
        }

        .carnate-pagination-wrapper .page-item.active .page-link {
            background: #e53935;
            border-color: #e53935;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(229, 57, 53, .18);
        }

        .carnate-pagination-wrapper .page-item.disabled .page-link {
            background: #f8fafc;
            border-color: #e2e8f0;
            color: #cbd5e1;
            cursor: not-allowed;
            box-shadow: none;
        }

        @media (max-width: 576px) {
            .carnate-pagination-wrapper {
                justify-content: center;
                overflow-x: auto;
                padding: 4px 0;
            }

            .carnate-pagination-wrapper .pagination {
                flex-wrap: nowrap;
            }

            .carnate-pagination-wrapper .page-link {
                min-width: 34px;
                height: 34px;
                padding: 0 9px;
                font-size: 12px;
            }
        }
    </style>

    <ul class="pagination justify-content-center">

        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">
                    Previous
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                    Previous
                </a>
            </li>
        @endif

        @foreach ($elements as $element)

            @if (is_array($element))

                @foreach ($element as $page => $url)

                    <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">
                            {{ $page }}
                        </a>
                    </li>

                @endforeach

            @endif

        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    Next
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">
                    Next
                </span>
            </li>
        @endif

    </ul>

</div>