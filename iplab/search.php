<?php
// Database connection parameters
$servername = "localhost"; // Adjust port if necessary
$username = "root";
$password = "";
$dbname = "banklocker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve search input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_number = $_POST['number'];

    // Prepare SQL statement
    $sql = "SELECT fullname, email, mobile_number, address, IDproof, locker_number FROM locker WHERE locker_number = ? OR key_number = ?";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $search_number, $search_number);
    
    // Execute the statement
    $stmt->execute();
    
    // Bind result variables
    $stmt->bind_result($fullname, $email, $mobile_number, $address, $IDproof, $locker_number);
    
    // Fetch values
    if ($stmt->fetch()) {
        echo "<div class='container'>";
        echo "<h2>Search Result:</h2>";
        echo "<p>Fullname: $fullname</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Mobile Number: $mobile_number</p>";
        echo "<p>Address: $address</p>";
        echo "<p>ID Proof: $IDproof</p>";
        echo "<p>Locker Proof: $locker_number</p>";
        echo "</div>";
    } else {
        echo "<div class='container'>";
        echo "<h2>No results found for '$search_number'.</h2>";
        echo "</div>";
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
