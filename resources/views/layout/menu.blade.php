<div class="site-menubar">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu">
          <li class="site-menu-category"><a href="{{route('tree.index')}}">Trees</a></li>
          <li class="site-menu-item">
            <a href="{{route('tree.create')}}">
              <i class="site-menu-icon fa fa-plus" aria-hidden="true"></i>
              <span class="site-menu-title">Create new tree</span>
            </a>
          </li>
          @foreach ($sidebar_trees as $tree)
          <li class="site-menu-item" data-tree-id="{{$tree->id}}">
            <a href="{{ route('tree.show', ['id' => $tree->id]) }}">
              <i class="site-menu-icon fa fa-sitemap" aria-hidden="true"></i>
              <span class="site-menu-title">{{$tree->title}}</span>
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