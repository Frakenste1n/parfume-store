<div class="payments-page">

    <div class="page-header">
        <div class="page-header-text">
            <h2>Payment Management</h2>
            <p>Kelola metode pembayaran dan rekening tujuan transaksi.</p>
        </div>
        <button type="button" class="btn-add-payment" data-bs-toggle="modal" data-bs-target="#createPaymentModal">
            <i class="bi bi-plus-lg"></i>
            <span>Add Payment</span>
        </button>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-total">
                <div class="icon-box"><i class="bi bi-credit-card"></i></div>
                <div class="stats-card-body">
                    <span>Total Methods</span>
                    <h3 id="totalPayments">0</h3>
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
            <div class="stats-card stat-logo">
                <div class="icon-box"><i class="bi bi-image"></i></div>
                <div class="stats-card-body">
                    <span>With Logo</span>
                    <h3 id="totalWithLogo">0</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card payments-table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <div class="table-card-icon"><i class="bi bi-credit-card-2-front"></i></div>
                <div>
                    <h5>All Payment Methods</h5>
                    <p>Metode pembayaran yang ditampilkan ke customer</p>
                </div>
            </div>
            <span class="table-count-badge" id="tablePaymentCount">0 methods</span>
        </div>

        <div class="payments-table-wrap">
            <table class="table payments-table align-middle w-100" id="paymentsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Method</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
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
<div class="modal fade" id="createPaymentModal" tabindex="-1" aria-labelledby="createPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="createPaymentModalLabel">Add Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createPaymentForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="create_name">Method Name</label>
                            <input type="text" id="create_name" name="name" class="form-control" placeholder="BCA / GoPay" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create_is_active">Status</label>
                            <select id="create_is_active" name="is_active" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create_account_name">Account Name</label>
                            <input type="text" id="create_account_name" name="account_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="create_account_number">Account Number</label>
                            <input type="text" id="create_account_number" name="account_number" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="create_logo">Logo (opsional)</label>
                            <input type="file" id="create_logo" name="logo" class="form-control" accept="image/jpeg,image/png,image/webp">
                        </div>
                        <div class="col-12 d-none" id="createLogoPreviewBox">
                            <img id="createLogoPreview" class="payment-preview-img" alt="Preview">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-column flex-sm-row gap-2">
                <button type="button" class="btn btn-light w-100 w-sm-auto" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary w-100 w-sm-auto" id="btnCreatePayment">Save Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editPaymentModal" tabindex="-1" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPaymentForm">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="edit_name">Method Name</label>
                            <input type="text" id="edit_name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit_is_active">Status</label>
                            <select id="edit_is_active" name="is_active" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit_account_name">Account Name</label>
                            <input type="text" id="edit_account_name" name="account_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="edit_account_number">Account Number</label>
                            <input type="text" id="edit_account_number" name="account_number" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="edit_logo">Ganti Logo</label>
                            <input type="file" id="edit_logo" name="logo" class="form-control" accept="image/jpeg,image/png,image/webp">
                        </div>
                        <div class="col-12" id="editLogoPreviewBox">
                            <img id="editLogoPreview" class="payment-preview-img" alt="Preview">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-column flex-sm-row gap-2">
                <button type="button" class="btn btn-light w-100 w-sm-auto" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary w-100 w-sm-auto" id="btnUpdatePayment">Update Payment</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/payments.css') ?>">
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url('assets/js/payments.js') ?>"></script>
