<?php
	
	session_start();
	
	$link = mysqli_connect("shareddb1e.hosting.stackcp.net", "siteusers-3637bdb6", "hcldbp17mw", "siteusers-3637bdb6");	
	if(mysqli_connect_error()) {
		die("there was an error");
	}
		
	if(array_key_exists("logout", $_GET)){
		session_unset();
		setcookie ("email","", time() - 60*60);
		setcookie ("password","", time() - 60*60);
		$_COOKIE["email"] = "";
		$_COOKIE["password"] = "";
	}elseif(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
		$query = "SELECT `id` FROM `siteusers` WHERE email = '".mysqli_real_escape_string($link, $_COOKIE["email"])."' AND password = '".mysqli_real_escape_string($link, $_COOKIE["password"])."'";
		if(!mysqli_query($link, $query)){
			$_COOKIE["email"] = "";
			$_COOKIE["password"] = "";
		}else{
			$_SESSION["email"] = $_COOKIE["email"];
			$_SESSION["password"] = $_COOKIE["password"];
			setcookie ("nemail",$_SESSION["email"],time()+ (10 * 365 * 24 * 60 * 60));
		}
	}
	if(isset($_SESSION["email"]) && isset($_SESSION["password"])){
		$query = "SELECT `id` FROM `siteusers` WHERE email = '".mysqli_real_escape_string($link, $_SESSION["email"])."' AND password = '".mysqli_real_escape_string($link, $_SESSION["password"])."'";
		if(!mysqli_query($link, $query)){
			$_SESSION["email"] = "";
			$_SESSION["password"] = "";
		}
		setcookie ("nemail",$_SESSION["email"],time()+ (10 * 365 * 24 * 60 * 60));
		header("location: SignedIn/");
	}
	
	if(isset($_POST["subsEmail"])){
		$emailTo = $_POST["subsEmail"];
		$subject = "AWOL: Subscribtion";
		$body = "You have been subscribed to the AWOL mentoring program. We will contact you soon about details on our mentor program";
		$headers = "From: AWOL <awolservices@awol.tech>\r\n";
		$headers .= "Reply-To: AWOL <awolservices@awol.tech>\r\n"; 
		$headers .= "Return-Path: AWOL <awolservices@awol.tech>\r\n";
		$headers .='X-Mailer: PHP/' . phpversion();
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		mail($emailTo, $subject, $body, $headers);
	}

?>

