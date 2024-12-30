<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_project"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password
$phone = $_POST['phone'];
$address = $_POST['address'];
$ownerType = $_POST['ownerType'];
$citizenshipNumber = $_POST['citizenshipNumber'];
$citizenshipCardPath = "";

// Check if the user already exists
$check_sql = "SELECT * FROM owners WHERE email = ? OR username = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ss", $email, $username);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    echo "User already exists. Please use a different email or username.";
    $check_stmt->close();
    $conn->close();
    exit();
}

$check_stmt->close();

// Handle file upload
if (isset($_FILES['citizenshipCard']) && $_FILES['citizenshipCard']['error'] == 0) {
    $target_dir = "uploads/"; // Ensure this directory exists and is writable
    $citizenshipCardPath = $target_dir . basename($_FILES["citizenshipCard"]["name"]);

    // Move file to target directory
    if (move_uploaded_file($_FILES["citizenshipCard"]["tmp_name"], $citizenshipCardPath)) {
        echo "File uploaded successfully: " . htmlspecialchars($citizenshipCardPath);
    } else {
        die("Error uploading file.");
    }
}

// Insert data into the database
$sql = "INSERT INTO owners (name, email, username, password, phone, address, ownerType, citizenshipNumber, citizenshipCard) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $name, $email, $username, $password, $phone, $address, $ownerType, $citizenshipNumber, $citizenshipCardPath);

if ($stmt->execute()) {
    // Redirect to login.html on success
    header("Location: login.html");
    exit(); // Ensure no further code is executed
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
