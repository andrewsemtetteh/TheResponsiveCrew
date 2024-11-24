<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talent Sphere - Register</title>
    <link rel="stylesheet" href="./styles/authentication.css" />
    <link rel="icon" href="./images/icon.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form id="registerForm" action="/php/register.php" method="POST" enctype="multipart/form-data">
            <input type="text" id="fullname" placeholder="Enter your full name" required />
            <input type="email" id="email" placeholder="Enter your Ashesi email" required />
            <input type="password" id="password" placeholder="Enter your password" required />
            <input type="password" id="passwordConfirm" placeholder="Confirm your password" required />
            <div class="form-control">
                <label for="avatar">Profile Picture</label>
                <input type="file" id="profilePicture" accept="image/*" />
            </div>
            <button type="submit">Register</button>
            <div class="error-messages" id="errorMessages"></div>
        </form>
        <div class="links">
            <p>Already have an account? <a href="login.php">Login</a></p>
            <p><span>NB: </span> You can ONLY Register with an Ashesi Email</p>
        </div>
    </div>
    <script src="validation.js"></script>
    <script>
    document
        .getElementById("registerForm")
        .addEventListener("submit", function(e) {
            e.preventDefault();
            let errors = [];
            const fullname = document.getElementById("fullname").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const passwordConfirm = document
                .getElementById("passwordConfirm")
                .value.trim();
            const expertise = document.getElementById("expertise").value;

            // Full name validation
            if (!fullname) errors.push("Full name is required.");

            // Email validation
            if (!email || !/^[\w.%+-]+@ashesi\.edu\.gh$/.test(email)) {
                errors.push("- A valid Ashesi email is required.");
            }

            // Password validation
            if (!password) {
                errors.push("- Password is required.");
            } else if (
                password.length < 8 ||
                !/[A-Z]/.test(password) ||
                !/\d.*\d.*\d/.test(password) ||
                !/[!@#$%^&*]/.test(password)
            ) {
                errors.push(
                    "- Password must have at least 8 characters, 1 uppercase letter, 3 digits, and 1 special character."
                );
            }

            // Confirm password validation
            if (password !== passwordConfirm) {
                errors.push("Passwords do not match.");
            }

            // Expertise validation
            if (!expertise) errors.push("- Expertise is required.");

            // Display errors
            const errorMessages = document.getElementById("errorMessages");
            errorMessages.innerHTML =
                errors.length > 0 ? errors.join("<br>") : "";

            // Submit form if no errors
            if (errors.length === 0) {
                this.submit(); // Form submission logic
            }
        });
    </script>
</body>

</html>