let table = null;

let createBrandModal = null;

let editBrandModal = null;

let slugManualEdit = false;


$(document).ready(function () {

    createBrandModal = new bootstrap.Modal(
        document.getElementById("createBrandModal")
    );

    editBrandModal = new bootstrap.Modal(
        document.getElementById("editBrandModal")
    );

    bindBrandEvents();

    loadStatistics();

    loadBrands();

});



/* =======================================
EVENTS
======================================= */

function bindBrandEvents()
{

    $("#create_name").on("input", function ()
    {
        if (!slugManualEdit)
        {
            $("#create_slug").val(slugify($(this).val()));
        }
    });

    $("#create_slug").on("input", function ()
    {
        slugManualEdit = $(this).val().length > 0;
    });

    $("#create_logo").on("change", function ()
    {
        previewLogoFile(this, "#createLogoPreview", "#createLogoPreviewBox");
    });

    $("#createBrandModal").on("hidden.bs.modal", function ()
    {
        resetCreateForm();
    });

    $("#btnCreateBrand").click(createBrand);

    $("#btnUpdateBrand").click(updateBrand);

}



function resetCreateForm()
{

    $("#createBrandForm")[0].reset();

    slugManualEdit = false;

    $("#createLogoPreviewBox").addClass("d-none");

    $("#createLogoPreview").attr("src", "");

}



function previewLogoFile(input, previewSelector, boxSelector)
{

    const file = input.files[0];

    if (!file)
    {
        $(boxSelector).addClass("d-none");

        return;
    }

    const reader = new FileReader();

    reader.onload = function (e)
    {
        $(previewSelector).attr("src", e.target.result);

        $(boxSelector).removeClass("d-none");
    };

    reader.readAsDataURL(file);

}



function slugify(text)
{

    return String(text || "")
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");

}



function formatDate(value)
{

    if (!value)
    {
        return "-";
    }

    const date = new Date(String(value).replace(" ", "T"));

    if (isNaN(date.getTime()))
    {
        return value;
    }

    return date.toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric"
    });

}



function logoUrl(filename)
{

    if (!filename)
    {
        return "";
    }

    return base_url + "uploads/brands/" + filename;

}



function renderBrandCell(data)
{

    let thumb = "";

    if (data.logo)
    {
        thumb = `
        <img
            src="${logoUrl(data.logo)}"
            alt="${data.name}"
            class="brand-logo-thumb"
            onerror="this.outerHTML='<div class=\\'brand-logo-fallback\\'><i class=\\'bi bi-tag\\'></i></div>'">`;
    }
    else
    {
        thumb = `<div class="brand-logo-fallback"><i class="bi bi-tag"></i></div>`;
    }

    return `
    <div class="brand-cell">
        ${thumb}
        <div class="brand-info">
            <span class="brand-name">${data.name || "-"}</span>
            <span class="brand-meta">${data.slug || "-"}</span>
        </div>
    </div>`;

}



function renderFeaturedBadge(isFeatured)
{

    if (isFeatured == 1)
    {
        return `<span class="badge-featured-yes"><i class="bi bi-star-fill me-1"></i>Featured</span>`;
    }

    return `<span class="badge-featured-no">Regular</span>`;

}



function renderStatusBadge(isActive)
{

    if (isActive == 1)
    {
        return `<span class="status-active">Active</span>`;
    }

    return `<span class="status-inactive">Inactive</span>`;

}



