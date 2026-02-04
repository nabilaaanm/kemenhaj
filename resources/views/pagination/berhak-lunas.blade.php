@if ($paginator->hasPages())
    <nav class="bl-pagination" role="navigation" aria-label="Pagination">
        <div class="bl-pagination__summary">
            Menampilkan {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} dari {{ $paginator->total() }}
        </div>
        <ul class="bl-pagination__list">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="bl-pagination__item is-disabled">
                    <span class="bl-pagination__link bl-pagination__link--icon">‹</span>
                </li>
            @else
                <li class="bl-pagination__item">
                    <a class="bl-pagination__link bl-pagination__link--icon" href="{{ $paginator->previousPageUrl() }}" rel="prev">‹</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="bl-pagination__item is-disabled">
                        <span class="bl-pagination__link">…</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="bl-pagination__item is-active">
                                <span class="bl-pagination__link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="bl-pagination__item">
                                <a class="bl-pagination__link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="bl-pagination__item">
                    <a class="bl-pagination__link bl-pagination__link--icon" href="{{ $paginator->nextPageUrl() }}" rel="next">›</a>
                </li>
            @else
                <li class="bl-pagination__item is-disabled">
                    <span class="bl-pagination__link bl-pagination__link--icon">›</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        .bl-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            border-radius: 14px;
        }
        .bl-pagination__summary {
            font-size: 12px;
            color: #6b7280;
            font-weight: 600;
        }
        .bl-pagination__list {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .bl-pagination__item {
            display: inline-flex;
        }
        .bl-pagination__link {
            min-width: 32px;
            height: 32px;
            padding: 0 10px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: #374151;
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 14px rgba(15, 23, 42, 0.06);
            transition: transform 0.15s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
        }
        .bl-pagination__item.is-active .bl-pagination__link {
            background: #ECB176;
            color: #1f2937;
            border-color: #ECB176;
            box-shadow: 0 10px 20px rgba(236, 177, 118, 0.35);
        }
        .bl-pagination__item.is-disabled .bl-pagination__link {
            color: #9ca3af;
            background: #f3f4f6;
            border-color: #e5e7eb;
            box-shadow: none;
            cursor: not-allowed;
        }
        .bl-pagination__link:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 20px rgba(15, 23, 42, 0.12);
        }
        .bl-pagination__link--icon {
            padding: 0;
            width: 32px;
        }
        @media (max-width: 640px) {
            .bl-pagination {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endif
