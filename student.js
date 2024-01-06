// AJAX function to get projects list
/*function getProjects() {
    <h3>hello</h3>
    // Get department filter value
    var department = document.getElementById("department-filter").value;
  
    // Create new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
  
    // Define function to handle response
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Parse response JSON
        var projects = JSON.parse(xhr.responseText);
  
        // Get projects list element
        var projectsList = document.getElementById("project-table");
  
        // Clear previous projects
        projectsList.innerHTML = "";
  
        // Loop through projects and add to list
        for (var i = 0; i < projects.length; i++) {
          // Check if project matches department filter
          if (department == "all" || projects[i].department == department) {
            // Create new project item element
            var projectItem = document.createElement("div");
            projectItem.classList.add("project-item");
  
            // Add project title and department
            var titleElement = document.createElement("h3");
            titleElement.innerHTML = projects[i].title;
            projectItem.appendChild(titleElement);
  
            var departmentElement = document.createElement("p");
            departmentElement.innerHTML = "Department: " + projects[i].department;
            projectItem.appendChild(departmentElement);
  
            // Add project description
            var descriptionElement = document.createElement("p");
            descriptionElement.innerHTML = projects[i].description;
            projectItem.appendChild(descriptionElement);
  
            // Add apply button
            var applyButton = document.createElement("button");
            applyButton.innerHTML = "Apply";
            applyButton.setAttribute("data-project-id", projects[i].id);
            applyButton.addEventListener("click", function() {
              showApplyModal(this.getAttribute("data-project-id"));
            });
            projectItem.appendChild(applyButton);
  
            // Add project item to list
            projectsList.appendChild(projectItem);
          }
        }
      }
    };
  
    // Send AJAX request
    xhr.open("GET", "get_projects.php", true);
    xhr.send();
  }
  
  // Function to show apply modal
  function showApplyModal(projectId) {
    // Show modal overlay
    var overlay = document.getElementById("modal-overlay");
    overlay.style.display = "block";
  
    // Get apply modal and set project ID
    var applyModal = document.getElementById("apply-modal");
    applyModal.setAttribute("data-project-id", projectId);
  
    // Clear previous input value
    var inputElement = document.getElementById("resume-input");
    inputElement.value = "";
  
    // Show apply modal
    applyModal.style.display = "block";
  }
  
  // Function to hide apply modal
  function hideApplyModal() {
    // Hide modal overlay
    var overlay = document.getElementById("modal-overlay");
    overlay.style.display = "none";
  
    // Hide apply modal
    var applyModal = document.getElementById("apply-modal");
    applyModal.style.display = "none";
  }
  
  // Function to submit resume
  function submitResume() {
    // Get project ID
    var projectId = document.getElementById("apply-modal").getAttribute("data-project-id");
  
    // Get resume file input element
    var inputElement = document.getElementById("resume-input");
  
    // Check if file has been selected
    if (inputElement.files.length == 0) {
      alert("Please select a file to upload.");
      return;
    }
  
    // Create new FormData object
    var formData = new FormData();
  
    // Append file to FormData object
    formData.append("resume", inputElement.files[0]);
  
    // Append project ID to FormData object
    formData.append("project_id", projectId);
  
    // Create new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    // Set up event listener for when request completes
    xhr.addEventListener("load", function() {
    if (xhr.status === 200) {
    // Success - display success message
    alert("Resume submitted successfully!");
    } else {
    // Error - display error message
    alert("Error submitting resume. Please try again.");
    }
    });
    
    // Open POST request and send FormData object
    xhr.open("POST", "submit_resume.php");
    xhr.send(formData);
  }
 */
// select elements
const departmentFilter = document.querySelector("#department-filter");
const projectTableBody = document.querySelector("#project-table tbody");
const projectModal = document.querySelector("#project-modal");
const projectModalTitle = document.querySelector("#project-modal-title");
const projectModalDepartment = document.querySelector("#project-modal-department");
const projectModalDescription = document.querySelector("#project-modal-description");
const applyForm = document.querySelector("#apply-form");
const closeModalBtn = document.querySelector(".close");

// event listeners
departmentFilter.addEventListener("change", loadProjects);
projectTableBody.addEventListener("click", handleApplyClick);
closeModalBtn.addEventListener("click", closeModal);
window.addEventListener("click", handleOutsideClick);

// load projects
loadProjects();

function loadProjects() {
  const department = departmentFilter.value;
  fetch(`get_projects.php?department=${encodeURIComponent(department)}`)
    .then((response) => response.json())
    .then((projects) => {
      // clear existing projects
      projectTableBody.innerHTML = "";
      
      // create HTML for each project
      projects.forEach((project) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${project.title}</td>
          <td>${project.department}</td>
          <td>${project.description}</td>
          <td><button class="apply-btn" data-id="${project.id}">Apply</button></td>
        `;
        projectTableBody.appendChild(tr);
      });
    })
    .catch((error) => console.error(error));
}

function handleApplyClick(event) {
  if (event.target.classList.contains("apply-btn")) {
    const projectId = event.target.dataset.id;
    fetch(`get_project.php?id=${encodeURIComponent(projectId)}`)
      .then((response) => response.json())
      .then((project) => {
        projectModalTitle.textContent = project.title;
        projectModalDepartment.textContent = project.department;
        projectModalDescription.textContent = project.description;
        applyForm.action = `submit_resume.php?id=${encodeURIComponent(projectId)}`;
        projectModal.style.display = "block";
      })
      .catch((error) => console.error(error));
  }
}

function closeModal() {
  projectModal.style.display = "none";
}

function handleOutsideClick(event) {
  if (event.target === projectModal) {
    closeModal();
  }
}
