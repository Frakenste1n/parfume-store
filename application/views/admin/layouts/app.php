<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SWEETALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AOS (opsional untuk dashboard nanti) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <style>
        body {
            background: #f5f6fa;
        }

        /* WRAPPER */
        .layout-wrapper {
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;

            background: #0f172a;
            color: #e2e8f0;

            overflow-y: auto;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* HEADER */
        .sidebar-header {
            height: 70px;
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 0 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar-logo {
            width: 38px;
            height: 38px;
            border-radius: 10px;
        }

        .sidebar-brand .brand-title {
            font-weight: 700;
            font-size: 14px;
            color: #ffffff;
        }

        .sidebar-brand .brand-subtitle {
            font-size: 11px;
            color: #94a3b8;
        }

        /* MENU */
        .sidebar-menu {
            padding: 12px;
        }

        /* LABEL */
        .menu-label {
            font-size: 11px;
            letter-spacing: .08em;
            color: #64748b;

            margin: 18px 10px 8px;
        }

        /* LINK */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;

            padding: 10px 12px;
            margin-bottom: 5px;

            border-radius: 10px;

            color: #cbd5e1;
            text-decoration: none;

            font-size: 14px;

            transition: .2s ease;
        }

        .sidebar-link i {
            font-size: 18px;
        }

        /* HOVER */
        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff;
        }

        /* ACTIVE */
        .sidebar-link.active {
            background: #1d4ed8;
            color: #ffffff;
        }

        /* SCROLLBAR (optional tapi bikin lebih premium) */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            margin-left: 260px;
        }

        /* TOPBAR (NAVBAR FILAMENT STYLE) */
        .topbar {
            height: 70px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 0 20px;

            background: white;

            border-bottom: 1px solid #eee;

            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* CONTENT */
        .content {
            padding: 20px;
        }

        /* MOBILE */
        @media (max-width: 991px) {
            .main-content {
                margin-left: 0;
            }
        }

        /*dashboard*/
        .transition {
            transition: all .2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }
    </style>

</head>

<body>

    <div class="layout-wrapper">

        <!-- SIDEBAR -->
        <?php $this->load->view('admin/layouts/sidebar'); ?>

        <!-- MAIN -->
        <div class="main-content">

            <!-- NAVBAR -->
            <?php $this->load->view('admin/layouts/navbar'); ?>

            <!-- CONTENT -->
            <div class="content">
                <?php $this->load->view($content); ?>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>