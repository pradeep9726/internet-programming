<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your database connection details
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "banklocker";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if username already exists
    $check_username_query = "SELECT * FROM login WHERE Username='$username'";
    $result = $conn->query($check_username_query);
    if ($result->num_rows > 0) {
        // Username already exists, update password
        $update_query = "UPDATE login SET Password='$password' WHERE Username='$username'";
        if ($conn->query($update_query) === TRUE) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        // Username doesn't exist, display error message
        echo "Username does not exist. Please register first.";
    }

    // Close connection
    $conn->close();
}
?>