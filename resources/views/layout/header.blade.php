<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
    data-toggle="menubar">
    <span class="sr-only">Toggle navigation</span>
    <span class="hamburger-bar"></span>
  </button>
  <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
  data-toggle="collapse">
  <i class="icon wb-more-horizontal" aria-hidden="true"></i>
</button>
<div class="navbar-brand navbar-brand-center">
  <span class="navbar-brand-text">Argue Secure</span>
</div>
<button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
data-toggle="collapse">
<span class="sr-only">Toggle Search</span>
<i class="icon wb-search" aria-hidden="true"></i>
</button>
</div>
<div class="navbar-container container-fluid">
  <!-- Navbar Collapse -->
  <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
    <!-- Navbar Toolbar -->
    <ul class="nav navbar-toolbar">
      <li class="hidden-xs" id="toggleFullscreen">
        <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
          <span class="sr-only">Toggle fullscreen</span>
        </a>
      </li>
      <li class="dropdown dropdown-fw dropdown-mega">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
        data-animation="fade" role="button">Menu <i class="icon wb-chevron-down-mini" aria-hidden="true"></i></a>
        <ul class="dropdown-menu" role="menu">
          <li role="presentation">
            <div class="mega-content">
              <div class="row">
                <div class="col-sm-4">
                  <h5>Trees</h5>
                  @if (!$header_tree_list->isEmpty())
                  <ul class="blocks-2">
                    @foreach($header_tree_list as $tree)
                    <li class="mega-menu margin-0">
                      <ul class="list-icons">
                        <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                          <a href="">{{$tree->name}}</a>
                        </li>
                      </ul>
                    </li>
                    @endforeach
                  </ul>
                  @endif
                  <a href="">Create a tree</a>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </li>
    </ul>
    <!-- End Navbar Toolbar -->
</div>
<!-- End Navbar Collapse -->
</div>
</nav>