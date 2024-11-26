<?php
require 'config/database.php';

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $blog_id = filter_var($_POST['blog_id'], FILTER_VALIDATE_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $category_id = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);
    $summary = filter_var($_POST['summary'], FILTER_SANITIZE_STRING);
    $content = $_POST['content']; 

    // Validate required fields
    $errors = [];
    if (empty($title)) $errors[] = "Blog title is required";
    if (empty($category_id)) $errors[] = "Please select a category";
    if (empty($summary)) $errors[] = "Blog summary is required";
    if (empty($content)) $errors[] = "Blog content is required";

    // Handle thumbnail upload
    $thumbnail = null;
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnail_name = $_FILES['thumbnail']['name'];
        $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_destination_path = '../images' . $thumbnail_name;

        // File type validation
        $allowed_types = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
        $file_type = $_FILES['thumbnail']['type'];
        
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Invalid file type. Only PNG, JPEG, JPG, and GIF are allowed.";
        }

        // File size validation (5MB max)
        $max_file_size = 5 * 1024 * 1024; // 5MB
        if ($_FILES['thumbnail']['size'] > $max_file_size) {
            $errors[] = "File size should be less than 5MB.";
        }
    }

    // If there are no errors, proceed with update
    if (empty($errors)) {
        // Prepare update query
        $query = "UPDATE blogs SET title = ?, category_id = ?, summary = ?, content = ?";
        $params = [$title, $category_id, $summary, $content];
        $param_types = "siss";

        // Handle thumbnail update if a new image is uploaded
        if (!empty($_FILES['thumbnail']['name'])) {
            // Move uploaded file
            if (move_uploaded_file($thumbnail_tmp, $thumbnail_destination_path)) {
                $query .= ", thumbnail = ?";
                $params[] = $thumbnail_destination_path;
                $param_types .= "s";
            } else {
                $_SESSION['blog-error'] = "Failed to upload thumbnail.";
                header('Location: ' . ROOT_URL . 'admin/editblog.php?id=' . $blog_id);
                exit();
            }
        }

        $query .= " WHERE id = ?";
        $params[] = $blog_id;
        $param_types .= "i";

        // Prepare and execute the statement
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, $param_types, ...$params);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success-message'] = "Blog updated successfully!";
            header('Location: ' . ROOT_URL . 'admin/manageblog.php');
            exit();
        } else {
            $_SESSION['blog-error'] = "Failed to update blog: " . mysqli_error($connection);
            header('Location: ' . ROOT_URL . 'admin/editblog.php?id=' . $blog_id);
            exit();
        }
    } else {
        // Store errors in session
        $_SESSION['blog-error'] = implode('<br>', $errors);
        header('Location: ' . ROOT_URL . 'admin/editblog.php?id=' . $blog_id);
        exit();
    }
} else {
    // If submit not set, redirect to manage blog
    header('Location: ' . ROOT_URL . 'admin/manageblog.php');
    exit();
}
?>