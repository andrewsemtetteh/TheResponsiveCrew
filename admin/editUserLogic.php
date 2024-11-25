<?php 

require_once '../config/database.php';

if (isset($_POST['submit'])) {
    // Get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // Check for valid inputs
    if (!$fullname){
        $_SESSION['edit-user'] = 'Invalid form input';
    } else {
        // Update user in the database 
        $query = "UPDATE users SET fullname=?, is_admin=? WHERE id=? LIMIT 1";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sii", $fullname, $is_admin, $id);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_errno($stmt)) {
            $_SESSION["edit-user"] = "Failed to update";
        } else {
            $_SESSION["edit-user-success"] = "User $fullname updated successfully";
        }
        mysqli_stmt_close($stmt);
    }
}

header('location: ' . ROOT_URL .'admin/manageUser.php');
die();
?>