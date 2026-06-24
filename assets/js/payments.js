let table = null;
let createPaymentModal = null;
let editPaymentModal = null;

$(document).ready(function () {
    createPaymentModal = new bootstrap.Modal(document.getElementById("createPaymentModal"));
    editPaymentModal = new bootstrap.Modal(document.getElementById("editPaymentModal"));

    bindPaymentEvents();
    loadStatistics();
    loadPayments();
});

function bindPaymentEvents() {
    $("#create_logo").on("change", function () {
        previewLogoFile(this, "#createLogoPreview", "#createLogoPreviewBox");
    });

    $("#edit_logo").on("change", function () {
        previewLogoFile(this, "#editLogoPreview", "#editLogoPreviewBox");
    });

    $("#createPaymentModal").on("hidden.bs.modal", function () {
        resetCreateForm();
    });

    $("#btnCreatePayment").click(createPayment);
    $("#btnUpdatePayment").click(updatePayment);
}

function resetCreateForm() {
    $("#createPaymentForm")[0].reset();
    $("#createLogoPreviewBox").addClass("d-none");
    $("#createLogoPreview").attr("src", "");
}

function uploadsUrl(folder, filename) {
    if (!filename) {
        return "";
    }

    return base_url.replace(/\/?$/, "/") + "uploads/" + folder + "/" + filename;
}

function previewLogoFile(input, previewSelector, boxSelector) {
    const file = input.files[0];

    if (!file) {
        $(boxSelector).addClass("d-none");
        return;
    }

    const reader = new FileReader();

    reader.onload = function (e) {
        $(previewSelector).attr("src", e.target.result);
        $(boxSelector).removeClass("d-none");
    };

    reader.readAsDataURL(file);
}

function renderStatusBadge(isActive) {
    if (isActive == 1) {
        return '<span class="status-active">Active</span>';
    }

    return '<span class="status-inactive">Inactive</span>';
}

function renderPaymentCell(data) {
    const img = data.logo
        ? uploadsUrl("payments", data.logo)
        : "https://ui-avatars.com/api/?name=" + encodeURIComponent(data.name || "Pay") + "&background=6366f1&color=fff";

    return `
    <div class="payment-cell">
        <img src="${img}" alt="${data.name || "Payment"}" class="payment-thumb">
        <div class="payment-info">
            <span class="payment-name">${data.name || "-"}</span>
        </div>
    </div>`;
}

function renderActionButtons(id) {
    return `
    <div class="action-group">
        <button type="button" class="btn-action btn-edit" onclick="editPayment(${id})" title="Edit payment">
            <i class="bi bi-pencil"></i>
        </button>
        <button type="button" class="btn-action btn-delete" onclick="deletePayment(${id})" title="Delete payment">
            <i class="bi bi-trash"></i>
        </button>
    </div>`;
}

function updateTableCount(total) {
    $("#tablePaymentCount").text(total + " methods");
}

function showApiError(xhr, fallback) {
    const message = xhr.responseJSON && xhr.responseJSON.message
        ? xhr.responseJSON.message
        : fallback;

    Swal.fire({ icon: "error", title: "Oops", text: message });
}

function releaseModalFocus(modalEl) {
    if (document.activeElement) {
        document.activeElement.blur();
    }

    const trigger = document.querySelector('[data-bs-target="#' + modalEl.id + '"]');

    if (trigger) {
        trigger.focus();
    }
}

function afterModalHidden(modalEl, callback) {
    modalEl.addEventListener("hidden.bs.modal", function handler() {
        modalEl.removeEventListener("hidden.bs.modal", handler);
        callback();
    });
}

function loadStatistics() {
    $.get(base_url + "api/payment-methods?all=1", function (res) {
        if (!res.success) {
            return;
        }

        const data = res.data || [];
        const active = data.filter(function (item) { return item.is_active == 1; }).length;
        const withLogo = data.filter(function (item) { return item.logo; }).length;

        $("#totalPayments").text(data.length);
        $("#totalActive").text(active);
        $("#totalInactive").text(data.length - active);
        $("#totalWithLogo").text(withLogo);
    });
}

