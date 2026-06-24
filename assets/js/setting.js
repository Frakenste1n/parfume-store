const SKIP_FIELDS = ["id", "created_at", "updated_at", "founder_name", "founder_photo", "founders"];

const FIELD_META = {
    site_name: { label: "Site Name", group: "store", col: "col-md-6" },
    logo: { label: "Logo", group: "store", col: "col-md-4", file: true, folder: "settings" },
    favicon: { label: "Favicon", group: "store", col: "col-md-4", file: true, folder: "settings" },
    about_us: { label: "About Us", group: "store", col: "col-12", textarea: true },
    email: { label: "Email", group: "contact", col: "col-md-6", type: "email" },
    whatsapp: { label: "WhatsApp", group: "contact", col: "col-md-6" },
    instagram: { label: "Instagram", group: "contact", col: "col-md-6" },
    address: { label: "Address", group: "contact", col: "col-12", textarea: true },
    featured_title: { label: "Featured Title", group: "frontend", col: "col-md-6" },
    featured_subtitle: { label: "Featured Subtitle", group: "frontend", col: "col-md-6", textarea: true }
};

const GROUP_LABELS = {
    store: "Store Identity",
    founder: "Founder Profiles",
    contact: "Contact & Social",
    frontend: "Frontend Content"
};

const FIELD_ORDER = [
    "site_name", "logo", "favicon", "about_us",
    "email", "whatsapp", "instagram", "address",
    "featured_title", "featured_subtitle"
];

const FOUNDER_COUNT = 5;

$(document).ready(function () {
    loadSettings();
    $("#btnSaveSetting").click(saveSettings);
});

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

function buildFoundersSection(founders) {
    founders = founders || [];

    let html = '<div class="col-12"><h6 class="setting-group-title">' + GROUP_LABELS.founder + '</h6></div>';
    html += '<div class="col-12"><p class="founder-section-desc">Tambahkan hingga 5 founder beserta foto profil masing-masing.</p></div>';

    for (let i = 0; i < FOUNDER_COUNT; i++) {
        const founder = founders[i] || { name: "", photo: "" };
        const photoUrl = uploadsUrl("settings", founder.photo);

        html += `
        <div class="col-md-6 col-xl-4">
            <div class="founder-card">
                <div class="founder-card-head">
                    <span class="founder-badge">Founder ${i + 1}</span>
                </div>
                <div class="founder-photo-wrap">
                    <img src="${photoUrl || "https://ui-avatars.com/api/?name=Founder&background=e2e8f0&color=64748b&size=128"}"
                         alt="Founder ${i + 1}"
                         class="founder-preview"
                         id="founderPreview_${i}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="founder_name_${i}">Nama Founder</label>
                    <input type="text"
                           class="form-control"
                           id="founder_name_${i}"
                           name="founder_name_${i}"
                           value="${escapeHtml(founder.name)}"
                           placeholder="Nama lengkap founder">
                </div>
                <div>
                    <label class="form-label" for="founder_photo_${i}">Foto Founder</label>
                    <input type="file"
                           class="form-control founder-photo-input"
                           id="founder_photo_${i}"
                           name="founder_photo_${i}"
                           data-index="${i}"
                           accept="image/jpeg,image/png,image/webp">
                    <input type="hidden"
                           name="founder_existing_photo_${i}"
                           id="founder_existing_photo_${i}"
                           value="${escapeHtml(founder.photo)}">
                    ${founder.photo ? '<small class="text-muted d-block mt-1">' + escapeHtml(founder.photo) + "</small>" : ""}
                </div>
            </div>
        </div>`;
    }

    return html;
}

function bindFounderPreview() {
    $(".founder-photo-input").off("change").on("change", function () {
        const index = $(this).data("index");
        const file = this.files && this.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            $("#founderPreview_" + index).attr("src", e.target.result);
        };

        reader.readAsDataURL(file);
    });
}

function buildSettingForm(data) {
    data = data || {};

    let html = "";
    let currentGroup = "";

    $.each(FIELD_ORDER, function (i, key) {
        const meta = FIELD_META[key];

        if (!meta) {
            return;
        }

        if (meta.group !== currentGroup) {
            currentGroup = meta.group;
            html += '<div class="col-12"><h6 class="setting-group-title">' + GROUP_LABELS[currentGroup] + "</h6></div>";
        }

        const value = data[key] || "";
        const id = "setting_" + key;
        const col = meta.col || "col-md-6";

        html += '<div class="' + col + '">';
        html += '<label class="form-label" for="' + id + '">' + meta.label + "</label>";

        if (meta.file) {
            html += '<input type="file" class="form-control" id="' + id + '" name="' + key + '" accept="image/jpeg,image/png,image/webp,image/x-icon,.ico">';

            if (value) {
                html += `
                <div class="setting-file-preview mt-2">
                    <img src="${uploadsUrl(meta.folder, value)}" alt="${meta.label}">
                    <small class="text-muted d-block mt-1">${escapeHtml(value)}</small>
                </div>`;
            }
        } else if (meta.textarea) {
            html += '<textarea class="form-control" id="' + id + '" name="' + key + '" rows="3">' + escapeHtml(value) + "</textarea>";
        } else {
            html += '<input type="' + (meta.type || "text") + '" class="form-control" id="' + id + '" name="' + key + '" value="' + escapeHtml(value) + '">';
        }

        html += "</div>";
    });

    html += buildFoundersSection(data.founders || []);

    $("#settingFormFields").html(html);
    bindFounderPreview();
}

function loadSettings() {
    $.ajax({
        url: base_url + "api/settings",
        dataType: "json",
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message || "Gagal memuat setting" });
                buildSettingForm({});
                return;
            }

            buildSettingForm(res.data || {});
        },
        error: function (xhr) {
            Swal.fire({
                icon: "error",
                title: "Oops",
                text: (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : "Gagal memuat setting"
            });
            buildSettingForm({});
        }
    });
}

function saveSettings() {
    const formEl = document.getElementById("settingForm");
    const formData = new FormData(formEl);
    const hasFile = $("#settingForm input[type='file']").toArray().some(function (input) {
        return input.files && input.files.length > 0;
    });

    const request = {
        url: base_url + "api/settings",
        data: hasFile ? formData : $("#settingForm").serialize(),
        processData: !hasFile,
        contentType: hasFile ? false : "application/x-www-form-urlencoded; charset=UTF-8",
        type: hasFile ? "POST" : "PUT",
        success: function (res) {
            if (!res.success) {
                Swal.fire({ icon: "error", title: "Oops", text: res.message });
                return;
            }

            buildSettingForm(res.data || {});

            Swal.fire({ icon: "success", title: "Berhasil", text: res.message });
        },
        error: function (xhr) {
            Swal.fire({
                icon: "error",
                title: "Oops",
                text: (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : "Gagal menyimpan setting"
            });
        }
    };

    $.ajax(request);
}
