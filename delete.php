<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "PRTDatabase";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$studentNumber = ''; // Initialize variable
$deletionMessage = ''; // Initialize variable for deletion message
if (isset($_GET['stdntnum'])) {
    $studentNumber = $_GET['stdntnum'];

    // Confirm the deletion
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepare SQL statement to delete the student record
        $sql = "DELETE FROM Student WHERE StudentNumber = ?";
        $stmt = $conn->prepare($sql);

        // Check if statement preparation was successful
        if ($stmt) {
            $stmt->bind_param("s", $studentNumber);
            if ($stmt->execute()) {
                $deletionMessage = "Your account has been deleted successfully.";
                // Redirect to home or login page
                header("Location: home.php?message=" . urlencode($deletionMessage));
                exit();
            } else {
                $deletionMessage = "Error deleting your account: " . $stmt->error; // Show error if deletion fails
            }
            $stmt->close(); // Close the statement
        } else {
            $deletionMessage = "Error preparing statement: " . $conn->error; // Show error if statement preparation fails
        }
    }
} else {
    echo "No student number provided.";
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Account</title>
    <style>
        body {
            background-image: url('Background.jpg');
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
        }

        h2 {
            margin-top: 50px;
        }

        form {
            display: inline-block;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background-color: darkred;
        }

        .cancel-button {
            background-color: gray;
        }

        .cancel-button:hover {
            background-color: darkgray;
        }
    </style>
</head>

<body>
    <h2>Are you sure you want to delete your account?</h2>
    <p>This action cannot be undone.</p>
    <form action="delete.php?stdntnum=<?php echo urlencode($studentNumber); ?>" method="post">
        <input type="submit" value="Yes, delete my account" class="button" onclick="return confirmDelete();">
        <a href="updateDetails.php?stdntnum=<?php echo urlencode($studentNumber); ?>" class="button cancel-button">Cancel</a>
    </form>

    <script>
        function confirmDelete() {
            // Show an alert before submitting the form
            return confirm("Are you sure you want to delete your account? This action cannot be undone.");
        }

        // Display the deletion message if it's set in the URL
        <?php if (isset($deletionMessage) && !empty($deletionMessage)) : ?>
            alert("<?php echo addslashes($deletionMessage); ?>");
        <?php endif; ?>
    </script>
</body>

</html>