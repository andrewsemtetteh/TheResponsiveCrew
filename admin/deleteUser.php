<?php
require_once 'config/database.php';

if(isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($connection, $_GET['id']);

    // First, fetch the user's profile picture
    $get_user_query = "SELECT profile FROM users WHERE id = '$user_id'";
    $result = mysqli_query($connection, $get_user_query);
    $user = mysqli_fetch_assoc($result);

    // Delete user's profile picture from server if it exists
    if (!empty($user['profile']) && $user['profile'] !== 'default-avatar.png') {
        $profile_pic_path = '../images/' . $user['profile'];
        if (file_exists($profile_pic_path)) {
            unlink($profile_pic_path);
        }
    }

    // Delete the user from the database
    $delete_user_query = "DELETE FROM users WHERE id = '$user_id'";
    $result = mysqli_query($connection, $delete_user_query);

    if($result) {
        $_SESSION['delete-user-success'] = "User deleted successfully";
        header('Location: ' . ROOT_URL . 'admin/manageUser.php');
        exit();
    } else {
        $_SESSION['delete-user-error'] = "Could not delete user";
        header('Location: ' . ROOT_URL . 'admin/manageUser.php');
        exit();
    }
} else {
    header('Location: ' . ROOT_URL . 'admin/manageUser.php');
    exit();
}
?>