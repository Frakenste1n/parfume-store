<?php
if (!isset($site_name))
{
    $CI =& get_instance();
    $CI->load->model('Setting_model');
    $store_setting = $CI->Setting_model->get_setting();

    $site_name = ($store_setting && $store_setting->site_name) ? $store_setting->site_name : 'Parfume Store';
    $site_logo = ($store_setting && !empty($store_setting->logo))
        ? base_url('uploads/settings/' . $store_setting->logo)
        : '';
    $site_favicon = ($store_setting && !empty($store_setting->favicon))
        ? base_url('uploads/settings/' . $store_setting->favicon)
        : '';
}

$page_title = $page_title ?? 'Parfume Store';
$favicon_href = !empty($site_favicon) ? $site_favicon : base_url('favicon.ico');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" href="<?= htmlspecialchars($favicon_href, ENT_QUOTES, 'UTF-8') ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/customer/app.css') ?>">

    <?php if (!empty($page_css)): ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/customer/' . $page_css) ?>">
    <?php endif; ?>
</head>

<body>

    <?php $this->load->view('customer/layouts/navbar'); ?>
    <?php $this->load->view($content); ?>
    <?php if (!in_array($content, ['customer/v_tentang', 'customer/v_login', 'customer/v_register'])): ?>
        <?php $this->load->view('customer/layouts/footer'); ?>
    <?php endif; ?>

    <script>
        const BASE_URL = "<?= base_url(); ?>";
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="<?= base_url('assets/js/customer/api.js') ?>"></script>
    <script src="<?= base_url('assets/js/customer/app.js') ?>"></script>
    <?php if (!empty($page_js)): ?>
        <script src="<?= base_url('assets/js/customer/' . $page_js) ?>"></script>
    <?php endif; ?>

    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>

</html>
