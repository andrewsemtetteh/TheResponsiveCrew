// redirection to the login page when the login button is clicked
document.querySelector("#login-btn").addEventListener("click", function () {
  window.location.href = "/pages/login.html";
});

// validating the booking form on the portfolio page
const bookingBtn = document.getElementById("bookingBtn");
const bookingModal = document.getElementById("bookingModal");
const closeModal = document.querySelector(".close-modal");
const bookingForm = document.querySelector(".booking-form");

bookingBtn.addEventListener("click", () => {
  bookingModal.classList.add("active");
});

closeModal.addEventListener("click", () => {
  bookingModal.classList.remove("active");
});

window.addEventListener("click", (e) => {
  if (e.target === bookingModal) {
    bookingModal.classList.remove("active");
  }
});

bookingForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const formData = {
    name: document.getElementById("name").value,
    email: document.getElementById("email").value,
    message: document.getElementById("message").value,
  };

  console.log("Form submitted:", formData);

  bookingForm.reset();
  bookingModal.classList.remove("active");
});
