<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="brand-page">

    <!-- HEADER -->
    <div class="brand-header">

        <div>

            <h2 class="brand-title">
                Admin -
                <span>Brand Management</span>
            </h2>

            <p class="brand-subtitle">
                Manage perfume brands, logos and company profiles
            </p>

        </div>

        <button
            type="button"
            class="btn-add-brand"
            onclick="openCreateModal()">

            <i class="bi bi-plus-circle"></i>
            Add Brand

        </button>

    </div>

    <!-- SEARCH -->
    <div class="card search-card mt-4">

        <div class="card-body">

            <div class="search-wrapper">

                <i class="bi bi-search search-icon"></i>

                <input
                    type="text"
                    id="searchBrand"
                    class="form-control search-input"
                    placeholder="Search brand name, country or website...">

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="card brand-table-card mt-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>

                        <tr>

                            <th width="90">
                                Logo
                            </th>

                            <th>
                                Brand
                            </th>

                            <th>
                                Country
                            </th>

                            <th>
                                Website
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Featured
                            </th>

                            <th>
                                Created
                            </th>

                            <th width="130">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody id="brandTableBody">

                        <!-- AJAX -->

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- MODAL -->
<div
    class="modal fade"
    id="brandModal"
    tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form
                id="brandForm"
                enctype="multipart/form-data">

                <div class="modal-header">

                    <div>

                        <h5
                            class="modal-title"
                            id="modalTitle">

                            Create Brand

                        </h5>

                        <small class="text-muted">

                            Fill all required information

                        </small>

                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        id="brandId">

                    <div class="row g-4">

                        <!-- BRAND NAME -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Brand Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                class="form-control"
                                placeholder="Dior">

                        </div>

                        <!-- COUNTRY -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Origin Country
                            </label>

                            <input
                                type="text"
                                id="origin_country"
                                class="form-control"
                                placeholder="France">

                        </div>

                        <!-- WEBSITE -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Website
                            </label>

                            <input
                                type="text"
                                id="website"
                                class="form-control"
                                placeholder="https://dior.com">

                        </div>

                        <!-- INSTAGRAM -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Instagram
                            </label>

                            <input
                                type="text"
                                id="instagram"
                                class="form-control"
                                placeholder="@dior">

                        </div>

                        <!-- LOGO -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Brand Logo
                            </label>

                            <input
                                type="file"
                                id="logo"
                                class="form-control"
                                accept="image/*">

                        </div>

                        <!-- PREVIEW -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Preview
                            </label>

                            <div class="logo-preview-wrapper">

                                <img
                                    id="logoPreview"
                                    src="https://placehold.co/300x300/e2e8f0/64748b?text=Logo"
                                    class="logo-preview">

                            </div>

                        </div>

                        <!-- DESCRIPTION -->
                        <div class="col-12">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                id="description"
                                rows="5"
                                class="form-control"
                                placeholder="Brand description..."></textarea>

                        </div>

                        <!-- FEATURED -->
                        <div class="col-md-3">

                            <label class="form-label d-block">
                                Featured Brand
                            </label>

                            <div class="form-check form-switch">

                                <input
                                    type="checkbox"
                                    id="is_featured"
                                    class="form-check-input">

                            </div>

                        </div>

                        <!-- ACTIVE -->
                        <div class="col-md-3">

                            <label class="form-label d-block">
                                Active Brand
                            </label>

                            <div class="form-check form-switch">

                                <input
                                    type="checkbox"
                                    id="is_active"
                                    class="form-check-input"
                                    checked>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-cancel"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn-save">

                        <i class="bi bi-check-circle"></i>
                        Save Brand

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- EMPTY STATE TEMPLATE -->
<template id="emptyStateTemplate">

<tr>

    <td colspan="8">

        <div class="empty-state">

            <div class="empty-icon">

                <i class="bi bi-tags"></i>

            </div>

            <h5>
                No Brands Found
            </h5>

            <p>
                Start by creating your first perfume brand.
            </p>

        </div>

    </td>

</tr>

