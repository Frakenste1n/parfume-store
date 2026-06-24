<div class="categories-page">

    <!-- HEADER -->
    <div class="page-header">

        <div class="page-header-text">

            <h2>
                Category Management
            </h2>

            <p>
                Organize perfume categories for better product structure.
            </p>

        </div>

        <button
            type="button"
            class="btn-add-category"
            data-bs-toggle="modal"
            data-bs-target="#createCategoryModal">

            <i class="bi bi-plus-lg"></i>

            <span>Add Category</span>

        </button>

    </div>


    <!-- STATISTICS -->
    <div class="row g-3 g-md-4 mb-4">

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-total">

                <div class="icon-box">
                    <i class="bi bi-grid"></i>
                </div>

                <div class="stats-card-body">

                    <span>Total Categories</span>

                    <h3 id="totalCategories">
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

                    <span>Active</span>

                    <h3 id="totalActive">
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

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-described">

                <div class="icon-box">
                    <i class="bi bi-card-text"></i>
                </div>

                <div class="stats-card-body">

                    <span>With Description</span>

                    <h3 id="totalDescribed">
                        0
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="content-card categories-table-card">

        <div class="table-card-header">

            <div class="table-card-title">

                <div class="table-card-icon">
                    <i class="bi bi-folder2-open"></i>
                </div>

                <div>

                    <h5>
                        All Categories
                    </h5>

                    <p>
                        Daftar lengkap kategori produk parfum
                    </p>

                </div>

            </div>

            <span class="table-count-badge" id="tableCategoryCount">
                0 categories
            </span>

        </div>

        <div class="categories-table-wrap">

            <table class="table categories-table align-middle w-100" id="categoriesTable">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Category</th>

                        <th>Description</th>

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
    id="createCategoryModal"
    tabindex="-1"
    aria-labelledby="createCategoryModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">

                <h5 class="modal-title" id="createCategoryModalLabel">
                    Add Category
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <form id="createCategoryForm">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label" for="create_name">
                                Category Name
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

                        <div class="col-12">

                            <label class="form-label" for="create_description">
                                Description
                            </label>

                            <textarea
                                id="create_description"
                                name="description"
                                rows="4"
                                class="form-control"
                                placeholder="Deskripsi singkat kategori..."></textarea>

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
                    id="btnCreateCategory">

                    Save Category

                </button>

            </div>

        </div>

    </div>

</div>


<!-- EDIT MODAL -->
<div
    class="modal fade"
    id="editCategoryModal"
    tabindex="-1"
    aria-labelledby="editCategoryModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">

                <h5 class="modal-title" id="editCategoryModalLabel">
                    Edit Category
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <form id="editCategoryForm">

                    <input type="hidden" name="id" id="edit_id">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label" for="edit_name">
                                Category Name
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

                        <div class="col-12">

                            <label class="form-label" for="edit_description">
                                Description
                            </label>

                            <textarea
                                id="edit_description"
                                name="description"
                                rows="4"
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
                    id="btnUpdateCategory">

                    Update Category

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
    href="<?= base_url('assets/css/categories.css') ?>">

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script src="<?= base_url('assets/js/categories.js') ?>"></script>
