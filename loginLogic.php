<?php
require 'config/database.php';

if (!isset($_POST['submit'])) {
    header('location: ' . ROOT_URL . 'login.php');
    die();
}

// Get form data
$email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Save form data in session for redirection
$_SESSION['login-data'] = [
    'email' => $email
];

if (!$email) {
    $_SESSION['login'] = 'Ashesi email required';
} elseif (!$password) {
    $_SESSION['login'] = 'Password required';
} else {
    // Fetch user from database
    $fetch_user_query = "SELECT * FROM users WHERE email='$email'";
    $fetch_user_result = mysqli_query($connection, $fetch_user_query);

    if (mysqli_num_rows($fetch_user_result) == 1) {
        $user_record = mysqli_fetch_assoc($fetch_user_result);
        $db_password = $user_record['password'];

        // Compare form password with database password
        if (password_verify($password, $db_password)) {
            // Set session for access control
            $_SESSION['user-id'] = $user_record['id'];

            // Set session if user is admin
            if ($user_record['is_admin'] == 1) {
                $_SESSION['user_is_admin'] = true;
                header('location: ' . ROOT_URL . 'admin/dashboard.php');
            } else {
                // Regular users also go to admin dashboard
                header('location: ' . ROOT_URL . 'admin/dashboard.php');
            }
            
            // Clear login data session
            unset($_SESSION['login-data']);
            die();
        } else {
            $_SESSION['login'] = 'Please check your input details';
        }
    } else {
        $_SESSION['login'] = 'User not found';
    }
}

// If any problem, redirect to login page
if (isset($_SESSION['login'])) {
    header('location: ' . ROOT_URL . 'login.php');
    die();
}
?>