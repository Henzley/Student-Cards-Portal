<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "PRTDatabase";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentNumber = $_POST['stdntnum'];
    $password = $_POST['password'];

    // Fetch student details from the database based on the student number and password
    $sql = "SELECT Password FROM Student WHERE StudentNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $studentNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Check the password against the hash
        if (password_verify($password, $row['Password'])) {
            header("Location: updateDetails.php?stdntnum=" . urlencode($studentNumber));
            exit;
        } else {
            $message = "Incorrect student number or password.";
        }
    } else {
        $message = "Incorrect student number or password.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Confirm Student Number</title>
    <style>
        body {
            background-image: url('Background.jpg');
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
        }

        form {
            display: inline-block;
            /* Center the form */
            margin-top: 20px;
        }

        label {
            display: block;
            /* Each label on a new line */
            margin: 10px 0 5px;
            text-align: left;
            /* Align label text to the left */
        }

        input[type="number"],
        input[type="password"] {
            width: 250px;
            padding: 8px;
            margin-bottom: 15px;
        }

        .button {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background-color: darkgreen;
            /* Darker green on hover */
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

    <h2>Confirm Your Student Number and Password</h2>
    <form action="confirmStudent.php" method="post">
        <label for="stdntnum">Student Number:</label>
        <input type="number" id="stdntnum" name="stdntnum" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Verify" class="button">
    </form>

    <?php if ($message): ?>
        <div class="error"><?php echo $message; ?></div>
    <?php endif; ?>

</body>

</html>