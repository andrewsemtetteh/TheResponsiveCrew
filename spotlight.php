<?php
require 'common/header.php';

// Ensure database connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch all posts from the database with user information
$query = "SELECT p.*, u.fullname, u.profile
          FROM posts p
          LEFT JOIN users u ON p.author_id = u.id
          ORDER BY p.date_time DESC";

$result = mysqli_query($connection, $query);

// Check if query was successful
if (!$result) {
    // Log the error (in a production environment, log to a file)
    error_log("Spotlight query error: " . mysqli_error($connection));
    die("Failed to retrieve spotlight posts. Please try again later.");
}
?>

<main class="container spotlight-container">
    <section class="filter-section">
        <div class="search-container">
            <i class='bx bx-search'></i>
            <input type="text" placeholder="Search works..." id="search-input" />
        </div>
    </section>

    <div class="gallery-grid" id="gallery-grid">
        <?php 
        // Check if there are any posts
        if (mysqli_num_rows($result) > 0) {
            // Loop through the posts
            while ($post = mysqli_fetch_assoc($result)) : 
                // Determine if the media is a video
                $media_path = ROOT_URL . 'uploads/' . $post['media'];
                $is_video = in_array(
                    strtolower(pathinfo($post['media'], PATHINFO_EXTENSION)), 
                    ['mp4', 'avi', 'mov', 'wmv']
                );

                // Fallback for missing media or author info
                $author_name = !empty($post['fullname']) 
                    ? htmlspecialchars($post['fullname']) 
                    : 'Unknown Author';
                
                // Fallback for profile image in images folder
                $avatar_path = !empty($post['profile']) 
                    ? ROOT_URL . 'images/' . $post['profile'] 
                    : ROOT_URL . 'images/boy.png';
        ?>
        <div class="gallery-item" data-type="<?= $is_video ? 'video' : 'image' ?>">
            <div class="media-container">
                <?php if ($is_video): ?>
                <video controls>
                    <source src="<?= $media_path ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="play-overlay">
                    <i class="bx bx-play-circle"></i>
                </div>
                <?php else: ?>
                <img src="<?= $media_path ?>" alt="<?= htmlspecialchars($post['title']) ?>" />
                <?php endif; ?>
            </div>

            <div class="gallery-item-info">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p><?= htmlspecialchars($post['description']) ?></p>
                <div class="creator-info">
                    <img src="<?= $avatar_path ?>" alt="<?= $author_name ?> profile" class="creator-avatar" />
                    <span><?= $author_name ?></span>
                </div>
                <!-- Add View button with post ID -->
                <div class="post-actions">
                    <a href="<?= ROOT_URL ?>spotlightpost.php?id=<?= $post['id'] ?>" class="read-more">Read More</a>
                </div>
            </div>
        </div>
        <?php 
            endwhile; 
        } else {
            // Display a message if no posts are found
            echo '<div class="no-posts-message">';
            echo '<p>No spotlight posts yet. <a href="' . ROOT_URL . 'admin/createpost.php">Create your first post</a>.</p>';
            echo '</div>';
        }
        ?>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const galleryItems = document.querySelectorAll('.gallery-item');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                galleryItems.forEach(item => {
                    const title = item.querySelector('h3').textContent.toLowerCase();
                    const description = item.querySelector('p').textContent.toLowerCase();

                    if (title.includes(searchTerm) || description.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });

            });
</script>

<?php
require 'common/footer.php';
?>