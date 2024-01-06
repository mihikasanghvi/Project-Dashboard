<?php

session_start();

// Check if user is logged in
if(!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

// Get the project ID and resume file from POST request
$project_id = $_POST['project_id'];
$resume_file = $_FILES['resume']['name'];
$email = $_SESSION['email']
// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '25102002';
$database = 'semp';

$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Save resume file to server
$target_dir = "resumes/";
$target_file = $target_dir . basename($_FILES["resume"]["name"]);
move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);

// Insert application data into applications table
$userid = $_SESSION['user_id'];
$sql = "INSERT INTO applications (project_id, user_id, email, resume) VALUES ('$project_id', '$userid', '$email', '$resume_file')";

if (mysqli_query($conn, $sql)) {
  // Redirect to dashboard with success message
  $_SESSION['success_message'] = "Your application has been submitted successfully!";
  header('Location: dashboard.php');
} else {
  // Redirect to dashboard with error message
  $_SESSION['error_message'] = "There was an error submitting your application. Please try again.";
  header('Location: dashboard.php');
}

mysqli_close($conn);

?>
