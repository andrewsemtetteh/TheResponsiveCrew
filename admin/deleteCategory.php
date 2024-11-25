<?php
require_once 'config/database.php';

if(isset($_GET['id'])) {
    $category_id = mysqli_real_escape_string($connection, $_GET['id']);

    // Delete the category from the database
    $delete_category_query = "DELETE FROM categories WHERE id = '$category_id'";
    $result = mysqli_query($connection, $delete_category_query);

    if($result) {
        $_SESSION['delete-category-success'] = "Category deleted successfully";
        header('Location: ' . ROOT_URL . 'admin/manageCategory.php');
        exit();
    } else {
        $_SESSION['delete-category-error'] = "Could not delete category";
        header('Location: ' . ROOT_URL . 'admin/manageCategory.php');
        exit();
    }
} else {
    header('Location: ' . ROOT_URL . 'admin/manageCategory.php');
    exit();
}
?>