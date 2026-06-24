let table = null;
let createParfumeModal = null;
let editParfumeModal = null;
let slugManualEdit = false;
let currentEditProductId = null;
let brandOptions = [];
let categoryOptions = [];

$(document).ready(function () {
    createParfumeModal = new bootstrap.Modal(document.getElementById("createParfumeModal"));
    editParfumeModal = new bootstrap.Modal(document.getElementById("editParfumeModal"));
    bindParfumeEvents();
    loadOptions().then(function () {
        loadStatistics();
        loadParfumes();
    });
});

function bindParfumeEvents() {
    $("#create_name").on("input", function () {
        if (!slugManualEdit) {
            $("#create_slug").val(slugify($(this).val()));
        }
    });
    $("#create_slug").on("input", function () {
        slugManualEdit = $(this).val().length > 0;
    });
    $("#createParfumeModal").on("hidden.bs.modal", resetCreateForm);
    $("#btnCreateParfume").click(createParfume);
    $("#btnUpdateParfume").click(updateParfume);
    $("#productImageInput").on("change", uploadProductImage);
}

function resetCreateForm() {
    $("#createParfumeForm")[0].reset();
    slugManualEdit = false;
}

function slugify(text) {
    return String(text || "").toLowerCase().trim()
        .replace(/[^\w\s-]/g, "").replace(/[\s_-]+/g, "-").replace(/^-+|-+$/g, "");
}

function rupiah(value) {
    return "Rp " + Number(value || 0).toLocaleString("id-ID");
}

function uploadsUrl(folder, filename) {
    if (!filename) {
        return "";
    }

    return base_url.replace(/\/?$/, "/") + "uploads/" + folder + "/" + filename;
}