<html lang="en">

	<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="icon" href="Awollogotab.ico">
	
	
    <title>AWOL - Home</title>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
	<style type="text/css">
	
		body{
			position:relative;
			background-color:#424242;
		}
				
		#home1{
			padding-top:130px;
			background-image: url(jumbobg.jpg);
			background-position: 0% 25%;
			background-size: cover;
			background-repeat: no-repeat;
			color: white;
			text-align:center;
		}
		
		#about1{
			background-image: url(jumbobg2.jpg);
			background-position: 0% 25%;
			background-size: cover;
			background-repeat: no-repeat;
			color: white;
		}
		
		#download1{
			background-color:#28A745;
			text-align:center;
			height:500px;
			margin-bottom:0;
		}
		
		.input-group{
			width:35%;
			margin: auto
		}
		
		.padding{
			padding:15px;
		}
		
		.center{
			margin: auto
		}
		
		.textCenter{
			text-align:center;
		}
		
		.white{
			color:white;
		}
		
		.borderWhite{
			border:1px white solid;
		}
		
		.lightGreen{
			color:#90EE90;
		}
		
		.cardPic{
			width:100%;
			height:150px;
		}
		
		#playstoreIcon{
			width:200px
		}
	
	</style>
	
	</head>
	
	<body data-spy="scroll" data-target="#topbar">
	
		<nav id="topbar" class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
		
			<a class="navbar-brand text-success" href="#home">AWOL</a>
			<button class="navbar-toggler border-success" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="nav nav-tabs nav-light mr-auto" role="tablist">
					<li class="nav-item">
						<a class="nav-link text-success" href="#home">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-success" href="#projects">Projects</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-success" href="#about">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-success" href="#download">Download</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-success" href="/Portfolio">Portfolios</a>
					</li>
				</ul>
				
				<form class="form-inline my-2 my-lg-0">
					<a class="btn btn-outline-success my-2 my-sm-0" href="SignIn.php">Sign In</a>
				</form>
			</div>
		</nav>
		
		<div id="home"></div>
		<form method="POST">
			<div id="home1" class="jumbotron">
				<p class="display-3 text-success">Our Mentoring Program</p>
				<p class="lead">This is the program that we made to help YOU get started</p>
				<hr class="my-4" color="#454545">
				<p class="lightGreen">Want to know more? Sign up with you'r Email</p>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">@</span>
					</div>
					<input type="email" class="form-control" name="subsEmail" placeholder="Your Email" aria-label="Username" aria-describedby="basic-addon1">
					<div class="ml-1">
						<button class="btn btn-success" type="submit" role="button">Sign Up</button>
					</div>
				</div>
				<div id="projects"></div>
			</div>
		</form>
				
		<div class="container">
		<h3 class="display-4 textCenter text-success">Projects</h3>
		<p class="lead center textCenter white">Here are a couple of projects that we have completed</p>
		</div>
		
		<div class="padding"></div>
		
		<div class="container">
			<div id="projects1" class="card-deck">
				<div class="card center border-success bg-dark" style="width: 18rem;">
					<img class="card-img-top cardPic" src="AWOLpic.jpg" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title text-success">AWOL Main Site</h5>
						<p class="card-text lightGreen">This is the first professional project that we took on. This site far from finished therefore we will be constantly updating it. So stay tuned!</p>
					</div>
				</div>
				<div class="card center border-warning bg-dark" style="width: 18rem;">
					<img class="card-img-top cardPic" src="reactionPic1.jpg" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title text-warning">Secret Diary</h5>
						<p class="card-texte" style="color:#F7F663;">While in Rob's course this is a project we took upon ourselves to test our skills and also to create a fun tool for you guys to enjoy.</p>
					</div>
				</div>
				<div class="card center bg-dark border-danger" style="width: 18rem;">
					<img class="card-img-top cardPic" src="codePlayer.jpg" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title text-danger">Code Player</h5>
						<p class="card-text" style="color:#E2704E;">This project was made while we were learning Jquery and is a great tool for anyone trying to test or learn HTML/CSS/Javascript.</p>
					</div>
				</div>
			</div>
		</div>
		
		<div id="about"></div>
		<div class="padding"></div>
		
		<div id="about1" class="jumbotron">
			<h1 class="display-3 text-success">About</h1>
			<hr class="my-4" color="#454545">
			<p class="lead">AWOL is an organization made by a group of university students who wants to bring their ideas and inventions to life. Currently, we take all freelance work and any projects for startups (email for inquiries). AWOL started as an idea that I had while I was in university. Eventually, as I started to invest more time into Web Development and App Development, I started to see that idea come to life. I approached many people and researched vigorously on how I could execute the idea. After overcoming many beginner's obstacles, I was able to gather a mass of people who are now as invested in my dream as I always have been - Talha (Founder/President)</p>
			<div class="form-inline">
				<p class="lightGreen">Want to know more?</p>
				<a class="btn btn-success mb-2 ml-2" href="#" role="button">More>></a>
			</div>
			<h1 class="display-3 text-success">Contact</h1>
			<hr class="my-4" color="#454545">
			<p class="lead">Office: 647-787-8881</p> 
			<p class="lead">Email for help: AWOLhelpservices@gmail.com</p>
			<p class="lead">Email for projects: AWOLwebservices@gmail.com</p>
		</div>	
		
		<div id="download"></div>
		<div class="padding"></div>
	
		<div id="download1" class="jumbotron">
			
			<h1 class="display-3 text-white mt-5">Download the App!</h1>
			<p class="lead text-white">Still in development and beta phase. Will be made public soon!</p>
			<a href=""><img id="playstoreIcon" src="googlePlay1.jpg"></a>
			
		</div>	
		
		<script type="text/javascript">
		
		
		
		</script>
		
	</body>
	
</html>