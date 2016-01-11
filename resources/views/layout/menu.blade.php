<div class="site-menubar">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu">
          <li class="site-menu-category">Trees</li>
          <li class="site-menu-item">
            <a href="{{route('tree.create')}}">
              <i class="site-menu-icon fa fa-plus" aria-hidden="true"></i>
              <span class="site-menu-title">Create new tree</span>
            </a>
          </li>
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