function renderWebsiteLink(url)
{

    if (!url)
    {
        return "-";
    }

    let href = url;

    if (!/^https?:\/\//i.test(href))
    {
        href = "https://" + href;
    }

    return `
    <a
        href="${href}"
        class="link-website"
        target="_blank"
        rel="noopener noreferrer">
        ${url}
    </a>`;

}



function renderActionButtons(id)
{

    return `
    <div class="action-group">
        <button
            type="button"
            class="btn-action btn-edit"
            onclick="editBrand(${id})"
            title="Edit brand">
            <i class="bi bi-pencil"></i>
        </button>
        <button
            type="button"
            class="btn-action btn-delete"
            onclick="deleteBrand(${id})"
            title="Delete brand">
            <i class="bi bi-trash"></i>
        </button>
    </div>`;

}



function updateTableCount(total)
{

    $("#tableBrandCount").text(total + " brands");

}



function showApiError(xhr, fallback)
{

    const message =
        xhr.responseJSON && xhr.responseJSON.message
            ? xhr.responseJSON.message
            : fallback;

    Swal.fire({
        icon: "error",
        title: "Oops",
        text: message
    });

}



function releaseModalFocus(modalEl)
{

    if (document.activeElement)
    {
        document.activeElement.blur();
    }

    const trigger = document.querySelector(
        '[data-bs-target="#' + modalEl.id + '"]'
    );

    if (trigger)
    {
        trigger.focus();
    }

}



function afterModalHidden(modalEl, callback)
{

    modalEl.addEventListener("hidden.bs.modal", function handler()
    {
        modalEl.removeEventListener("hidden.bs.modal", handler);
        callback();
    });

}



/* =======================================
LOAD DATATABLE
======================================= */

function loadBrands()
{

    if (table != null)
    {
        table.destroy();
    }

    table = $("#brandsTable").DataTable({

        processing: true,

        responsive: {
            details: {
                type: "inline",
                target: "tr"
            }
        },

        scrollX: true,

        autoWidth: false,

        order: [[0, "desc"]],

        pageLength: 10,

        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],

        dom:
            '<"brands-dt-top"lf>' +
            "rt" +
            '<"brands-dt-bottom"ip>',

        language: {
            processing: "Memuat data...",
            search: "",
            searchPlaceholder: "Cari brand, negara, website...",
            lengthMenu: "Tampilkan _MENU_",
            info: "Menampilkan _START_–_END_ dari _TOTAL_ brand",
            infoEmpty: "Belum ada brand",
            infoFiltered: "(filter dari _MAX_ total)",
            zeroRecords: "Brand tidak ditemukan",
            paginate: {
                first: "«",
                last: "»",
                next: "›",
                previous: "‹"
            }
        },

        ajax: {
            url: base_url + "api/brands",
            dataSrc: function (json)
            {
                if (!json.success)
                {
                    return [];
                }

                updateTableCount(json.data.length);

                return json.data;
            }
        },

        columnDefs: [
            { responsivePriority: 6, targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 4, targets: 2 },
            { responsivePriority: 5, targets: 3 },
            { responsivePriority: 3, targets: 4 },
            { responsivePriority: 2, targets: 5 },
            { responsivePriority: 7, targets: 6 },
            { responsivePriority: 1, targets: 7, orderable: false, className: "text-end all" }
        ],

        columns: [
            { data: "id" },
            {
                data: null,
                render: function (data)
                {
                    return renderBrandCell(data);
                }
            },
            {
                data: "origin_country",
                render: function (data)
                {
                    return `<span class="cell-country">${data || "-"}</span>`;
                }
            },
            {
                data: "website",
                render: function (data)
                {
                    return renderWebsiteLink(data);
                }
            },
            {
                data: "is_featured",
                render: function (data)
                {
                    return renderFeaturedBadge(data);
                }
            },
            {
                data: "is_active",
                render: function (data)
                {
                    return renderStatusBadge(data);
                }
            },
            {
                data: "created_at",
                render: function (data)
                {
                    return `<span class="cell-date">${formatDate(data)}</span>`;
                }
            },
            {
                data: "id",
                orderable: false,
                render: function (data)
                {
                    return renderActionButtons(data);
                }
            }
        ]

    });

}



/* =======================================
STATISTICS
======================================= */

