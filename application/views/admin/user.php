<div class="container-fluid py-4">
<style>
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 14px;
    }

    .user-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,.08);
    }

    .user-card .card-header {
        background: linear-gradient(135deg,#0f172a,#1e293b);
        color: white;
        padding: 20px 25px;
        border: none;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg,#2563eb,#3b82f6);
        border: none;
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 600;
    }

    .btn-primary-custom:hover {
        opacity: .9;
    }

    .table thead th {
        background: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
        font-weight: 600;
        color: #334155;
    }

    .table td {
        vertical-align: middle;
    }

    .action-btn {
        border-radius: 10px;
        padding: 6px 12px;
    }

    .badge-user {
        background: #eff6ff;
        color: #2563eb;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .modal-content {
        border: none;
        border-radius: 18px;
    }

    .modal-header {
        border-bottom: 1px solid #e5e7eb;
    }

    .modal-footer {
        border-top: 1px solid #e5e7eb;
    }

    .form-control {
        border-radius: 12px;
        min-height: 46px;
    }

    .empty-state {
        text-align: center;
        padding: 50px;
        color: #94a3b8;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1">User Management</h1>
        <div class="page-subtitle">
            Kelola seluruh user yang terdaftar pada sistem
        </div>
    </div>

    <button class="btn btn-primary-custom text-white"
            data-bs-toggle="modal"
            data-bs-target="#createModal">
        <i class="bi bi-plus-circle me-2"></i>
        Add User
    </button>
</div>

<div class="card user-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">Users</h5>
                <small>Data pengguna aplikasi</small>
            </div>

            <span class="badge-user" id="totalUser">
                0 Users
            </span>
        </div>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table align-middle" id="userTable">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>
        </div>

    </div>
</div>


</div>

<!-- CREATE MODAL -->

<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="createForm" class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Create User</h5>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-3">
                <label class="form-label">Name</label>

                <input type="text"
                       class="form-control"
                       id="create_name"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>

                <input type="email"
                       class="form-control"
                       id="create_email"
                       required>
            </div>

            <div>
                <label class="form-label">Password</label>

                <input type="password"
                       class="form-control"
                       id="create_password"
                       required>
            </div>

        </div>

        <div class="modal-footer">

            <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">
                Cancel
            </button>

            <button type="submit"
                    class="btn btn-primary">
                Save User
            </button>

        </div>

    </form>
</div>


</div>

<!-- EDIT MODAL -->

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editForm" class="modal-content">


        <input type="hidden" id="edit_id">

        <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-3">
                <label class="form-label">Name</label>

                <input type="text"
                       class="form-control"
                       id="edit_name"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>

                <input type="email"
                       class="form-control"
                       id="edit_email"
                       required>
            </div>

            <div>
                <label class="form-label">
                    Password (opsional)
                </label>

                <input type="password"
                       class="form-control"
                       id="edit_password">
            </div>

        </div>

        <div class="modal-footer">

            <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">
                Cancel
            </button>

            <button type="submit"
                    class="btn btn-warning">
                Update User
            </button>

        </div>

    </form>
</div>


</div>

<!-- DELETE MODAL -->

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">


    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title text-danger">
                Delete User
            </h5>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            Apakah anda yakin ingin menghapus user ini?
        </div>

        <div class="modal-footer">

            <button class="btn btn-light"
                    data-bs-dismiss="modal">
                Cancel
            </button>

            <button class="btn btn-danger"
                    id="confirmDelete">
                Delete
            </button>

        </div>

    </div>

</div>


</div>

<script>

const API_URL = "<?= base_url('api/users') ?>";

let deleteId = null;

async function loadUsers()
{
    const response = await fetch(API_URL);
    const result = await response.json();

    document.getElementById('totalUser').innerText =
        result.data.length + ' Users';

    let html = '';

    if(result.data.length === 0)
    {
        html = `
            <tr>
                <td colspan="4">
                    <div class="empty-state">
                        No users found
                    </div>
                </td>
            </tr>
        `;
    }

    result.data.forEach(user => {

        html += `
            <tr>

                <td>${user.id}</td>

                <td>
                    <strong>${user.name}</strong>
                </td>

                <td>${user.email}</td>

                <td>

                    <button
                        class="btn btn-warning btn-sm action-btn"
                        onclick="openEdit(${user.id})">
                        Edit
                    </button>

                    <button
                        class="btn btn-danger btn-sm action-btn"
                        onclick="openDelete(${user.id})">
                        Delete
                    </button>

                </td>

            </tr>
        `;
    });

    document.querySelector('#userTable tbody')
        .innerHTML = html;
}

loadUsers();

/* CREATE */

document
.getElementById('createForm')
.addEventListener('submit', async function(e){

    e.preventDefault();

    await fetch(API_URL, {
        method: 'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify({
            name: document.getElementById('create_name').value,
            email: document.getElementById('create_email').value,
            password: document.getElementById('create_password').value
        })
    });

    bootstrap.Modal
        .getInstance(document.getElementById('createModal'))
        .hide();

    this.reset();

    loadUsers();
});

/* EDIT */

async function openEdit(id)
{
    const response =
        await fetch(API_URL + '/' + id);

    const result =
        await response.json();

    document.getElementById('edit_id').value =
        result.data.id;

    document.getElementById('edit_name').value =
        result.data.name;

    document.getElementById('edit_email').value =
        result.data.email;

    new bootstrap.Modal(
        document.getElementById('editModal')
    ).show();
}

document
.getElementById('editForm')
.addEventListener('submit', async function(e){

    e.preventDefault();

    const id =
        document.getElementById('edit_id').value;

    let payload = {
        name: document.getElementById('edit_name').value,
        email: document.getElementById('edit_email').value
    };

    const password =
        document.getElementById('edit_password').value;

    if(password){
        payload.password = password;
    }

    await fetch(API_URL + '/' + id,{
        method:'PUT',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify(payload)
    });

    bootstrap.Modal
        .getInstance(document.getElementById('editModal'))
        .hide();

    loadUsers();
});

/* DELETE */

function openDelete(id)
{
    deleteId = id;

    new bootstrap.Modal(
        document.getElementById('deleteModal')
    ).show();
}

document
.getElementById('confirmDelete')
.addEventListener('click', async function(){

    await fetch(API_URL + '/' + deleteId,{
        method:'DELETE'
    });

    bootstrap.Modal
        .getInstance(document.getElementById('deleteModal'))
        .hide();

    loadUsers();
});

</script>
