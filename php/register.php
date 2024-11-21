<?php
include 'php\db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collects form data
    $fullname = $conn->real_escape_string(trim($_POST['fullname']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);
    $expertise = $conn->real_escape_string(trim($_POST['expertise']));
    $description = $conn->real_escape_string(trim($_POST['description']));
    $profilePicture = ''; 

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL Insert Statement
    $sql = "INSERT INTO users (fullname, email, password, expertise, description, profile_picture)
            VALUES ('$fullname', '$email', '$hashedPassword', '$expertise', '$description', '$profilePicture')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>