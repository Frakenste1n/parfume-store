<div class="brands-page">

    <!-- HEADER -->
    <div class="page-header">

        <div class="page-header-text">

            <h2>
                Brand Management
            </h2>

            <p>
                Manage perfume brands, logos, and company profiles.
            </p>

        </div>

        <button
            type="button"
            class="btn-add-brand"
            data-bs-toggle="modal"
            data-bs-target="#createBrandModal">

            <i class="bi bi-plus-lg"></i>

            <span>Add Brand</span>

        </button>

    </div>


    <!-- STATISTICS -->
    <div class="row g-3 g-md-4 mb-4">

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-total">

                <div class="icon-box">
                    <i class="bi bi-tags"></i>
                </div>

                <div class="stats-card-body">

                    <span>Total Brands</span>

                    <h3 id="totalBrands">
                        0
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-active">

                <div class="icon-box">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div class="stats-card-body">

                    <span>Active Brands</span>

                    <h3 id="totalActive">
                        0
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-featured">

                <div class="icon-box">
                    <i class="bi bi-star"></i>
                </div>

                <div class="stats-card-body">

                    <span>Featured</span>

                    <h3 id="totalFeatured">
                        0
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-inactive">

                <div class="icon-box">
                    <i class="bi bi-slash-circle"></i>
                </div>

                <div class="stats-card-body">

                    <span>Inactive</span>

                    <h3 id="totalInactive">
                        0
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="content-card brands-table-card">

        <div class="table-card-header">

            <div class="table-card-title">

                <div class="table-card-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div>

                    <h5>
                        All Brands
                    </h5>

                    <p>
                        Daftar lengkap brand parfum terdaftar
                    </p>

                </div>

            </div>

            <span class="table-count-badge" id="tableBrandCount">
                0 brands
            </span>

        </div>

        <div class="brands-table-wrap">

            <table class="table brands-table align-middle w-100" id="brandsTable">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Brand</th>

                        <th>Country</th>

                        <th>Website</th>

                        <th>Featured</th>

                        <th>Status</th>

                        <th>Created</th>

                        <th class="text-end">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- CREATE MODAL -->
<div
    class="modal fade"
    id="createBrandModal"
    tabindex="-1"
    aria-labelledby="createBrandModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">

                <h5 class="modal-title" id="createBrandModalLabel">
                    Add Brand
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <form id="createBrandForm" enctype="multipart/form-data">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label" for="create_name">
                                Brand Name
                            </label>

                            <input
                                type="text"
                                id="create_name"
                                name="name"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="create_slug">
                                Slug
                            </label>

                            <input
                                type="text"
                                id="create_slug"
                                name="slug"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="create_origin_country">
                                Origin Country
                            </label>

                            <input
                                type="text"
                                id="create_origin_country"
                                name="origin_country"
                                class="form-control"
                                placeholder="e.g. France">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="create_logo">
                                Logo
                            </label>

                            <input
                                type="file"
                                id="create_logo"
                                name="logo"
                                class="form-control"
                                accept="image/jpeg,image/png,image/webp">

                        </div>

                        <div class="col-12">

                            <div class="logo-preview-box d-none" id="createLogoPreviewBox">

                                <img
                                    src=""
                                    alt="Logo preview"
                                    id="createLogoPreview"
                                    class="logo-preview-img">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="create_website">
                                Website
                            </label>

                            <input
                                type="url"
                                id="create_website"
                                name="website"
                                class="form-control"
                                placeholder="https://">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="create_instagram">
                                Instagram
                            </label>

                            <input
                                type="text"
                                id="create_instagram"
                                name="instagram"
                                class="form-control"
                                placeholder="@brandname">

                        </div>

                        <div class="col-12">

                            <label class="form-label" for="create_description">
                                Description
                            </label>

                            <textarea
                                id="create_description"
                                name="description"
                                rows="3"
                                class="form-control"></textarea>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="create_is_featured">
                                Featured
                            </label>

                            <select
                                id="create_is_featured"
                                name="is_featured"
                                class="form-select">

                                <option value="0">
                                    No
                                </option>

                                <option value="1">
                                    Yes
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="create_is_active">
                                Status
                            </label>

                            <select
                                id="create_is_active"
                                name="is_active"
                                class="form-select">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer flex-column flex-sm-row gap-2">

                <button
                    type="button"
                    class="btn btn-light w-100 w-sm-auto"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <button
                    type="button"
                    class="btn btn-primary w-100 w-sm-auto"
                    id="btnCreateBrand">

                    Save Brand

                </button>

            </div>

        </div>

    </div>

</div>


<!-- EDIT MODAL -->
<div
    class="modal fade"
    id="editBrandModal"
    tabindex="-1"
    aria-labelledby="editBrandModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">

                <h5 class="modal-title" id="editBrandModalLabel">
                    Edit Brand
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <form id="editBrandForm">

                    <input type="hidden" name="id" id="edit_id">

                    <div class="row g-3">

                        <div class="col-12">

                            <div class="edit-logo-wrap d-none" id="editLogoWrap">

                                <label class="form-label">
                                    Current Logo
                                </label>

                                <img
                                    src=""
                                    alt="Brand logo"
                                    id="editLogoPreview"
                                    class="logo-preview-img">

                                <small class="text-muted d-block mt-2">
                                    Upload logo hanya tersedia saat create brand.
                                </small>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="edit_name">
                                Brand Name
                            </label>

                            <input
                                type="text"
                                id="edit_name"
                                name="name"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="edit_slug">
                                Slug
                            </label>

                            <input
                                type="text"
                                id="edit_slug"
                                name="slug"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="edit_origin_country">
                                Origin Country
                            </label>

                            <input
                                type="text"
                                id="edit_origin_country"
                                name="origin_country"
                                class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="edit_website">
                                Website
                            </label>

                            <input
                                type="url"
                                id="edit_website"
                                name="website"
                                class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="edit_instagram">
                                Instagram
                            </label>

                            <input
                                type="text"
                                id="edit_instagram"
                                name="instagram"
                                class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="edit_is_featured">
                                Featured
                            </label>

                            <select
                                id="edit_is_featured"
                                name="is_featured"
                                class="form-select">

                                <option value="0">
                                    No
                                </option>

                                <option value="1">
                                    Yes
                                </option>

                            </select>

                        </div>

                        <div class="col-12">

                            <label class="form-label" for="edit_description">
                                Description
                            </label>

                            <textarea
                                id="edit_description"
                                name="description"
                                rows="3"
                                class="form-control"></textarea>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="edit_is_active">
                                Status
                            </label>

                            <select
                                id="edit_is_active"
                                name="is_active"
                                class="form-select">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer flex-column flex-sm-row gap-2">

                <button
                    type="button"
                    class="btn btn-light w-100 w-sm-auto"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <button
                    type="button"
                    class="btn btn-primary w-100 w-sm-auto"
                    id="btnUpdateBrand">

                    Update Brand

                </button>

            </div>

        </div>

    </div>

</div>


<link
    rel="stylesheet"
    href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/brands.css') ?>">

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script src="<?= base_url('assets/js/brands.js') ?>"></script>
