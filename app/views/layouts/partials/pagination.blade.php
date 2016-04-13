

@if ($paginator->getLastPage() > 1)
          <nav role="navigation">
              <ul class="cd-pagination">
                <li class="button">
                <a href="{{ ($paginator->getCurrentPage() == 1) ? '#' : $paginator->getUrl($paginator->getCurrentPage()-1) }}" class="{{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}">
                上一页
                </a>
                </li>
               <?php $PrintSize=3;?>

                @if($paginator->getLastPage()>$paginator->getCurrentPage()+$PrintSize)
                <?php $pageMax=$paginator->getCurrentPage()+$PrintSize;?>
                @else
                 <?php $pageMax=$paginator->getLastPage();?>
                @endif
@if($paginator->getCurrentPage()%4==0)
<?php $StartPage=$paginator->getCurrentPage();?>
@else
<?php $tmpPage=$paginator->getCurrentPage()%4;?>
<?php $StartPage=$paginator->getCurrentPage()-$tmpPage+1;?>

@endif
                @for ($i = $StartPage; $i <= $pageMax; $i++)
                <li>
                <a href="{{ $paginator->getUrl($i) }}" class="item{{ ($paginator->getCurrentPage() == $i) ? ' current' : '' }}">{{ $i }}</a>
                </li>
                @endfor
@if($pageMax<$paginator->getLastPage())
                <li>
                <a href="#" >{{ "..." }}</a>
                </li>
                <li>
                <a href="{{ $paginator->getUrl($paginator->getLastPage()) }}" >{{ $paginator->getLastPage() }}</a>
                </li>
@endif
               @if($paginator->getCurrentPage()==$paginator->getLastPage())
                          <?php $page=$paginator->getLastPage() ?>
                          @else
                          <?php $page=$paginator->getCurrentPage()+1?>
               @endif

                <li class="button">

                  <a href="{{ $paginator->getUrl($page) }}" class="{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}">
                                下一页
                            </a>
                </li>
              </ul>
            </nav>


@endif
<script src="assets/js/modernizr.js"></script>
