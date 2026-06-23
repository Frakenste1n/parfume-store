<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-wrapper">

    <!-- HEADER -->
    <div class="page-header">

        <div>

            <div class="page-badge">
                <i class="bi bi-droplet"></i>
                Admin Panel
            </div>

            <h1 class="page-title">
                Parfume Management
            </h1>

            <p class="page-subtitle">
                Manage perfumes, pricing, stock and brand relations
            </p>

        </div>

        <button class="btn-primary-action" onclick="openCreateModal()">

            <i class="bi bi-plus-lg"></i>
            New Parfume

        </button>

    </div>

    <!-- SEARCH -->
    <div class="card ui-card mt-4">

        <div class="card-body">

            <div class="search-box">

                <i class="bi bi-search"></i>

                <input type="text" id="searchParfume" placeholder="Search parfume name, brand, price..."
                    autocomplete="off">

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="card ui-card mt-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table ui-table">

                    <thead>

                        <tr>

                            <th>Parfume</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th width="120">Action</th>

                        </tr>

                    </thead>

                    <tbody id="parfumeTableBody"></tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="parfumeModal">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content ui-modal">

            <form id="parfumeForm">

                <div class="modal-header">

                    <div>

                        <h5 id="modalTitle">Create Parfume</h5>

                        <small class="text-muted">
                            Fill parfume information
                        </small>

                    </div>

                    <button class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <input type="hidden" id="parfumeId">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label>Name</label>

                            <input type="text" id="name" class="form-control ui-input" placeholder="Dior Sauvage">

                        </div>

                        <div class="col-md-6">

                            <label>Brand ID</label>

                            <select id="brand_id" class="form-control ui-input"></select>
                        </div>

                        <div class="col-md-6">

                            <label>Price</label>

                            <input type="number" id="price" class="form-control ui-input" placeholder="250000">

                        </div>

                        <div class="col-md-6">

                            <label>Stock</label>

                            <input type="number" id="stock" class="form-control ui-input" placeholder="10">

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn-soft" type="button" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button class="btn-primary-action" type="submit">
                        <i class="bi bi-check2"></i>
                        Save
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<style>

/* =========================
   ROOT (CONSISTENT SYSTEM)
========================= */

:root{
    --bg:#f8fafc;
    --card:#ffffff;
    --text:#0f172a;
    --muted:#64748b;
    --border:#e2e8f0;
}

/* =========================
   PAGE WRAPPER
========================= */

