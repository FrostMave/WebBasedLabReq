<nav @guest style="width: 100%; left:0;" @endguest class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    @guest
    <div class="search-form">
      <a href="#" class="brand-title">
        UJI<span>Lab</span>
      </a>
    </div>
    @endguest
    <ul class="navbar-nav">    
      <li class="nav-item dropdown nav-profile">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="name font-weight-bold mb-0 text-body mx-1" href="#"> {{ Auth::user()->name ?? 'Nama User' }} </span>
          <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="profile">
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <div class="dropdown-header d-flex flex-column align-items-center">
            <div class="figure mb-3">
              <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="">
            </div>
            <div class="info text-center">
              <p class="name font-weight-bold mb-0"> {{ Auth::user()->name ?? 'Nama User' }} </p>
              <p class="email text-muted mb-3">{{ Auth::user()->email ?? 'email@user.test' }}</p>
            </div>
          </div>
          <div class="dropdown-body">
            <ul class="profile-nav p-0 pt-3">
              <li class="nav-item">
                <a href="{{ url('/profile') }}" class="nav-link">
                  <i data-feather="user"></i>
                  <span>Profile</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/profile/edit" class="nav-link">
                  <i data-feather="edit"></i>
                  <span>Edit Profile</span>
                </a>
              </li>              
              <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  <i data-feather="log-out"></i>
                  <span>Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>