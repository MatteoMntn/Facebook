<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once("function.php");
uploadFile();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Facebook le vrai</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/facebook.css" rel="stylesheet">
</head>

<body>

	<div class="wrapper">
		<div class="box"> 
			<div class="row row-offcanvas row-offcanvas-left">
				<!-- main right col -->
				<div class="column col-sm-10 col-xs-11" id="main">

					<!-- top nav -->
					<div class="navbar navbar-blue navbar-static-top">
						<div class="navbar-header">
							<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<img src="./assets/img/Facebook_logo.png" alt="Facebook logo" width="40">
						</div>
						<nav class="collapse navbar-collapse" role="navigation">
							<form class="navbar-form navbar-left">
								<div class="input-group input-group-sm" style="max-width:360px;">
									<input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
									<div class="input-group-btn">
										<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
									</div>
								</div>
							</form>
							<ul class="nav navbar-nav">
								<li>
									<a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
								</li>
								<li>
									<a href="#postModal" onclick='onOrOffButton()' role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
								</li>
								<li>
									<a href="#postEdition" role="button" data-toggle="modal"><i class="glyphicon glyphicon-pencil"></i> Edition</a>
								</li>
								<li>
									<a href="#"><span class="badge">badge</span></a>
								</li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="./assets/img/paypal.png" alt="" width="20"></a>
									<ul class="dropdown-menu">
										<li><a href="">Jsp1</a></li>
										<li><a href="">Jsp2</a></li>
										<li><a href="">Jsp3</a></li>
										<li><a href="">Jps4</a></li>
										<li><a href="">Jps5</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
					<!-- /top nav -->

				
		
		</div>
		</form>
		<script type="text/javascript" src="assets/js/jquery.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('[data-toggle=offcanvas]').click(function() {
					$(this).toggleClass('visible-xs text-center');
					$(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
					$('.row-offcanvas').toggleClass('active');
					$('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
					$('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
					$('#btnShow').toggle();
				});
			});
		</script>
</body>

</html>