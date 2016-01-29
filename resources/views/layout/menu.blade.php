<div class="site-menubar">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu">
          
          @foreach ($sidebar_tags as $tag)
          <li class="site-menu-item" data-tag-id="{{$tag->id}}">
            <a>
              <i class="site-menu-icon icon-tag" aria-hidden="true"></i>
              <span class="site-menu-title">{{$tag->title}}</span>
            </a>
          </li>
          @endforeach
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