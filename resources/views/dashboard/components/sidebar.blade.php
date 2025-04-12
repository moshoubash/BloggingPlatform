<!-- Sidebar Start -->
<aside class="left-sidebar" style="background-color:#141a31">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{route('dashboard')}}" class="text-nowrap">
          <h2 class="m-0 text-white">{{env("APP_NAME")}}</h2>
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard')}}" aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">Overview</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Manage</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard.users.index')}}" aria-expanded="false">
              <span>
                <i class="ti ti-users"></i>
              </span>
              <span class="hide-menu">Users</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard.posts.index')}}" aria-expanded="false">
              <span>
                <i class="ti ti-file"></i>
              </span>
              <span class="hide-menu">Posts</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard.comments.index')}}" aria-expanded="false">
              <span>
                <i class="ti ti-message"></i>
              </span>
              <span class="hide-menu">Comments</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard.reports.index')}}" aria-expanded="false">
              <span>
                <i class="ti ti-file"></i>
              </span>
              <span class="hide-menu">Reports</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard.tags.index')}}" aria-expanded="false">
              <span>
                <i class="ti ti-tag"></i>
              </span>
              <span class="hide-menu">Tags</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard.premium.index')}}" aria-expanded="false">
              <span>
                <i class="ti ti-crown"></i>
              </span>
              <span class="hide-menu">Premium</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Settings</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard.account.index')}}" aria-expanded="false">
              <span>
                <i class="ti ti-user"></i>
              </span>
              <span class="hide-menu">Account</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('dashboard.site.index')}}" aria-expanded="false">
              <span>
                <i class="ti ti-settings"></i>
              </span>
              <span class="hide-menu">Site</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
  <!--  Sidebar End -->