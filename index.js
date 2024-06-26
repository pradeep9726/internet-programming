// script.js

function validateForm() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    // Example validation (replace with your actual logic)
    if (username === 'admin' && password === 'password') {
      // Successful login, redirect or show success message
      alert('Login successful!');
      // Redirect to dashboard or another page
      // window.location.href = 'dashboard.php';
    } else {
      // Display error message
      alert('Invalid username or password. Please try again.');
    }
  }
  