<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banklocker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get users
$sql = "SELECT fullname, email, mobile_number, address, IDproof, locker_number, key_number FROM locker";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Address</th>
                <th>ID Proof</th>
                <th>Locker Number</th>
                <th>Key Number</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["fullname"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["mobile_number"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["IDproof"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["locker_number"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["key_number"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
