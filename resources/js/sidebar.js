document.querySelectorAll(".sidebar .nav-link").forEach((link) => {
    link.addEventListener("click", function () {
        // 🚫 JANGAN ganggu dropdown Bootstrap
        if (this.hasAttribute("data-bs-toggle")) return;

        // reset active
        document.querySelectorAll(".sidebar .nav-link").forEach((el) => {
            el.classList.remove("active");
        });

        // set active
        this.classList.add("active");

        // parent submenu ikut active
        let parentCollapse = this.closest(".collapse");
        if (parentCollapse) {
            let parentLink = document.querySelector(
                '[href="#' + parentCollapse.id + '"]',
            );
            if (parentLink) parentLink.classList.add("active");
        }
    });
});

const sidebar = document.getElementById("sidebar");
const content = document.getElementById("content");
const overlay = document.getElementById("overlay");

function toggleSidebar() {
    if (window.innerWidth <= 768) {
        sidebar.classList.toggle("active");
        overlay.classList.toggle("active");
    } else {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("full");
    }
}

function closeSidebar() {
    sidebar.classList.remove("active");
    overlay.classList.remove("active");
}

/* AUTO RESPONSIVE */
window.addEventListener("load", () => {
    if (window.innerWidth <= 768) {
        sidebar.classList.add("collapsed");
        content.classList.add("full");
    }
});

window.addEventListener("resize", () => {
    if (window.innerWidth <= 768) {
        sidebar.classList.add("collapsed");
        content.classList.add("full");
    } else {
        sidebar.classList.remove("collapsed");
        content.classList.remove("full");
    }
});
