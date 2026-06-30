$(document).ready(function () {
    loadFounders();
    $("#btnAddFounder").click(openAddModal);
    $("#btnSaveFounder").click(saveFounder);
    $("#founderPhoto").change(previewPhoto);
});

const founderModal = new bootstrap.Modal(document.getElementById('founderModal'));

function uploadsUrl(folder, filename) {
    if (!filename) {
        return "";
    }
    return base_url.replace(/\/?$/, "/") + "uploads/" + folder + "/" + filename;
}

function escapeHtml(str) {
    return String(str || "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;");
}

function loadFounders() {
    $.ajax({
        url: base_url + "api/founders",
        dataType: "json",
        success: function (res) {
            if (!res.success) {
                renderEmptyFounders();
                return;
            }
            renderFoundersTable(res.data || []);
        },
        error: function () {
            renderEmptyFounders();
        }
    });
}

function renderEmptyFounders() {
    const tbody = $("#foundersTable tbody");
    tbody.html(`
        <tr>
            <td colspan="6" class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                Belum ada data founder
            </td>
        </tr>
    `);
}

function renderFoundersTable(founders) {
    const tbody = $("#foundersTable tbody");

    if (!founders || founders.length === 0) {
        renderEmptyFounders();
        return;
    }

    let html = "";
    founders.forEach(function (founder) {
        const photoUrl = founder.photo ? uploadsUrl("founders", founder.photo) : "https://ui-avatars.com/api/?name=" + encodeURIComponent(founder.name) + "&background=e2e8f0&color=64748b&size=64";
        const statusBadge = founder.is_active
            ? '<span class="badge bg-success">Aktif</span>'
            : '<span class="badge bg-secondary">Nonaktif</span>';

        const contactLinks = [];
        if (founder.whatsapp) {
            contactLinks.push(`<a href="https://wa.me/${escapeHtml(founder.whatsapp.replace(/[^0-9]/g, ''))}" target="_blank" rel="noopener" class="founder-contact-link" title="WhatsApp">
                <i class="bi bi-whatsapp"></i>
            </a>`);
        }
        if (founder.instagram) {
            const instagramUrl = founder.instagram.startsWith('http') ? founder.instagram : 'https://instagram.com/' + founder.instagram.replace('@', '');
            contactLinks.push(`<a href="${escapeHtml(instagramUrl)}" target="_blank" rel="noopener" class="founder-contact-link" title="Instagram">
                <i class="bi bi-instagram"></i>
            </a>`);
        }
        const contactHtml = contactLinks.length > 0 ? contactLinks.join('') : '<span class="text-muted">-</span>';

        html += `
        <tr>
            <td>
                <img src="${photoUrl}" alt="${escapeHtml(founder.name)}" class="founder-avatar">
            </td>
            <td>
                <div class="fw-semibold">${escapeHtml(founder.name)}</div>
            </td>
            <td>${escapeHtml(founder.position)}</td>
            <td>${contactHtml}</td>
            <td>${statusBadge}</td>
            <td>
                <div class="action-buttons">
                    <button type="button" class="btn-action btn-edit" onclick="editFounder(${founder.id})" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn-action btn-delete" onclick="deleteFounder(${founder.id})" title="Hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </td>
        </tr>`;
    });

    tbody.html(html);
}

function openAddModal() {
    $("#founderModalTitle").text("Tambah Founder");
    $("#founderForm")[0].reset();
    $("#founderId").val("");
    $("#founderExistingPhoto").val("");
    $("#founderPhotoPreview").html("");
    $("#founderActive").prop("checked", true);
    founderModal.show();
}

function editFounder(id) {
    $.ajax({
        url: base_url + "api/founders/" + id,
        dataType: "json",
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: "Gagal memuat data founder" });
                return;
            }

            const founder = res.data;
            $("#founderModalTitle").text("Edit Founder");
            $("#founderId").val(founder.id);
            $("#founderName").val(founder.name);
            $("#founderPosition").val(founder.position);
            $("#founderWhatsapp").val(founder.whatsapp || "");
            $("#founderInstagram").val(founder.instagram || "");
            $("#founderActive").prop("checked", founder.is_active);
            $("#founderExistingPhoto").val(founder.photo || "");

            if (founder.photo) {
                const photoUrl = uploadsUrl("founders", founder.photo);
                $("#founderPhotoPreview").html(`
                    <img src="${photoUrl}" alt="Preview" class="img-thumbnail" style="max-width: 150px;">
                `);
            } else {
                $("#founderPhotoPreview").html("");
            }

            founderModal.show();
        },
        error: function () {
            Swal.fire({ icon: "error", title: "Oops", text: "Gagal memuat data founder" });
        }
    });
}

function saveFounder() {
    const formEl = document.getElementById("founderForm");
    const formData = new FormData(formEl);
    const id = $("#founderId").val();
    const hasFile = $("#founderPhoto")[0].files.length > 0;

    if (!$("#founderName").val().trim()) {
        Swal.fire({ icon: "warning", title: "Validasi", text: "Nama founder wajib diisi" });
        return;
    }

    if (!$("#founderPosition").val().trim()) {
        Swal.fire({ icon: "warning", title: "Validasi", text: "Jabatan wajib diisi" });
        return;
    }

    const url = id ? base_url + "api/founders/" + id : base_url + "api/founders";
    const method = id ? "PUT" : "POST";

    $.ajax({
        url: url,
        type: method,
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message || "Gagal menyimpan founder" });
                return;
            }

            founderModal.hide();
            loadFounders();
            Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
        },
        error: function (xhr) {
            const message = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : "Gagal menyimpan founder";
            Swal.fire({ icon: "error", title: "Oops", text: message });
        }
    });
}

function toggleFounder(id) {
    Swal.fire({
        icon: "question",
        title: "Konfirmasi",
        text: "Apakah Anda yakin ingin mengubah status founder ini?",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Batal"
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                url: base_url + "api/founders/" + id + "/toggle",
                type: "PUT",
                success: function (res) {
                    if (!res.success) {
                        Swal.fire({ icon: "error", title: "Oops", text: "Gagal mengubah status" });
                        return;
                    }
                    loadFounders();
                    Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
                },
                error: function () {
                    Swal.fire({ icon: "error", title: "Oops", text: "Gagal mengubah status" });
                }
            });
        }
    });
}

function deleteFounder(id) {
    Swal.fire({
        icon: "warning",
        title: "Hapus Founder?",
        text: "Data yang dihapus tidak dapat dikembalikan",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batal",
        confirmButtonColor: "#dc3545"
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                url: base_url + "api/founders/" + id,
                type: "DELETE",
                success: function (res) {
                    if (!res.success) {
                        Swal.fire({ icon: "error", title: "Oops", text: "Gagal menghapus founder" });
                        return;
                    }
                    loadFounders();
                    Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
                },
                error: function () {
                    Swal.fire({ icon: "error", title: "Oops", text: "Gagal menghapus founder" });
                }
            });
        }
    });
}

function previewPhoto() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $("#founderPhotoPreview").html(`
                <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 150px;">
            `);
        };
        reader.readAsDataURL(file);
    }
}
