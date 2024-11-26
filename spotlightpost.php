<?php
require 'common/header.php';

// Check if post ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to spotlight page if no ID is provided
    header('location: ' . ROOT_URL . 'spotlight.php');
    die();
}

// Sanitize the post ID
$post_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

// Fetch the specific post with user information
$query = "SELECT p.*, u.fullname, u.profile, u.id AS user_id
          FROM posts p
          LEFT JOIN users u ON p.author_id = u.id
          WHERE p.id = ?";

// Prepare and execute the statement
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $post_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if post exists
if (mysqli_num_rows($result) == 0) {
    // Redirect if post not found
    header('location: ' . ROOT_URL . 'spotlight.php');
    die();
}

// Fetch post details
$post = mysqli_fetch_assoc($result);

// Determine media type
$media_path = ROOT_URL . 'uploads/' . $post['media'];
$is_video = in_array(
    strtolower(pathinfo($post['media'], PATHINFO_EXTENSION)), 
    ['mp4', 'avi', 'mov', 'wmv']
);

// Fallback for missing author info
$author_name = !empty($post['fullname']) 
    ? htmlspecialchars($post['fullname']) 
    : 'Unknown Author';

// Fallback for profile image
$avatar_path = !empty($post['profile']) 
    ? ROOT_URL . 'images/' . $post['profile'] 
    : ROOT_URL . 'images/boy.png';

// Calculate time since post
$post_time = strtotime($post['date_time']);
$current_time = time();
$time_diff = $current_time - $post_time;

// Convert time difference to readable format
if ($time_diff < 60) {
    $time_ago = $time_diff . " seconds ago";
} elseif ($time_diff < 3600) {
    $minutes = floor($time_diff / 60);
    $time_ago = $minutes . ($minutes == 1 ? " minute ago" : " minutes ago");
} elseif ($time_diff < 86400) {
    $hours = floor($time_diff / 3600);
    $time_ago = $hours . ($hours == 1 ? " hour ago" : " hours ago");
} else {
    $days = floor($time_diff / 86400);
    $time_ago = $days . ($days == 1 ? " day ago" : " days ago");
}
?>

<main class="container spotlightpost-container">
    <section class="post-wrapper">
        <div class="post-header">
            <div class="header-top">
                <div class="creator-info">
                    <img src="<?= $avatar_path ?>" alt="<?= $author_name ?>" class="creator-avatar" />
                    <div class="creator-details">
                        <span class="creator-name"><?= $author_name ?></span>
                        <span class="post-time"><?= $time_ago ?></span>
                    </div>
                </div>
                <h1 id="post-title"><?= htmlspecialchars($post['title']) ?></h1>
            </div>
        </div>
        <div class="media-container">
            <?php if ($is_video): ?>
            <video controls>
                <source src="<?= $media_path ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <?php else: ?>
            <img src="<?= $media_path ?>" alt="<?= htmlspecialchars($post['title']) ?>" />
            <?php endif; ?>
        </div>
        <div class="post-details">
            <p id="post-description"><?= htmlspecialchars($post['description']) ?></p>
        </div>
    </section>
</main>

<?php
require 'common/footer.php';
?>