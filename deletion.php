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

    // Check if username exists
    $check_username_query = "SELECT * FROM login WHERE username='$username'";
    $result = $conn->query($check_username_query);
    if ($result->num_rows > 0) {
        // Username exists, proceed with deletion
        $delete_query = "DELETE FROM login WHERE username='$username'";
        if ($conn->query($delete_query) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        // Username doesn't exist, display error message
        echo "Username does not exist. Cannot delete.";
    }

    // Close connection
    $conn->close();
}
?>