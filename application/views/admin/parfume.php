<div class="parfume-page">

    <div class="page-header">
        <div class="page-header-text">
            <h2>Parfume Management</h2>
            <p>Manage perfumes, pricing, stock, brand and category relations.</p>
        </div>
        <button type="button" class="btn-add-parfume" data-bs-toggle="modal" data-bs-target="#createParfumeModal">
            <i class="bi bi-plus-lg"></i>
            <span>Add Parfume</span>
        </button>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-total">
                <div class="icon-box"><i class="bi bi-droplet"></i></div>
                <div class="stats-card-body">
                    <span>Total Products</span>
                    <h3 id="totalProducts">0</h3>
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
            <div class="stats-card stat-featured">
                <div class="icon-box"><i class="bi bi-star"></i></div>
                <div class="stats-card-body">
                    <span>Featured</span>
                    <h3 id="totalFeatured">0</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-lowstock">
                <div class="icon-box"><i class="bi bi-exclamation-triangle"></i></div>
                <div class="stats-card-body">
                    <span>Low Stock</span>
                    <h3 id="totalLowStock">0</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card parfume-table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <div class="table-card-icon"><i class="bi bi-box-seam"></i></div>
                <div>
                    <h5>All Parfumes</h5>
                    <p>Daftar lengkap produk parfum</p>
                </div>
            </div>
            <span class="table-count-badge" id="tableProductCount">0 products</span>
        </div>
        <div class="parfume-table-wrap">
            <table class="table parfume-table align-middle w-100" id="parfumeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Featured</th>
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
<div class="modal fade" id="createParfumeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title">Add Parfume</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createParfumeForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" id="create_name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Slug</label>
                            <input type="text" id="create_slug" name="slug" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" id="create_brand_id" class="form-select" required></select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select name="category_id" id="create_category_id" class="form-select" required></select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Price (Rp)</label>
                            <input type="number" name="price" class="form-control" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Featured</label>
                            <select name="is_featured" class="form-select">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="is_active" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-column flex-sm-row gap-2">
                <button type="button" class="btn btn-light w-100 w-sm-auto" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary w-100 w-sm-auto" id="btnCreateParfume">Save Parfume</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editParfumeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title">Edit Parfume</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editParfumeForm">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" id="edit_name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Slug</label>
                            <input type="text" id="edit_slug" name="slug" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">SKU</label>
                            <input type="text" id="edit_sku" name="sku" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" id="edit_brand_id" class="form-select" required></select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select name="category_id" id="edit_category_id" class="form-select" required></select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Price (Rp)</label>
                            <input type="number" id="edit_price" name="price" class="form-control" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Stock</label>
                            <input type="number" id="edit_stock" name="stock" class="form-control" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Featured</label>
                            <select id="edit_is_featured" name="is_featured" class="form-select">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select id="edit_is_active" name="is_active" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea id="edit_short_description" name="short_description" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea id="edit_description" name="description" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </form>

                <hr class="my-4">

                <div class="product-images-section">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h6 class="mb-0 fw-bold">Product Images</h6>
                        <label class="btn btn-sm btn-outline-primary mb-0">
                            <i class="bi bi-upload"></i> Upload Image
                            <input type="file" id="productImageInput" class="d-none" accept="image/jpeg,image/png,image/webp">
                        </label>
                    </div>
                    <div id="productImagesList" class="product-images-grid"></div>
                </div>
            </div>
            <div class="modal-footer flex-column flex-sm-row gap-2">
                <button type="button" class="btn btn-light w-100 w-sm-auto" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary w-100 w-sm-auto" id="btnUpdateParfume">Update Parfume</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/parfume.css') ?>">
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url('assets/js/parfume.js') ?>"></script>
