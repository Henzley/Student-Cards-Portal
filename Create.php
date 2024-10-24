<!DOCTYPE html>
<html>

<style>
	body {
		background-image: url('Background.jpg');
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
		margin: 0;
	}

	.container {
		background-color: rgba(0, 0, 0, 0.5);
		/* Optional: for better visibility on background */
		padding: 20px;
		border-radius: 10px;
		text-align: center;
		color: white;
	}

	.heading {
		font-family: Arial, sans-serif;
		font-size: 24px;
		margin-bottom: 20px;
	}

	form {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	label,
	input,
	select {
		font-family: Arial, sans-serif;
		margin-bottom: 10px;
		width: 100%;
		max-width: 300px;
	}

	input,
	select {
		padding: 8px;
		border-radius: 5px;
		border: none;
		box-sizing: border-box;
	}

	.button {
		margin-top: 20px;
		background-color: green;
		color: white;
		padding: 10px 20px;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}

	.button:hover {
		background-color: darkgreen;
	}
</style>

<head>
	<title>Register Account</title>
</head>

<body>
	<div class="container">
		<h2 class="heading">Please enter your details</h2>

		<form action="register.php" method="post">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" required>

			<label for="surname">Surname:</label>
			<input type="text" id="surname" name="surname" required>

			<label for="stdntnum">Student Number:</label>
			<input type="text" id="stdntnum" name="stdntnum" required pattern="\d{9}" minlength="9" maxlength="9" title="Please enter a 9-digit student number">


			<label for="contactNumber">Contact Number:</label>
			<input type="text" id="contactNumber" name="contactNumber" required pattern="^0[6-8][0-9]{8}$" title="Please enter a valid South African contact number">

			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>

			<label for="yos">Year of Study:</label>
			<select id="yos" name="yos" required>
				<option value="" disabled selected>Select your year of study</option>
				<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
			</select>

			<label for="dept">Department:</label>
			<select id="dept" name="dept" required>
				<option value="" disabled selected>Select your department</option>
				<option value="Informatics and Design">Informatics and Design</option>
				<option value="Applied Sciences">Applied Sciences</option>
				<option value="Business and Management Sciences">Business and Management Sciences</option>
				<option value="Education">Education</option>
				<option value="Engineering and the Built Environment">Engineering and the Built Environment</option>
				<option value="Health and Wellness Sciences">Health and Wellness Sciences</option>
			</select>

			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>

			<input type="submit" class="button" value="Submit">
		</form>
	</div>
</body>

</html>