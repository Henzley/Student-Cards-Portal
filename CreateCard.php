<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a237e;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .image-upload {
            text-align: center;
            margin-right: 20px;
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .avatar img {
            width: 80px;
            height: 80px;
        }

        .form-container {
            max-width: 400px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body style="background-image: url('Background.jpg');">
    <div class="form-container">
        <h2>Please choose a date for collection</h2>
        <form action="submit_form.php" method="post">
            <label for="collection-date">*<i>select any date after 7 days from now</i></label>
            <input type="date" id="collection-date" name="collection-date" required
                min="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
            <br><br>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    </div>
</body>

</html>