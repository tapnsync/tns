<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
    TNS
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['/']) }}">
        <a href="{{ route('contact.dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a href="{{ route('contact.settings') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Settings</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['/']) }}">
        <a href="{{ route('contact.logout') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Logout</span>
        </a>
    </li>
    </ul>
  </div>
</nav>
