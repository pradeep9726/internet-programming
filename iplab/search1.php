<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h2 {
            text-align: center;
            color: #333;
        }
        
        p {
            margin-bottom: 10px;
            font-size: 1.1em;
            line-height: 1.6;
        }
        
        .no-results {
            text-align: center;
            color: #777;
        }
        
        .go-home {
            text-align: center;
            margin-top: 20px;
        }
        
        .go-home a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .go-home a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

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

// Initialize variables to store search results
$fullname = $email = $mobile_number = $address = $IDproof = $locker_number = "";

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
        echo "<p><strong>Fullname:</strong> $fullname</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Mobile Number:</strong> $mobile_number</p>";
        echo "<p><strong>Address:</strong> $address</p>";
        echo "<p><strong>ID Proof:</strong> $IDproof</p>";
        echo "<p><strong>Locker Number:</strong> $locker_number</p>";
        echo "</div>";
    } else {
        echo "<div class='container no-results'>";
        echo "<h2>No results found for '$search_number'.</h2>";
        echo "</div>";
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<div class="go-home">
    <a href="home.html">Go Home</a>
</div>

</body>
</html>
