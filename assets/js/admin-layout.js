$(document).ready(function () {
    if (typeof AOS !== "undefined") {
        AOS.init({ duration: 600, once: true });
    }

    $("#btnAdminLogout").on("click", function (e) {
        e.preventDefault();
        handleAdminLogout();
    });
});

function escapeLayoutHtml(str) {
    return String(str || "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;");
}

function handleAdminLogout() {
    const adminName = $("#adminDisplayName").data("name") || "Admin";

    Swal.fire({
        title: "Keluar dari panel?",
        html: "Sesi admin <strong>" + escapeLayoutHtml(adminName) + "</strong> akan diakhiri.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#6366f1",
        cancelButtonColor: "#94a3b8",
        confirmButtonText: "Ya, logout",
        cancelButtonText: "Batal",
        reverseButtons: true
    }).then(function (result) {
        if (!result.isConfirmed) {
            return;
        }

        Swal.fire({
            title: "Selamat tinggal!",
            html:
                '<div class="goodbye-wrap">' +
                    '<div class="goodbye-wave animate">👋</div>' +
                    '<p class="goodbye-text">Sampai jumpa, <strong>' + escapeLayoutHtml(adminName) + "</strong></p>" +
                    '<div class="goodbye-spinner"></div>' +
                "</div>",
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 2400,
            timerProgressBar: true
        }).then(function () {
            window.location.href = base_url + "admin/logout";
        });
    });
}
