<?php
session_start(); // start session
$conn = mysqli_connect("localhost", "root", "25102002", "semp"); // database connection details
//$conn = mysqli_connect("localhost", "root", "", "semp");

if (isset($_POST['login'])) { // check if login form is submitted
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_type'] = $row['user_type'];
        $_SESSION['username'] = $row['name'];
        //$_SESSION['username'] = $row['name'];
        /*if ($_SESSION['user_type'] == 'student') {
            header("Location: student_dashboard.php"); // redirect to student dashboard
        } else {
            header("Location: professor_dashboard.php"); // redirect to professor dashboard
        }*/
    } else {
        echo "Invalid email or password.";
    }

    /*$sql = "SELECT name FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $professor_name = $row['name'];
    //session_start(); // start the session
    $_SESSION['username'] = $professor_name; // set the session variable*/
}
// Set localStorage variable to indicate that user is logged in
echo "<script>localStorage.setItem('loggedIn', 'true');</script>";
// Redirect to dashboard
header('Location: student-dashboard.html');

?>

<!-- Login Form HTML Code 
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
-->
