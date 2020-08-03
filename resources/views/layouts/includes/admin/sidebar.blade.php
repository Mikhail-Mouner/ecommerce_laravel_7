<div class="main-menu menu-static menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      
      <!-- /Dashboard -->
      <li class=" nav-item">
        <a href="{{ route('admin.dashboard') }}">
          <i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span>
        </a>
      </li>
      <!-- /Dashboard -->
      
      <li class=" nav-item"><a href="#"><i class="la la-cog"></i><span class="menu-title" data-i18n="nav.settings.main">Settings</span></a>
        <ul class="menu-content">
          <!-- Setting language -->
          <li>
            <a class="menu-item" href="{{ route('admin.language.index') }}" data-i18n="nav.settings.1_column">
              <i class="la la-language"></i>Languages
              <span class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Language::count() }}</span>
            </a>
          </li>
          <!-- /Setting language -->
          <!-- Setting Main Categories -->
          <li>
            <a class="menu-item" href="{{ route('admin.main.categories.index') }}" data-i18n="nav.categories.2_column">
              <i class="la la-list-alt"></i>Categories
              <span class="badge badge badge-success badge-pill float-right mr-2">{{ App\Models\MainCategory::defaultCategory()->count() }}</span>
            </a>
          </li>
          <!-- /Setting Main Categories -->
          <!-- Setting Vendors -->
          <li>
            <a class="menu-item" href="{{ route('admin.vendors.index') }}" data-i18n="nav.categories.3_column">
              <i class="la la-building"></i>Vendors
              <span class="badge badge badge-warning badge-pill float-right mr-2">{{ App\Models\Vendor::count() }}</span>
            </a>
          </li>
          <!-- /Setting Vendors -->
          <li><a class="menu-item" href="#" data-i18n="nav.settings.3_columns.main">Content Sidebar</a>
            <ul class="menu-content">
              <li><a class="menu-item" href="layout-content-right-sidebar.html"
                data-i18n="nav.settings.3_columns.right_sidebar">Right sidebar</a>
              </li>
              <li><a class="menu-item" href="layout-content-right-sticky-sidebar.html"
                data-i18n="nav.settings.3_columns.right_sticky_sidebar">Right sticky sidebar</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>