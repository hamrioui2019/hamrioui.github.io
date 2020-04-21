	<?php 
	require_once 'inc/db.php';
	if(isset($_POST['submit'])){ 

		$email=htmlspecialchars($_POST['email']);
		$avis=htmlspecialchars($_POST['avis']);
		if(!empty($_POST) ){
			$req=$pdo->prepare('INSERT INTO avis(email,avis,date_avis) VALUES(?,?,CURRENT_DATE)');
			$req->execute([$email,$avis]);               
			header('Location: index.php?&env=ok');
		}
	}
	?>
	<!DOCTYPE html>
	<link rel="icon" type="image/png" href="images/logo.jpg" />

	<html lang="fr">
	<head>
		<title>Ensemble pour l'Afrique</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
		<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
		<link rel="stylesheet" type="text/css" href="styles/responsive.css">
	</head>
	<body>
		<div class="super_container" id="top">
			<header class="header1" style="background-color: white">
				<nav style="font-size: 1.1rem" class="navbar navbar-expand-lg navbar-light bg-light">
					<a class="navbar-brand" href="#">
						<div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="100" height="100" style="margin-right: 400px"></a></div>
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavDropdown">
						<ul class="navbar-nav active">
							<li class="nav-item">
								<a class="nav-link" href="index.php"> Accueil</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="about.php">Qui sommes nous?</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="projets.html">Projets</a>
							</li>
							<li  class="nav-item">
								<a class="nav-link" href="forum.php">Forum</a>
							</li>             
							<li class="nav-item">
								<a class="nav-link" href="login.php"> Adhérent</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="login_admin.php">Membre</a>
								<li class="nav-item">
									<a class="nav-link"  href="adhesion.php" style="margin-right: 5px">Adhésion</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</header>

			<div id="scroll">
				<nav class="fixed-bottom text-right" style="width: 100%">
					<a class="nav-item" href="#top" title="haut de page"> 
						<img src="images/ret.jpg" width="90" height="90" alt="">
					</a>
				</nav> 

			</div>
			<!-- Home -->
			<div class="home">
				<div class="jumbotron jumbotron-fluid" style="background-image: url(../images/im1.jpg);
				background-size: cover;
				background-repeat: no-repeat;
				color: black;
				text-align: center;
				height: 400px;
				">
				<div class="section_title text-center">
					<div>Ensemble</div>
					<br>
					<h5>Pour </h5><br>
					<h1>l'Afrique <i
						class="fa fa-globe-africa"></i></h1>
					</div> 
		<!-- <div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
			<ol class="carousel-indicators">
				<li class="active" data-slide-to="0" data-target="#carouselExampleIndicators"></li>
				<li data-slide-to="1" data-target="#carouselExampleIndicators"></li>
				<li data-slide-to="2" data-target="#carouselExampleIndicators"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="overlay-image">
						<a href="#"><img alt="First slide" class="d-block w-100" src="images/im1.jpg"></a>
	            <div class="hover">
				  	<div class="text">EPA</div>
				</div>

					</div>
					</div>
				<div class="carousel-item"><img alt="Second slide" class="d-block w-100" src="images/im7.jpeg"></div>
				<div class="carousel-item"><img alt="Third slide" class="d-block w-100" src="images/im6.jpg"></div>
			</div>
		</div>
		
	</div> -->
</div>
<!-- Intro -->

