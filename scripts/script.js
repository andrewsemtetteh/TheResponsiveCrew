// Login button click
document.getElementById("login-btn").addEventListener("click", function () {
  window.location.href = "/pages/login.html";
});

// Register button click
document.getElementById("register-btn").addEventListener("click", function () {
  window.location.href = "/pages/register.html";
});

// Newsletter form submission handler
document
  .querySelector(".newsletter-form")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    alert("Newsletter subscription would be implemented here");
  });
