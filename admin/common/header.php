<?php

require 'config/database.php';

//fetch current user from database
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT profile FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $profile = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talent Sphere</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/index.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/blog.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/portfolio.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/spotlight.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/addCategory.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/dashboard.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/blogpost.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/createpost.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/createblog.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/profile.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/editprofile.css" />
    <link rel="icon" href="<?= ROOT_URL ?>images/icon.png" type="image/x-icon" />
</head>

<body>
    <div class="landing-section">
        <header>
            <nav class="container">
                <div class="logo">Talent <span>Sphere</span></div>
                <div class="nav-links">
                    <a href="<?= ROOT_URL ?>index.php">Home</a>
                    <a href="<?= ROOT_URL ?>portfolio.php">Portfolios</a>
                    <a href="<?= ROOT_URL ?>blog.php">Blogs</a>
                    <a href="<?= ROOT_URL ?>spotlight.php">Spotlight</a>
                </div>

                <div class="nav-buttons-container">

                    <?php if(isset($_SESSION['user-id'])) : ?>

                    <div class="navprofile">
                        <div class="avatar">
                            <img src="<?= ROOT_URL . 'images/' . $profile['profile'] ?>" />
                        </div>
                        <div class="navprofile-dropdown">
                            <a href="<?= ROOT_URL ?>admin/dashboard.php">Dashboard</a>
                            <a href="<?= ROOT_URL ?>profile.php">Profile</a>
                            <a href="<?= ROOT_URL ?>logout.php">Logout</a>
                        </div>
                    </div>

                    <?php else: ?>

                    <div class="auth-buttons">
                        <button id="login-btn">Login</button>
                    </div>

                    <?php endif; ?>

                </div>
            </nav>
        </header>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the avatar element specifically (the circle) and dropdown
            const avatar = document.querySelector('.navprofile .avatar');
            const dropdown = document.querySelector('.navprofile-dropdown');
            let isDropdownOpen = false;

            // Toggle dropdown when clicking the avatar
            avatar.addEventListener('click', function(e) {
                e.stopPropagation();
                isDropdownOpen = !isDropdownOpen;

                if (isDropdownOpen) {
                    dropdown.classList.add('active');
                } else {
                    dropdown.classList.remove('active');
                }
            });

            // Close dropdown only when clicking outside both the avatar and dropdown
            document.addEventListener('click', function(e) {
                const isClickInsideDropdown = dropdown.contains(e.target);
                const isClickInsideAvatar = avatar.contains(e.target);

                if (!isClickInsideDropdown && !isClickInsideAvatar && isDropdownOpen) {
                    dropdown.classList.remove('active');
                    isDropdownOpen = false;
                }
            });

            // Prevent clicks inside dropdown from closing it
            dropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
        </script>