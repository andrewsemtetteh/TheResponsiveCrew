// Login button click
document.getElementById("login-btn").addEventListener("click", function () {
  window.location.href = "/pages/login.html";
});

// Adding an event listener to the login form
document.getElementById("loginForm").addEventListener("submit", validateForm);

// Newsletter form submission handler
document
  .querySelector(".newsletter-form")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    alert("Newsletter subscription would be implemented here");
  });
