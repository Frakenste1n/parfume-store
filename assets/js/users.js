let table = null;

let createUserModal = null;

let editUserModal = null;


$(document).ready(function () {

    createUserModal = new bootstrap.Modal(
        document.getElementById("createUserModal")
    );

    editUserModal = new bootstrap.Modal(
        document.getElementById("editUserModal")
    );

    loadStatistics();

    loadUsers();

});



/* =======================================
LOAD DATATABLE
======================================= */

function getInitials(name)
{

    if (!name)
    {
        return "?";
    }

    return name
        .trim()
        .split(/\s+/)
        .map(function (part)
        {
            return part.charAt(0);
        })
        .join("")
        .substring(0, 2)
        .toUpperCase();

}



function formatDate(value)
{

    if (!value)
    {
        return "-";
    }

    const date = new Date(value.replace(" ", "T"));

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



function renderUserCell(data)
{

    return `
    <div class="user-cell">
        <div class="user-avatar">${getInitials(data.name)}</div>
        <div class="user-info">
            <span class="user-name">${data.name}</span>
            <span class="user-meta">${data.email || "-"}</span>
        </div>
    </div>`;

}



function renderRoleBadge(role)
{

    if (role == "admin")
    {
        return `<span class="role-admin">Admin</span>`;
    }

    return `<span class="role-customer">Customer</span>`;

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
            onclick="editUser(${id})"
            title="Edit user">
            <i class="bi bi-pencil"></i>
        </button>
        <button
            type="button"
            class="btn-action btn-delete"
            onclick="deleteUser(${id})"
            title="Delete user">
            <i class="bi bi-trash"></i>
        </button>
    </div>`;

}



function updateTableCount(total)
{

    $("#tableUserCount").text(total + " users");

}



function loadUsers()
{

    if (table != null)
    {
        table.destroy();
    }

    table = $("#usersTable").DataTable({

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
            '<"users-dt-top"lf>' +
            'rt' +
            '<"users-dt-bottom"ip>',

        language: {
            processing: "Memuat data...",
            search: "",
            searchPlaceholder: "Cari nama, email, phone...",
            lengthMenu: "Tampilkan _MENU_",
            info: "Menampilkan _START_–_END_ dari _TOTAL_ user",
            infoEmpty: "Belum ada user",
            infoFiltered: "(filter dari _MAX_ total)",
            zeroRecords: "User tidak ditemukan",
            paginate: {
                first: "«",
                last: "»",
                next: "›",
                previous: "‹"
            }
        },

        ajax: {

            url: base_url + "api/users",

            dataSrc: function (json)
            {
                updateTableCount(json.data.length);

                return json.data;
            }

        },

        columnDefs: [
            { responsivePriority: 6, targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 3, targets: 2 },
            { responsivePriority: 5, targets: 3 },
            { responsivePriority: 4, targets: 4 },
            { responsivePriority: 2, targets: 5 },
            { responsivePriority: 7, targets: 6 },
            { responsivePriority: 1, targets: 7, orderable: false, className: "text-end all" }
        ],

        columns: [

            {
                data: "id"
            },

            {
                data: null,

                render: function (data)
                {
                    return renderUserCell(data);
                }
            },

            {
                data: "email",

                render: function (data)
                {
                    return `<span class="cell-email">${data || "-"}</span>`;
                }
            },

            {
                data: "phone",

                render: function (data)
                {
                    return `<span class="cell-phone">${data || "-"}</span>`;
                }
            },

            {
                data: "role",

                render: function (data)
                {
                    return renderRoleBadge(data);
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
STATISTICS
======================================= */

function loadStatistics()
{

    $.ajax({

        url: base_url+"api/users",

        success:function(res)
        {

            let users = res.data;

            let totalUsers = users.length;

            let totalAdmin = 0;

            let totalCustomer = 0;

            let totalInactive = 0;


            $.each(users,function(i,item){

                if(item.role=="admin")
                {
                    totalAdmin++;
                }
                else
                {
                    totalCustomer++;
                }

                if(item.is_active==0)
                {
                    totalInactive++;
                }

            });


            $("#totalUsers").text(totalUsers);

            $("#totalAdmin").text(totalAdmin);

            $("#totalCustomer").text(totalCustomer);

            $("#totalInactive").text(totalInactive);

            updateTableCount(totalUsers);

        }

    });

}



/* =======================================
CREATE
======================================= */

$("#btnCreateUser").click(function(){

    $.ajax({

        url: base_url+"api/users",

        type:"POST",

        data:$("#createUserForm").serialize(),

        success:function(res){

            const modalEl = document.getElementById("createUserModal");

            afterModalHidden(modalEl, function()
            {

                $("#createUserForm")[0].reset();

                loadUsers();

                loadStatistics();

                Swal.fire({
                    icon:"success",
                    title:"Berhasil",
                    text:res.message
                });

            });

            releaseModalFocus(modalEl);

            createUserModal.hide();

        },

        error:function(xhr){

            Swal.fire({

                icon:"error",

                title:"Oops",

                text:xhr.responseJSON.message

            });

        }

    });

});



/* =======================================
EDIT
======================================= */

function editUser(id)
{

    $.ajax({

        url:base_url+"api/users/"+id,

        success:function(res){

            let x = res.data;

            $("#edit_id").val(x.id);

            $("#edit_name").val(x.name);

            $("#edit_email").val(x.email);

            $("#edit_phone").val(x.phone);

            $("#edit_address").val(x.address);

            $("#edit_role").val(x.role);

            $("#edit_status").val(x.is_active);

            editUserModal.show();

        }

    });

}



$("#btnUpdateUser").click(function(){

    let id = $("#edit_id").val();

    $.ajax({

        url:base_url+"api/users/"+id,

        type:"PUT",

        data:$("#editUserForm").serialize(),

        success:function(res){

            const modalEl = document.getElementById("editUserModal");

            afterModalHidden(modalEl, function()
            {

                loadUsers();

                loadStatistics();

                Swal.fire({

                    icon:"success",

                    title:"Berhasil",

                    text:res.message

                });

            });

            releaseModalFocus(modalEl);

            editUserModal.hide();

        },

        error:function(xhr){

            Swal.fire({

                icon:"error",

                title:"Oops",

                text:xhr.responseJSON.message

            });

        }

    });

});



/* =======================================
DELETE
======================================= */

function deleteUser(id)
{

    Swal.fire({

        title:"Hapus user?",

        icon:"warning",

        showCancelButton:true,

        confirmButtonText:"Ya"

    })

    .then((result)=>{

        if(result.isConfirmed)
        {

            $.ajax({

                url:base_url+"api/users/"+id,

                type:"DELETE",

                success:function(res){

                    Swal.fire({

                        icon:"success",

                        title:"Berhasil",

                        text:res.message

                    });

                    loadUsers();

                    loadStatistics();

                }

            });

        }

    });

}
