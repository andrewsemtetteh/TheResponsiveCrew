<?php
require 'common/header.php';

// Check if blog post ID is provided in the URL
if (isset($_GET['id'])) {
    $blog_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // Fetch the specific blog post with full details
    $query = "SELECT b.*, 
                     c.title AS category_title, 
                     u.fullname AS author_name, 
                     u.profile AS author_profile
              FROM blogs b
              JOIN categories c ON b.category_id = c.id
              JOIN users u ON b.author_id = u.id
              WHERE b.id = ?";
    
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $blog_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if blog post exists
    if (mysqli_num_rows($result) > 0) {
        $blog = mysqli_fetch_assoc($result);
?>

<main class="blog-post-container">
    <article class="blog-post">
        <div class="blog-post-header">
            <div class="post-category"><?= htmlspecialchars($blog['category_title']) ?></div>
            <div class="blog-post-meta">
                <div class="blog-post-info">
                    <div class="author-info">
                        <?php 
                        // Use author profile image or default
                        $profile_image = !empty($blog['author_profile']) 
                            ? htmlspecialchars($blog['author_profile'])
                            : 'boy.png'; 
                        ?>
                        <img src="./images/<?= $profile_image ?>" alt="<?= htmlspecialchars($blog['author_name']) ?>"
                            class="author-avatar" />
                        <div class="author-details">
                            <span class="author-name"><?= htmlspecialchars($blog['author_name']) ?></span>
                            <span class="post-date"><?= date("F d, Y", strtotime($blog['date_time'])) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="blog-post-title"><?= htmlspecialchars($blog['title']) ?></h1>
        </div>

        <img src="./images/<?= htmlspecialchars($blog['thumbnail']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>"
            class="featured-image" />

        <div class="blog-content">
            <p class="description">
                <?= htmlspecialchars($blog['summary']) ?>
            </p>

            <p class="content">
                <?= nl2br(htmlspecialchars($blog['content'])) ?>
            </p>
        </div>
    </article>

    <section class="comments-section">
        <h2 class="comments-title">Comments (2)</h2>

        <div class="comment-form">
            <form class="comment-input-form">
                <textarea placeholder="Add a comment..." rows="3"></textarea>
                <button type="submit" class="comment-submit">Post Comment</button>
            </form>
        </div>

        <div class="comments-list">
            <div class="comment">
                <img src="./images/girl.png" alt="Commenter" class="comment-avatar" />
                <div class="comment-content">
                    <div class="comment-header">
                        <h4 class="commenter-name">Griselda Owusu-Ansah</h4>
                        <span class="comment-date">2 days ago</span>
                    </div>
                    <p class="comment-text">
                        This is such an insightful article! I particularly enjoyed the
                        section about finding your voice. It resonates with my own
                        creative journey.
                    </p>
                    <button class="reply-btn">Reply</button>
                </div>
            </div>

            <div class="comment">
                <img src="./images/boy.png" alt="Commenter" class="comment-avatar" />
                <div class="comment-content">
                    <div class="comment-header">
                        <h4 class="commenter-name">Princess Cheryl</h4>
                        <span class="comment-date">1 day ago</span>
                    </div>
                    <p class="comment-text">
                        Great perspective on creative expression! Would love to see a
                        follow-up article about specific techniques and exercises.
                    </p>
                    <button class="reply-btn">Reply</button>
                </div>
            </div>
        </div>
    </section>
</main>

<?php 
    } else {
        // Blog post not found
        echo "<main class='container'><p>Blog post not found.</p></main>";
    }
} else {
    // No blog post ID provided
    echo "<main class='container'><p>No blog post specified.</p></main>";
}

include 'common/footer.php';
?>