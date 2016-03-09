<div class="site-menubar">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu">
          @if (!empty($sidebar_tags))
          <li class="site-menu-item-custom clear-filters">
            <a>
              <i class="site-menu-icon fa fa-times" aria-hidden="true"></i>
              <span class="site-menu-title">Clear filters</span>
            </a>            
          </li>
          <li class="site-menu-item-custom site-menu-item-custom node-tag" data-tag-id="0" data-tag-slug="">
            <a>
              <i class="site-menu-icon icon-tag" aria-hidden="true"></i>
              <span class="site-menu-title">Empty tags</span>
            </a>
          </li>
          @foreach ($sidebar_tags as $tag)
          <li class="site-menu-item-custom site-menu-item-custom node-tag" data-tag-id="{{$tag->id}}" data-tag-slug="{{$tag->slug}}">
            <a>
              <i class="site-menu-icon icon-tag" aria-hidden="true"></i>
              <span class="site-menu-title">{{$tag->title}}</span>
            </a>
          </li>
          @endforeach
          <li class="site-menu-item-custom site-menu-item-custom node-tag empty-tag" data-tag-id="" data-tag-slug="">
            <a>
              <i class="site-menu-icon icon-tag" aria-hidden="true"></i>
              <span class="site-menu-title"></span>
            </a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
  <div class="site-menubar-footer">
    <a href="{{route('logout')}}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
      <span class="icon wb-power" aria-hidden="true"></span>
    </a>
  </div>
</div>