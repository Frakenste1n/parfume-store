<?php
if (!isset($site_name))
{
    $CI =& get_instance();
    $CI->load->model('Setting_model');
    $store_setting = $CI->Setting_model->get_setting();

    $site_name = ($store_setting && $store_setting->site_name) ? $store_setting->site_name : 'Parfume CMS';
    $site_logo = ($store_setting && !empty($store_setting->logo))
        ? base_url('uploads/settings/' . $store_setting->logo)
        : '';
    $site_favicon = ($store_setting && !empty($store_setting->favicon))
        ? base_url('uploads/settings/' . $store_setting->favicon)
        : '';
    $admin_name = $CI->session->userdata('name') ?: 'Admin';
    $admin_email = $CI->session->userdata('email') ?: '';
}

$page_title = $title ?? 'Dashboard';
$favicon_href = !empty($site_favicon) ? $site_favicon : base_url('favicon.ico');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?> - <?= htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" href="<?= htmlspecialchars($favicon_href, ENT_QUOTES, 'UTF-8') ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/admin-layout.css') ?>" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
</head>

<body class="admin-app">

    <div class="layout-wrapper">

        <?php $this->load->view('admin/layouts/sidebar'); ?>

        <div class="main-content">

            <?php $this->load->view('admin/layouts/navbar'); ?>

            <div class="content">
                <?php $this->load->view($content); ?>
            </div>

        </div>

    </div>

    <script>
        const base_url = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url('assets/js/admin-layout.js') ?>"></script>

</body>

</html>
