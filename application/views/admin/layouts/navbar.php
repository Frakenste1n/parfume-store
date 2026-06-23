<?php $admin_name = $admin_name ?? 'Admin'; ?>

<nav class="topbar">

    <!-- LEFT SIDE -->
    <div class="d-flex align-items-center gap-2">

        <!-- HAMBURGER (MOBILE ONLY) -->
        <button class="btn d-lg-none"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar">
            <i class="bi bi-list fs-3"></i>
        </button>

    </div>

    <!-- RIGHT SIDE (FIX DROPDOWN RIGHT) -->
    <div class="dropdown ms-auto">

        <button class="btn d-flex align-items-center gap-2 dropdown-toggle"
                data-bs-toggle="dropdown">

            <img src="https://ui-avatars.com/api/?name=<?= urlencode($admin_name) ?>"
                 width="35"
                 height="35"
                 class="rounded-circle">

            <span class="d-none d-md-block">
                <?= $admin_name ?>
            </span>

        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow">

            <li>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-person me-2"></i> Profile
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <a class="dropdown-item text-danger"
                   href="<?= base_url('admin/login') ?>">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>

        </ul>

    </div>

</nav>