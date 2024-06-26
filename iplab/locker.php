<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
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

    // Get form data
    $full_name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $id_proof = mysqli_real_escape_string($conn, $_POST['IDproof']);
    $locker_number = mysqli_real_escape_string($conn, $_POST['locker_number']);
    $key_number = mysqli_real_escape_string($conn, $_POST['key_number']);

    // Insert data into database
    $sql = "INSERT INTO locker (fullname, email, mobile_number, address, IDproof, locker_number, key_number)
            VALUES ('$full_name', '$email', '$mobile_number', '$address', '$id_proof', '$locker_number', '$key_number')";

    if ($conn->query($sql) === TRUE) {
        echo "Locker assigned successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
