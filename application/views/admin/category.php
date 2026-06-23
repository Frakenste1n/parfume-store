<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-wrapper">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div>

            <div class="page-badge">
                <i class="bi bi-tags"></i>
                Admin Panel
            </div>

            <h1 class="page-title">
                Category Management
            </h1>

            <p class="page-subtitle">
                Organize perfume categories for better product structure
            </p>

        </div>

        <button
            class="btn-primary-action"
            onclick="openCreateModal()">

            <i class="bi bi-plus-lg"></i>
            New Category

        </button>

    </div>

    <!-- SEARCH -->
    <div class="card ui-card mt-4">

        <div class="card-body">

            <div class="search-box">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchCategory"
                    placeholder="Search categories..."
                    autocomplete="off">

            </div>

        </div>

    </div>

    <!-- TABLE CARD -->
    <div class="card ui-card mt-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table ui-table">

                    <thead>

                        <tr>
                            <th>Category</th>
                            <th width="120">Action</th>
                        </tr>

                    </thead>

                    <tbody id="categoryTableBody"></tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="categoryModal">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content ui-modal">

            <form id="categoryForm">

                <div class="modal-header">

                    <div>

                        <h5 id="modalTitle">Create Category</h5>

                        <small class="text-muted">
                            Simple category setup
                        </small>

                    </div>

                    <button class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <input type="hidden" id="categoryId">

                    <label class="form-label">
                        Category Name
                    </label>

                    <input
                        type="text"
                        id="category_name"
                        class="form-control ui-input"
                        placeholder="Example: Men Perfume">

                    <div class="input-hint">
                        Use clear and simple naming for better organization
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-soft"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn-primary-action">

                        <i class="bi bi-check2"></i>
                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- EMPTY STATE -->
<template id="emptyStateTemplate">

<tr>

    <td colspan="2">

        <div class="empty-state">

            <i class="bi bi-folder-x"></i>

            <h4>No Categories</h4>

            <p>Start by creating your first category</p>

        </div>

    </td>

</tr>

</template>

<!-- LOADING -->
<template id="loadingTemplate">

<tr>

    <td colspan="2">

        <div class="loading-state">

            <div class="spinner-border"></div>

            <p>Loading categories...</p>

        </div>

    </td>

</tr>

</template>

<style>

:root{
    --bg:#f8fafc;
    --card:#ffffff;
    --text:#0f172a;
    --muted:#64748b;
    --border:#e2e8f0;
}

/* PAGE */
.page-wrapper{
    animation:fade .25s ease;
}

@keyframes fade{
    from{opacity:0;transform:translateY(8px)}
    to{opacity:1;transform:translateY(0)}
}

/* HEADER */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;

    padding:28px;

    background:var(--card);
    border:1px solid var(--border);
    border-radius:20px;
}

.page-badge{
    display:inline-flex;
    gap:8px;
    align-items:center;

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
}

/* BUTTON */
.btn-primary-action{
    background:#111827;
    color:#fff;

    border:none;
    padding:11px 16px;

    border-radius:12px;

    font-weight:600;

    display:flex;
    gap:8px;
    align-items:center;

    transition:.2s ease;
}

.btn-primary-action:hover{
    transform:translateY(-2px);
    background:#1f2937;
}

.btn-soft{
    background:#f1f5f9;
    border:none;
    padding:10px 14px;
    border-radius:12px;
}

/* CARD */
.ui-card{
    border:1px solid var(--border);
    border-radius:20px;
    background:var(--card);
}

/* SEARCH */
.search-box{
    display:flex;
    align-items:center;
    gap:10px;

    padding:12px 14px;

    border:1px solid var(--border);
    border-radius:14px;
}

.search-box i{
    color:var(--muted);
}

.search-box input{
    border:none;
    outline:none;
    width:100%;
}

/* TABLE */
.ui-table thead th{
    font-size:12px;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.04em;

    padding:16px;
    border-bottom:1px solid var(--border);
}

.ui-table tbody td{
    padding:18px 16px;
    border-bottom:1px solid #f1f5f9;
}

.ui-table tbody tr:hover{
    background:#f8fafc;
}

/* CATEGORY ITEM */
.category-name{
    font-weight:600;
    color:var(--text);
}

.category-meta{
    font-size:12px;
    color:var(--muted);
    margin-top:2px;
}

/* ACTION */
.action-btn{
    width:36px;
    height:36px;

    border:none;
    border-radius:10px;

    display:inline-flex;
    align-items:center;
    justify-content:center;

    transition:.2s;
}

.action-btn:hover{
    transform:translateY(-2px);
}

.edit-btn{
    background:#f59e0b;
    color:white;
}

.delete-btn{
    background:#ef4444;
    color:white;
}

/* MODAL */
.ui-modal{
    border:none;
    border-radius:18px;
    overflow:hidden;
}

.input-hint{
    font-size:12px;
    color:var(--muted);
    margin-top:6px;
}

/* EMPTY */
.empty-state{
    text-align:center;
    padding:50px 20px;
    color:var(--muted);
}

.empty-state i{
    font-size:42px;
    margin-bottom:10px;
}

/* LOADING */
.loading-state{
    text-align:center;
    padding:40px;
    color:var(--muted);
}

</style>

<script>

const API = '<?= base_url("api/categories") ?>';

let modal;

document.addEventListener('DOMContentLoaded', () => {

    modal = new bootstrap.Modal(
        document.getElementById('categoryModal')
    );

    load();
    search();
    submit();

});

async function load(){

    const tbody = document.getElementById('categoryTableBody');

    tbody.innerHTML = document.getElementById('loadingTemplate').innerHTML;

    const res = await fetch(API);
    const json = await res.json();

    const data = json.data || [];

    if(data.length === 0){
        tbody.innerHTML = document.getElementById('emptyStateTemplate').innerHTML;
        return;
    }

    let html = '';

    data.forEach(c => {

        html += `
        <tr>

            <td>

                <div class="category-name">
                    ${c.category_name}
                </div>

                <div class="category-meta">
                    ID #${c.id}
                </div>

            </td>

            <td>

                <button class="action-btn edit-btn" onclick="edit(${c.id})">
                    <i class="bi bi-pencil"></i>
                </button>

                <button class="action-btn delete-btn" onclick="remove(${c.id})">
                    <i class="bi bi-trash"></i>
                </button>

            </td>

        </tr>`;
    });

    tbody.innerHTML = html;

}

function openCreateModal(){

    document.getElementById('categoryForm').reset();
    document.getElementById('categoryId').value = '';
    document.getElementById('modalTitle').innerText = 'Create Category';

    modal.show();

}

function submit(){

    document.getElementById('categoryForm').addEventListener('submit', async e => {

        e.preventDefault();

        const id = document.getElementById('categoryId').value;
        const name = document.getElementById('category_name').value;

        const url = id ? `${API}/${id}` : API;
        const method = id ? 'PUT' : 'POST';

        const res = await fetch(url, {
            method,
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:new URLSearchParams({category_name:name})
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

    const c = json.data;

    document.getElementById('categoryId').value = c.id;
    document.getElementById('category_name').value = c.category_name;
    document.getElementById('modalTitle').innerText = 'Edit Category';

    modal.show();

}

async function remove(id){

    const ok = await Swal.fire({
        title:'Delete?',
        text:'This action cannot be undone',
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

    document.getElementById('searchCategory').addEventListener('keyup', function(){

        const val = this.value.toLowerCase();

        document.querySelectorAll('#categoryTableBody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
        });

    });

}

</script>