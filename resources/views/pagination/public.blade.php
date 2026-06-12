@if ($paginator->total() > 0)
    <nav class="public-pagination" role="navigation" aria-label="Pagination">
        <div class="public-pagination__summary">
            Menampilkan {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} dari {{ $paginator->total() }}
        </div>
        <ul class="public-pagination__list">
            @if ($paginator->onFirstPage())
                <li class="public-pagination__item is-disabled">
                    <span class="public-pagination__link public-pagination__link--icon" aria-hidden="true">‹</span>
                </li>
            @else
                <li class="public-pagination__item">
                    <a class="public-pagination__link public-pagination__link--icon" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Halaman sebelumnya">‹</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="public-pagination__item is-disabled">
                        <span class="public-pagination__link">…</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="public-pagination__item is-active">
                                <span class="public-pagination__link" aria-current="page">{{ $page }}</span>
                            </li>
                        @else
                            <li class="public-pagination__item">
                                <a class="public-pagination__link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="public-pagination__item">
                    <a class="public-pagination__link public-pagination__link--icon" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Halaman berikutnya">›</a>
                </li>
            @else
                <li class="public-pagination__item is-disabled">
                    <span class="public-pagination__link public-pagination__link--icon" aria-hidden="true">›</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        .public-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            padding: 12px 14px;
            border-radius: 14px;
        }
        .public-pagination__summary {
            font-size: 13px;
            color: #374151;
            font-weight: 600;
        }
        .public-pagination__list {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .public-pagination__item {
            display: inline-flex;
        }
        .public-pagination__link {
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: #374151;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 14px rgba(15, 23, 42, 0.06);
            transition: transform 0.15s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }
        .public-pagination__item.is-active .public-pagination__link {
            background: var(--color-primary);
            color: var(--on-primary-text, #111827);
            border-color: var(--color-primary);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.12);
        }
        .public-pagination__item.is-disabled .public-pagination__link {
            color: #9ca3af;
            background: #f3f4f6;
            border-color: #e5e7eb;
            box-shadow: none;
            cursor: not-allowed;
        }
        .public-pagination__link:hover {
            transform: translateY(-1px);
            border-color: var(--color-primary);
            color: var(--color-primary-dark);
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.12);
        }
        .public-pagination__item.is-active .public-pagination__link:hover,
        .public-pagination__item.is-disabled .public-pagination__link:hover {
            transform: none;
        }
        .public-pagination__item.is-active .public-pagination__link:hover {
            color: var(--on-primary-text, #111827);
            border-color: var(--color-primary);
        }
        .public-pagination__link--icon {
            padding: 0;
            width: 36px;
        }
        @media (max-width: 640px) {
            .public-pagination {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endif
