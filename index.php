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
				<section class="intro-left">
					<h1>I'm Daanphi,</h1>
					<h3>an aspiring Web Developer</h3>
					<p>I am an aspiring Web Developer with a passion for back-end systems and databases.</p>
				</section>
				<section class="side-chapters">
					<article>
						<h3>About me</h3>
						<p>I have experience in various languages such as HTML, CSS, Javascript and PHP. Furthermore I've also received basic guidance in C# and Python.</p>
						<a href="#about-me-section">Learn more</a>
					</article>
					<article>
						<h3>Projects / Work</h3>
						<p>I'm still building up my experience to larger projects, but I've created smaller pages and components using HTML, CSS, and JavaScript to practice my skills and experiment with ideas.</p>
						<a href="#project-section">Learn more</a>
					</article>
				</section>
			</div>
			
			<section id="about-me-section">
				<h2>About Me</h2>
				<div class="about-me-content">
					<article>
						<h3>Introduction</h3>
						<p>During my studies at Inholland University in Alkmaar, I discovered my passion for programming and am now continuing my journey at REA College, specializing in web development and working with various programming languages. I enjoy building clean, functional, and creative web experiences that bring ideas to life, and I'm eager to apply my knowledge in a professional environment. I am looking for an internship as a web developer where I can continue to grow, learn from others, and refine my skills, motivated by the challenge of turning ideas into interactive, user-friendly solutions.</p>
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
						<section class="top-section">
							<div class="project-title">
								<img src="img/logo/html.svg" alt="HTML Logo" title="HTML Logo" width="50" height="50">
								<h3>HTML</h3>
							</div>
							<img src="img/html-project2.png" class="project-images" alt="html image of a table" title="" width="400" height="250">
						</section>
						<section class="bottom-section">
							<p>I built projects to strengthen my web fundamentals, including an extensive HTML <a href="" class="page-link">reference table</a> and an interactive Game of Thrones image map linking regions to their wiki pages.</p>
						</section>
					</article>
					<article>
						<section class="top-section">
							<div class="project-title">
								<img src="img/logo/css.svg" alt="CSS Logo" title="CSS Logo" width="50" height="50">
								<h3>CSS</h3>
							</div>
							<img src="img/css-project.png" class="project-images" alt="image of a medical webshop" title="" width="400" height="250">
						</section>
						<section class="bottom-section">
							<p>I recreated a medical <a href="" class="page-link">webshop</a> design provided in Figma using only HTML and CSS. The result is a 1:1 responsive layout that works seamlessly across desktop and mobile screens, showcasing my attention to detail and front-end styling skills.</p>
						</section>
					</article>
					<article>
						<section class="top-section">
							<div class="project-title">
								<img src="img/logo/seo.svg" alt="SEO Logo" title="SEO Logo" width="50" height="50">
								<h3>SEO</h3>
							</div>
							<img src="img/seo-project.png" class="project-images" alt="SEO code snippet" title="" width="400" height="250">
						</section>
						<section class="bottom-section">
							<p>I created multiple JSON-LD schemas and XML sitemaps for different webpages to improve their search engine visibility. Along the way, I developed a solid understanding of basic SEO principles and how to optimize pages for better ranking.</p>
						</section>
					</article>
					<article>
						<section class="top-section">
							<div class="project-title">
								<img src="img/logo/js.svg" alt="Javascript Logo" title="Javascript Logo" width="50" height="50">
								<h3>Javascript</h3>
							</div>
							<img src="img/js-project.png" class="project-images" alt="webpage image" title="" width="400" height="250">
						</section>
						<section class="bottom-section">
							<p>I learned the basics of JavaScript and how to add interactivity to webpages. The highlight was working with DOM manipulation and JSON data, allowing me to dynamically update and display content on web pages.</p>
						</section>
					</article>
					<article>
						<section class="top-section">
							<div class="project-title">
								<img src="img/logo/php.svg" alt="PHP Logo" title="PHP Logo" width="50" height="50">
								<h3>PHP</h3>
							</div>
							<img src="img/php-project.png" class="project-images" alt="game shop webpage image" title="" width="400" height="250">
						</section>
						<section class="bottom-section">
							<p>I'm currently completing my PHP course, where I've learned the fundamentals of backend development. I'm now progressing toward more advanced topics like object-oriented programming (OOP) to build cleaner and more scalable applications.</p>
						</section>
					</article>
				</div>
			</section>
			<section id="contact-section">
				<h2>Contact</h2>
				<section class="contact-content">
					<section class="contact-left">
						<h3>Contact me</h3>
						<form action="index.php" method="post">
							<div class="form-row">
								<label for="">Name</label>
								<input type="text" name="" id="" placeholder="Enter your name">
							</div>
							<div class="form-row">
								<label for="">Email</label>
								<input type="text" name="" id="" placeholder="Enter your email" required>
							</div>
							<div class="form-row">
								<label for="">Message</label>
								<textarea name="" id="" rows="4" placeholder="Enter your message"></textarea>
							</div>
							<input type="submit" value="Submit" name="">
						</form>
					</section>
					<section class="contact-right">
						<div class="contact-row">
							<h3>Email</h3>
							<a href="">daanphin@gmail.com</a>
						</div>
						<div class="contact-row">
							<h3>Phonenumber</h3>
							<p>06-10764657</p>
						</div>
						<div class="contact-row">
							<h3>Socials</h3>
							<div class="socials">
								<a href="https://x.com/Aefryr"><i class="fa-brands fa-twitter"></i></a>
								<a href="https://www.linkedin.com/in/daanphi-nguyen-9a80a4367"><i class="fa-brands fa-linkedin"></i></a>
							</div>
						</div>
					</section>
				</section>
			</section>
		</main>
		<?php include("includes/footer.php");?>
	</body>
</html>
