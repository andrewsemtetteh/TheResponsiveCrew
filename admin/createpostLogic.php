<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    // Get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $author_id = $_SESSION['user-id'];
    $media = $_FILES['media'];

    // Validate input
    if (!$title || !$description || !$media['name']) {
        $_SESSION['post-error'] = "All fields are required";
        header('location: ' . ROOT_URL . 'admin/createpost.php');
        die();
    }

    // Work on media upload
    $time = time(); 
    $media_name = $time . $media['name'];
    $media_tmp_name = $media['tmp_name'];
    $media_destination_path = '../uploads/' . $media_name;

    // Define allowed file types
    $allowed_files = [
        // Images
        'png', 'jpg', 'jpeg', 'gif', 
        // Videos
        'mp4', 'avi', 'mov', 'wmv', 
        // Audio
        'mp3', 'wav', 'ogg', 
        // Documents
        'pdf', 'doc', 'docx'
    ];

    // Get file extension
    $extension = strtolower(pathinfo($media['name'], PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($extension, $allowed_files)) {
        $_SESSION['post-error'] = "Invalid file type. Allowed types: " . implode(', ', $allowed_files);
        header('location: ' . ROOT_URL . 'admin/createpost.php');
        die();
    }

    // Validate file size (max 50MB)
    if ($media['size'] > 50000000) {
        $_SESSION['post-error'] = "File size too big. Should be less than 50MB";
        header('location: ' . ROOT_URL . 'admin/createpost.php');
        die();
    }

    // Upload media
    if (!move_uploaded_file($media_tmp_name, $media_destination_path)) {
        $_SESSION['post-error'] = "Failed to upload media";
        header('location: ' . ROOT_URL . 'admin/createpost.php');
        die();
    }

    // Get current date and time
    $date_time = date('Y-m-d H:i:s');

    // Insert post into database
    $query = "INSERT INTO posts (title, description, media, date_time, author_id) 
              VALUES (?, ?, ?, ?, ?)";
              
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $title, $description, $media_name, $date_time, $author_id);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['post-success'] = "Spotlight post created successfully";
            header('location: ' . ROOT_URL . 'admin/dashboard.php');
            die();
        } else {
            $_SESSION['post-error'] = "Failed to create spotlight post: " . mysqli_error($connection);
            header('location: ' . ROOT_URL . 'admin/createpost.php');
            die();
        }
    } else {
        $_SESSION['post-error'] = "Database error: " . mysqli_error($connection);
        header('location: ' . ROOT_URL . 'admin/createpost.php');
        die();
    }

} else {
    header('location: ' . ROOT_URL . 'admin/createpost.php');
    die();
}
?>