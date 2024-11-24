<?php
require 'config/database.php';

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
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/portfolio.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/spotlight.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/blog.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/blogpost.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/profile.css" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/spotlightpost.css" />
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
                    <div class="auth-buttons">
                        <button id="login-btn">Login</button>
                    </div>
                    <!-- <div class="navprofile">
                        <div class="avatar">
                            <img src="/images/girl.png" alt="profile" />
                        </div>
                        <div class="navprofile-dropdown">
                            <a href="<?= ROOT_URL ?>admin/dashboard.php">Dashboard</a>
                            <a href="<?= ROOT_URL ?>profile.php">Profile</a>
                            <a href="<?= ROOT_URL ?>logout.php">Logout</a>
                        </div>
                    </div> -->
                </div>
            </nav>
        </header>

        <script>
        document.querySelector("#login-btn").addEventListener("click", function() {
            window.location.href = "<?= ROOT_URL ?>login.php";
        });
        </script>