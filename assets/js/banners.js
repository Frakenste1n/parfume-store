let table = null;
let createBannerModal = null;
let editBannerModal = null;

$(document).ready(function () {
    createBannerModal = new bootstrap.Modal(document.getElementById("createBannerModal"));
    editBannerModal = new bootstrap.Modal(document.getElementById("editBannerModal"));

    bindBannerEvents();
    loadStatistics();
    loadBanners();
});

function bindBannerEvents() {
    $("#create_image").on("change", function () {
        previewImageFile(this, "#createImagePreview", "#createImagePreviewBox");
    });

    $("#edit_image").on("change", function () {
        previewImageFile(this, "#editImagePreview", "#editImagePreviewBox");
    });

    $("#createBannerModal").on("hidden.bs.modal", function () {
        resetCreateForm();
    });

    $("#btnCreateBanner").click(createBanner);
    $("#btnUpdateBanner").click(updateBanner);
}

function resetCreateForm() {
    $("#createBannerForm")[0].reset();
    $("#createImagePreviewBox").addClass("d-none");
    $("#createImagePreview").attr("src", "");
}

function uploadsUrl(folder, filename) {
    if (!filename) {
        return "";
    }

    return base_url.replace(/\/?$/, "/") + "uploads/" + folder + "/" + filename;
}

function previewImageFile(input, previewSelector, boxSelector) {
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

function truncateText(text, max) {
    if (!text) {
        return "-";
    }

    if (text.length <= max) {
        return text;
    }

    return text.substring(0, max) + "...";
}

function renderStatusBadge(isActive) {
    if (isActive == 1) {
        return '<span class="status-active">Active</span>';
    }

    return '<span class="status-inactive">Inactive</span>';
}

function renderBannerCell(data) {
    const img = data.image
        ? uploadsUrl("banners", data.image)
        : "https://ui-avatars.com/api/?name=Banner&background=e2e8f0&color=64748b";

    return `
    <div class="banner-cell">
        <img src="${img}" alt="${data.title || "Banner"}" class="banner-thumb">
        <div class="banner-info">
            <span class="banner-title">${data.title || "-"}</span>
            <span class="banner-meta">${truncateText(data.subtitle, 40)}</span>
        </div>
    </div>`;
}

function renderActionButtons(id) {
    return `
    <div class="action-group">
        <button type="button" class="btn-action btn-edit" onclick="editBanner(${id})" title="Edit banner">
            <i class="bi bi-pencil"></i>
        </button>
        <button type="button" class="btn-action btn-delete" onclick="deleteBanner(${id})" title="Delete banner">
            <i class="bi bi-trash"></i>
        </button>
    </div>`;
}

function updateTableCount(total) {
    $("#tableBannerCount").text(total + " banners");
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
    $.get(base_url + "api/banners", function (res) {
        if (!res.success) {
            return;
        }

        const data = res.data || [];
        const active = data.filter(function (item) { return item.is_active == 1; }).length;
        const withCta = data.filter(function (item) { return item.button_text && item.button_link; }).length;

        $("#totalBanners").text(data.length);
        $("#totalActive").text(active);
        $("#totalInactive").text(data.length - active);
        $("#totalWithCta").text(withCta);
    });
}

function loadBanners() {
    if (table != null) {
        table.destroy();
    }

    table = $("#bannersTable").DataTable({
        processing: true,
        responsive: { details: { type: "inline", target: "tr" } },
        scrollX: true,
        autoWidth: false,
        order: [[4, "asc"]],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"banners-dt-top"lf>rt<"banners-dt-bottom"ip>',
        language: {
            processing: "Memuat data...",
            search: "",
            searchPlaceholder: "Cari judul, subtitle, CTA...",
            lengthMenu: "Tampilkan _MENU_",
            info: "Menampilkan _START_–_END_ dari _TOTAL_ banner",
            infoEmpty: "Belum ada banner",
            infoFiltered: "(filter dari _MAX_ total)",
            zeroRecords: "Banner tidak ditemukan",
            paginate: { first: "«", last: "»", next: "›", previous: "‹" }
        },
        ajax: {
            url: base_url + "api/banners",
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
            { responsivePriority: 4, targets: 3 },
            { responsivePriority: 2, targets: 4 },
            { responsivePriority: 2, targets: 5 },
            { responsivePriority: 1, targets: 6, orderable: false, className: "text-end all" }
        ],
        columns: [
            { data: "id" },
            {
                data: null,
                render: function (data) {
                    return renderBannerCell(data);
                }
            },
            {
                data: "subtitle",
                render: function (data) {
                    return '<span class="cell-description">' + truncateText(data, 60) + "</span>";
                }
            },
            {
                data: null,
                render: function (data) {
                    if (!data.button_text) {
                        return "-";
                    }

                    return '<span class="cta-badge">' + data.button_text + "</span>";
                }
            },
            { data: "sort_order" },
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

function createBanner() {
    const formEl = document.getElementById("createBannerForm");
    const formData = new FormData(formEl);

    $.ajax({
        url: base_url + "api/banners",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }

            const modalEl = document.getElementById("createBannerModal");

            createBannerModal.hide();

            afterModalHidden(modalEl, function () {
                Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
                loadStatistics();
                table.ajax.reload(null, false);
            });

            releaseModalFocus(modalEl);
        },
        error: function (xhr) {
            showApiError(xhr, "Gagal menambahkan banner");
        }
    });
}

function editBanner(id) {
    $.get(base_url + "api/banners/" + id, function (res) {
        if (!res.success) {
            Swal.fire({ icon: "error", title: "Oops", text: res.message });
            return;
        }

        const data = res.data;

        $("#edit_id").val(data.id);
        $("#edit_title").val(data.title);
        $("#edit_subtitle").val(data.subtitle);
        $("#edit_button_text").val(data.button_text);
        $("#edit_button_link").val(data.button_link);
        $("#edit_sort_order").val(data.sort_order);
        $("#edit_is_active").val(data.is_active);

        if (data.image) {
            $("#editImagePreview").attr("src", uploadsUrl("banners", data.image));
            $("#editImagePreviewBox").removeClass("d-none");
        } else {
            $("#editImagePreview").attr("src", "");
            $("#editImagePreviewBox").addClass("d-none");
        }

        editBannerModal.show();
    });
}

function updateBanner() {
    const id = $("#edit_id").val();
    const formEl = document.getElementById("editBannerForm");
    const hasFile = $("#edit_image")[0].files.length > 0;

    const request = {
        url: base_url + "api/banners/" + id,
        type: hasFile ? "POST" : "PUT",
        data: hasFile ? new FormData(formEl) : $("#editBannerForm").serialize(),
        processData: !hasFile,
        contentType: hasFile ? false : "application/x-www-form-urlencoded; charset=UTF-8",
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }

            const modalEl = document.getElementById("editBannerModal");

            editBannerModal.hide();

            afterModalHidden(modalEl, function () {
                Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
                loadStatistics();
                table.ajax.reload(null, false);
            });

            releaseModalFocus(modalEl);
        },
        error: function (xhr) {
            showApiError(xhr, "Gagal mengupdate banner");
        }
    };

    $.ajax(request);
}

function deleteBanner(id) {
    Swal.fire({
        title: "Hapus banner?",
        text: "Data banner akan dihapus permanen.",
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
            url: base_url + "api/banners/" + id,
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
                showApiError(xhr, "Gagal menghapus banner");
            }
        });
    });
}
