const navActive = document.getElementById("hb-menu");
const navbarNav = document.querySelector(".navbar-nav");
const emailInput = document.querySelector('input[type="email"]');

navActive.addEventListener("click", function () {
  console.log("done cak");
  navbarNav.classList.toggle("active");
});

document.addEventListener("click", function (e) {
  if (!navActive.contains(e.target) && !navbarNav.contains(e.target))
    navbarNav.classList.remove("active");
});

form.addEventListener("submit", function (e) {
  if (!emailInput.value.includes("@")) {
    e.preventDefault();
    alert("Please enter a valid email address.");
  }
});