function loadPayments() {
    if (table != null) {
        table.destroy();
    }

    table = $("#paymentsTable").DataTable({
        processing: true,
        responsive: { details: { type: "inline", target: "tr" } },
        scrollX: true,
        autoWidth: false,
        order: [[0, "desc"]],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"payments-dt-top"lf>rt<"payments-dt-bottom"ip>',
        language: {
            processing: "Memuat data...",
            search: "",
            searchPlaceholder: "Cari metode, rekening...",
            lengthMenu: "Tampilkan _MENU_",
            info: "Menampilkan _START_–_END_ dari _TOTAL_ metode",
            infoEmpty: "Belum ada metode pembayaran",
            infoFiltered: "(filter dari _MAX_ total)",
            zeroRecords: "Metode tidak ditemukan",
            paginate: { first: "«", last: "»", next: "›", previous: "‹" }
        },
        ajax: {
            url: base_url + "api/payment-methods?all=1",
            dataSrc: function (json) {
                if (!json.success) {
                    return [];
                }

                updateTableCount(json.data.length);
                return json.data;
            }
        },
        columnDefs: [
            { responsivePriority: 5, targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 3, targets: 2 },
            { responsivePriority: 3, targets: 3 },
            { responsivePriority: 2, targets: 4 },
            { responsivePriority: 1, targets: 5, orderable: false, className: "text-end all" }
        ],
        columns: [
            { data: "id" },
            {
                data: null,
                render: function (data) {
                    return renderPaymentCell(data);
                }
            },
            { data: "account_name" },
            {
                data: "account_number",
                render: function (data) {
                    return '<span class="account-number">' + (data || "-") + "</span>";
                }
            },
            {
                data: "is_active",
                render: function (data) {
                    return renderStatusBadge(data);
                }
            },
            {
                data: "id",
                render: function (data) {
                    return renderActionButtons(data);
                }
            }
        ]
    });
}

function createPayment() {
    const formEl = document.getElementById("createPaymentForm");
    const formData = new FormData(formEl);

    $.ajax({
        url: base_url + "api/payment-methods",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }

            const modalEl = document.getElementById("createPaymentModal");

            createPaymentModal.hide();

            afterModalHidden(modalEl, function () {
                Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
                loadStatistics();
                table.ajax.reload(null, false);
            });

            releaseModalFocus(modalEl);
        },
        error: function (xhr) {
            showApiError(xhr, "Gagal menambahkan metode pembayaran");
        }
    });
}

function editPayment(id) {
    $.get(base_url + "api/payment-methods/" + id, function (res) {
        if (!res.success) {
            Swal.fire({ icon: "error", title: "Oops", text: res.message });
            return;
        }

        const data = res.data;

        $("#edit_id").val(data.id);
        $("#edit_name").val(data.name);
        $("#edit_account_name").val(data.account_name);
        $("#edit_account_number").val(data.account_number);
        $("#edit_is_active").val(data.is_active);

        if (data.logo) {
            $("#editLogoPreview").attr("src", uploadsUrl("payments", data.logo));
            $("#editLogoPreviewBox").removeClass("d-none");
        } else {
            $("#editLogoPreview").attr("src", "");
            $("#editLogoPreviewBox").addClass("d-none");
        }

        editPaymentModal.show();
    });
}

function updatePayment() {
    const id = $("#edit_id").val();
    const formEl = document.getElementById("editPaymentForm");
    const hasFile = $("#edit_logo")[0].files.length > 0;

    const request = {
        url: base_url + "api/payment-methods/" + id,
        type: hasFile ? "POST" : "PUT",
        data: hasFile ? new FormData(formEl) : $("#editPaymentForm").serialize(),
        processData: !hasFile,
        contentType: hasFile ? false : "application/x-www-form-urlencoded; charset=UTF-8",
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }

            const modalEl = document.getElementById("editPaymentModal");

            editPaymentModal.hide();

            afterModalHidden(modalEl, function () {
                Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
                loadStatistics();
                table.ajax.reload(null, false);
            });

            releaseModalFocus(modalEl);
        },
        error: function (xhr) {
            showApiError(xhr, "Gagal mengupdate metode pembayaran");
        }
    };

    $.ajax(request);
}

function deletePayment(id) {
    Swal.fire({
        title: "Hapus metode pembayaran?",
        text: "Data akan dihapus permanen.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        cancelButtonColor: "#94a3b8",
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal"
    }).then(function (result) {
        if (!result.isConfirmed) {
            return;
        }

        $.ajax({
            url: base_url + "api/payment-methods/" + id,
            type: "DELETE",
            success: function (res) {
                if (!res.success) {
                    Swal.fire({ icon: "error", title: "Oops", text: res.message });
                    return;
                }

                Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
                loadStatistics();
                table.ajax.reload(null, false);
            },
            error: function (xhr) {
                showApiError(xhr, "Gagal menghapus metode pembayaran");
            }
        });
    });
}
