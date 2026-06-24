<?php
$current = uri_string();
?>

<div class="menu-label">MAIN</div>

<a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link <?= $current === 'admin/dashboard' ? 'active' : '' ?>">
    <i class="bi bi-speedometer2"></i>
    <span>Dashboard</span>
</a>

<div class="menu-label">MANAGEMENT</div>

<a href="<?= base_url('admin/users') ?>" class="sidebar-link <?= $current === 'admin/users' ? 'active' : '' ?>">
    <i class="bi bi-people"></i>
    <span>User</span>
</a>

<a href="<?= base_url('admin/brands') ?>" class="sidebar-link <?= $current === 'admin/brands' ? 'active' : '' ?>">
    <i class="bi bi-tags"></i>
    <span>Brand</span>
</a>

<a href="<?= base_url('admin/categories') ?>" class="sidebar-link <?= $current === 'admin/categories' ? 'active' : '' ?>">
    <i class="bi bi-grid"></i>
    <span>Kategori</span>
</a>

<a href="<?= base_url('admin/parfume') ?>" class="sidebar-link <?= $current === 'admin/parfume' ? 'active' : '' ?>">
    <i class="bi bi-droplet"></i>
    <span>Parfume</span>
</a>

<a href="<?= base_url('admin/banners') ?>" class="sidebar-link <?= $current === 'admin/banners' ? 'active' : '' ?>">
    <i class="bi bi-images"></i>
    <span>Banner</span>
</a>

<a href="<?= base_url('admin/payments') ?>" class="sidebar-link <?= $current === 'admin/payments' ? 'active' : '' ?>">
    <i class="bi bi-credit-card"></i>
    <span>Payment</span>
</a>

<a href="<?= base_url('admin/orders') ?>" class="sidebar-link <?= $current === 'admin/orders' ? 'active' : '' ?>">
    <i class="bi bi-bag"></i>
    <span>Order</span>
</a>

<div class="menu-label">SYSTEM</div>

<a href="<?= base_url('admin/setting') ?>" class="sidebar-link <?= $current === 'admin/setting' ? 'active' : '' ?>">
    <i class="bi bi-gear"></i>
    <span>Setting</span>
</a>
