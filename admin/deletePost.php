<?php
require '../config/database.php';

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // First, fetch the post details to verify ownership and get media filename
    $query = "SELECT media, author_id FROM posts WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $post = mysqli_fetch_assoc($result);

    // Check if post exists and belongs to current user
    if (!$post || $post['author_id'] != $_SESSION['user-id']) {
        $_SESSION['post-error'] = "Unauthorized deletion or post not found";
        header('location: ' . ROOT_URL . 'admin/dashboard.php');
        die();
    }

    // Delete media file if it exists
    if ($post['media']) {
        $file_path = '../uploads/' . $post['media'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Delete post from database
    $delete_query = "DELETE FROM posts WHERE id = ?";
    $delete_stmt = mysqli_prepare($connection, $delete_query);
    mysqli_stmt_bind_param($delete_stmt, "i", $id);

    if (mysqli_stmt_execute($delete_stmt)) {
        $_SESSION['post-success'] = "Spotlight post deleted successfully";
    } else {
        $_SESSION['post-error'] = "Failed to delete spotlight post";
    }
} else {
    $_SESSION['post-error'] = "No post ID provided";
}

header('location: ' . ROOT_URL . 'admin/dashboard.php');
die();
?>