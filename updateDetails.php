<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "PRTDatabase";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Initialize variables to avoid undefined variable warnings
$studentNumber = '';
$studentName = '';
$studentSurname = '';
$contactNumber = '';
$email = '';
$yearOfStudy = '';
$department = '';

// Sample code to fetch student details (replace with actual DB query)
if (isset($_GET['stdntnum'])) { // Assume student number is passed as a query parameter
    $studentNumber = $_GET['stdntnum']; // Get the student number from URL
    // Fetch student details from the database based on the student number
    $sql = "SELECT * FROM Student WHERE StudentNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $studentNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the details into variables
        $row = $result->fetch_assoc();
        $studentName = $row['StudentName'];
        $studentSurname = $row['StudentSurname'];
        $contactNumber = $row['StudentContactNumber']; // Ensure this column exists in your table
        $email = $row['StudentEmail']; // Ensure this column exists in your table
        $yearOfStudy = $row['YearOfStudy'];
        $department = $row['Department'];
    } else {
        // Handle the case where no student is found
        echo "No student found with that number.";
    }
}

// If the form is submitted, update the student details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $studentNumber = $_POST['stdntnum'];
    $studentName = $_POST['name'];
    $studentSurname = $_POST['surname'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $yearOfStudy = $_POST['yos'];
    $department = $_POST['dept'];

    // Prepare the SQL update statement
    $sql = "UPDATE Student SET StudentName = ?, StudentSurname = ?, StudentContactNumber = ?, StudentEmail = ?, YearOfStudy = ?, Department = ? WHERE StudentNumber = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $studentName, $studentSurname, $contactNumber, $email, $yearOfStudy, $department, $studentNumber);

    // Execute the update query
    if ($stmt->execute()) {
        echo "Details updated successfully!";
    } else {
        echo "Error updating details: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Student Details</title>
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

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="password"],
        select {
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

        .delete-button {
            background-color: red;
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            /* Red for delete action */
        }

        .delete-button:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>

    <h2>Update Your Details</h2>
    <form action="updateDetails.php?stdntnum=<?php echo htmlspecialchars($studentNumber); ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($studentName); ?>" required>

        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($studentSurname); ?>" required>

        <label for="stdntnum">Student Number:</label>
        <input type="number" id="stdntnum" name="stdntnum" value="<?php echo htmlspecialchars($studentNumber); ?>" required readonly>

        <label for="contactNumber">Contact Number:</label>
        <input type="text" id="contactNumber" name="contactNumber" value="<?php echo htmlspecialchars($contactNumber); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="yos">Year of Study:</label>
        <select id="yos" name="yos" required>
            <option value="" disabled>Select your year of study</option>
            <option value="2023" <?php if ($yearOfStudy == '2023') echo 'selected'; ?>>2023</option>
            <option value="2024" <?php if ($yearOfStudy == '2024') echo 'selected'; ?>>2024</option>
            <option value="2025" <?php if ($yearOfStudy == '2025') echo 'selected'; ?>>2025</option>
        </select>

        <label for="dept">Department:</label>
        <select id="dept" name="dept" required>
            <option value="" disabled>Select your department</option>
            <option value="Informatics and Design" <?php if ($department == 'Informatics and Design') echo 'selected'; ?>>Informatics and Design</option>
            <option value="Applied Sciences" <?php if ($department == 'Applied Sciences') echo 'selected'; ?>>Applied Sciences</option>
            <option value="Business and Management Sciences" <?php if ($department == 'Business and Management Sciences') echo 'selected'; ?>>Business and Management Sciences</option>
            <option value="Education" <?php if ($department == 'Education') echo 'selected'; ?>>Education</option>
            <option value="Engineering and the Built Environment" <?php if ($department == 'Engineering and the Built Environment') echo 'selected'; ?>>Engineering and the Built Environment</option>
            <option value="Health and Wellness Sciences" <?php if ($department == 'Health and Wellness Sciences') echo 'selected'; ?>>Health and Wellness Sciences</option>
        </select>
        </br>
        <input type="submit" value="Update Details" class="button">
    </form>
    </br>
    <form action="delete.php?stdntnum=<?php echo urlencode($studentNumber); ?>" method="post" style="margin-top: 20px;">
        <a href="delete.php?stdntnum=<?php echo urlencode($studentNumber); ?>" class="delete-button">Delete Account</a>

    </form>

</body>

</html>