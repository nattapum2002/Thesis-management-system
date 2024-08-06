document.getElementById("toggleSidebar").addEventListener("click", function () {
    document.getElementById("sidebar").classList.toggle("collapsed");
    document.querySelector(".main").classList.toggle("collapsed");
    document.querySelector(".main .navbar").classList.toggle("collapsed");
});

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
});
