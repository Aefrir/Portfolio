<?php
	
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
		<script src="https://kit.fontawesome.com/a0a5e50891.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php include("includes/header.php");?>
		<main>
			<div class="intro-content">
				<section class="intro">
					<h1>I'm Daanphi,</h1>
					<h3>an aspiring Web Developer</h3>
					<p>I am an aspiring Web Developer with a passion for back-end systems and databases.</p>
				</section>
				<section class="side-chapters">
					<article>
						<h2>About me</h2>
						<p>I have experience in various languages such as HTML, CSS, Javascript and PHP. Furthermore I've also received basic guidance in C# and Python.</p>
						<a href="#about-me-section">Learn more</a>
					</article>
					<article>
						<h2>Projects / Work</h2>
						<p>I'm still building up my experience to larger projects, but I've created smaller pages and components using HTML, CSS, and JavaScript to practice my skills and experiment with ideas.</p>
						<a href="projects.php">Learn more</a>
					</article>
				</section>
			</div>
			
			<section id="about-me-section">
				<h2>About Me</h2>
				<div class="about-me-content">
					<article>
						<p>I am currently a student enrolled at REA College studying Webdevelopment. So far I've finished my HTML, CSS, SEO and my introductory JavaScript course. You can see the projects i've worked on in the project section.</p>
					</article>
				</div>

			</section>
			<section id="project-section">
				<h2>Projects</h2>
				<div class="project-content">
					<article>
						<h4>HTML</h4>
						<p>In HTML I've made a <a href="#" class="webpage-link">webpage</a> containing a table with a detailed description of all the metatags, elements, attributes that I've learned during my HTML course.</p>
					</article>
					<article>
						<h4>CSS</h4>
						<p>In CSS I've created a medical <a href="#" class="webpage-link">webpage</a> of a Webshop designed in Figma.</p>
					</article>
					<article>
						<h4>SEO</h4>
						<p>SEO is part of a webpage that you don't see as a customer hence why it is hard to show an actual product of it.</p>
					</article>
					<article>
						<h4>Javascript</h4>
						<p>In Javascript I've learned how to manipulate the DOM.</p>
					</article>
					<article>
						<h4>PHP</h4>
						<p></p>
					</article>
				</div>
			</section>
			<section id="contact-section">
				<h2>Contact</h2>
				<form action="index.php" method="post">
					<label for="">Filler</label>
				</form>
			</section>
		</main>
		<?php include("includes/footer.php");?>
	</body>
</html>
