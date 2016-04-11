

@if ($paginator->getLastPage() > 1)

    <div class="change-page">
        <p>

            <a href="{{ ($paginator->getCurrentPage() == 1) ? '#' : $paginator->getUrl(1) }}" class="item{{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}">
                <i class="icon left arrow"></i>
                上一页
            </a>

        @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
            <a href="{{ $paginator->getUrl($i) }}" class="item{{ ($paginator->getCurrentPage() == $i) ? ' active' : '' }}">
                {{ $i }}
            </a>
        @endfor

            <a href="{{ $paginator->getUrl($paginator->getLastPage()) }}" class="item{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}">
                下一页
                <i class="icon right arrow"></i>
            </a>

        </p>
    </div>

@endif