</template>

<!-- LOADING TEMPLATE -->
<template id="loadingTemplate">

<tr>

    <td colspan="8">

        <div class="loading-state">

            <div
                class="spinner-border text-primary"
                role="status">
            </div>

            <p class="mt-3 mb-0">
                Loading brands...
            </p>

        </div>

    </td>

</tr>

</template>

<style>

:root{
    --primary:#4f46e5;
    --primary-dark:#4338ca;
    --secondary:#7c3aed;
    --success:#10b981;
    --success-dark:#059669;
    --danger:#ef4444;
    --danger-dark:#dc2626;
    --warning:#f59e0b;
    --warning-dark:#ea580c;
    --gray:#64748b;
    --border:#e2e8f0;
    --bg:#f8fafc;
}

/* =========================
   PAGE
========================= */

.brand-page{
    animation:fadeIn .3s ease;
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
   HEADER
========================= */

.brand-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    flex-wrap:wrap;

    padding:28px;

    background:#ffffff;

    border-radius:24px;

    border:1px solid #e2e8f0;

    box-shadow:
    0 4px 20px
    rgba(15,23,42,.04);

}

.brand-title{

    font-size:28px;
    font-weight:700;
    margin:0;

    color:#0f172a;

}

.brand-title span{

    color:#334155;

}

.brand-subtitle{

    color:#64748b;
    margin-top:6px;

}

.btn-add-brand{

    border:none;

    padding:12px 20px;

    border-radius:14px;

    background:#111827;

    color:white;

    font-weight:600;

    transition:.25s;

}

.btn-add-brand:hover{

    background:#1f2937;

    transform:translateY(-2px);

}

/* =========================
   CARD
========================= */

.search-card,
.brand-table-card{

    border:none !important;

    border-radius:24px;

    overflow:hidden;

    box-shadow:
    0 10px 30px
    rgba(15,23,42,.05);

}

.card-body{
    background:white;
}

/* =========================
   SEARCH
========================= */

.search-wrapper{

    position:relative;

}

.search-icon{

    position:absolute;

    left:18px;
    top:50%;

    transform:translateY(-50%);

    color:#94a3b8;

    z-index:2;

}

.search-input{

    height:55px;

    border-radius:16px;

    padding-left:50px;

    border:1px solid var(--border);

}

.search-input:focus{

    border-color:var(--primary);

    box-shadow:
    0 0 0 .2rem
    rgba(79,70,229,.15);

}

/* =========================
   TABLE
========================= */

.table{
    margin:0;
}

.table thead{

    background:#f8fafc;

}

.table thead th{

    border:none;

    padding:20px;

    font-size:13px;

    font-weight:700;

    color:#64748b;

    text-transform:uppercase;

    letter-spacing:.04em;

}

.table tbody td{

    padding:20px;

    vertical-align:middle;

}

.table tbody tr{

    transition:.25s;

}

.table tbody tr:hover{

    background:#f8fafc;

}

/* =========================
   LOGO
========================= */

.brand-logo{

    width:55px;
    height:55px;

    border-radius:14px;

    object-fit:cover;

    border:1px solid #e5e7eb;

}

/* =========================
   BADGE
========================= */

.active-badge{

    display:inline-block;

    padding:7px 14px;

    border-radius:999px;

    color:white;

    font-size:12px;

    font-weight:600;

    background:
    linear-gradient(
        135deg,
        var(--success),
        var(--success-dark)
    );

}

.inactive-badge{

    display:inline-block;

    padding:7px 14px;

    border-radius:999px;

    color:white;

    font-size:12px;

    font-weight:600;

    background:
    linear-gradient(
        135deg,
        #64748b,
        #475569
    );

}

.featured-badge{

    display:inline-block;

    padding:7px 14px;

    border-radius:999px;

    color:white;

    font-size:12px;

    font-weight:600;

    background:
    linear-gradient(
        135deg,
        var(--warning),
        var(--warning-dark)
    );

}