<div class="intro">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 col-lg-6">
				<div class="section_title text-center">
					<div>EPA</div>
					<br>
					<h5>Présentation</h5><br>
					<h1>Que représente EPA?</h1>
				</div> 
			</div>
			<div class="col-xl-6 col-lg-6">
				<div class="section_title text-center">
					<div>Liens</div>
					<br>
					<h5>Quelques liens utiles</h5><br>
					<h1>Consultez:</h1>
				</div> 
			</div>
		</div>
		<div class="row intro_row">
			<div class="col-xl-6 col-lg-6">
				<div class="intro_text text-justify">
					<p>Agir ensemble pour l'Afrique est notre ambition.

						Elle est née d’une prise de conscience collective (étudiants de la Cité Internationale Universitaire et habitués de la chapelle des Franciscains sise dans le 14ème arrondissement de Paris) devant la gravité des violences survenues au Rwanda en 1994, puis en Côte d'ivoire en 1999.

					Pour conjurer le sentiment d'impuissance et de culpabilité ressenti en pareille circonstance, le meilleur moyen était de nous engager dans le projet de développement durable de l'Afrique.</p>
					<button class="btn btn-primary" href="about.php"> en savoir plus</button>
					<br><br>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6">
				<ul>
					<li><a href="http://agencedys.com/wp-pass/">Programme d’Appui Au développement des Strategies mutualiste de Santé Informations et Contacts</a></li>
					<li><a href=" http://www.uam-afro.org/index.html">UAM : Union de la Mutualité Africaine Université et Économie Sociale et Solidaire - 2015 </a></li>
					<li><a href=" www.ove-national.education.fr">OVE : observatoire national de la vie Etudiante –</a></li>
					<li><a href="http://www.fondationgoree.org/memorial">Message de Gorée Purification de la Mémoire Pour une Humanité nouvelle (07/10/2003) (XIIIème SCEAM)</a></li>
					<li><a href="http://www.rfi.fr/emission/20150108-togo-conducteurs-taxi-moto-mutuelle-transport-emploi-travail-cooperation-developpement">Une mutuelle innovante au Togo pour les motos taxis</a></li>
				</ul>
			</div>
			<div class="header_link text-center"></div>
		</div>
	</div>


	<!-- projects -->

	<div class="rooms_right container_wrapper">
		<div class="container">
			<div class="row row-eq-height">

				<!-- project Image -->
				
				<!-- Rooms Content -->
				<div class="col-xl-4  order-xl-1 order-2">
					<div class="rooms_right_content">
						<div class="section_title">
							<div class="Bienvenue">
							New</div>
						</div>
						<div class="rooms_text">
							<span>Nos projets</span>
							<p>Nous avons depuis plusieurs années participé à de nombreux projets de développement en Afrique.
							les résultats ont toujours été positifs grace à la contribution de nos membres-adhérents mais aussi au soutient financier de nos donateurs...</p>
						</div>

						<div class="button rooms_button"><a href="projets.html">plus</a></div>
					</div>
				</div>


				<!-- Rooms Content -->
				<div class="col-xl-4">
					<div class="rooms_left_content">
						<div class="section_title">
							<div>Join</div>
						</div>
						<div class="rooms_text">
							<p>Conditions d'adhésion</p>
							<br><br><br>

							<p style="color: black">Une personne devient membre d’EPA par l’adhésion à nos valeurs et le règlement de la cotisation annuelle.</p>
							<br><br><br>
						</div>
						
						<div class="button rooms_button"><a href="about.php">plus</a></div>
					</div>
				</div>
				<!-- Rooms Image -->
				<div class="col-xl-4 order-xl-1 order-2">
					<div class="rooms_slider_container">
						<div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
							<ol class="carousel-indicators">
								<li class="active" data-slide-to="0" data-target="#carouselExampleIndicators"></li>
								<li data-slide-to="1" data-target="#carouselExampleIndicators"></li>
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active"><img alt="First slide" class="d-block w-100" src="images/im4.png"></div>
								<div class="carousel-item"><img alt="Second slide" class="d-block w-100" src="images/im5.png"></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<br>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<div class="bienvenue">Dons</div>
						<br>
						<h3>Ils nous ont fait confiance</h3><br>
						<h1>Nos précieux donateurs</h1>
					</div> 
				</div>
			</div>
		</div>

		<br><br>	
		<div id="dg">
			<div class="container">
				<div class="row centered">
					<br>
					<div class="col-xl-4 order-xl-1 order-2">
						<div class="overlay-image">
							<a href="#"><img class="image" src="images/im4.png" alt=""></a>
							<div class="hover">
								<div class="text">Communauté</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4 order-xl-1 order-2">
						<div class="overlay-image">
							<a href="#"><img class="image" src="images/im5.png" alt=""></a>
							<div class="hover">
								<div class="text">Adhérents</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4 order-xl-1 order-2">          
						<div class="overlay-image">
							<a href="#"><img class="image" src="images/total.png"alt=""></a>
							<div class="hover">
								<div class="text">Total</div>
							</div>
						</div>
					</div>
					<br> <br>
					<div class="col-lg-12"><br><br></div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<br><br>
			<hr>
			<br>
			<div class="container bienvenue" style="margin-bottom: 10px; height: 200px; font-size: 1.5rem">
				<div class="form-row">
					<div class="form-group col-md-4 ">
						<form method="post">
							<label for=""> Email *  </label>
							<!--ici required indique que le champ est obligatoire -->
							<input type="email" name="email" placeholder="Entrez votre mail" class="form-control" required="" />
						</div>
						<hr>
						<div class="form-group col-md-4 offset-1">
							<label for=""> Votre avis </label>
							<!--ici required indique que le champ est obligatoire -->
							<textarea name="avis" placeholder="Entrez votre Prénom" rows="3" cols="40" class="form-control" required=""></textarea>
						</div>	
						<hr>
						<div class="form-group col-md-2 offset-1">
							<button type="submit" name="submit" class="btn btn-primary"> Envoyer</button>	
						</div>	
					</div>

				</form>
			</div>
		</div>

		<!-- Footer -->
		<hr>
