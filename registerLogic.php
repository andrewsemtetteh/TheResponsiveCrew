<?php
session_start();
require 'config/database.php';

if (!isset($_POST['submit'])) {
    header('location: ' . ROOT_URL . 'register.php');
    die();
}

// Sanitize and validate input data
$fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$createpassword = $_POST['createpassword'];
$confirmpassword = $_POST['confirmpassword'];
$profile = $_FILES['profile'] ?? null;

// Store form data in case of validation errors
$_SESSION['register-data'] = $_POST;

// Validation checks
if (empty($fullname)) {
    $_SESSION['register'] = 'Please enter your full name';
} elseif (!$email) {
    $_SESSION['register'] = 'Please enter a valid email';
} elseif (substr(strrchr($email, "@"), 1) !== 'ashesi.edu.gh') {
    $_SESSION['register'] = 'Please use an Ashesi email address';
} elseif (strlen($createpassword) < 8) {
    $_SESSION['register'] = 'Password should be at least 8 characters';
} elseif ($createpassword !== $confirmpassword) {
    $_SESSION['register'] = 'Passwords do not match';
} elseif (!$profile['name']) {
    $_SESSION['register'] = 'Please add a profile picture';
} else {
    // Hash the password
    $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

    // Check if email already exists
    $user_check_query = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_prepare($connection, $user_check_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $user_check_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($user_check_result) > 0) {
        $_SESSION['register'] = "Email already exists";
    } else {
        // Work on profile picture
        $time = time();
        $profile_name = $time . $profile['name'];
        $profile_tmp_name = $profile['tmp_name'];
        $profile_destination_path = 'images/' . $profile_name;

        // Make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $profile_name);
        $extension = strtolower(end($extension));

        if (in_array($extension, $allowed_files)) {
            // Make sure file size is not more than 1mb
            if ($profile['size'] < 1000000) {
                // Upload profile picture
                $upload_result = move_uploaded_file($profile_tmp_name, $profile_destination_path);

                if ($upload_result) {
                    // Insert new user into users table
                    $insert_user_query = "INSERT INTO users (fullname, email, password, profile, is_admin) VALUES (?, ?, ?, ?, 0)";
                    $stmt = mysqli_prepare($connection, $insert_user_query);
                    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $hashed_password, $profile_name);
                    
                    if (mysqli_stmt_execute($stmt)) {
                        // Clear session data and redirect to login
                        unset($_SESSION['register-data']);
                        $_SESSION['register-success'] = "Registration successful. Please log in";
                        header('location: ' . ROOT_URL . 'login.php');
                        die();
                    } else {
                        $_SESSION['register'] = "Database error occurred. Please try again.";
                    }
                } else {
                    $_SESSION['register'] = "Failed to upload profile picture. Please try again.";
                }
            } else {
                $_SESSION['register'] = 'File size too big. Should be less than 1mb';
            }
        } else {
            $_SESSION['register'] = 'File should be png, jpg, or jpeg';
        }
    }
}

// If any error occurred, redirect back to register page
if (isset($_SESSION['register'])) {
    header('location: ' . ROOT_URL . 'register.php');
    die();
}