.regular-badge{

    display:inline-block;

    padding:7px 14px;

    border-radius:999px;

    color:white;

    font-size:12px;

    font-weight:600;

    background:
    linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );

}

/* =========================
   ACTION BUTTON
========================= */

.action-group{

    display:flex;
    gap:8px;

}

.action-btn{

    width:40px;
    height:40px;

    border:none;

    border-radius:12px;

    color:white;

    transition:.3s;

}

.action-btn:hover{

    transform:translateY(-3px);

}

.edit-btn{

    background:
    linear-gradient(
        135deg,
        var(--warning),
        var(--warning-dark)
    );

}

.delete-btn{

    background:
    linear-gradient(
        135deg,
        var(--danger),
        var(--danger-dark)
    );

}

/* =========================
   MODAL
========================= */

.modal-content{

    border:none;

    border-radius:24px;

    overflow:hidden;

}

.modal-header{

    padding:20px 25px;

    border-bottom:
    1px solid #f1f5f9;

}

.modal-body{

    padding:25px;

}

.modal-footer{

    padding:20px 25px;

    border-top:
    1px solid #f1f5f9;

}

.modal-title{

    font-weight:700;

}

/* =========================
   FORM
========================= */

.form-control{

    border-radius:14px;

    min-height:50px;

    border:1px solid var(--border);

}

textarea.form-control{

    min-height:auto;

}

.form-control:focus{

    border-color:var(--primary);

    box-shadow:
    0 0 0 .2rem
    rgba(79,70,229,.15);

}

.form-check-input{

    width:50px;
    height:26px;

}

.form-check-input:checked{

    background-color:var(--primary);
    border-color:var(--primary);

}

/* =========================
   LOGO PREVIEW
========================= */

.logo-preview-wrapper{

    display:flex;
    align-items:center;

}

.logo-preview{

    width:140px;
    height:140px;

    border-radius:20px;

    object-fit:cover;

    border:1px solid #e5e7eb;

    background:#f8fafc;

}

/* =========================
   BUTTON
========================= */

.btn-save{

    border:none;

    color:white;

    padding:12px 20px;

    border-radius:14px;

    font-weight:600;

    background:
    linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );

}

.btn-cancel{

    border:none;

    padding:12px 20px;

    border-radius:14px;

    background:#f1f5f9;

}

/* =========================
   EMPTY STATE
========================= */

.empty-state{

    text-align:center;

    padding:60px 20px;

}

.empty-icon{

    width:90px;
    height:90px;

    display:flex;
    align-items:center;
    justify-content:center;

    margin:auto;

    border-radius:50%;

    background:#f1f5f9;

    font-size:36px;

    color:#64748b;

}

.empty-state h5{

    margin-top:20px;

    font-weight:700;

}

.empty-state p{

    color:#64748b;

}

/* =========================
   LOADING
========================= */

.loading-state{

    text-align:center;

    padding:60px 20px;

}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:768px){

    .brand-header{

        flex-direction:column;
        align-items:stretch;

    }

    .btn-add-brand{

        width:100%;

    }

    .brand-title{

        font-size:24px;

    }

    .logo-preview{

        width:100px;
        height:100px;

    }

    .table thead th,
    .table tbody td{

        padding:15px;

    }

}

</style>

<script>

const API = '<?= base_url("api/brands") ?>';

let brandModal = null;

document.addEventListener('DOMContentLoaded', () => {

    brandModal = new bootstrap.Modal(
        document.getElementById('brandModal')
    );

    loadBrands();

    initializeSearch();

    initializeLogoPreview();

    initializeFormSubmit();

});

/* ======================================
   LOAD DATA
====================================== */

