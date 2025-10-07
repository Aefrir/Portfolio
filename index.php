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
						<h3>Introduction</h3>
						<p>During my studies at Inholland University in Alkmaar, I discovered my passion for programming. I'm currently continuing my journey at REA College, specializing in web development and working with various programming languages. I enjoy building clean, functional, and creative web experiences that bring ideas to life.</p>
					</article>
					<article>
						<h3>Goals</h3>
						<p>I'm eager to apply my knowledge in a professional environment and am looking for an internship as a web developer where I can continue to grow, learn from others, and refine my skills. I'm motivated by the challenge of turning ideas into interactive, user-friendly solutions.</p>
					</article>
					<article>
						<h3>Hobbies</h3>
						<p>Outside of coding, I'm a creative at heart. I enjoy watching anime, reading comics, and creating digital art, hobbies that inspire my sense of design and storytelling. I also play and analyze games, often diving into how they work behind the scenes. These interests fuel my curiosity and help me approach web development from both a technical and artistic perspective.</p>
					</article>
					
				</div>

			</section>
			<section id="project-section">
				<h2>Projects</h2>
				<div class="project-content">
					<article>
						<h3>HTML</h3>
						<p>In HTML I've made a <a href="#" class="webpage-link">webpage</a> containing a table with a detailed description of all the metatags, elements, attributes that I've learned during my HTML course.</p>
						<p>Eindopdracht + Afbeeldingen opdracht 5 + 6</p>
					</article>
					<article>
						<h3>CSS</h3>
						<p>In CSS I've created a medical <a href="#" class="webpage-link">webpage</a> of a Webshop designed in Figma.</p>
						<p>Flexbox 4, Grid 7, Animaties key + 6, Mediaqueries 4 + 6, Scrollen 6 + 7 & Variabelen 5</p>
					</article>
					<article>
						<h3>SEO</h3>
						<p>SEO is part of a webpage that you don't see as a customer hence why it is hard to show an actual product of it.</p>
						<p>Rich results 4, Site maps 5 & Error documents 2</p>
					</article>
					<article>
						<h3>Javascript</h3>
						<p>In Javascript I've learned how to manipulate the DOM.</p>
						<p>JSON 4, DOM 7</p>
					</article>
					<article>
						<h3>PHP</h3>
						<p>Sessies 4</p>
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
