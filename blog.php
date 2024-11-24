<?php
require 'config/database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talent Sphere - Blog</title>
    <link rel="stylesheet" href="./styles.css" />
    <link rel="stylesheet" href="./styles/blog.css" />
    <link rel="icon" href="./images/icon.png" type="image/x-icon" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
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
                    <div class="navprofile">
                        <div class="avatar">
                            <img src="/images/girl.png" alt="profile" />
                        </div>
                        <div class="navprofile-dropdown">
                            <a href="<?= ROOT_URL ?>admin/dashboard.php">Dashboard</a>
                            <a href="<?= ROOT_URL ?>profile.php"></a>
                            <a href="<?= ROOT_URL ?>logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="search-container">
            <i class='bx bx-search'></i>
            <input type="text" placeholder="Search blog posts..." />
        </div>

        <main class="container blog-container">
            <div class="filter-container">
                <div class="filter-section">
                    <div class="blog-categories">
                        <button class="category-btn active" data-category="all">
                            All Posts
                        </button>
                        <button class="category-btn" data-category="creative-writing">
                            Creative Writing
                        </button>
                        <button class="category-btn" data-category="reflections">
                            Reflections
                        </button>
                        <button class="category-btn" data-category="art-stories">
                            Art Stories
                        </button>
                        <button class="category-btn" data-category="tutorials">
                            Tutorials
                        </button>
                    </div>
                </div>
            </div>

            <div class="blog-feed">
                <article class="blog-post">
                    <div class="post-image">
                        <img src="/images/africanfood.jpg" alt="Blog Post" />
                    </div>
                    <div class="post-content">
                        <div class="post-header">
                            <div class="post-category">Creative Writing</div>
                        </div>
                        <h2 class="post-title">The Art of Creative Expression</h2>
                        <div class="post-meta">
                            <div class="author-info">
                                <img src="/images/boy.png" alt="Author" class="author-avatar" />
                                <span class="author-name">Andrew Sem Tetteh</span>
                            </div>
                            <span class="post-date">March 15, 2024</span>
                        </div>
                        <p class="post-excerpt">
                            Exploring the boundless possibilities of creative expression
                            through various mediums and perspectives. Discover how different
                            artists interpret and convey their unique visions...
                        </p>
                        <a href="/pages/blogpost.html" class="read-more">Read More</a>
                    </div>
                </article>

                <article class="blog-post">
                    <div class="post-image">
                        <img src="/images/beats.jpg" alt="Blog Post" />
                    </div>
                    <div class="post-content">
                        <div class="post-header">
                            <div class="post-category">Art Stories</div>
                        </div>
                        <h2 class="post-title">Journey Through Colors</h2>
                        <div class="post-meta">
                            <div class="author-info">
                                <img src="/images/girl.png" alt="Author" class="author-avatar" />
                                <span class="author-name">Princess Cheryl</span>
                            </div>
                            <span class="post-date">March 14, 2024</span>
                        </div>
                        <p class="post-excerpt">
                            A personal narrative about finding inspiration in everyday colors
                            and translating them into art. Experience the transformation of
                            ordinary moments into extraordinary creations...
                        </p>
                        <a href="/pages/blogpost.html" class="read-more">Read More</a>
                    </div>
                </article>

                <article class="blog-post">
                    <div class="post-image">
                        <img src="/images/background.jpg" alt="Blog Post" />
                    </div>
                    <div class="post-content">
                        <div class="post-header">
                            <div class="post-category">Tutorials</div>
                        </div>
                        <h2 class="post-title">Mastering Digital Art Techniques</h2>
                        <div class="post-meta">
                            <div class="author-info">
                                <img src="/images/boy.png" alt="Author" class="author-avatar" />
                                <span class="author-name">Griselda Owusu-Ansah<span>
                            </div>
                            <span class="post-date">March 10, 2024</span>
                        </div>
                        <p class="post-excerpt">
                            A comprehensive guide to advanced digital art techniques, tools,
                            and creative strategies for aspiring digital artists...
                        </p>
                        <a href="/pages/blogpost.html" class="read-more">Read More</a>
                    </div>
                </article>
            </div>
        </main>

        <script src="/scripts/script.js"></script>
</body>

</html>

<?php
include 'common/footer.php'

?>