async function loadBrands(){

    const tbody =
    document.getElementById('brandTableBody');

    tbody.innerHTML =
    document.getElementById(
        'loadingTemplate'
    ).innerHTML;

    try{

        const response =
        await fetch(API);

        const result =
        await response.json();

        const brands =
        result.data || [];

        if(brands.length === 0){

            tbody.innerHTML =
            document.getElementById(
                'emptyStateTemplate'
            ).innerHTML;

            return;

        }

        let html = '';

        brands.forEach(brand => {

            html += `
            <tr>

                <td>

                    <img
                        src="<?= base_url('uploads/brands/') ?>${brand.logo}"
                        class="brand-logo"
                        onerror="this.src='https://placehold.co/200x200/e2e8f0/64748b?text=Logo'">

                </td>

                <td>

                    <div class="fw-semibold">
                        ${brand.name ?? '-'}
                    </div>

                    <small class="text-muted">

                        ${
                            brand.description
                            ? brand.description.substring(0,50)+'...'
                            : '-'
                        }

                    </small>

                </td>

                <td>
                    ${brand.origin_country ?? '-'}
                </td>

                <td>

                    ${
                        brand.website
                        ? `
                        <a
                            href="${brand.website}"
                            target="_blank">

                            Visit

                        </a>
                        `
                        : '-'
                    }

                </td>

                <td>

                    ${
                        Number(brand.is_active) === 1
                        ? '<span class="active-badge">Active</span>'
                        : '<span class="inactive-badge">Inactive</span>'
                    }

                </td>

                <td>

                    ${
                        Number(brand.is_featured) === 1
                        ? '<span class="featured-badge">Featured</span>'
                        : '<span class="regular-badge">Regular</span>'
                    }

                </td>

                <td>

                    ${
                        brand.created_at
                        ? new Date(
                            brand.created_at
                        ).toLocaleDateString()
                        : '-'
                    }

                </td>

                <td>

                    <div class="action-group">

                        <button
                            class="action-btn edit-btn"
                            onclick="editBrand(${brand.id})">

                            <i class="bi bi-pencil-square"></i>

                        </button>

                        <button
                            class="action-btn delete-btn"
                            onclick="deleteBrand(${brand.id})">

                            <i class="bi bi-trash"></i>

                        </button>

                    </div>

                </td>

            </tr>
            `;

        });

        tbody.innerHTML = html;

    }catch(error){

        tbody.innerHTML = `
        <tr>

            <td colspan="8">

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="bi bi-wifi-off"></i>

                    </div>

                    <h5>
                        Failed To Load Data
                    </h5>

                    <p>
                        Please try again later.
                    </p>

                </div>

            </td>

        </tr>
        `;

    }

}

/* ======================================
   OPEN CREATE
====================================== */

function openCreateModal(){

    resetForm();

    document.getElementById(
        'modalTitle'
    ).innerText = 'Create Brand';

    brandModal.show();

}

/* ======================================
   RESET FORM
====================================== */

function resetForm(){

    document.getElementById('brandForm')
    .reset();

    document.getElementById('brandId')
    .value = '';

    document.getElementById(
        'logoPreview'
    ).src =
    'https://placehold.co/300x300/e2e8f0/64748b?text=Logo';

}

/* ======================================
   PREVIEW LOGO
====================================== */

function initializeLogoPreview(){

    const logoInput =
    document.getElementById('logo');

    logoInput.addEventListener(
        'change',
        function(){

            const file =
            this.files[0];

            if(!file) return;

            const reader =
            new FileReader();

            reader.onload = e => {

                document.getElementById(
                    'logoPreview'
                ).src =
                e.target.result;

            };

            reader.readAsDataURL(file);

        }
    );

}

/* ======================================
   CREATE / UPDATE
====================================== */

