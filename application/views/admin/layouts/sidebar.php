<?php
$site_name = $site_name ?? 'Parfume CMS';
$site_logo = $site_logo ?? '';
$logo_url = $site_logo
    ? $site_logo
    : 'https://ui-avatars.com/api/?name=' . urlencode($site_name) . '&background=6366f1&color=fff&size=128';
?>

<!-- SIDEBAR DESKTOP -->
<div class="sidebar d-none d-lg-flex flex-column">

    <div class="sidebar-header">
        <div class="sidebar-logo-wrap">
            <img src="<?= htmlspecialchars($logo_url, ENT_QUOTES, 'UTF-8') ?>"
                 alt="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>"
                 class="sidebar-logo">
        </div>

        <div class="sidebar-brand">
            <div class="brand-title"><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></div>
            <div class="brand-subtitle">Admin Panel</div>
        </div>
    </div>

    <div class="sidebar-menu">
        <?php $this->load->view('admin/layouts/_sidebar_menu'); ?>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-store-badge">
            <img src="<?= htmlspecialchars($logo_url, ENT_QUOTES, 'UTF-8') ?>"
                 alt="Store"
                 width="32"
                 height="32"
                 style="border-radius:10px;object-fit:cover;">
            <div>
                <small>Store aktif</small>
                <strong><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></strong>
            </div>
        </div>
    </div>

</div>

<!-- MOBILE OFFCANVAS -->
<div class="offcanvas offcanvas-start mobile-sidebar text-white"
     tabindex="-1"
     id="mobileSidebar">

    <div class="offcanvas-header">
        <div class="d-flex align-items-center gap-3">
            <div class="sidebar-logo-wrap">
                <img src="<?= htmlspecialchars($logo_url, ENT_QUOTES, 'UTF-8') ?>"
                     alt="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>"
                     class="sidebar-logo">
            </div>
            <div>
                <div class="fw-bold"><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></div>
                <small class="text-secondary">Admin Panel</small>
            </div>
        </div>

        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <?php $this->load->view('admin/layouts/_sidebar_menu'); ?>
    </div>

</div>
