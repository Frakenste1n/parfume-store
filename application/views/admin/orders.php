<div class="orders-page">

    <div class="page-header">
        <div class="page-header-text">
            <h2>Order Management</h2>
            <p>Monitor customer orders, payment status, and order fulfillment.</p>
        </div>
        <div class="header-actions">
            <select id="filterStatus" class="form-select filter-status">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
                <option value="failed">Failed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-total">
                <div class="icon-box"><i class="bi bi-bag"></i></div>
                <div class="stats-card-body">
                    <span>Total Orders</span>
                    <h3 id="totalOrders">0</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-pending">
                <div class="icon-box"><i class="bi bi-clock"></i></div>
                <div class="stats-card-body">
                    <span>Pending</span>
                    <h3 id="totalPending">0</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-paid">
                <div class="icon-box"><i class="bi bi-credit-card"></i></div>
                <div class="stats-card-body">
                    <span>Paid</span>
                    <h3 id="totalPaid">0</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stats-card stat-revenue">
                <div class="icon-box"><i class="bi bi-cash-stack"></i></div>
                <div class="stats-card-body">
                    <span>Revenue (Paid)</span>
                    <h3 id="totalRevenue" class="revenue-text">Rp 0</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card orders-table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <div class="table-card-icon"><i class="bi bi-receipt"></i></div>
                <div>
                    <h5>All Orders</h5>
                    <p>Daftar pesanan dari seluruh customer</p>
                </div>
            </div>
            <span class="table-count-badge" id="tableOrderCount">0 orders</span>
        </div>
        <div class="orders-table-wrap">
            <table class="table orders-table align-middle w-100" id="ordersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Payment Status</th>
                        <th>Created</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- DETAIL MODAL -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title">Order Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="orderDetailBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/orders.css') ?>">
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url('assets/js/orders.js') ?>"></script>
