<?php
	include("includes/validation-and-processing/form-handling.php")
?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="robots" content="index,follow">
		<title>Portfolio</title>
		<link rel="stylesheet" href="css/stylesheet.css">
		<link rel="stylesheet" href="css/index-style.css">
		<link rel="stylesheet" href="css/project-style.css">
		<link rel="stylesheet" href="css/about-me-style.css">
		<link rel="stylesheet" href="css/contact-style.css">
		<link rel="stylesheet" media="screen and (max-width: 1000px)" href="css/mobile.css">
		<link rel="stylesheet" media="screen and (max-width: 425px)" href="css/mobile-small.css">
		<script src="https://kit.fontawesome.com/a0a5e50891.js" crossorigin="anonymous"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
		<?php include("includes/header.php");?>
		<main>
			<?php include("includes/intro.php");?>
			<?php include("includes/about-me.php");?>
			<?php include("includes/projects.php");?>
			<?php include("includes/contact-form.php");?>
		</main>
		<?php include("includes/footer.php");?>
	</body>
</html>
