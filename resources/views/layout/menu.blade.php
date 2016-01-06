<div class="site-menubar">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu">
          <li class="site-menu-category">Trees</li>
          <li class="site-menu-item">
            <a href="javascript:void(0)">
              <i class="site-menu-icon fa fa-plus" aria-hidden="true"></i>
              <span class="site-menu-title">Create new tree</span>
            </a>
          </li>
          @if (!$header_tree_list->isEmpty())
          <li class="site-menu-item has-sub">
            <a href="javascript:void(0)">
              <i class="site-menu-icon fa fa-tree" aria-hidden="true"></i>
              <span class="site-menu-title">Tree list</span>
              <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
              @foreach($header_tree_list as $tree)
              <li class="site-menu-item">
                <a href="javascript:void(0)">
                  <i class="site-menu-icon" aria-hidden="true"></i>
                  <span class="site-menu-title">{{$tree->name}}</span>
                </a>
              </li>
              @endforeach
            </ul>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
  <div class="site-menubar-footer">
    <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
    data-original-title="Settings">
    <span class="icon wb-settings" aria-hidden="true"></span>
  </a>
  <a href="{{route('logout')}}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
    <span class="icon wb-power" aria-hidden="true"></span>
  </a>
</div>
</div>