<?php
$admin_name = $admin_name ?? 'Admin';
$admin_email = $admin_email ?? '';
$site_name = $site_name ?? 'Parfume CMS';
$site_logo = $site_logo ?? '';
$page_title = $title ?? 'Dashboard';
$avatar_url = 'https://ui-avatars.com/api/?name=' . urlencode($admin_name) . '&background=6366f1&color=fff&size=128';
$logo_url = $site_logo
    ? $site_logo
    : 'https://ui-avatars.com/api/?name=' . urlencode($site_name) . '&background=111827&color=fff&size=64';
?>

<nav class="topbar">

    <div class="topbar-left">
        <button class="btn-topbar-menu d-lg-none"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar"
                aria-label="Toggle menu">
            <i class="bi bi-list fs-4"></i>
        </button>

        <div class="topbar-breadcrumb">
            <small><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></small>
            <strong><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></strong>
        </div>
    </div>

    <div class="dropdown admin-profile-dropdown ms-auto">
        <button class="dropdown-toggle admin-profile-trigger"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">

            <img src="<?= htmlspecialchars($avatar_url, ENT_QUOTES, 'UTF-8') ?>"
                 alt="<?= htmlspecialchars($admin_name, ENT_QUOTES, 'UTF-8') ?>"
                 class="admin-avatar">

            <span class="admin-profile-text d-none d-md-block">
                <span class="name" id="adminDisplayName" data-name="<?= htmlspecialchars($admin_name, ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($admin_name, ENT_QUOTES, 'UTF-8') ?>
                </span>
                <span class="role">Administrator</span>
            </span>

            <i class="bi bi-chevron-down text-muted d-none d-md-inline"></i>
        </button>

        <div class="dropdown-menu dropdown-menu-end admin-dropdown-menu">
            <div class="admin-dropdown-header">
                <img src="<?= htmlspecialchars($avatar_url, ENT_QUOTES, 'UTF-8') ?>"
                     alt="<?= htmlspecialchars($admin_name, ENT_QUOTES, 'UTF-8') ?>"
                     class="admin-avatar-lg">
                <h6><?= htmlspecialchars($admin_name, ENT_QUOTES, 'UTF-8') ?></h6>
                <p><?= htmlspecialchars($admin_email ?: 'admin@parfume.store', ENT_QUOTES, 'UTF-8') ?></p>
            </div>

            <div class="admin-dropdown-body">
                <a href="<?= base_url('admin/setting') ?>" class="admin-dropdown-item">
                    <i class="bi bi-gear"></i>
                    Pengaturan Toko
                </a>

                <button type="button" class="admin-dropdown-item logout" id="btnAdminLogout">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </div>

            <div class="admin-dropdown-footer">
                <div class="admin-dropdown-store">
                    <img src="<?= htmlspecialchars($logo_url, ENT_QUOTES, 'UTF-8') ?>"
                         alt="<?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?>">
                    <span>
                        <strong><?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></strong>
                        Panel admin aktif
                    </span>
                </div>
            </div>
        </div>
    </div>

</nav>
