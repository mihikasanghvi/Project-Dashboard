<?php
// Start session
session_start();
echo "sc";
// Check if user is logged in
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Include database connection
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
else{
    echo " success";
}

// Get selected department from query string parameter
$selected_dept = $_GET['department'];

// Prepare SQL statement to retrieve projects based on department
$sql = "SELECT * FROM projects WHERE department = ? ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selected_dept);
$stmt->execute();

// Store result set in variable
$result = $stmt->get_result();

// Create empty array to store project data
$projects = array();

// Loop through each row in result set and store project data in array
while ($row = $result->fetch_assoc()) {
  $project = array(
    'id' => $row['id'],
    'title' => $row['title'],
    'department' => $row['department'],
    'description' => $row['description'],
    'professor' => $row['professor_id']
  );
  array_push($projects, $project);
}

// Encode project data as JSON and output to browser
header('Content-Type: application/json');
echo json_encode($projects);

// Close database connection
$stmt->close();
$conn->close();
?>