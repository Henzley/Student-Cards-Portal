<?php
// Database connection code here
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "PRTDatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use null coalescing operator to avoid undefined index warnings
    $stdntnum = $_POST['stdntnum'] ?? null;
    $new_password = $_POST['password'] ?? null;
    $confirm_password = $_POST['confirm_password'] ?? null;

    // Check if the required fields are filled out
    if ($stdntnum === null || $new_password === null || $confirm_password === null) {
        echo "Please fill in all fields.";
        exit;
    }

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        echo "Passwords do not match";
        exit;
    }

    // Check if student number exists
    $sql = "SELECT * FROM Student WHERE StudentNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $stdntnum);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Student number not found";
        exit;
    }

    // Update password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_sql = "UPDATE Student SET Password = ? WHERE StudentNumber = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ss", $hashed_password, $stdntnum);

    if ($update_stmt->execute()) {
        // Center the success message and button
        echo "<div style='display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh;'>";
        echo "<h3>Password updated successfully!</h3>";
        echo "<a href='signup.html'><button style='padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;'>Go to Signup</button></a>";
        echo "</div>";
    } else {
        echo "Error updating password";
    }
}
