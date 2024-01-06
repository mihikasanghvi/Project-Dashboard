<!DOCTYPE html>
<html>
<head>
	<title>Student Dashboard</title>
	<link rel="stylesheet" href="student.css">
  <script src="student.js"></script>
</head>
<body>
	<div class="header">
		<h1>Student Dashboard</h1>
	</div>
	<div class="container">
		<div class="filter">
			<h2>Filter by Department:</h2>
			<select id="department-filter">
				<option value="all">All Departments</option>
				<option value="computer">Computer Science</option>
				<option value="engineering">Engineering</option>
				<option value="business">Business</option>
			</select>
		</div>
		<div class="projects" id="projects">
			<h2>Projects:</h2>
			<table id="project-table">
				<thead>
					<tr>
						<th>Title</th>
						<th>Department</th>
						<th>Description</th>
						<th >Apply</th>
					</tr>
				</thead>
				<tbody>
          <?php
        $conn = new mysqli('localhost','root','25102002','semp');
        if($conn->connect_error){
            die('Connection Failed :'.$conn->connect_error);
        }
        //$var=result();
        //echo "$var";
        $query = "select * from projects;";
        $query_run = mysqli_query($conn,$query);
		    $check = mysqli_num_rows($query_run) > 0;
        //$redirect = 
        if($check){
            while($row = mysqli_fetch_array($query_run))
                {
                    ?>
                        <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo "<button onclick=\"window.location.href='popup.html'\" >Apply</button>";?></td>
                        </tr>
                    <?php   
                }
        }
        else{
            echo "No record found";
        }
    ?>
				</tbody>
			</table>
		</div>
	</div>
	<div id="project-modal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<h2 id="project-modal-title"></h2>
			<p id="project-modal-department"></p>
			<p id="project-modal-description"></p>
			<form id="apply-form" action="submit_resume.php" method="post" enctype="multipart/form-data">
				<label for="resume">Upload Resume (PDF only):</label>
				<input type="file" name="resume" id="resume" accept="application/pdf">
				<input type="submit" value="Apply">
			</form>
		</div>
	</div>
</body>
</html>
<!--
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Student Dashboard</h1>
  <form>
    <label for="department">Filter by department:</label>
    <select id="department">
      <option value="">All departments</option>
      <option value="Computer Science">Computer Science</option>
      <option value="Electrical Engineering">Electrical Engineering</option>
      <option value="Mechanical Engineering">Mechanical Engineering</option>
    </select>
  </form>
  <div id="projects"></div>

  <script>
    // Function to load projects from server and display them
    function loadProjects() {
      var department = document.getElementById("department").value;
      var xhr = new XMLHttpRequest();
      <h3>hello</h3>
      xhr.open("GET", "get_projects.php?department=" + encodeURIComponent(department));
      xhr.onload = function() {
        if (xhr.status === 200) {
          // Clear existing projects
          document.getElementById("projects").innerHTML = "";
          
          // Parse JSON response and create HTML for each project
          var projects = JSON.parse(xhr.responseText);
          projects.forEach(function(project) {
            var projectHTML = "<div class='project'>" +
                              "<h2>" + project.title + "</h2>" +
                              "<p><strong>Department:</strong> " + project.department + "</p>" +
                              "<p><strong>Description:</strong> " + project.description + "</p>" +
                              "<button onclick='applyForProject(" + project.id + ")'>Apply</button>" +
                              "</div>";
            document.getElementById("projects").innerHTML += projectHTML;
          });
        }
      };
      xhr.send();
    }
    loadProjects();
    // Function to apply for a project
    function applyForProject(projectId) {
      var inputElement = document.createElement("input");
      inputElement.type = "file";
      inputElement.accept = "application/pdf";
      inputElement.addEventListener("change", function() {
        var formData = new FormData();
        formData.append("resume", inputElement.files[0]);
        formData.append("project_id", projectId);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "submit_resume.php");
        xhr.onload = function() {
          if (xhr.status === 200) {
            alert("Your application has been submitted!");
          } else {
            alert("An error occurred while submitting your application.");
          }
        };
        xhr.send(formData);
      });
      inputElement.click();
    }

    // Load projects on page load and when filter changes
    window.onload = loadProjects;
    document.getElementById("department").addEventListener("change", loadProjects);
  </script>
</body>
</html>
-->