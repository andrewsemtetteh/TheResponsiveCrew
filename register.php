<?php
require 'config/constants.php';

// Get back form data if there was a registration error
$fullname = $_SESSION['register-data']['fullname'] ?? null;
$email = $_SESSION['register-data']['email'] ?? null;
$createpassword = $_SESSION['register-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['register-data']['confirmpassword'] ?? null;

// Delete signup data session
unset($_SESSION['register-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talent Sphere - Register</title>
    <link rel="icon" href="<?= ROOT_URL ?>images/icon.png" type="image/x-icon" />
    <style>
    .alert_message {
        padding: 10px;
        margin: 10px auto;
        border-radius: 5px;
        width: 80%;
        text-align: center;
    }

    .alert_message p {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .alert_message.error {
        background-color: rgba(255, 0, 0, 0.1);
        color: red;
        border: 1px solid red;
    }

    .alert_message.success {
        background-color: rgba(0, 128, 0, 0.1);
        color: green;
        border: 1px solid green;
    }
    </style>
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/authentication.css" />
</head>

<body>
    <div class="container">
        <h2>Register</h2>

        <?php if (isset($_SESSION['register'])) : ?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['register'];
                    unset($_SESSION['register']);
                    ?>
            </p>
        </div>
        <?php endif; ?>

        <form id="registerForm" action="<?= ROOT_URL ?>registerLogic.php" method="POST" enctype="multipart/form-data">
            <input type="text" id="fullname" name="fullname" value="<?= $fullname ?>"
                placeholder="Enter your full name" />
            <input type="email" id="email" name="email" value="<?= $email ?>" placeholder="Enter your Ashesi email" />
            <input type="password" id="password" name="createpassword" value="<?= $createpassword ?>"
                placeholder="Enter your password" />
            <input type="password" id="passwordConfirm" name="confirmpassword" value="<?= $confirmpassword ?>"
                placeholder="Confirm your password" />
            <div class="form-control">
                <label for="profile">Profile Picture</label>
                <input type="file" id="profilePicture" name="profile" accept="image/*" />
            </div>
            <button type="submit" name="submit">Register</button>
            <div class="error-messages" id="errorMessages"></div>
        </form>
        <div class="links">
            <p>Already have an account? <a href="login.php">Login</a></p>
            <p><span>NB: </span> You can ONLY Register with an Ashesi Email</p>
        </div>
    </div>
</body>

</html>