<div class="banners-page">

    <div class="page-header">
        <div class="page-header-text">
            <h2>Banner Management</h2>
            <p>Kelola banner hero, promo, dan slider di halaman utama toko.</p>
        </div>
        <button type="button" class="btn-add-banner" data-bs-toggle="modal" data-bs-target="#createBannerModal">
            <i class="bi bi-plus-lg"></i>
            <span>Add Banner</span>
        </button>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-total">
                <div class="icon-box"><i class="bi bi-images"></i></div>
                <div class="stats-card-body">
                    <span>Total Banners</span>
                    <h3 id="totalBanners">0</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-active">
                <div class="icon-box"><i class="bi bi-check-circle"></i></div>
                <div class="stats-card-body">
                    <span>Active</span>
                    <h3 id="totalActive">0</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-inactive">
                <div class="icon-box"><i class="bi bi-slash-circle"></i></div>
                <div class="stats-card-body">
                    <span>Inactive</span>
                    <h3 id="totalInactive">0</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-sort">
                <div class="icon-box"><i class="bi bi-sort-numeric-down"></i></div>
                <div class="stats-card-body">
                    <span>With CTA</span>
                    <h3 id="totalWithCta">0</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card banners-table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <div class="table-card-icon"><i class="bi bi-images"></i></div>
                <div>
                    <h5>All Banners</h5>
                    <p>Daftar banner yang ditampilkan di frontend</p>
                </div>
            </div>
            <span class="table-count-badge" id="tableBannerCount">0 banners</span>
        </div>

        <div class="banners-table-wrap">
            <table class="table banners-table align-middle w-100" id="bannersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Banner</th>
                        <th>Subtitle</th>
                        <th>CTA</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</div>

<!-- CREATE MODAL -->
<div class="modal fade" id="createBannerModal" tabindex="-1" aria-labelledby="createBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="createBannerModalLabel">Add Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createBannerForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="create_title">Title</label>
                            <input type="text" id="create_title" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create_sort_order">Sort Order</label>
                            <input type="number" id="create_sort_order" name="sort_order" class="form-control" value="0" min="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="create_subtitle">Subtitle</label>
                            <textarea id="create_subtitle" name="subtitle" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create_button_text">Button Text</label>
                            <input type="text" id="create_button_text" name="button_text" class="form-control" placeholder="Shop Now">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create_button_link">Button Link</label>
                            <input type="text" id="create_button_link" name="button_link" class="form-control" placeholder="/products">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create_is_active">Status</label>
                            <select id="create_is_active" name="is_active" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create_image">Banner Image</label>
                            <input type="file" id="create_image" name="image" class="form-control" accept="image/jpeg,image/png,image/webp" required>
                        </div>
                        <div class="col-12 d-none" id="createImagePreviewBox">
                            <img id="createImagePreview" class="banner-preview-img" alt="Preview">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-column flex-sm-row gap-2">
                <button type="button" class="btn btn-light w-100 w-sm-auto" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary w-100 w-sm-auto" id="btnCreateBanner">Save Banner</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="editBannerModalLabel">Edit Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBannerForm">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="edit_title">Title</label>
                            <input type="text" id="edit_title" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit_sort_order">Sort Order</label>
                            <input type="number" id="edit_sort_order" name="sort_order" class="form-control" min="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="edit_subtitle">Subtitle</label>
                            <textarea id="edit_subtitle" name="subtitle" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit_button_text">Button Text</label>
                            <input type="text" id="edit_button_text" name="button_text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit_button_link">Button Link</label>
                            <input type="text" id="edit_button_link" name="button_link" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit_is_active">Status</label>
                            <select id="edit_is_active" name="is_active" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit_image">Ganti Gambar</label>
                            <input type="file" id="edit_image" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                        </div>
                        <div class="col-12" id="editImagePreviewBox">
                            <img id="editImagePreview" class="banner-preview-img" alt="Preview">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-column flex-sm-row gap-2">
                <button type="button" class="btn btn-light w-100 w-sm-auto" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary w-100 w-sm-auto" id="btnUpdateBanner">Update Banner</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/banners.css') ?>">
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url('assets/js/banners.js') ?>"></script>
