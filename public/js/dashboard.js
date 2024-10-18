function toggleNav() {
    var sidebar = document.querySelector(".main-sidebar");
    var mainContent = document.querySelector(".main-container");
    var header = document.querySelector(".header"); // ใช้ main-container แทน #main

    if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
        mainContent.style.marginLeft = "0";
        header.style.marginLeft = "0";

    } else {
        sidebar.style.width = "250px";
        mainContent.style.marginLeft = "250px";
        header.style.marginLeft = "250px";
    }
    // Toggle the classes for open sidebar and expanded content
    sidebar.classList.toggle("open");
    mainContent.classList.toggle("expanded");
}