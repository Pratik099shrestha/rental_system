<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="forgot-password-container">
        <h1>Forgot Password</h1>
        <form id="forgotPasswordForm" action="reset_password.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="citizenshipNumber">Citizenship Number</label>
                <input type="text" id="citizenshipNumber" name="citizenshipNumber" placeholder="Enter your Citizenship Number" required>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" id="newPassword" name="newPassword" placeholder="Enter your new password" required><br>
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your new password" required>
            </div>
            <button type="submit" class="reset-password-btn">Reset Password</button>
        </form>
    </div>
    <script>
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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $citizenshipNumber = $_POST['citizenshipNumber'];
    $newPassword = $_POST['newPassword'];

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Query to check if the user exists
    $sql = "SELECT email FROM owners WHERE email = ? AND citizenshipNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $citizenshipNumber);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User exists, update the password
        $updateSql = "UPDATE owners SET password = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ss", $hashedPassword, $email);
        if ($updateStmt->execute()) {
            echo "Password reset successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error updating password. Please try again.";
        }
        $updateStmt->close();
    } else {
        echo "User not found with the provided email and citizenship number.";
    }

    $stmt->close();
}

$conn->close();
?>

    </script>
</body>
</html>
