<?php
    require 'config/constants.php';
?>

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
        <form id="registerForm" action="<?= ROOT_URL ?>registerLogic.php" method="POST" enctype="multipart/form-data">
            <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" />
            <input type="email" id="email" name="email" placeholder="Enter your Ashesi email" />
            <input type="password" id="password" name="createpassword" placeholder="Enter your password" />
            <input type="password" id="passwordConfirm" name="confirmpassword" placeholder="Confirm your password" />
            <div class="form-control">
                <label for="avatar">Profile Picture</label>
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