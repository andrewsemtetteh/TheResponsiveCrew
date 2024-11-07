// Login button click
document.getElementById("login-btn").addEventListener("click", function () {
  window.location.href = "/pages/login.html";
});

//login validation
function validateForm(event) {
  event.preventDefault();
  // Prevent the form from submitting when the submit button is clicked without any input

  const emailInput = document.getElementById("username").value;
  const passwordInput = document.getElementById("password").value;

  // Email validation using a regular expression
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(emailInput)) {
    alert("Please enter a valid email address.");
    return;
  }

  // Password validation
  const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
  if (!passwordPattern.test(passwordInput)) {
    alert(
      "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character."
    );
    return;
  }

  alert("Login successful!");
}

// Adding an event listener to the login form
document.getElementById("loginForm").addEventListener("submit", validateForm);

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

// when the create blog post is clicked
document
  .querySelector(".create-post-btn")
  .addEventListener("click", function () {
    window.location.href = "/pages/createblog.html";
  });

//when the create new post is clicked

document
  .getElementsByClassName("create-newpost-btn")
  .addEventListener("click", function () {
    window.location.href = "/pages/createpost.hmtl";
  });
