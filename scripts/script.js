// Login button click
document.getElementById("login-btn").addEventListener("click", function () {
  window.location.href = "login.html";
});

// Register button click
document.getElementById("register-btn").addEventListener("click", function () {
  window.location.href = "register.html";
});

// Newsletter form submission handler
document
  .querySelector(".newsletter-form")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    alert("Newsletter subscription would be implemented here");
  });
