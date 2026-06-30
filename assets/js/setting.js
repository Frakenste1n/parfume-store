const SKIP_FIELDS = ["id", "created_at", "updated_at", "founder_name", "founder_photo", "founders"];

const FIELD_META = {
    site_name: { label: "Site Name", group: "general", col: "col-md-6" },
    logo: { label: "Logo", group: "branding", col: "col-md-6", file: true, folder: "settings" },
    favicon: { label: "Favicon", group: "branding", col: "col-md-6", file: true, folder: "settings" },
    about_us: { label: "About Us", group: "about", col: "col-12", textarea: true },
    featured_title: { label: "Featured Title", group: "featured", col: "col-md-6" },
    featured_subtitle: { label: "Featured Subtitle", group: "featured", col: "col-md-6", textarea: true },
    email: { label: "Email", group: "contact", col: "col-md-6", type: "email" },
    whatsapp: { label: "WhatsApp", group: "contact", col: "col-md-6" },
    instagram: { label: "Instagram", group: "contact", col: "col-md-6" },
    google_maps_embed: { label: "Google Maps Embed URL", group: "maps", col: "col-12", textarea: true }
};

const GROUP_LABELS = {
    general: "General Information",
    branding: "Logo & Favicon",
    about: "About Us",
    featured: "Featured Section",
    contact: "Contact Information",
    maps: "Google Maps"
};

const FIELD_ORDER = [
    "site_name",
    "logo", "favicon",
    "about_us",
    "featured_title", "featured_subtitle",
    "email", "whatsapp", "instagram",
    "google_maps_embed"
];

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

    $("#settingFormFields").html(html);
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
