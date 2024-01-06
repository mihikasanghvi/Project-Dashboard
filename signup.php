<?php
session_start(); // start session
$conn = mysqli_connect("localhost", "root", "25102002", "semp"); // database connection details
//$conn = mysqli_connect("localhost", "root", "", "semp");

if (isset($_POST['signup'])) { // check if signup form is submitted
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = $_POST['user_type'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Email address already exists.";
    } else {
        if ($password != $confirm_password) {
            echo "Passwords do not match.";
        } else {
            $sql = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
            mysqli_query($conn, $sql);
            echo "Signup successful.";
        }
    }
}
// Set localStorage variable to indicate that user is logged in
echo "<script>localStorage.setItem('loggedIn', 'true');</script>";
// Redirect to dashboard
header('Location: index.html');
//$_SESSION['username']=$name;
?>

<!-- Signup Form HTML Code 
<!DOCTYPE html>
<html>
<head>
    <title>Signup Page</title>
</head>
<body>
    <h2>Signup</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br><br>
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br><br>
        <label>User Type:</label>
        <select name="user_type" required>
            <option value="">Select
-->