function showApiError(xhr, fallback) {
    Swal.fire({
        icon: "error",
        title: "Oops",
        text: (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : fallback
    });
}

function releaseModalFocus(modalEl) {
    if (document.activeElement) document.activeElement.blur();
    const trigger = document.querySelector('[data-bs-target="#' + modalEl.id + '"]');
    if (trigger) trigger.focus();
}

function afterModalHidden(modalEl, callback) {
    modalEl.addEventListener("hidden.bs.modal", function handler() {
        modalEl.removeEventListener("hidden.bs.modal", handler);
        callback();
    });
}

function loadOptions() {
    return $.when(
        $.get(base_url + "api/brands"),
        $.get(base_url + "api/categories")
    ).then(function (brandRes, categoryRes) {
        brandOptions = brandRes[0].success ? brandRes[0].data : [];
        categoryOptions = categoryRes[0].success ? categoryRes[0].data : [];
        fillSelect("#create_brand_id", brandOptions);
        fillSelect("#create_category_id", categoryOptions);
        fillSelect("#edit_brand_id", brandOptions);
        fillSelect("#edit_category_id", categoryOptions);
    });
}

function fillSelect(selector, items) {
    let html = '<option value="">Select</option>';
    $.each(items, function (i, item) {
        html += '<option value="' + item.id + '">' + item.name + '</option>';
    });
    $(selector).html(html);
}

function renderProductCell(data) {
    let thumb = "";

    if (data.primary_image) {
        thumb = `
        <img
            src="${uploadsUrl("products", data.primary_image)}"
            alt="${data.name || "Product"}"
            class="product-thumb-img">`;
    } else {
        thumb = `<div class="product-icon"><i class="bi bi-droplet-fill"></i></div>`;
    }

    return `
    <div class="product-cell">
        ${thumb}
        <div class="product-info">
            <span class="product-name">${data.name || "-"}</span>
            <span class="product-meta">${data.sku || "No SKU"}</span>
        </div>
    </div>`;
}

function renderFeaturedBadge(v) {
    return v == 1
        ? '<span class="badge-featured-yes"><i class="bi bi-star-fill me-1"></i>Yes</span>'
        : '<span class="badge-featured-no">No</span>';
}

function renderStatusBadge(v) {
    return v == 1
        ? '<span class="status-active">Active</span>'
        : '<span class="status-inactive">Inactive</span>';
}

function renderStockBadge(stock) {
    stock = Number(stock || 0);
    if (stock <= 0) return '<span class="stock-badge stock-empty">Empty</span>';
    if (stock <= 5) return '<span class="stock-badge stock-low">' + stock + '</span>';
    return '<span class="stock-badge stock-ok">' + stock + '</span>';
}

function renderActionButtons(id) {
    return `
    <div class="action-group">
        <button type="button" class="btn-action btn-edit" onclick="editParfume(${id})" title="Edit"><i class="bi bi-pencil"></i></button>
        <button type="button" class="btn-action btn-delete" onclick="deleteParfume(${id})" title="Delete"><i class="bi bi-trash"></i></button>
    </div>`;
}

function updateTableCount(total) {
    $("#tableProductCount").text(total + " products");
}

function loadParfumes() {
    if (table != null) table.destroy();

    table = $("#parfumeTable").DataTable({
        processing: true,
        responsive: { details: { type: "inline", target: "tr" } },
        scrollX: true,
        autoWidth: false,
        order: [[0, "desc"]],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"parfume-dt-top"lf>rt<"parfume-dt-bottom"ip>',
        language: {
            processing: "Memuat data...",
            search: "",
            searchPlaceholder: "Cari produk, brand, SKU...",
            lengthMenu: "Tampilkan _MENU_",
            info: "Menampilkan _START_–_END_ dari _TOTAL_ produk",
            infoEmpty: "Belum ada produk",
            infoFiltered: "(filter dari _MAX_ total)",
            zeroRecords: "Produk tidak ditemukan",
            paginate: { first: "«", last: "»", next: "›", previous: "‹" }
        },
        ajax: {
            url: base_url + "api/products",
            dataSrc: function (json) {
                if (!json.success) return [];
                updateTableCount(json.data.length);
                return json.data;
            }
        },
        columnDefs: [
            { responsivePriority: 6, targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 3, targets: 2 },
            { responsivePriority: 4, targets: 3 },
            { responsivePriority: 2, targets: 4 },
            { responsivePriority: 5, targets: 5 },
            { responsivePriority: 7, targets: 6 },
            { responsivePriority: 8, targets: 7 },
            { responsivePriority: 1, targets: 8, orderable: false, className: "text-end all" }
        ],
        columns: [
            { data: "id" },
            { data: null, render: function (d) { return renderProductCell(d); } },
            { data: "brand_name", render: function (d) { return d || "-"; } },
            { data: "category_name", render: function (d) { return d || "-"; } },
            { data: "price", render: function (d) { return '<span class="cell-price">' + rupiah(d) + '</span>'; } },
            { data: "stock", render: function (d) { return renderStockBadge(d); } },
            { data: "is_featured", render: function (d) { return renderFeaturedBadge(d); } },
            { data: "is_active", render: function (d) { return renderStatusBadge(d); } },
            { data: "id", orderable: false, render: function (d) { return renderActionButtons(d); } }
        ]
    });
}

function loadStatistics() {
    $.ajax({
        url: base_url + "api/products",
        success: function (res) {
            if (!res.success) return;
            let total = 0, active = 0, featured = 0, lowStock = 0;
            $.each(res.data, function (i, item) {
                total++;
                if (item.is_active == 1) active++;
                if (item.is_featured == 1) featured++;
                if (Number(item.stock) <= 5) lowStock++;
            });
            $("#totalProducts").text(total);
            $("#totalActive").text(active);
            $("#totalFeatured").text(featured);
            $("#totalLowStock").text(lowStock);
            updateTableCount(total);
        }
    });
}

function createParfume() {
    $.ajax({
        url: base_url + "api/products",
        type: "POST",
        data: $("#createParfumeForm").serialize(),
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }
            const modalEl = document.getElementById("createParfumeModal");
            afterModalHidden(modalEl, function () {
                loadParfumes();
                loadStatistics();
                Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
            });
            releaseModalFocus(modalEl);
            createParfumeModal.hide();
        },
        error: function (xhr) { showApiError(xhr, "Gagal menambahkan produk"); }
    });
}

