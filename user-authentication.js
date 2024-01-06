// Login Form Validation
function validateLoginForm() {
    var email = document.forms["login-form"]["email"].value;
    var password = document.forms["login-form"]["password"].value;
    
    if (email == "") {
      alert("Please enter your email.");
      return false;
    }
    
    if (password == "") {
      alert("Please enter your password.");
      return false;
    }
  }
  
  // Signup Form Validation
  function validateSignupForm() {
    var name = document.forms["signup-form"]["name"].value;
    var email = document.forms["signup-form"]["email"].value;
    var password = document.forms["signup-form"]["password"].value;
    var confirm_password = document.forms["signup-form"]["confirm_password"].value;
    var user_type = document.forms["signup-form"]["user_type"].value;
    
    if (name == "") {
      alert("Please enter your name.");
      return false;
    }
    
    if (email == "") {
      alert("Please enter your email.");
      return false;
    }
    
    if (password == "") {
      alert("Please enter your password.");
      return false;
    }
    
    if (confirm_password == "") {
      alert("Please confirm your password.");
      return false;
    }
    
    if (password != confirm_password) {
      alert("Passwords do not match.");
      return false;
    }
    
    if (user_type == "") {
      alert("Please select your user type.");
      return false;
    }
  }
  