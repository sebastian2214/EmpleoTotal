function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    var mainContent = document.getElementById("main-content");
    var overlay = document.getElementById("overlay");

    if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
        mainContent.style.marginLeft = "0";
        overlay.classList.remove("active");
    } else {
        sidebar.style.width = "250px";
        mainContent.style.marginLeft = "250px";
        overlay.classList.add("active");
    }
}

function closeSidebar() {
    var sidebar = document.getElementById("sidebar");
    var mainContent = document.getElementById("main-content");
    var overlay = document.getElementById("overlay");

    sidebar.style.width = "0";
    mainContent.style.marginLeft = "0";
    overlay.classList.remove("active");
}
