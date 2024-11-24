<?php
require 'config/database.php';

//get signup data if the signup button is clicked
if(isset($_POST['submit'])) {
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $profile = $_FILES['profile'];

    //validating input values
    if (!$fullname){
        $_SESSION['register'] = 'Please enter your full name';
    } elseif(!$email){
        $_SESSION['register'] = 'Please enter an Ashesi email';
    } elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['register'] = 'Password should be more than 8 characters';
    } elseif(!$profile['name']){
        $_SESSION['register'] = 'Please add profile picture';
    } else {
        //check if passwords match
        if ($createpassword !== $confirmpassword){
            $_SESSION['register'] = 'Passwords do not match';
        } else {
            //hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            //check if email already exist in the database
            $user_check_query =  "SELECT * FROM users WHERE email='$email'"; // Fixed the missing quote here
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION["register"] = "Email already exist!";
            } else {
                //work on avatar
                //rename avatar
                $time = time();
                $profile_name = $time . $profile['name'];
                $profile_temp_name = $profile['temp_name'];
                $profile_destination_path = 'images/' . $profile_name;
            }

            //make sure the file is an image

            
        }
    }


} else {
    //if button wasn't clicked, move back to the register page
    header('location: ' . ROOT_URL . 'register.php');
    die();
}
?>