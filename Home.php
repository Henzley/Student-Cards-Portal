<?php
if (isset($_GET['message'])) {
	echo '<script>alert("' . htmlspecialchars($_GET['message']) . '");</script>';
}
?>

<!DOCTYPE html>
<html>
<style>
	header {
		font-family: Arial, sans-serif;
		color: white;
		text-align: center;
	}

	.heading {
		font-family: Arial, sans-serif;
		color: white;
		text-align: center;
	}

	div {
		font-family: Arial, sans-serif;
		color: white;
		position: absolute;
		text-align: center;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	a {
		color: white;
		text-decoration: none;
		display: block;
		/* Makes the entire area clickable */
		margin: 10px 0;
		/* Adds some space between links */
	}

	a:hover {
		text-decoration: underline;
		/* Optional: Adds an underline on hover */
	}
</style>

<head>
	<title>Welcome</title>
</head>
<header>
	<h1>Welcome</h1><br>
	<a href="About.html">
		<p style="color:White;">About</p>
	</a>
</header>

<body style="background-image: url('Background.jpg');">

	<div>
		<a href="Check.html">
			<p style="color:White;">Check Status</p>
		</a>
		<a href="Signup.html">
			<p style="color:White;">Create Student Card</p>
		</a>
		<a href="confirmStudent.php"> <!-- Added Update Details link -->
			<p style="color:White;">Update Details</p>
		</a>
	</div>
</body>

</html>