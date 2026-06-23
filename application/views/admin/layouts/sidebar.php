<?php
$current = uri_string();
?>
<!-- SIDEBAR DESKTOP -->
<div class="sidebar d-none d-lg-flex flex-column">

    <!-- LOGO AREA -->
    <div class="sidebar-header">

        <img src="https://ui-avatars.com/api/?name=Parfume+CMS&background=111827&color=fff&size=64"
            class="sidebar-logo">

        <div class="sidebar-brand">
            <div class="brand-title">Parfume CMS</div>
            <div class="brand-subtitle">Admin Panel</div>
        </div>

    </div>

    <!-- MENU -->
    <div class="sidebar-menu">

        <div class="menu-label">MAIN</div>

        <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link <?= $current == 'admin' ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <div class="menu-label">MANAGEMENT</div>

        <a href="<?= base_url('admin/users') ?>" class="sidebar-link <?= $current == 'users' ? 'active' : '' ?>">
            <i class="bi bi-people"></i>
            <span>User</span>
        </a>

        <a href="<?= base_url('admin/brands') ?>" class="sidebar-link <?= $current == 'brands' ? 'active' : '' ?>">
            <i class="bi bi-tags"></i>
            <span>Brand</span>
        </a>

        <a href="<?= base_url('admin/categories') ?>" class="sidebar-link <?= $current == 'categories' ? 'active' : '' ?>">
            <i class="bi bi-grid"></i>
            <span>Kategori</span>
        </a>

        <a href="<?= base_url('admin/parfume') ?>" class="sidebar-link <?= $current == 'parfumes' ? 'active' : '' ?>">
            <i class="bi bi-droplet"></i>
            <span>Parfume</span>
        </a>

        <a href="<?= base_url('admin/orders') ?>" class="sidebar-link <?= $current == 'orders' ? 'active' : '' ?>">
            <i class="bi bi-bag"></i>
            <span>Order</span>
        </a>

        <div class="menu-label">SYSTEM</div>

        <a href="<?= base_url('admin/setting') ?>"
            class="sidebar-link <?= $current == 'admin/setting' ? 'active' : '' ?>">
            <i class="bi bi-gear"></i>
            <span>Setting</span>
        </a>

    </div>

</div>


<!-- MOBILE OFFCANVAS -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar">

    <div class="offcanvas-header border-bottom border-secondary">

        <div class="d-flex align-items-center gap-2">

            <img src="https://ui-avatars.com/api/?name=Parfume+CMS&background=111827&color=fff&size=40" class="rounded">

            <div>
                <div class="fw-bold">Parfume CMS</div>
                <small class="text-secondary">Admin Panel</small>
            </div>

        </div>

        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>

    </div>

    <div class="offcanvas-body">

        <a href="<?= base_url('admin') ?>" class="sidebar-link">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="<?= base_url('users') ?>" class="sidebar-link">
            <i class="bi bi-people"></i> User
        </a>

        <a href="#" class="sidebar-link">
            <i class="bi bi-tags"></i> Brand
        </a>

        <a href="#" class="sidebar-link">
            <i class="bi bi-grid"></i> Kategori
        </a>

        <a href="#" class="sidebar-link">
            <i class="bi bi-droplet"></i> Parfume
        </a>

        <a href="#" class="sidebar-link">
            <i class="bi bi-bag"></i> Order
        </a>

        <a href="<?= base_url('admin/setting') ?>" class="sidebar-link">
            <i class="bi bi-gear"></i> Setting
        </a>

    </div>

</div>