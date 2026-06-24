let table = null;
let orderDetailModal = null;

$(document).ready(function () {
    orderDetailModal = new bootstrap.Modal(document.getElementById("orderDetailModal"));
    $("#filterStatus").on("change", applyStatusFilter);
    loadStatistics();
    loadOrders();
});

function rupiah(value) {
    return "Rp " + Number(value || 0).toLocaleString("id-ID");
}

function formatDate(value) {
    if (!value) return "-";
    const date = new Date(String(value).replace(" ", "T"));
    if (isNaN(date.getTime())) return value;
    return date.toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit"
    });
}

function getPaymentStatus(order) {
    return order.payment_status || order.status || "pending";
}

function getOrderTotal(order) {
    return order.grand_total || order.total_price || order.subtotal || 0;
}

function renderPaymentBadge(status) {
    const map = {
        pending: "payment-pending",
        paid: "payment-paid",
        failed: "payment-failed",
        cancelled: "payment-cancelled"
    };
    const cls = map[String(status).toLowerCase()] || "payment-pending";
    return '<span class="payment-badge ' + cls + '">' + String(status) + '</span>';
}

function renderStatusSelect(order) {
    const status = getPaymentStatus(order).toLowerCase();
    const options = ["pending", "paid", "failed", "cancelled"];

    let html = '<select class="form-select form-select-sm status-select" onchange="updateOrderStatus(' + order.id + ', this.value)">';

    $.each(options, function (i, opt) {
        html += '<option value="' + opt + '"' + (status === opt ? " selected" : "") + '>' + opt + '</option>';
    });

    html += "</select>";

    return html;
}

function renderOrderCell(order) {
    return `
    <div class="order-cell">
        <div class="order-icon"><i class="bi bi-receipt"></i></div>
        <div class="order-info">
            <span class="order-number">${order.order_number || ("#" + order.id)}</span>
            <span class="order-meta">ID ${order.id}</span>
        </div>
    </div>`;
}

function renderCustomerCell(order) {
    return `
    <div class="customer-cell">
        <span class="customer-name">${order.name || "User #" + order.user_id}</span>
        <span class="customer-meta">${order.email || ("User ID: " + (order.user_id || "-"))}</span>
    </div>`;
}

function renderActionButtons(id) {
    return `
    <div class="action-group">
        <button type="button" class="btn-action btn-view" onclick="viewOrderDetail(${id})" title="Detail">
            <i class="bi bi-eye"></i>
        </button>
        <button type="button" class="btn-action btn-delete" onclick="deleteOrder(${id})" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </div>`;
}

function updateTableCount(total) {
    $("#tableOrderCount").text(total + " orders");
}

