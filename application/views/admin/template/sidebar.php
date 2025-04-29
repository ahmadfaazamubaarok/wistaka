    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between mb-3">
          <a href="<?= site_url('admin/dashboard') ?>" class="text-nowrap logo-img">
            <img src="<?= base_url('assets/user/images/logogelap.png') ?>" width="180" alt="Logo" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('admin/dashboard') ?>">
                <span><i class="ti ti-layout-dashboard"></i></span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('admin/wisata') ?>">
                <span><i class="ti ti-map-pin"></i></span>
                <span class="hide-menu">Wisata</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('admin/kategori') ?>">
                <span><i class="ti ti-list"></i></span>
                <span class="hide-menu">Kategori</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('admin/artikel') ?>">
                <span><i class="ti ti-article"></i></span>
                <span class="hide-menu">Artikel</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('admin/iklan') ?>">
                <span><i class="ti ti-star"></i></span>
                <span class="hide-menu">Iklan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= site_url('admin/event') ?>">
                <span><i class="ti ti-speakerphone"></i></span>
                <span class="hide-menu">Event</span>
              </a>
            </li>
            <?php if ($this->session->userdata('admin')->role === 'owner'): ?>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="<?= site_url('admin/admin') ?>">
                    <span><i class="ti ti-user"></i></span>
                    <span class="hide-menu">Admin</span>
                  </a>
                </li>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </aside>
  <!-- Sidebar End -->