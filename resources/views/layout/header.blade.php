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
</div>
<div class="navbar-container container-fluid">
  <!-- Navbar Collapse -->
  <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
    <!-- Navbar Toolbar -->
    <ul class="nav navbar-toolbar">
      <li class="hidden-float" id="toggleMenubar">
        <a data-toggle="menubar" href="#" role="button">
          <i class="icon hamburger hided unfolded">
              <span class="sr-only">Toggle menubar</span>
              <span class="hamburger-bar"></span>
            </i>
        </a>
      </li>
      <li class="hidden-xs" id="toggleFullscreen">
        <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
          <span class="sr-only">Toggle fullscreen</span>
        </a>
      </li>
      <li>
        <a class="icon" href="{{route('help')}}"><i class="fa fa-question-circle"></i></a>
      </li>
      <li>
        <a href="{{route('tree.index')}}">Assessment list</a>
      </li>
      <li>
        <a href="{{route('tree.create')}}">Create new assessment</a>
      </li>
    </ul>
    <!-- End Navbar Toolbar -->
</div>
<!-- End Navbar Collapse -->
</div>
</nav>