<div class="setting-page">

    <div class="page-header">
        <div class="page-header-text">
            <h2>Store Settings</h2>
            <p>Configure store profile, contact information, and general preferences.</p>
        </div>
        <button type="button" class="btn-save-setting" id="btnSaveSetting">
            <i class="bi bi-check2-circle"></i>
            <span>Save Changes</span>
        </button>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-md-4">
            <div class="stats-card stat-info">
                <div class="icon-box"><i class="bi bi-shop"></i></div>
                <div class="stats-card-body">
                    <span>Configuration</span>
                    <h3>Store</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card stat-contact">
                <div class="icon-box"><i class="bi bi-telephone"></i></div>
                <div class="stats-card-body">
                    <span>Contact & Social</span>
                    <h3>Info</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card stat-commerce">
                <div class="icon-box"><i class="bi bi-currency-dollar"></i></div>
                <div class="stats-card-body">
                    <span>Frontend CMS</span>
                    <h3>Content</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card setting-form-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <div class="table-card-icon"><i class="bi bi-gear"></i></div>
                <div>
                    <h5>General Settings</h5>
                    <p>Pengaturan toko yang ditampilkan ke customer</p>
                </div>
            </div>
        </div>

        <div class="setting-form-body">
            <form id="settingForm" enctype="multipart/form-data">
                <div id="settingFormFields" class="row g-3">
                    <div class="col-12 text-center py-5 text-muted">
                        Memuat pengaturan...
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<link rel="stylesheet" href="<?= base_url('assets/css/setting.css') ?>">
<script src="<?= base_url('assets/js/setting.js') ?>"></script>