.page-wrapper{
    animation:fadeIn .25s ease;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(10px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* =========================
   HEADER (FILAMENT STYLE)
========================= */

.page-header{

    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    flex-wrap:wrap;

    padding:28px;

    background:var(--card);
    border:1px solid var(--border);
    border-radius:20px;

}

.page-badge{

    display:inline-flex;
    align-items:center;
    gap:8px;

    font-size:12px;
    font-weight:600;

    color:var(--muted);

    margin-bottom:10px;

}

.page-title{

    font-size:26px;
    font-weight:700;

    color:var(--text);

    margin:0;

}

.page-subtitle{

    margin-top:6px;

    color:var(--muted);

    font-size:14px;

}

/* =========================
   PRIMARY BUTTON
========================= */

.btn-primary-action{

    background:#111827;
    color:#fff;

    border:none;

    padding:11px 16px;

    border-radius:12px;

    font-weight:600;

    display:flex;
    align-items:center;
    gap:8px;

    transition:.2s ease;

}

.btn-primary-action:hover{

    transform:translateY(-2px);
    background:#1f2937;

}

/* =========================
   CARD SYSTEM
========================= */

.ui-card{

    border:1px solid var(--border);

    border-radius:20px;

    background:var(--card);

    overflow:hidden;

}

/* =========================
   SEARCH BOX (CLEAN FILAMENT)
========================= */

.search-box{

    display:flex;
    align-items:center;
    gap:10px;

    padding:12px 14px;

    border:1px solid var(--border);

    border-radius:14px;

    background:#fff;

}

.search-box i{
    color:var(--muted);
}

.search-box input{

    border:none;
    outline:none;

    width:100%;

    font-size:14px;

}

/* =========================
   TABLE
========================= */

.ui-table thead th{

    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.04em;

    color:var(--muted);

    padding:16px;

    border-bottom:1px solid var(--border);

    background:#fafafa;

}

.ui-table tbody td{

    padding:18px 16px;

    border-bottom:1px solid #f1f5f9;

    vertical-align:middle;

}

.ui-table tbody tr:hover{

    background:#f8fafc;

}

/* =========================
   PARFUME CELL
========================= */

.parfume-name{

    font-weight:600;

    color:var(--text);

    font-size:14px;

}

.parfume-meta{

    font-size:12px;

    color:var(--muted);

    margin-top:3px;

}

/* =========================
   BRAND BADGE
========================= */

.brand-badge{

    display:inline-flex;

    padding:6px 10px;

    border-radius:999px;

    font-size:12px;

    font-weight:600;

    background:#f1f5f9;

    color:#334155;

}

/* =========================
   PRICE STYLE
========================= */

.price-tag{

    font-weight:700;

    color:#0f172a;

}

/* =========================
   STOCK BADGE
========================= */

.stock-badge{

    display:inline-flex;

    padding:6px 10px;

    border-radius:999px;

    font-size:12px;

    font-weight:600;

}

.stock-low{
    background:#fee2e2;
    color:#991b1b;
}

.stock-good{
    background:#dcfce7;
    color:#166534;
}

/* =========================
   ACTION BUTTONS
========================= */

.action-group{
    display:flex;
    gap:8px;
}

.action-btn{

    width:36px;
    height:36px;

    border:none;

    border-radius:10px;

    display:flex;
    align-items:center;
    justify-content:center;

    transition:.2s ease;

    color:white;

}

.action-btn:hover{
    transform:translateY(-2px);
}

.edit-btn{
    background:#f59e0b;
}

.delete-btn{
    background:#ef4444;
}

/* =========================
   MODAL
========================= */

.ui-modal{

    border:none;

    border-radius:18px;

    overflow:hidden;

}

.modal-header{

    border-bottom:1px solid #f1f5f9;

    padding:18px 22px;

}

.modal-body{

    padding:22px;

}

.modal-footer{

    border-top:1px solid #f1f5f9;

    padding:18px 22px;

}

/* =========================
   FORM
========================= */

.btn-soft{

    border:1px solid #e2e8f0;
    background:#f8fafc;
    color:#334155;
    padding:10px 16px;
    border-radius:12px;
    font-weight:600;
    transition:.2s ease;

}

.btn-soft:hover{
    background:#eef2f7;
    transform:translateY(-1px);
    border-color:#cbd5e1;

}

.form-control.ui-input{

    border-radius:12px;

    border:1px solid var(--border);

    padding:10px 12px;

    font-size:14px;

}

.form-control.ui-input:focus{

    border-color:#111827;

    box-shadow:0 0 0 .15rem rgba(17,24,39,.1);

}

label{

    font-size:13px;

    color:#334155;

    font-weight:600;

    margin-bottom:6px;

}

/* =========================
   EMPTY STATE
========================= */

.empty-state{

    text-align:center;

    padding:50px 20px;

    color:var(--muted);

}

.empty-state i{

    font-size:44px;

    margin-bottom:10px;

}

/* =========================
   LOADING
========================= */

.loading-state{

    text-align:center;

    padding:40px;

    color:var(--muted);

}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:768px){

    .page-header{
        flex-direction:column;
        align-items:stretch;
    }

    .btn-primary-action{
        width:100%;
        justify-content:center;
    }

    .ui-table thead{
        display:none;
    }

    .ui-table tbody td{
        display:block;
        width:100%;
    }

}

</style>

<script>

const API = '<?= base_url("api/parfumes") ?>';

let modal;

document.addEventListener('DOMContentLoaded', () => {

    modal = new bootstrap.Modal(
        document.getElementById('parfumeModal')
    );

    load();
    search();
    submit();
    loadBrandsOptions();

});

async function load(){

    const tbody = document.getElementById('parfumeTableBody');

    const res = await fetch(API);
    const json = await res.json();

    const data = json.data || [];

    if(data.length === 0){
        tbody.innerHTML = `
        <tr>
            <td colspan="5" class="text-center text-muted p-4">
                No Parfume Found
            </td>
        </tr>`;
        return;
    }

    let html = '';

    data.forEach(p => {

        html += `
        <tr>

            <td>
                <div class="fw-semibold">${p.name}</div>
                <div class="text-muted small">ID #${p.id}</div>
            </td>

            <td>
                ${p.brand_id ?? '-'}
            </td>

            <td>
                Rp ${Number(p.price).toLocaleString()}
            </td>

            <td>
                ${p.stock}
            </td>

            <td>

                <div class="d-flex gap-2">

                    <button class="action-btn edit-btn" onclick="edit(${p.id})">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <button class="action-btn delete-btn" onclick="remove(${p.id})">
                        <i class="bi bi-trash"></i>
                    </button>

                </div>

            </td>

        </tr>`;
    });

    tbody.innerHTML = html;

}

async function loadBrandsOptions(){

    const res = await fetch('<?= base_url("api/brands") ?>');
    const json = await res.json();

    const select = document.getElementById('brand_id');

    select.innerHTML = `<option value="">Select Brand</option>`;

    json.data.forEach(b => {
        select.innerHTML += `
            <option value="${b.id}">
                ${b.name}
            </option>
        `;
    });
}

function openCreateModal(){

    document.getElementById('parfumeForm').reset();
    document.getElementById('parfumeId').value = '';
    document.getElementById('modalTitle').innerText = 'Create Parfume';

    modal.show();

}

function submit(){

    document.getElementById('parfumeForm').addEventListener('submit', async (e) => {

        e.preventDefault();

        const id = document.getElementById('parfumeId').value;

        const payload = new URLSearchParams({
            name: document.getElementById('name').value,
            brand_id: document.getElementById('brand_id').value,
            price: document.getElementById('price').value,
            stock: document.getElementById('stock').value
        });

        const url = id ? `${API}/${id}` : API;
        const method = id ? 'PUT' : 'POST';

        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: payload
        });

        const json = await res.json();

        if(json.status){
            modal.hide();
            load();
        }

    });

}

async function edit(id){

    const res = await fetch(`${API}/${id}`);
    const json = await res.json();

    const p = json.data;

    document.getElementById('parfumeId').value = p.id;
    document.getElementById('name').value = p.name;
    document.getElementById('brand_id').value = p.brand_id;
    document.getElementById('price').value = p.price;
    document.getElementById('stock').value = p.stock;

    document.getElementById('modalTitle').innerText = 'Edit Parfume';

    modal.show();

}

async function remove(id){

    const ok = await Swal.fire({
        title:'Delete Parfume?',
        icon:'warning',
        showCancelButton:true
    });

    if(!ok.isConfirmed) return;

    await fetch(`${API}/${id}`, {
        method:'DELETE'
    });

    load();

}

function search(){

    document.getElementById('searchParfume').addEventListener('keyup', function(){

        const val = this.value.toLowerCase();

        document.querySelectorAll('#parfumeTableBody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
        });

    });

}

</script>