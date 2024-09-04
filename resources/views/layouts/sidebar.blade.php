<nav class="sidebar">
  <div class="sidebar-header">
    <a href="@role('admin')  {{ url('/admin') }} @else {{ url('/home') }} @endrole " class="sidebar-brand">
      LAB<span>UJI</span>
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
      <li class="nav-item @role('admin') {{ active_class(['admin']) }} @else {{ active_class(['home']) }} @endrole ">
        <a href="@role('admin')  {{ url('/admin') }} @else {{ url('/home') }} @endrole " class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">
            @role('admin')
            Dashboard
            @else
            Home
            @endrole
          </span>
        </a>
      </li>
      @role('admin')
      <li class="nav-item nav-category">Pengajuan </li>
      <li class="nav-item {{ active_class(['admin/semua']) }}">
        <a href="{{ url('/admin/semua') }}" class="nav-link">
          <i class="link-icon" data-feather="archive"></i>
          <span class="link-title">Semua</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/persetujuan']) }}">
        <a href="{{ url('/admin/persetujuan') }}" class="nav-link">
          <i class="link-icon" data-feather="check-circle"></i>
          <span class="link-title">Persetujuan</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/pembayaran']) }}">
        <a href="{{ url('/admin/pembayaran') }}" class="nav-link">
          <i class="link-icon" data-feather="credit-card"></i>
          <span class="link-title">Pembayaran</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/pengujian']) }}">
        <a href="{{ url('/admin/pengujian') }}" class="nav-link">
        <i class="link-icon" data-feather="thermometer"></i>
          <span class="link-title">Pengujian</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/laporan']) }}">
        <a href="{{ url('/admin/laporan') }}" class="nav-link">
          <i class="link-icon" data-feather="clipboard"></i>
          <span class="link-title">Laporan</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/selesai']) }}">
        <a href="{{ url('/admin/selesai') }}" class="nav-link">
        <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Selesai</span>
        </a>
      </li>
      <li class="nav-item nav-category">Feedback </li>
      <li class="nav-item {{ active_class(['admin/umpan-balik']) }}">
        <a href="{{ url('/admin/umpan-balik') }}" class="nav-link">
          <i class="link-icon" data-feather="trello"></i>
          <span class="link-title">Umpan Balik</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/saran']) }}">
        <a href="{{ url('/admin/saran') }}" class="nav-link">
          <i class="link-icon" data-feather="list"></i>
          <span class="link-title">Saran</span>
        </a>
      </li>
      @endrole
      @role('user')
      <li class="nav-item nav-category">Form Pengajuan </li>
      <li class="nav-item {{ active_class(['pengajuan']) }}">
        <a href="{{ url('/pengajuan') }}" class="nav-link">
          <i class="link-icon" data-feather="plus-square"></i>
          <span class="link-title">Tambah Pengajuan</span>
        </a>
      </li>      
      <li class="nav-item nav-category">Status Pengajuan </li>
      <li class="nav-item {{ active_class(['status']) }}">
        <a href="{{ url('/status') }}" class="nav-link">
          <i class="link-icon" data-feather="align-center"></i>
          <span class="link-title">Lihat Status</span>
        </a>
      </li>
      <li class="nav-item nav-category">Informasi </li>
      <li class="nav-item {{ active_class(['info']) }}">
        <a href="{{ url('/info') }}" class="nav-link">
          <i class="link-icon" data-feather="info"></i>
          <span class="link-title">Lihat Info</span>
        </a>
      </li>
      @endrole
     </ul>
  </div>
</nav>
<nav class="settings-sidebar">
  <div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
      <i data-feather="settings"></i>
    </a>
    <h6 class="text-muted">Sidebar:</h6>
    <div class="form-group border-bottom">
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
  </div>
</nav>