<!-- Sidebar Start -->
<aside class="left-sidebar">
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="<?= site_url('admin/dashboard') ?>" class="text-nowrap logo-img">
        <img src="<?= base_url('assets/images/logos/dark-logo.svg') ?>" width="180" alt="Logo" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= site_url('admin/dashboard') ?>">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= site_url('admin/wisata') ?>">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Wisata</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= site_url('admin/kategori') ?>">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Kategori</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= site_url('admin/artikel') ?>">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Artikel</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= site_url('admin/iklan') ?>">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Iklan</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!-- Sidebar End -->
<!--  Main wrapper -->
<div class="body-wrapper">