function initializeFormSubmit(){

    document
    .getElementById('brandForm')
    .addEventListener(
        'submit',
        async function(e){

            e.preventDefault();

            const id =
            document.getElementById(
                'brandId'
            ).value;

            const formData =
            new FormData();

            formData.append(
                'name',
                document.getElementById('name').value
            );

            formData.append(
                'description',
                document.getElementById('description').value
            );

            formData.append(
                'website',
                document.getElementById('website').value
            );

            formData.append(
                'instagram',
                document.getElementById('instagram').value
            );

            formData.append(
                'origin_country',
                document.getElementById('origin_country').value
            );

            formData.append(
                'is_featured',
                document.getElementById('is_featured').checked ? 1 : 0
            );

            formData.append(
                'is_active',
                document.getElementById('is_active').checked ? 1 : 0
            );

            const logo =
            document.getElementById('logo')
            .files[0];

            if(logo){

                formData.append(
                    'logo',
                    logo
                );

            }

            const endpoint =
            id
            ? `${API}/update/${id}`
            : API;

            try{

                const response =
                await fetch(
                    endpoint,
                    {
                        method:'POST',
                        body:formData
                    }
                );

                const result =
                await response.json();

                if(result.status){

                    brandModal.hide();

                    await Swal.fire({

                        icon:'success',

                        title:
                        id
                        ? 'Brand Updated'
                        : 'Brand Created',

                        text:result.message,

                        timer:1800,

                        showConfirmButton:false

                    });

                    loadBrands();

                }else{

                    Swal.fire({

                        icon:'error',
                        title:'Failed',
                        text:result.message

                    });

                }

            }catch(error){

                Swal.fire({

                    icon:'error',
                    title:'Error',
                    text:'Something went wrong'

                });

            }

        }
    );

}

/* ======================================
   EDIT
====================================== */

async function editBrand(id){

    try{

        const response =
        await fetch(
            `${API}/${id}`
        );

        const result =
        await response.json();

        const brand =
        result.data;

        document.getElementById(
            'modalTitle'
        ).innerText =
        'Edit Brand';

        document.getElementById(
            'brandId'
        ).value =
        brand.id;

        document.getElementById(
            'name'
        ).value =
        brand.name ?? '';

        document.getElementById(
            'description'
        ).value =
        brand.description ?? '';

        document.getElementById(
            'website'
        ).value =
        brand.website ?? '';

        document.getElementById(
            'instagram'
        ).value =
        brand.instagram ?? '';

        document.getElementById(
            'origin_country'
        ).value =
        brand.origin_country ?? '';

        document.getElementById(
            'is_featured'
        ).checked =
        Number(brand.is_featured) === 1;

        document.getElementById(
            'is_active'
        ).checked =
        Number(brand.is_active) === 1;

        document.getElementById(
            'logoPreview'
        ).src =
        '<?= base_url("uploads/brands/") ?>'
        + brand.logo;

        brandModal.show();

    }catch(error){

        Swal.fire({

            icon:'error',
            title:'Error',
            text:'Failed to load brand'

        });

    }

}

/* ======================================
   DELETE
====================================== */

async function deleteBrand(id){

    const confirm =
    await Swal.fire({

        title:'Delete Brand?',

        html:`
        <div class="text-muted">

            This action cannot be undone.

        </div>
        `,

        icon:'warning',

        showCancelButton:true,

        confirmButtonText:
        'Yes, Delete',

        cancelButtonText:
        'Cancel',

        confirmButtonColor:'#dc2626',

        reverseButtons:true

    });

    if(!confirm.isConfirmed){

        return;

    }

    try{

        const response =
        await fetch(
            `${API}/delete/${id}`,
            {
                method:'POST'
            }
        );

        const result =
        await response.json();

        if(result.status){

            await Swal.fire({

                icon:'success',

                title:'Deleted',

                text:result.message,

                timer:1500,

                showConfirmButton:false

            });

            loadBrands();

        }else{

            Swal.fire({

                icon:'error',

                title:'Failed',

                text:result.message

            });

        }

    }catch(error){

        Swal.fire({

            icon:'error',

            title:'Error',

            text:'Delete failed'

        });

    }

}

/* ======================================
   SEARCH
====================================== */

function initializeSearch(){

    const search =
    document.getElementById(
        'searchBrand'
    );

    search.addEventListener(
        'keyup',
        function(){

            const keyword =
            this.value.toLowerCase();

            document
            .querySelectorAll(
                '#brandTableBody tr'
            )
            .forEach(row => {

                row.style.display =
                row.innerText
                .toLowerCase()
                .includes(keyword)
                ? ''
                : 'none';

            });

        }
    );

}

</script>