<?php
require 'common/header.php';

// Fetch posts from the blogs table with user profile image
$query = "SELECT b.*, 
                 c.title AS category_title, 
                 u.fullname AS author_name, 
                 u.profile AS author_profile
          FROM blogs b
          JOIN categories c ON b.category_id = c.id
          JOIN users u ON b.author_id = u.id
          ORDER BY b.date_time DESC";
$result = mysqli_query($connection, $query);
?>

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
            </div>
        </div>
    </div>

    <div class="blog-feed">
        <?php 
        // Check if there are any blogs
        if (mysqli_num_rows($result) > 0) {
            // Loop through the blogs
            while($blog = mysqli_fetch_assoc($result)) : 
        ?>
        <article class="blog-post">
            <div class="post-image">
                <img src="./images/<?= htmlspecialchars($blog['thumbnail']) ?>"
                    alt="<?= htmlspecialchars($blog['title']) ?>" />
            </div>
            <div class="post-content">
                <div class="post-header">
                    <div class="post-category"><?= htmlspecialchars($blog['category_title']) ?></div>
                </div>
                <h2 class="post-title"><?= htmlspecialchars($blog['title']) ?></h2>
                <div class="post-meta">
                    <div class="author-info">
                        <?php 
                            // Check if profile image exists, otherwise use default
                            $profile_image = !empty($blog['author_profile']) 
                                ? htmlspecialchars($blog['author_profile'])
                                : 'boy.png'; 
                            ?>
                        <img src="./images/<?= $profile_image ?>" alt="<?= htmlspecialchars($blog['author_name']) ?>"
                            class="author-avatar" />
                        <span class="author-name"><?= htmlspecialchars($blog['author_name']) ?></span>
                    </div>
                    <span class="post-date"><?= date("M d, Y - H:i", strtotime($blog['date_time'])) ?></span>
                </div>
                <p class="post-excerpt">
                    <?= htmlspecialchars($blog['summary']) ?>
                </p>
                <a href="<?= ROOT_URL ?>blogpost.php?id=<?= $blog['id'] ?>" class="read-more">Read More</a>
            </div>
        </article>
        <?php 
            endwhile; 
        } else {
            // Display a message if no blogs are found
            echo "<p>No blog posts found.</p>";
        }
        ?>
    </div>
</main>

<?php
include 'common/footer.php';
?>