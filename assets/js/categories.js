let table = null;

let createCategoryModal = null;

let editCategoryModal = null;

let slugManualEdit = false;


$(document).ready(function () {

    createCategoryModal = new bootstrap.Modal(
        document.getElementById("createCategoryModal")
    );

    editCategoryModal = new bootstrap.Modal(
        document.getElementById("editCategoryModal")
    );

    bindCategoryEvents();

    loadStatistics();

    loadCategories();

});



/* =======================================
EVENTS
======================================= */

function bindCategoryEvents()
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

    $("#createCategoryModal").on("hidden.bs.modal", function ()
    {
        resetCreateForm();
    });

    $("#btnCreateCategory").click(createCategory);

    $("#btnUpdateCategory").click(updateCategory);

}



function resetCreateForm()
{

    $("#createCategoryForm")[0].reset();

    slugManualEdit = false;

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



function truncateText(text, max)
{

    if (!text)
    {
        return "-";
    }

    if (text.length <= max)
    {
        return text;
    }

    return text.substring(0, max) + "...";

}



function renderCategoryCell(data)
{

    return `
    <div class="category-cell">
        <div class="category-icon">
            <i class="bi bi-folder2"></i>
        </div>
        <div class="category-info">
            <span class="category-name">${data.name || "-"}</span>
            <span class="category-meta">${data.slug || "-"}</span>
        </div>
    </div>`;

}



function renderStatusBadge(isActive)
{

    if (isActive == 1)
    {
        return `<span class="status-active">Active</span>`;
    }

    return `<span class="status-inactive">Inactive</span>`;

}



function renderActionButtons(id)
{

    return `
    <div class="action-group">
        <button
            type="button"
            class="btn-action btn-edit"
            onclick="editCategory(${id})"
            title="Edit category">
            <i class="bi bi-pencil"></i>
        </button>
        <button
            type="button"
            class="btn-action btn-delete"
            onclick="deleteCategory(${id})"
            title="Delete category">
            <i class="bi bi-trash"></i>
        </button>
    </div>`;

}



function updateTableCount(total)
{

    $("#tableCategoryCount").text(total + " categories");

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

function loadCategories()
{

    if (table != null)
    {
        table.destroy();
    }

    table = $("#categoriesTable").DataTable({

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
            '<"categories-dt-top"lf>' +
            "rt" +
            '<"categories-dt-bottom"ip>',

        language: {
            processing: "Memuat data...",
            search: "",
            searchPlaceholder: "Cari nama, slug, deskripsi...",
            lengthMenu: "Tampilkan _MENU_",
            info: "Menampilkan _START_–_END_ dari _TOTAL_ kategori",
            infoEmpty: "Belum ada kategori",
            infoFiltered: "(filter dari _MAX_ total)",
            zeroRecords: "Kategori tidak ditemukan",
            paginate: {
                first: "«",
                last: "»",
                next: "›",
                previous: "‹"
            }
        },

        ajax: {
            url: base_url + "api/categories",
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
            { responsivePriority: 5, targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 3, targets: 2 },
            { responsivePriority: 2, targets: 3 },
            { responsivePriority: 4, targets: 4 },
            { responsivePriority: 1, targets: 5, orderable: false, className: "text-end all" }
        ],

        columns: [
            { data: "id" },
            {
                data: null,
                render: function (data)
                {
                    return renderCategoryCell(data);
                }
            },
            {
                data: "description",
                render: function (data)
                {
                    return `<span class="cell-description">${truncateText(data, 80)}</span>`;
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
        url: base_url + "api/categories",
        success: function (res)
        {
            if (!res.success)
            {
                return;
            }

            let categories = res.data;

            let totalCategories = categories.length;

            let totalActive = 0;

            let totalInactive = 0;

            let totalDescribed = 0;

            $.each(categories, function (i, item)
            {
                if (item.is_active == 1)
                {
                    totalActive++;
                }
                else
                {
                    totalInactive++;
                }

                if (item.description && String(item.description).trim() !== "")
                {
                    totalDescribed++;
                }
            });

            $("#totalCategories").text(totalCategories);

            $("#totalActive").text(totalActive);

            $("#totalInactive").text(totalInactive);

            $("#totalDescribed").text(totalDescribed);

            updateTableCount(totalCategories);
        }
    });

}



/* =======================================
CREATE
======================================= */

function createCategory()
{

    $.ajax({
        url: base_url + "api/categories",
        type: "POST",
        data: $("#createCategoryForm").serialize(),
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

            const modalEl = document.getElementById("createCategoryModal");

            afterModalHidden(modalEl, function ()
            {
                loadCategories();
                loadStatistics();

                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.message
                });
            });

            releaseModalFocus(modalEl);

            createCategoryModal.hide();
        },
        error: function (xhr)
        {
            showApiError(xhr, "Gagal menambahkan kategori");
        }
    });

}



/* =======================================
EDIT
======================================= */

function editCategory(id)
{

    $.ajax({
        url: base_url + "api/categories/" + id,
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

            let category = res.data;

            $("#edit_id").val(category.id);

            $("#edit_name").val(category.name);

            $("#edit_slug").val(category.slug);

            $("#edit_description").val(category.description);

            $("#edit_is_active").val(category.is_active);

            editCategoryModal.show();
        },
        error: function (xhr)
        {
            showApiError(xhr, "Gagal memuat data kategori");
        }
    });

}



function updateCategory()
{

    let id = $("#edit_id").val();

    $.ajax({
        url: base_url + "api/categories/" + id,
        type: "PUT",
        data: $("#editCategoryForm").serialize(),
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

            const modalEl = document.getElementById("editCategoryModal");

            afterModalHidden(modalEl, function ()
            {
                loadCategories();
                loadStatistics();

                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.message
                });
            });

            releaseModalFocus(modalEl);

            editCategoryModal.hide();
        },
        error: function (xhr)
        {
            showApiError(xhr, "Gagal mengupdate kategori");
        }
    });

}



/* =======================================
DELETE
======================================= */

function deleteCategory(id)
{

    Swal.fire({
        title: "Hapus kategori?",
        text: "Data kategori akan dihapus permanen.",
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
            url: base_url + "api/categories/" + id,
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

                loadCategories();
                loadStatistics();
            },
            error: function (xhr)
            {
                showApiError(xhr, "Gagal menghapus kategori");
            }
        });
    });

}
