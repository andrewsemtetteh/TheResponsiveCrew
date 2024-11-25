<?php 
require_once '../config/database.php';

if (isset($_POST['submit'])) {
    // Get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Check for valid inputs
    if (!$title){
        $_SESSION['edit-category-error'] = 'Invalid category title';
        header('location: ' . ROOT_URL .'admin/editCategory.php?id=' . $id);
        exit();
    } else {
        // Update category in the database 
        $query = "UPDATE categories SET title=? WHERE id=? LIMIT 1";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "si", $title, $id);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_errno($stmt)) {
            $_SESSION['edit-category-error'] = "Failed to update category";
        } else {
            $_SESSION['edit-category-success'] = "Category '$title' updated successfully";
        }
        mysqli_stmt_close($stmt);
    }
}

header('location: ' . ROOT_URL .'admin/manageCategory.php');
exit();
?>