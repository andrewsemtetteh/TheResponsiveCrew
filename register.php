<?php
    session_start();
    require 'config/constants.php';

    //gets back form data if there was a registration error
    $fullname = $_SESSION['register-data']['fullname'] ?? null;
    $email = $_SESSION['register-data']['email'] ?? null;
    $createpassword = $_SESSION['register-data']['createpassword'] ?? null;
    $confirmpassword = $_SESSION['register-data']['confirmpassword'] ?? null;

    //deletes registration data session after retrieving it
    unset($_SESSION['register-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Sphere - Register</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <link rel="icon" href="<?= ROOT_URL ?>images/icon.png" type="image/x-icon">
    <style>
    .container {
        width: 100%;
        max-width: 400px;
        margin: 5vh auto;
        padding: 2rem;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 2rem;
    }

    .alert_message {
        padding: 0.8rem;
        margin-bottom: 1rem;
        border-radius: 5px;
        text-align: center;
    }

    .alert_message.error {
        background: rgba(255, 0, 0, 0.1);
        color: red;
        border: 1px solid red;
    }

    .alert_message.success {
        background: rgba(0, 255, 0, 0.1);
        color: green;
        border: 1px solid green;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    input {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }

    input:focus {
        outline: none;
        border-color: #666;
    }

    .form-control {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-control label {
        font-size: 0.9rem;
        color: #666;
    }

    button {
        background: #007bff;
        color: white;
        padding: 0.8rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background 0.3s ease;
    }

    button:hover {
        background: #0056b3;
    }

    .links {
        margin-top: 1rem;
        text-align: center;
    }

    .links p {
        margin: 0.5rem 0;
        color: #666;
    }

    .links a {
        color: #007bff;
        text-decoration: none;
    }

    .links a:hover {
        text-decoration: underline;
    }

    .links span {
        color: red;
        font-weight: bold;
    }

    #errorMessages {
        color: red;
        margin-top: 0.5rem;
        font-size: 0.9rem;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Register</h2>

        <?php
            if (isset($_SESSION['register'])) {
                $message_class = strpos($_SESSION['register'], 'successful') !== false ? 'success' : 'error';
        ?>
        <div class="alert_message <?= $message_class ?>">
            <p><?= $_SESSION['register'] ?></p>
        </div>
        <?php
                unset($_SESSION['register']);
            }
        ?>

        <form id="registerForm" action="<?= ROOT_URL ?>registerLogic.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="fullname" value="<?= htmlspecialchars($fullname) ?>"
                placeholder="Enter your full name" required>

            <input type="email" name="email" value="<?= htmlspecialchars($email) ?>"
                placeholder="Enter your Ashesi email" pattern="[a-z0-9._%+-]+@ashesi\.edu\.gh$"
                title="Please use an Ashesi email address" required>

            <input type="password" name="createpassword" value="<?= htmlspecialchars($createpassword) ?>"
                placeholder="Create password" minlength="8" required>

            <input type="password" name="confirmpassword" value="<?= htmlspecialchars($confirmpassword) ?>"
                placeholder="Confirm password" minlength="8" required>

            <div class="form-control">
                <label for="profile">Profile Picture</label>
                <input type="file" name="profile" id="profile" accept=".jpg,.jpeg,.png" required>
            </div>

            <button type="submit" name="submit">Register</button>
        </form>

        <div class="links">
            <p>Already have an account? <a href="<?= ROOT_URL ?>login.php">Login</a></p>
            <p><span>NB: </span>You can ONLY Register with an Ashesi Email</p>
        </div>
    </div>

    <script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const password = document.querySelector('input[name="createpassword"]').value;
        const confirmPassword = document.querySelector('input[name="confirmpassword"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const errorMessages = document.getElementById('errorMessages');
        let hasError = false;
        errorMessages.innerHTML = '';

        // Password match validation
        if (password !== confirmPassword) {
            e.preventDefault();
            errorMessages.innerHTML += '<p>Passwords do not match!</p>';
            hasError = true;
        }

        // Email domain validation
        if (!email.endsWith('@ashesi.edu.gh')) {
            e.preventDefault();
            errorMessages.innerHTML += '<p>Please use an Ashesi email address!</p>';
            hasError = true;
        }

        // Password length validation
        if (password.length < 8) {
            e.preventDefault();
            errorMessages.innerHTML += '<p>Password must be at least 8 characters long!</p>';
            hasError = true;
        }

        // File validation
        const fileInput = document.querySelector('input[name="profile"]');
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            // Convert to MB
            const fileSize = file.size / 1024 / 1024;
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

            if (!allowedTypes.includes(file.type)) {
                e.preventDefault();
                errorMessages.innerHTML += '<p>Please upload only JPG, JPEG, or PNG files!</p>';
                hasError = true;
            }

            if (fileSize > 1) {
                e.preventDefault();
                errorMessages.innerHTML += '<p>File size should be less than 1MB!</p>';
                hasError = true;
            }
        }

        if (hasError) {
            errorMessages.style.display = 'block';
        }
    });
    </script>
</body>

</html>