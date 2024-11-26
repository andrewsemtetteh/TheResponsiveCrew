<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    // Get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $summary = filter_var($_POST['summary'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
    $author_id = $_SESSION['user-id'];
    $thumbnail = $_FILES['thumbnail'];

    // Validate input
    if (!$title || !$summary || !$content || !$category_id || !$thumbnail['name']) {
        $_SESSION['blog-error'] = "All fields are required";
        header('location: ' . ROOT_URL . 'admin/createblog.php');
        die();
    }

    // Work on thumbnail
    $time = time(); // Make thumbnail name unique
    $thumbnail_name = $time . $thumbnail['name'];
    $thumbnail_tmp_name = $thumbnail['tmp_name'];
    $thumbnail_destination_path = '../images/' . $thumbnail_name;

    // Make sure file is an image
    $allowed_files = ['png', 'jpg', 'jpeg'];
    $extension = explode('.', $thumbnail_name);
    $extension = end($extension);

    if (!in_array(strtolower($extension), $allowed_files)) {
        $_SESSION['blog-error'] = "File should be png, jpg, or jpeg";
        header('location: ' . ROOT_URL . 'admin/createblog.php');
        die();
    }

    // Make sure image is not too large (4mb+)
    if ($thumbnail['size'] > 4000000) {
        $_SESSION['blog-error'] = "File size too big. Should be less than 4mb";
        header('location: ' . ROOT_URL . 'admin/createblog.php');
        die();
    }

    // Upload thumbnail
    if (!move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path)) {
        $_SESSION['blog-error'] = "Failed to upload image";
        header('location: ' . ROOT_URL . 'admin/createblog.php');
        die();
    }

    // Insert blog into database
    $query = "INSERT INTO blogs (title, summary, content, thumbnail, category_id, author_id) 
              VALUES (?, ?, ?, ?, ?, ?)";
              
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssii", $title, $summary, $content, $thumbnail_name, $category_id, $author_id);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['blog-success'] = "Blog post created successfully";
            header('location: ' . ROOT_URL . 'admin/manageblog.php');
            die();
        } else {
            $_SESSION['blog-error'] = "Failed to create blog post: " . mysqli_error($connection);
            header('location: ' . ROOT_URL . 'admin/createblog.php');
            die();
        }
    } else {
        $_SESSION['blog-error'] = "Database error: " . mysqli_error($connection);
        header('location: ' . ROOT_URL . 'admin/createblog.php');
        die();
    }

} else {
    header('location: ' . ROOT_URL . 'admin/createblog.php');
    die();
}
?>