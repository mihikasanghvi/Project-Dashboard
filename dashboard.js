// Wait for the page to load before running any code
document.addEventListener("DOMContentLoaded", function() {
    // Get the form elements for adding a new project
    const addProjectForm = document.getElementById("add-project-form");
    const projectTitle = document.getElementById("project-title");
    const projectDepartment = document.getElementById("project-department");
    const projectDescription = document.getElementById("project-description");
  
    // Add an event listener to the form submit button
    addProjectForm.addEventListener("submit", function(event) {
      // Prevent the form from submitting
      event.preventDefault();
  
      // Get the values of the form fields
      const title = projectTitle.value;
      const department = projectDepartment.value;
      const description = projectDescription.value;
  
      // Make an AJAX request to add the project to the database
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "add_project.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          // Clear the form fields and show a success message
          projectTitle.value = "";
          projectDepartment.value = "";
          projectDescription.value = "";
          alert("Project added successfully!");
        }
      };
      xhr.send(`title=${title}&department=${department}&description=${description}`);
    });
  
    // Get the table body element for displaying projects
    const projectsTableBody = document.getElementById("projects-table-body");
  
    // Make an AJAX request to get the projects from the database
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "get_projects.php", true);
    xhr.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        // Parse the JSON response and add each project to the table
        const projects = JSON.parse(this.responseText);
        projects.forEach(function(project) {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${project.title}</td>
            <td>${project.department}</td>
            <td>${project.description}</td>
            <td><a href="view_applications.php?project_id=${project.id}">View Applications</a></td>
          `;
          projectsTableBody.appendChild(row);
        });
      }
    };
    xhr.send();
  });
  