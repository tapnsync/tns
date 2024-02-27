<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        <img style="    width: 36%;" src="{{asset('frontend/img/Logo Png-01.png')}}" alt="">
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">

  

       
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        
     
        @if(auth()->user()->hasRole('Super-Admin'))
          <li class="nav-item {{ request()->routeIs('company.list') ? 'active' : '' }}">
            <a href="{{ route('company.list') }}" class="nav-link">
              <i class="link-icon" data-feather="message-square"></i>
              <span class="link-title">Companies</span>
            </a>
          </li>
        @endif
        
        <li class="nav-item {{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
          <a href="{{ route('admin.contacts.index') }}" class="nav-link">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">Contacts</span>
          </a>
        </li>
        
        <li class="nav-item {{ request()->routeIs('password.change') ? 'active' : '' }}">
          <a href="{{ route('password.change') }}" class="nav-link">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">Settings</span>
          </a>
        </li>
        
        <li class="nav-item ">
          <a href="{{ route('logout') }}" class="nav-link">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">Logout</span>
          </a>
        </li>

        

       
      </ul>
    </div>
  </nav>
  {{-- <nav class="settings-sidebar">
    <div class="sidebar-body">
      <a href="#" class="settings-sidebar-toggler">
        <i data-feather="settings"></i>
      </a>
      <h6 class="text-muted mb-2">Sidebar:</h6>
      <div class="mb-3 pb-3 border-bottom">
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
            Light
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
            Dark
          </label>
        </div>
      </div>
      <div class="theme-wrapper">
        <h6 class="text-muted mb-2">Light Version:</h6>
        <a class="theme-item active" href="https://www.nobleui.com/laravel/template/demo1/">
          <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
        </a>
        <h6 class="text-muted mb-2">Dark Version:</h6>
        <a class="theme-item" href="https://www.nobleui.com/laravel/template/demo2/">
          <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
        </a>
      </div>
    </div>
  </nav> --}}