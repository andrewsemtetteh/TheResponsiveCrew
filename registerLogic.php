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

// Initialize session data for potential error redirect
$_SESSION['register-data'] = [
    'fullname' => $fullname,
    'email' => $email,
    'createpassword' => $createpassword,
    'confirmpassword' => $confirmpassword
];

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
} elseif (!$profile || !$profile['name']) {
    $_SESSION['register'] = 'Please add a profile picture';
} else {
    // Check if email already exists
    $stmt = mysqli_prepare($connection, "SELECT email FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['register'] = "Email already exists!";
    } else {
        // Process profile picture
        $allowed_extensions = ['png', 'jpg', 'jpeg'];
        $time = time();
        $profile_name = $time . basename($profile['name']);
        $profile_tmp_name = $profile['tmp_name'];
        $profile_destination_path = 'images/' . $profile_name;
        $profile_extension = strtolower(pathinfo($profile_name, PATHINFO_EXTENSION));

        if (!in_array($profile_extension, $allowed_extensions)) {
            $_SESSION['register'] = "File should be png, jpg, or jpeg";
        } elseif ($profile['size'] > 1000000) {
            $_SESSION['register'] = "File size too big. Should be less than 1mb";
        } else {
            // Create images directory if it doesn't exist
            if (!is_dir('images')) {
                mkdir('images', 0777, true);
            }

            // Upload profile picture
            if (move_uploaded_file($profile_tmp_name, $profile_destination_path)) {
                // Hash password
                $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

                // Insert new user
                $stmt = mysqli_prepare($connection, 
                    "INSERT INTO users (fullname, email, password, profile, is_admin) VALUES (?, ?, ?, ?, 0)"
                );
                mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $hashed_password, $profile_name);
                
                if (mysqli_stmt_execute($stmt)) {
                    unset($_SESSION['register-data']);
                    $_SESSION['register-success'] = "Registration successful. Please log in";
                    header('location: ' . ROOT_URL . 'login.php');
                    die();
                } else {
                    if (file_exists($profile_destination_path)) {
                        unlink($profile_destination_path);
                    }
                    $_SESSION['register'] = "Registration failed. Please try again";
                }
            } else {
                $_SESSION['register'] = "Failed to upload profile picture";
            }
        }
    }
}

// If any error occurred, redirect back to register page
if (isset($_SESSION['register'])) {
    header('location: ' . ROOT_URL . 'register.php');
    die();
}