function loadStatistics()
{

    $.ajax({
        url: base_url + "api/brands",
        success: function (res)
        {
            if (!res.success)
            {
                return;
            }

            let brands = res.data;

            let totalBrands = brands.length;

            let totalActive = 0;

            let totalFeatured = 0;

            let totalInactive = 0;

            $.each(brands, function (i, item)
            {
                if (item.is_active == 1)
                {
                    totalActive++;
                }
                else
                {
                    totalInactive++;
                }

                if (item.is_featured == 1)
                {
                    totalFeatured++;
                }
            });

            $("#totalBrands").text(totalBrands);

            $("#totalActive").text(totalActive);

            $("#totalFeatured").text(totalFeatured);

            $("#totalInactive").text(totalInactive);

            updateTableCount(totalBrands);
        }
    });

}



/* =======================================
CREATE
======================================= */

function createBrand()
{

    const formData = new FormData($("#createBrandForm")[0]);

    $.ajax({
        url: base_url + "api/brands",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res)
        {
            if (!res.success)
            {
                Swal.fire({
                    icon: "error",
                    title: "Oops",
                    text: res.message
                });

                return;
            }

            const modalEl = document.getElementById("createBrandModal");

            afterModalHidden(modalEl, function ()
            {
                loadBrands();
                loadStatistics();

                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.message
                });
            });

            releaseModalFocus(modalEl);

            createBrandModal.hide();
        },
        error: function (xhr)
        {
            showApiError(xhr, "Gagal menambahkan brand");
        }
    });

}



/* =======================================
EDIT
======================================= */

function editBrand(id)
{

    $.ajax({
        url: base_url + "api/brands/" + id,
        success: function (res)
        {
            if (!res.success)
            {
                Swal.fire({
                    icon: "error",
                    title: "Oops",
                    text: res.message
                });

                return;
            }

            let brand = res.data;

            $("#edit_id").val(brand.id);

            $("#edit_name").val(brand.name);

            $("#edit_slug").val(brand.slug);

            $("#edit_origin_country").val(brand.origin_country);

            $("#edit_website").val(brand.website);

            $("#edit_instagram").val(brand.instagram);

            $("#edit_description").val(brand.description);

            $("#edit_is_featured").val(brand.is_featured);

            $("#edit_is_active").val(brand.is_active);

            if (brand.logo)
            {
                $("#editLogoPreview").attr("src", logoUrl(brand.logo));

                $("#editLogoWrap").removeClass("d-none");
            }
            else
            {
                $("#editLogoWrap").addClass("d-none");
            }

            editBrandModal.show();
        },
        error: function (xhr)
        {
            showApiError(xhr, "Gagal memuat data brand");
        }
    });

}



function updateBrand()
{

    let id = $("#edit_id").val();

    $.ajax({
        url: base_url + "api/brands/" + id,
        type: "PUT",
        data: $("#editBrandForm").serialize(),
        success: function (res)
        {
            if (!res.success)
            {
                Swal.fire({
                    icon: "error",
                    title: "Oops",
                    text: res.message
                });

                return;
            }

            const modalEl = document.getElementById("editBrandModal");

            afterModalHidden(modalEl, function ()
            {
                loadBrands();
                loadStatistics();

                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.message
                });
            });

            releaseModalFocus(modalEl);

            editBrandModal.hide();
        },
        error: function (xhr)
        {
            showApiError(xhr, "Gagal mengupdate brand");
        }
    });

}



/* =======================================
DELETE
======================================= */

function deleteBrand(id)
{

    Swal.fire({
        title: "Hapus brand?",
        text: "Data brand akan dihapus permanen.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal"
    }).then(function (result)
    {
        if (!result.isConfirmed)
        {
            return;
        }

        $.ajax({
            url: base_url + "api/brands/" + id,
            type: "DELETE",
            success: function (res)
            {
                if (!res.success)
                {
                    Swal.fire({
                        icon: "error",
                        title: "Oops",
                        text: res.message
                    });

                    return;
                }

                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.message
                });

                loadBrands();
                loadStatistics();
            },
            error: function (xhr)
            {
                showApiError(xhr, "Gagal menghapus brand");
            }
        });
    });

}
