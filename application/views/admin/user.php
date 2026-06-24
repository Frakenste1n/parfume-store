<div class="users-page">

    <!-- HEADER -->
    <div class="page-header">

        <div class="page-header-text">

            <h2>
                Users Management
            </h2>

            <p>
                Manage all user accounts and permissions.
            </p>

        </div>

        <button
            type="button"
            class="btn-add-user"
            data-bs-toggle="modal"
            data-bs-target="#createUserModal">

            <i class="bi bi-plus-lg"></i>

            <span>Add User</span>

        </button>

    </div>


    <!-- STATISTICS -->
    <div class="row g-3 g-md-4 mb-4">

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-users">

                <div class="icon-box">
                    <i class="bi bi-people"></i>
                </div>

                <div class="stats-card-body">

                    <span>Total Users</span>

                    <h3 id="totalUsers">
                        0
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-admin">

                <div class="icon-box">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div class="stats-card-body">

                    <span>Total Admin</span>

                    <h3 id="totalAdmin">
                        0
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-customer">

                <div class="icon-box">
                    <i class="bi bi-person-heart"></i>
                </div>

                <div class="stats-card-body">

                    <span>Total Customer</span>

                    <h3 id="totalCustomer">
                        0
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-6 col-xl-3">

            <div class="stats-card stat-inactive">

                <div class="icon-box">
                    <i class="bi bi-person-x"></i>
                </div>

                <div class="stats-card-body">

                    <span>Inactive User</span>

                    <h3 id="totalInactive">
                        0
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="content-card users-table-card">

        <div class="table-card-header">

            <div class="table-card-title">

                <div class="table-card-icon">
                    <i class="bi bi-person-lines-fill"></i>
                </div>

                <div>

                    <h5>
                        All Users
                    </h5>

                    <p>
                        Daftar lengkap akun pengguna terdaftar
                    </p>

                </div>

            </div>

            <span class="table-count-badge" id="tableUserCount">
                0 users
            </span>

        </div>

        <div class="users-table-wrap">

            <table class="table users-table align-middle w-100" id="usersTable">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>User</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Role</th>

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
    id="createUserModal"
    tabindex="-1"
    aria-labelledby="createUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">

                <h5 class="modal-title" id="createUserModalLabel">
                    Add User
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <form id="createUserForm">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">Name</label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">Phone</label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control">

                        </div>

                        <div class="col-12">

                            <label class="form-label">Address</label>

                            <textarea
                                name="address"
                                rows="3"
                                class="form-control"></textarea>

                        </div>

                        <div class="col-12">

                            <label class="form-label">Role</label>

                            <select
                                class="form-select"
                                name="role">

                                <option value="admin">
                                    Admin
                                </option>

                                <option value="customer">
                                    Customer
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
                    id="btnCreateUser">

                    Save User

                </button>

            </div>

        </div>

    </div>

</div>



<!-- EDIT MODAL -->
<div
    class="modal fade"
    id="editUserModal"
    tabindex="-1"
    aria-labelledby="editUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-header">

                <h5 class="modal-title" id="editUserModalLabel">
                    Edit User
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <form id="editUserForm">

                    <input
                        type="hidden"
                        name="id"
                        id="edit_id">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">Name</label>

                            <input
                                id="edit_name"
                                name="name"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">Email</label>

                            <input
                                id="edit_email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">Phone</label>

                            <input
                                id="edit_phone"
                                name="phone"
                                class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">Role</label>

                            <select
                                id="edit_role"
                                class="form-select"
                                name="role">

                                <option value="admin">
                                    Admin
                                </option>

                                <option value="customer">
                                    Customer
                                </option>

                            </select>

                        </div>

                        <div class="col-12">

                            <label class="form-label">Address</label>

                            <textarea
                                rows="3"
                                id="edit_address"
                                class="form-control"
                                name="address"></textarea>

                        </div>

                        <div class="col-12">

                            <label class="form-label">Status</label>

                            <select
                                class="form-select"
                                id="edit_status"
                                name="is_active">

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
                    id="btnUpdateUser">

                    Update User

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
    href="<?= base_url('assets/css/users.css') ?>">

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script src="<?= base_url('assets/js/users.js') ?>"></script>
