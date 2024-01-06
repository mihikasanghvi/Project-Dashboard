<?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "25102002";
    $dbname = "semp";
    session_start();
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch projects posted by professor
    $professor_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM projects WHERE professor_id='$professor_id'";
    $result = $conn->query($sql);

    // Query to fetch applications submitted for projects posted by professor
    //$sql_applications = "SELECT * FROM applications WHERE user_id='$professor_id'";
    //$result_applications = $conn->query($sql_applications);
    //echo "hello";
    // If form is submitted to add a new project
    if(isset($_POST['add_project'])) {
        echo "hello";
        $title = $_POST['title'];
        $department = $_POST['department'];
        $description = $_POST['description'];
        $professor_id = $_SESSION['user_id'];

        // Insert new project into database
        $sql_add_project = "INSERT INTO projects (title, department, description, professor_id)
                            VALUES ('$title', '$department', '$description', '$professor_id')";
        if ($conn->query($sql_add_project) === TRUE) {
            echo "<script>alert('New project added successfully');</script>";
        } else {
            echo "Error: " . $sql_add_project . "<br>" . $conn->error;
        }
    }

    // If form is submitted to approve a student's application
    /*if(isset($_POST['approve_application'])) {
        $application_id = $_POST['application_id'];

        // Update the status of the application to approved
        $sql_approve_application = "UPDATE applications SET status='approved' WHERE id='$application_id'";
        if ($conn->query($sql_approve_application) === TRUE) {
            echo "<script>alert('Application approved successfully');</script>";
        } else {
            echo "Error: " . $sql_approve_application . "<br>" . $conn->error;
        }
    }*/

    // If form is submitted to reject a student's application
    /*if(isset($_POST['reject_application'])) {
        $application_id = $_POST['application_id'];

        // Update the status of the application to rejected
        $sql_reject_application = "UPDATE applications SET status='rejected' WHERE id='$application_id'";
        if ($conn->query($sql_reject_application) === TRUE) {
            echo "<script>alert('Application rejected successfully');</script>";
        } else {
            echo "Error: " . $sql_reject_application . "<br>" . $conn->error;
        }
    }*/
    $conn->close();
?>

