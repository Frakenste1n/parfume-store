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

    <div class="content-card setting-form-card mb-4">
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

    <div class="content-card founders-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <div class="table-card-icon"><i class="bi bi-people"></i></div>
                <div>
                    <h5>Founders</h5>
                    <p>Kelola data founder dan profil tim</p>
                </div>
            </div>
            <button type="button" class="btn-add-founder" id="btnAddFounder">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Founder</span>
            </button>
        </div>

        <div class="founders-body">
            <div class="table-responsive">
                <table class="table table-hover" id="foundersTable">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Memuat data founder...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Founder Modal -->
<div class="modal fade" id="founderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="founderModalTitle">Tambah Founder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="founderForm" enctype="multipart/form-data">
                    <input type="hidden" id="founderId" name="id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Founder <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="founderName" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="founderPosition" name="position" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" id="founderWhatsapp" name="whatsapp" placeholder="628xxxxxxxxxx">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Instagram</label>
                            <input type="text" class="form-control" id="founderInstagram" name="instagram" placeholder="@username">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Foto Founder</label>
                            <input type="file" class="form-control" id="founderPhoto" name="photo" accept="image/jpeg,image/png,image/webp">
                            <div id="founderPhotoPreview" class="mt-2"></div>
                            <input type="hidden" id="founderExistingPhoto" name="existing_photo">
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="founderActive" name="is_active" checked>
                                <label class="form-check-label" for="founderActive">Aktif</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSaveFounder">Simpan</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url('assets/css/setting.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/founders.css') ?>">
<script src="<?= base_url('assets/js/setting.js') ?>"></script>
<script src="<?= base_url('assets/js/founders.js') ?>"></script>
