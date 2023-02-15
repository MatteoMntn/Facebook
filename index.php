<?php		

							error_reporting(E_ALL);
							ini_set("display_errors", 1);

						
			    

						if(filter_input(INPUT_POST, 'btnPost') && empty($_FILES))
						{
							var_dump($_FILES);
							foreach ($_FILES["userfile"]["error"] as $key => $error) {
							$error = false;
							$fileTmpName = $_FILES['userfile']['tmp_name'][$key];
							$uploads_dir = 'img/';
							$imageInfo = getimagesize($fileTmpName);
							
							$name = basename($_FILES["userfile"]["name"][$key]);
							  if (!$imageInfo === false) {
							
								
								move_uploaded_file($fileTmpName, $uploads_dir . uniqid('', true) . $name);
								}
						}
					}
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
									<a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
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

					<div class="padding">
						<div class="full col-sm-9">

							<!-- content -->
							<div class="row">

								<!-- main col left -->
								<div class="col-sm-5">

									<div class="panel panel-default">
										<div class="panel-thumbnail"><img src="assets/img/roadhogpatch.jpg" class="img-responsive"></div>
										<div class="panel-body">
											<p class="lead">Patch de roadhog</p>
											<p>400000000000000000000 Followers, 13 Posts</p>

											<p>
												<img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">
											</p>
										</div>
									</div>


									<div class="panel panel-default">
										<div class="panel-heading"><a href="#" class="pull-right">View all</a>
											<h4>Bootstrap Examples</h4>
										</div>
										<div class="panel-body">
											<div class="list-group">
												<a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Modal / Dialog</a>
												<a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Datetime Examples</a>
												<a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Data Grids</a>
											</div>
										</div>
									</div>

									<div class="well">
										<form class="form-horizontal" role="form">
											<h4>What's New</h4>
											<div class="form-group" style="padding:14px;">
												<textarea class="form-control" placeholder="Update your status"></textarea>
											</div>
											<button class="btn btn-primary pull-right" type="button">Post</button>
											<ul class="list-inline">
												<li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
												<li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
												<li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
											</ul>
										</form>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading"><a href="#" class="pull-right">View all</a>
											<h4>More Templates</h4>
										</div>
										<div class="panel-body">
											<img src="assets/img/150x150.gif" class="img-circle pull-right"> <a href="#">Free @Bootply</a>
											<div class="clearfix"></div>
											There a load of new free Bootstrap 3
											ready templates at Bootply. All of these templates are free and don't
											require extensive customization to the Bootstrap baseline.
											<hr>
											<ul class="list-unstyled">
												<li><a href="http://usebootstrap.com/theme/facebook">Dashboard</a></li>
												<li><a href="http://usebootstrap.com/theme/facebook">Darkside</a></li>
												<li><a href="http://usebootstrap.com/theme/facebook">Greenfield</a></li>
											</ul>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4>What Is Bootstrap?</h4>
										</div>
										<div class="panel-body">
											Bootstrap is front end frameworkto
											build custom web applications that are fast, responsive &amp; intuitive.
											It consist of CSS and HTML for typography, forms, buttons, tables,
											grids, and navigation along with custom-built jQuery plug-ins and
											support for responsive layouts. With dozens of reusable components for
											navigation, pagination, labels, alerts etc.. </div>
									</div>



								</div>

								<!-- main col right -->
								<div class="col-sm-7">

									<div class="well">
										<form class="form">
											<h4>Sign-up</h4>
											<div class="input-group text-center">
												<input class="form-control input-lg" placeholder="Enter your email address" type="text">
												<span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span>
											</div>
										</form>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading"><a href="#" class="pull-right">View all</a>
											<h4>Bootply Editor &amp; Code Library</h4>
										</div>
										<div class="panel-body">
											<p><img src="assets/img/150x150.gif" class="img-circle pull-right"> <a href="#">The Bootstrap Playground</a></p>
											<div class="clearfix"></div>
											<hr>
											Design, build, test, and prototype
											using Bootstrap in real-time from your Web browser. Bootply combines the
											power of hand-coded HTML, CSS and JavaScript with the benefits of
											responsive design using Bootstrap. Find and showcase Bootstrap-ready
											snippets in the 100% free Bootply.com code repository.
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading"><a href="#" class="pull-right">View all</a>
											<h4>Stackoverflow</h4>
										</div>
										<div class="panel-body">
											<img src="assets/img/150x150.gif" class="img-circle pull-right"> <a href="#">Keyword: Bootstrap</a>
											<div class="clearfix"></div>
											<hr>

											<p>If you're looking for help with Bootstrap code, the <code>twitter-bootstrap</code> tag at <a href="http://stackoverflow.com/questions/tagged/twitter-bootstrap">Stackoverflow</a> is a good place to find answers.</p>

											<hr>
											<form>
												<div class="input-group">
													<div class="input-group-btn">
														<button class="btn btn-default">+1</button><button class="btn btn-default"><i class="glyphicon glyphicon-share"></i></button>
													</div>
													<input class="form-control" placeholder="Add a comment.." type="text">
												</div>
											</form>

										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading"><a href="#" class="pull-right">View all</a>
											<h4>Portlet Heading</h4>
										</div>
										<div class="panel-body">
											<ul class="list-group">
												<li class="list-group-item">Modals</li>
												<li class="list-group-item">Sliders / Carousel</li>
												<li class="list-group-item">Thumbnails</li>
											</ul>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-thumbnail"><img src="assets/img/desitiny2.png" class="img-responsive"></div>
										<div class="panel-body">
											<p class="lead">Bientot le nouveau dlc</p>
											<p>12222222222 Followers, 83 Posts</p>

											<p>
												<img src="assets/img/photo.jpg" height="28px" width="28px">
												<img src="assets/img/photo.png" height="28px" width="28px">
												<img src="assets/img/photo_002.jpg" height="28px" width="28px">
											</p>
										</div>
									</div>

								</div>
							</div><!--/row-->

							<div class="row">
								<div class="col-sm-6">
									<a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a> <small class="text-muted">|</small> <a href="#">Google+</a>
								</div>
							</div>

							<div class="row" id="footer">
								<div class="col-sm-6">

								</div>
								<div class="col-sm-6">
									<p>
										<a href="#" class="pull-right">�Copyright 2013</a>
									</p>
								</div>
							</div>

							<hr>

							<h4 class="text-center">
								<a href="http://usebootstrap.com/theme/facebook" target="ext">Download this Template @Bootply</a>
							</h4>

							<hr>


						</div><!-- /col-9 -->
					</div><!-- /padding -->
				</div>
				<!-- /main -->

			</div>
		</div>
	</div>
	<!--post modal-->
	<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
					Update Status
				</div>
				
				<form class="form center-block" enctype="multipart/form-data" action="#" method="POST">
				<div class="modal-body">

					<!--Form utiliser pour le post d'image  -->
					

				
						<div class="form-group">
							<textarea class="form-control input-lg" autofocus="" placeholder="Que voulez-vous partager ?"></textarea>
						</div>
				</div>
				<div class="modal-footer">
					 <input type="file" id="userfile" name="userfile[]" accept="image/png, image/gif, image/jpeg"  onchange="fileValidation()" multiple>

					<div>
						<input	type="submit" id="btnPost" name="btnPost" value="Post" >
						
					</div>
				
					
					<script>
					
						function onOrOffButton(){

							console.log("rgehuj");
							var filePath = document.getElementById('userfile').files;

							if(filePath.length == 0)
							{
								document.getElementById("btnPost").setAttribute("disabled", "");
							}
							else
							{
								document.getElementById("btnPost").removeAttribute("disabled");
							}
						
						}


						function fileValidation() {
							
							var fileInput = document.getElementById('userfile');

							const arrayFinal = ["blbl.jpg"];

							var filePath = fileInput.files;
							

							// Allowing file type
							var allowedExtensions =
								/(\.jpg|\.jpeg|\.png|\.gif|\.jfif)$/i;
							var sizeTotal = 0;
							for (let index = 0; index < filePath.length; index++) {
								
								sizeTotal += filePath[index].size;

								if (!allowedExtensions.exec(filePath[index].name) ) {
									
									alert('Type de fichier invalide');
									document.getElementById("btnPost").setAttribute("disabled", "");
									break;
								}
								if( (filePath[index].size > 3000000))
								{
									alert('Un des fichier est trop volumineux (max 3Mb)');
									document.getElementById("btnPost").setAttribute("disabled", "");
									break;
								}
								if(sizeTotal > 70000000)
								{
									alert('La somme total de tous les fichiers est trop volumineuse (max 70Mb)');
									document.getElementById("btnPost").setAttribute("disabled", "");
									break;
								}
								else
								{
									document.getElementById("btnPost").removeAttribute("disabled");
									
								}

							
							
							}
							
						
						}
					</script>
				
				
				</div>
			</div>
		</div>
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