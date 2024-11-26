<?php
require_once 'config/database.php';

if(isset($_GET['id'])) {
    $blog_id = mysqli_real_escape_string($connection, $_GET['id']);

    // First, fetch the blog's thumbnail
    $get_blog_query = "SELECT thumbnail FROM blogs WHERE id = '$blog_id'";
    $result = mysqli_query($connection, $get_blog_query);
    $blog = mysqli_fetch_assoc($result);

    // Delete blog's thumbnail from server if it exists
    if (!empty($blog['thumbnail'])) {
        $thumbnail_path = '../' . $blog['thumbnail']; // Adjust path as needed
        if (file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }
    }

    // Delete the blog from the database
    $delete_blog_query = "DELETE FROM blogs WHERE id = '$blog_id'";
    $result = mysqli_query($connection, $delete_blog_query);

    if($result) {
        $_SESSION['delete-blog-success'] = "Blog deleted successfully";
        header('Location: ' . ROOT_URL . 'admin/manageblog.php');
        exit();
    } else {
        $_SESSION['delete-blog-error'] = "Could not delete blog";
        header('Location: ' . ROOT_URL . 'admin/manageblog.php');
        exit();
    }
} else {
    header('Location: ' . ROOT_URL . 'admin/manageblog.php');
    exit();
}
?>