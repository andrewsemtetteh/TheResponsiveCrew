<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    // Get form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // First, verify the post exists and belongs to the current user
    $check_query = "SELECT media, author_id FROM posts WHERE id = ?";
    $check_stmt = mysqli_prepare($connection, $check_query);
    mysqli_stmt_bind_param($check_stmt, "i", $id);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);
    $post = mysqli_fetch_assoc($check_result);

    if (!$post || $post['author_id'] != $_SESSION['user-id']) {
        $_SESSION['post-error'] = "Unauthorized edit or post not found";
        header('location: ' . ROOT_URL . 'admin/dashboard.php');
        die();
    }

    // Validate input
    if (!$title || !$description) {
        $_SESSION['post-error'] = "Title and description are required";
        header('location: ' . ROOT_URL . 'admin/editPost.php?id=' . $id);
        die();
    }

    // Check if new media is uploaded
    $media_name = $post['media'];
    $media_to_upload = false;

    if (isset($_FILES['media']) && $_FILES['media']['name']) {
        $media = $_FILES['media'];
        $media_to_upload = true;

        // Define allowed file types (same as in createpostLogic.php)
        $allowed_files = [
            'png', 'jpg', 'jpeg', 'gif', 
            'mp4', 'avi', 'mov', 'wmv', 
            'mp3', 'wav', 'ogg', 
            'pdf', 'doc', 'docx'
        ];

        // Get file extension
        $extension = strtolower(pathinfo($media['name'], PATHINFO_EXTENSION));

        // Validate file type
        if (!in_array($extension, $allowed_files)) {
            $_SESSION['post-error'] = "Invalid file type. Allowed types: " . implode(', ', $allowed_files);
            header('location: ' . ROOT_URL . 'admin/editPost.php?id=' . $id);
            die();
        }

        // Validate file size (max 50MB)
        if ($media['size'] > 50000000) {
            $_SESSION['post-error'] = "File size too big. Should be less than 50MB";
            header('location: ' . ROOT_URL . 'admin/editPost.php?id=' . $id);
            die();
        }

        // Generate new filename
        $time = time(); 
        $media_name = $time . $media['name'];
        $media_tmp_name = $media['tmp_name'];
        $media_destination_path = '../uploads/' . $media_name;

        // Upload new media
        if (!move_uploaded_file($media_tmp_name, $media_destination_path)) {
            $_SESSION['post-error'] = "Failed to upload media";
            header('location: ' . ROOT_URL . 'admin/editPost.php?id=' . $id);
            die();
        }

        // Delete old media file if it exists and it's not the same as the new one
        if ($media_name !== $post['media']) {
            $old_file_path = '../uploads/' . $post['media'];
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }
        }
    }

    // Update post in database
    $query = "UPDATE posts SET title = ?, description = ?, media = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $media_name, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['post-success'] = "Spotlight post updated successfully";
        header('location: ' . ROOT_URL . 'admin/dashboard.php');
        die();
    } else {
        $_SESSION['post-error'] = "Failed to update spotlight post: " . mysqli_error($connection);
        header('location: ' . ROOT_URL . 'admin/editPost.php?id=' . $id);
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'admin/dashboard.php');
    die();
}
?>