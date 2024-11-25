<?php
require 'config/database.php';
session_start();

if (isset($_POST['submit'])) {  
    // get form data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($email)) {
        $_SESSION['login'] = "Email required";
    } elseif (empty($password)) {
        $_SESSION['login'] = "Password required";
    } else {
        // Verify if it's an Ashesi email
        if (!preg_match('/@ashesi\.edu\.gh$/', $email)) {
            $_SESSION['login'] = "Please use an Ashesi email address";
        } else {
            // fetch user from database using prepared statement
            $fetch_user_query = "SELECT * FROM users WHERE email=?";
            $stmt = mysqli_prepare($connection, $fetch_user_query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                // convert the record into associative array
                $user_record = mysqli_fetch_assoc($result);
                $db_password = $user_record['password'];

                // compare form password with database password
                if (password_verify($password, $db_password)) {
                    // set session for access control
                    $_SESSION['user-id'] = $user_record['id'];
                    // set session if user is admin
                    if ($user_record['is_admin'] == 1) {
                        $_SESSION['user_is_admin'] = true;
                    }
                    
                    // log user in
                    header('location: ' . ROOT_URL . 'admin/dashboard.php');
                    exit();
                } else {
                    $_SESSION['login'] = "Password is incorrect";
                }
            } else {
                $_SESSION['login'] = "User not found";
            }
        }
    }

    // if any problem, redirect back to signin page with login details
    if (isset($_SESSION['login'])) {
        $_SESSION['login-data'] = $_POST;
        header('location: ' . ROOT_URL . 'login.php');
        exit();
    }
} else {
    header('location: ' . ROOT_URL . 'login.php');
    exit();
}
?>