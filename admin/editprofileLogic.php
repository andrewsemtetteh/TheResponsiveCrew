<?php
require 'config/database.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user-id'])) {
    $_SESSION['error'] = "You must be logged in to edit your profile";
    header('location: ' . ROOT_URL . 'login.php');
    die();
}

// Check if the form is submitted
if (!isset($_POST['submit'])) {
    header('location: ' . ROOT_URL . 'admin/editprofile.php');
    die();
}

// Get current user's ID
$user_id = $_SESSION['user-id'];

// Sanitize and validate inputs
$bio = filter_var($_POST['bio'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$creator_type = filter_var($_POST['creator_type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Handle skills (assuming skills are submitted as comma-separated)
$skills = isset($_POST['skills']) ? explode(',', $_POST['skills']) : [];
$skills_json = json_encode(array_map('trim', array_filter($skills))); // Filter out empty skills

// Handle socials (removing empty values)
$socials = [
    'linkedin' => !empty($_POST['linkedin']) ? filter_var($_POST['linkedin'], FILTER_SANITIZE_URL) : null,
    'github' => !empty($_POST['github']) ? filter_var($_POST['github'], FILTER_SANITIZE_URL) : null,
    'twitter' => !empty($_POST['twitter']) ? filter_var($_POST['twitter'], FILTER_SANITIZE_URL) : null
];
$socials = array_filter($socials); // Remove null values
$socials_json = json_encode($socials);

// Optional: Profile picture upload
$profile_pic = $_FILES['profile'] ?? null;

// Check if a new profile picture is uploaded
if ($profile_pic && $profile_pic['name']) {
    $time = time();
    $profile_pic_name = $time . $profile_pic['name'];
    $profile_pic_tmp_name = $profile_pic['tmp_name'];
    $profile_pic_destination_path = 'images/' . $profile_pic_name;

    // Validate image
    $allowed_files = ['png', 'jpg', 'jpeg'];
    $extension = strtolower(pathinfo($profile_pic['name'], PATHINFO_EXTENSION));

    if (in_array($extension, $allowed_files)) {
        if ($profile_pic['size'] < 1000000) { // Less than 1MB
            // Upload new profile picture
            if (move_uploaded_file($profile_pic_tmp_name, $profile_pic_destination_path)) {
                // Update user's profile picture in users table
                $update_profile_query = "UPDATE users SET profile = ? WHERE id = ?";
                $stmt = mysqli_prepare($connection, $update_profile_query);
                mysqli_stmt_bind_param($stmt, "si", $profile_pic_name, $user_id);
                mysqli_stmt_execute($stmt);
            } else {
                $_SESSION['error'] = "Failed to upload profile picture";
                header('location: ' . ROOT_URL . 'admin/editprofile.php');
                die();
            }
        } else {
            $_SESSION['error'] = "Profile picture should be less than 1MB";
            header('location: ' . ROOT_URL . 'admin/editprofile.php');
            die();
        }
    } else {
        $_SESSION['error'] = "Invalid profile picture format. Use png, jpg, or jpeg";
        header('location: ' . ROOT_URL . 'admin/editprofile.php');
        die();
    }
}

try {
    // Use UPSERT (INSERT ... ON DUPLICATE KEY UPDATE) for more robust handling
    $upsert_query = "
        INSERT INTO portfolio (author_id, bio, creator_type, skills, socials) 
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
        bio = VALUES(bio), 
        creator_type = VALUES(creator_type), 
        skills = VALUES(skills), 
        socials = VALUES(socials)
    ";
    
    $stmt = mysqli_prepare($connection, $upsert_query);
    mysqli_stmt_bind_param($stmt, "issss", $user_id, $bio, $creator_type, $skills_json, $socials_json);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Profile updated successfully";
        header('location: ' . ROOT_URL . 'profile.php');
        die();
    } else {
        throw new Exception("Database update failed: " . mysqli_error($connection));
    }
} catch (Exception $e) {
    $_SESSION['error'] = "An error occurred: " . $e->getMessage();
    header('location: ' . ROOT_URL . 'admin/editprofile.php');
    die();
}