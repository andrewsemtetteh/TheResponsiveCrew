<?php
session_start();
require 'config/constants.php';

// Get back form data if there was a login error
$email = $_SESSION['login-data']['email'] ?? null;

// Delete login data session
unset($_SESSION['login-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talent Sphere - Login</title>
    <link rel="icon" href="./images/icon.png" type="image/x-icon" />
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
    <link rel="stylesheet" href="./styles/authentication.css" />
</head>

<body>
    <div class="container">
        <h2>Login</h2>

        <?php
            // Show registration success message if it exists
            if (isset($_SESSION['login-success'])) {
        ?>
        <div class="alert_message success">
            <p><?= $_SESSION['login-success'] ?></p>
        </div>
        <?php
                unset($_SESSION['login-success']);
            }

            // Show login error message if it exists
            if (isset($_SESSION['login'])) {
                $message_class = strpos($_SESSION['login'], 'successful') !== false ? 'success' : 'error';
        ?>
        <div class="alert_message <?= $message_class ?>">
            <p><?= $_SESSION['login'] ?></p>
        </div>
        <?php
                unset($_SESSION['login']);
            }
        ?>

        <form id="loginForm" action="<?= ROOT_URL ?>loginLogic.php" method="POST">
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>"
                placeholder="Enter your Ashesi email" />
            <input type="password" id="password" name="password" placeholder="Enter your password" />
            <button type="submit" name="submit">Login</button>
            <div class="error-messages" id="errorMessages"></div>
        </form>
        <div class="links">
            <p>Don't have an account? <a href="register.php">Register</a></p>
            <p><span>NB: </span> You can ONLY Login with an Ashesi Email</p>
        </div>
    </div>
</body>

</html>