<br><br><br>
<!-- 		<div class="bienvenue text-center">Coordonnées</div> <br>
 -->
		<hr>
		<footer class="new_footer_area bg_color">
			<div class="new_footer_top">
				<div class="container">
					<div class="footer_bg" style=" position: absolute;
				bottom: 0;
				background: url('http://droitthemes.com/html/saasland/img/seo/footer_bg.png') no-repeat scroll center 0;
				width: 100%;
				height: 266px;">
				<div class="footer_bg_one" style=" background: url('https://1.bp.blogspot.com/-mvKUJFGEc-k/XclCOUSvCnI/AAAAAAAAUAE/jnBSf6Fe5_8tjjlKrunLBXwceSNvPcp3wCLcBGAsYHQ/s1600/volks.gif') no-repeat center center;
				width: 330px;
				height: 105px;
				background-size:100%;
				position: absolute;
				bottom: 0;
				left: 30%;
				-webkit-animation: myfirst 22s linear infinite;
				animation: myfirst 22s linear infinite;"></div>
				<div class="footer_bg_two" style="background: url('https://1.bp.blogspot.com/-hjgfxUW1o1g/Xck--XOdlxI/AAAAAAAAT_4/JWYFJl83usgRFMvRfoKkSDGd--_Sv04UQCLcBGAsYHQ/s1600/cyclist.gif') no-repeat center center;
				width: 88px;
				height: 100px;
				background-size:100%;
				bottom: 0;
				left: 38%;
				position: absolute;
				-webkit-animation: myfirst 30s linear infinite;
				animation: myfirst 30s linear infinite;"></div>
			</div>
		</div>
		<br>
					<div class="row">
						<div class="col-lg-3 offset-1 col-md-6">
							<div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
								<h3 class="f-title f_600 t_color f_size_18">Menu</h3>
								<ul class="list-unstyled f_list">
									<li><a href="index.php">Accueil</a></li>
									<li><a href="projets.html">Projets</a></li>
									<li><a href="forum.php">Forum</a></li>
									<li><a href="adhesion.php">Adhésion</a></li>
									<li><a href="login.php">Connexion</a></li>
									<li><a href="login_admin.php">Membre</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
								<h3 class="f-title f_600 t_color f_size_18">Contact</h3>
								<ul class="list-unstyled f_list">
									<li>Identification INSEE : N° de SIRET 484 104237 00017, Code APE  913E</li>
									<li>Le siège social est fixé  au 10, Avenue Paul Appel 75014 Paris – France</li>
									<li>email:contact@epa.com</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 offset-1 col-md-6">
							<div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
								
								<div class="f_social_icon">
									<a href="#"><img src="images/logo.jpg" width="100" height="100"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
		<br>
		<div class="container text-center">
			<div class="row align-items-center">
				<div class="col-lg-12 col-sm-7">
					<p class="mb-0 f_400"><p>&copy; Copyrights <strong>odile hamrioui - WEB Factory 2K20</strong>. All Rights Reserved </p>
				</div>
				
			</div>
		</div>
	</footer>

</div>

<script src="js/menu.js"></script>
<script src="styles/bootstrap-4.1.2/popper.js"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="plugins/jquery-ui.js"></script>
<script src="js/index.js"></script>
</body>
</html>