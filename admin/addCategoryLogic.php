<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    
    if (!$title) {
        $_SESSION['addCategory'] = 'Enter Title';
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/addCategory.php');
        die();
    }

    //insert category into database
    $query = "INSERT INTO categories (title) VALUES ('$title')";
    $result = mysqli_query($connection, $query);

    if(mysqli_errno($connection)) {
        $_SESSION["add-category"] = "Could not add category";
        header('location: ' . ROOT_URL .'admin/addCategory.php');
        die();
    } else {
        $_SESSION["add-category-success"] = "Category $title added successfully";
        header("location: ". ROOT_URL .'admin/manageCategory.php');
        die();
    }
}
?>