function editParfume(id) {
    $.ajax({
        url: base_url + "api/products/" + id,
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }
            let p = res.data;
            currentEditProductId = p.id;
            $("#edit_id").val(p.id);
            $("#edit_name").val(p.name);
            $("#edit_slug").val(p.slug);
            $("#edit_sku").val(p.sku);
            $("#edit_brand_id").val(p.brand_id);
            $("#edit_category_id").val(p.category_id);
            $("#edit_price").val(p.price);
            $("#edit_stock").val(p.stock);
            $("#edit_is_featured").val(p.is_featured);
            $("#edit_is_active").val(p.is_active);
            $("#edit_short_description").val(p.short_description);
            $("#edit_description").val(p.description);
            renderProductImages(p.images || []);
            editParfumeModal.show();
        },
        error: function (xhr) { showApiError(xhr, "Gagal memuat produk"); }
    });
}

function updateParfume() {
    let id = $("#edit_id").val();
    $.ajax({
        url: base_url + "api/products/" + id,
        type: "PUT",
        data: $("#editParfumeForm").serialize(),
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }
            const modalEl = document.getElementById("editParfumeModal");
            afterModalHidden(modalEl, function () {
                currentEditProductId = null;
                loadParfumes();
                loadStatistics();
                Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
            });
            releaseModalFocus(modalEl);
            editParfumeModal.hide();
        },
        error: function (xhr) { showApiError(xhr, "Gagal mengupdate produk"); }
    });
}

function deleteParfume(id) {
    Swal.fire({
        title: "Hapus produk?",
        text: "Data produk akan dihapus permanen.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal"
    }).then(function (result) {
        if (!result.isConfirmed) return;
        $.ajax({
            url: base_url + "api/products/" + id,
            type: "DELETE",
            success: function (res) {
                if (!res.success) {
                    Swal.fire({ icon: "error", title: "Oops", text: res.message });
                    return;
                }
                Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
                loadParfumes();
                loadStatistics();
            },
            error: function (xhr) { showApiError(xhr, "Gagal menghapus produk"); }
        });
    });
}

function renderProductImages(images) {
    if (!images.length) {
        $("#productImagesList").html('<p class="text-muted small mb-0">Belum ada gambar produk.</p>');
        return;
    }
    let html = "";
    $.each(images, function (i, img) {
        html += `
        <div class="product-image-item">
            <img src="${uploadsUrl("products", img.image)}" alt="Product image">
            ${img.is_primary == 1 ? '<span class="primary-tag">Primary</span>' : ""}
            <button type="button" class="btn-remove-image" onclick="deleteProductImage(${img.id})" title="Hapus">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>`;
    });
    $("#productImagesList").html(html);
}

function uploadProductImage() {
    const file = this.files[0];
    if (!file || !currentEditProductId) return;

    let formData = new FormData();
    formData.append("product_id", currentEditProductId);
    formData.append("image", file);
    formData.append("is_primary", $("#productImagesList").children().length === 0 ? 1 : 0);

    $.ajax({
        url: base_url + "api/product-images",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            $("#productImageInput").val("");
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }
            editParfume(currentEditProductId);
            Swal.fire({ icon: "success", title: "Berhasil", text: res.message, timer: 1500, showConfirmButton: false });
        },
        error: function (xhr) { showApiError(xhr, "Gagal upload gambar"); }
    });
}

function deleteProductImage(imageId) {
    Swal.fire({
        title: "Hapus gambar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya"
    }).then(function (result) {
        if (!result.isConfirmed) return;
        $.ajax({
            url: base_url + "api/product-images/" + imageId,
            type: "DELETE",
            success: function (res) {
                if (!res.success) {
                    Swal.fire({ icon: "error", title: "Oops", text: res.message });
                    return;
                }
                editParfume(currentEditProductId);
            },
            error: function (xhr) { showApiError(xhr, "Gagal menghapus gambar"); }
        });
    });
}
