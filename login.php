<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talent Sphere - Login</title>
    <link rel="stylesheet" href="./styles/authentication.css" />
    <link rel="icon" href="./images/icon.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="/php/login.php" method="POST">
            <input type="text" id="email" placeholder="Enter your Ashesi email" required />
            <input type="password" id="password" placeholder="Enter your password" required />
            <button type="submit">Login</button>
            <div id="errorMessages" style="
            color: var(--alert-error);
            margin-top: 10px;
            text-align: center;
          "></div>
        </form>
        <div class="links">
            <a href="#" id="forgotPassword">Forgot Password?</a>
            <p>Don't have an account? <a href="register.php">Sign up</a></p>
            <p><span>NB: </span> You can ONLY Login with an Ashesi Email</p>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
    document
        .getElementById("loginForm")
        .addEventListener("submit", function(event) {
            event.preventDefault();

            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex =
                /^(?=.*[A-Z])(?=.*\d{3,})(?=.*[@#$%^&+=!]).{8,}$/;

            const errorMessagesDiv = document.getElementById("errorMessages");
            errorMessagesDiv.innerHTML = "";

            let errorMessages = [];

            if (!email) {
                errorMessages.push("- Email address is required.");
            } else if (!emailRegex.test(email)) {
                errorMessages.push("- Please enter a valid email address.");
            }

            if (!password) {
                errorMessages.push("Password is required.");
            } else if (!passwordRegex.test(password)) {
                errorMessages.push(
                    "- Password must be at least 8 characters long, contain at least one uppercase letter, three digits, and one special character (@, #, $, etc.)."
                );
            }

            if (errorMessages.length > 0) {
                errorMessagesDiv.innerHTML = errorMessages
                    .map((msg) => `<p style="margin: 0; padding: 5px 0;">${msg}</p>`)
                    .join("");
            } else {
                // Form is valid - proceed with submission
                alert("Form submitted successfully!");
                // Optionally: submit the form programmatically (uncomment the next line)
                // this.submit();
            }
        });
    </script>
</body>

</html>