function showApiError(xhr, fallback) {
    Swal.fire({
        icon: "error",
        title: "Oops",
        text: (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : fallback
    });
}

function loadOrders() {
    if (table != null) table.destroy();

    table = $("#ordersTable").DataTable({
        processing: true,
        responsive: { details: { type: "inline", target: "tr" } },
        scrollX: true,
        autoWidth: false,
        order: [[0, "desc"]],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"orders-dt-top"lf>rt<"orders-dt-bottom"ip>',
        language: {
            processing: "Memuat data...",
            search: "",
            searchPlaceholder: "Cari order, customer, status...",
            lengthMenu: "Tampilkan _MENU_",
            info: "Menampilkan _START_–_END_ dari _TOTAL_ order",
            infoEmpty: "Belum ada order",
            infoFiltered: "(filter dari _MAX_ total)",
            zeroRecords: "Order tidak ditemukan",
            paginate: { first: "«", last: "»", next: "›", previous: "‹" }
        },
        ajax: {
            url: base_url + "api/orders",
            dataSrc: function (json) {
                if (!json.success) return [];
                updateTableCount(json.data.length);
                return json.data;
            }
        },
        columnDefs: [
            { responsivePriority: 5, targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: 2 },
            { responsivePriority: 3, targets: 3 },
            { responsivePriority: 4, targets: 4 },
            { responsivePriority: 6, targets: 5 },
            { responsivePriority: 1, targets: 6, orderable: false, className: "text-end all" }
        ],
        columns: [
            { data: "id" },
            { data: null, render: function (d) { return renderOrderCell(d); } },
            { data: null, render: function (d) { return renderCustomerCell(d); } },
            { data: null, render: function (d) { return '<span class="cell-total">' + rupiah(getOrderTotal(d)) + '</span>'; } },
            { data: null, render: function (d) { return renderStatusSelect(d); } },
            { data: "created_at", render: function (d) { return '<span class="cell-date">' + formatDate(d) + '</span>'; } },
            { data: "id", orderable: false, render: function (d) { return renderActionButtons(d); } }
        ]
    });
}

function loadStatistics() {
    $.ajax({
        url: base_url + "api/orders",
        success: function (res) {
            if (!res.success) return;
            let total = 0, pending = 0, paid = 0, revenue = 0;
            $.each(res.data, function (i, item) {
                total++;
                let status = getPaymentStatus(item).toLowerCase();
                if (status === "pending") pending++;
                if (status === "paid") {
                    paid++;
                    revenue += Number(getOrderTotal(item));
                }
            });
            $("#totalOrders").text(total);
            $("#totalPending").text(pending);
            $("#totalPaid").text(paid);
            $("#totalRevenue").text(rupiah(revenue));
            updateTableCount(total);
        }
    });
}

function applyStatusFilter() {
    const val = $("#filterStatus").val().toLowerCase();
    if (!table) return;
    table.column(4).search(val ? "^" + val + "$" : "", true, false).draw();
}

function updateOrderStatus(id, status) {
    $.ajax({
        url: base_url + "api/orders/" + id,
        type: "PUT",
        data: { payment_status: status },
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                loadOrders();
                return;
            }
            loadStatistics();
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: res.message,
                timer: 1200,
                showConfirmButton: false
            });
        },
        error: function (xhr) {
            showApiError(xhr, "Gagal update status order");
            loadOrders();
        }
    });
}

function viewOrderDetail(id) {
    $.ajax({
        url: base_url + "api/orders/" + id,
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }

            let order = res.data;
            let itemsHtml = "";

            if (order.items && order.items.length) {
                $.each(order.items, function (i, item) {
                    itemsHtml += `
                    <div class="order-item-row">
                        <div>
                            <strong>${item.product_name || "-"}</strong>
                            <div class="text-muted small">${item.qty || 0} x ${rupiah(item.price)}</div>
                        </div>
                        <div class="fw-semibold">${rupiah(item.subtotal)}</div>
                    </div>`;
                });
            } else {
                itemsHtml = '<p class="text-muted mb-0">Tidak ada item pesanan.</p>';
            }

            $("#orderDetailBody").html(`
                <div class="order-detail-summary mb-3">
                    <h5 class="mb-1">${order.order_number || ("Order #" + order.id)}</h5>
                    <div class="mb-2">${renderPaymentBadge(getPaymentStatus(order))}</div>
                    <div class="small text-muted">Customer: ${order.name || "-"} (${order.email || "-"})</div>
                </div>
                <div class="detail-grid mb-3">
                    <div class="detail-row"><span class="detail-label">Subtotal</span><span class="detail-value">${rupiah(order.subtotal)}</span></div>
                    <div class="detail-row"><span class="detail-label">Grand Total</span><span class="detail-value">${rupiah(getOrderTotal(order))}</span></div>
                    <div class="detail-row"><span class="detail-label">Phone</span><span class="detail-value">${order.phone || "-"}</span></div>
                    <div class="detail-row"><span class="detail-label">Created</span><span class="detail-value">${formatDate(order.created_at)}</span></div>
                </div>
                <h6 class="fw-bold mb-3">Order Items</h6>
                <div class="order-items-list">${itemsHtml}</div>
            `);

            orderDetailModal.show();
        },
        error: function (xhr) {
            showApiError(xhr, "Gagal memuat detail order");
        }
    });
}

function deleteOrder(id) {
    Swal.fire({
        title: "Hapus order?",
        text: "Order dan item terkait akan dihapus permanen.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal"
    }).then(function (result) {
        if (!result.isConfirmed) return;

        $.ajax({
            url: base_url + "api/orders/" + id,
            type: "DELETE",
            success: function (res) {
                if (!res.success) {
                    Swal.fire({ icon: "error", title: "Oops", text: res.message });
                    return;
                }
                Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
                loadOrders();
                loadStatistics();
            },
            error: function (xhr) {
                showApiError(xhr, "Gagal menghapus order");
            }
        });
    });
}
