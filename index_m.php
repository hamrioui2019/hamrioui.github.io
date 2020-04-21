<?php 
    session_start();
    require 'inc/db2.php';
    $id=$_GET['session'];
 ?>
<!DOCTYPE html>
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

<div class="super_container">
    <header class="header">
        <nav style="font-size: 1.1rem" class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">
            <div class="logo"><a class="nav-link" href=<?php echo "index.php?session=".$id?>><img class="logo_1" src="images/logo.jpg" alt="" width="150" height="150" style="margin-right: 600px"></a></div>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav active">
       			<li class="nav-item">
			  	<a class="nav-link" href=<?php echo "index.php?session=".$id?>> Accueil</a>
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
					<div class="dropdown right">
					  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Mon compte
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    <a class="dropdown-item" href=<?php  switch ($id) {
                            case '1':
                                echo "presidente.php?session=".$id;
                                break;
                            case '2':
                                echo "secretaire.php?session=".$id;
                                break;
                            case '3':
                                echo "compta.php?session=".$id;
                                break;
                            case '4':
                                echo "accueil_etudiant.php?session=".$id;
                                break;
                            default:
                                # code...
                                break;
                        };?>>Profil <span class="sr-only">(current)</span></a>
					    <a class="dropdown-item" href="logout.php">Déconnexion</a>
					  </div>
					</div>
				</li>              
            </ul>
        </div>
    </div>
	</nav>
</header>

	
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
		<!-- <div class="section_title text-center">
						<div>Ensemble</div>
						<br>
							<h5>Pour </h5><br>
							<h1>l'Afrique <i
				class="fa fa-globe-africa"></i></h1>
					</div> 
		<div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
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
					<div class="intro_text text-center">
						<p>Agir ensemble pour l'Afrique est notre ambition.

						Elle est née d’une prise de conscience collective (étudiants de la Cité Internationale Universitaire et habitués de la chapelle des Franciscains sise dans le 14ème arrondissement de Paris) devant la gravité des violences survenues au Rwanda en 1994, puis en Côte d'ivoire en 1999.

						Pour conjurer le sentiment d'impuissance et de culpabilité ressenti en pareille circonstance, le meilleur moyen était de nous engager dans le projet de développement durable de l'Afrique.</p>
						<button class="btn btn-primary" href="about.html"> en savoir plus</button>
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
				<div class="col-xl-6 order-xl-1 order-2">
					<div class="rooms_slider_container">
						<div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
							<ol class="carousel-indicators">
								<li class="active" data-slide-to="0" data-target="#carouselExampleIndicators"></li>
								<li data-slide-to="1" data-target="#carouselExampleIndicators"></li>
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active"><img alt="First slide" class="d-block w-100" src="images/im4.jpg"></div>
								<div class="carousel-item"><img alt="Second slide" class="d-block w-100" src="images/im5.png"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- Rooms Content -->
				<div class="col-xl-6 order-xl-1 order-2">
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

			</div>
		</div>
	</div>

	<!-- sSERVICES -->
	<br>
	<div class="rooms_left container_wrapper">
		<div class="container">
			<div class="row row-eq-height">
				
				<!-- Rooms Content -->
				<div class="col-xl-6">
					<div class="rooms_left_content">
						<div class="section_title">
							<div>Join</div>
						</div>
						<div class="rooms_text">
							<p>Conditions d'adhésion</p>
							<p>Une personne devient membre d’EPA par l’adhésion à nos valeurs et le règlement de la cotisation annuelle.</p>
						</div>
						
						<div class="button rooms_button"><a href="about.html">plus</a></div>
					</div>
				</div>

				<!-- Rooms Image -->
				<div class="col-xl-6 order-xl-1 order-2">
					<div class="rooms_slider_container">
						<div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
							<ol class="carousel-indicators">
								<li class="active" data-slide-to="0" data-target="#carouselExampleIndicators"></li>
								<li data-slide-to="1" data-target="#carouselExampleIndicators"></li>
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active"><img alt="First slide" class="d-block w-100" src="images/im3.png"></div>
								<div class="carousel-item"><img alt="Second slide" class="d-block w-100" src="images/im2.jpg"></div>
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

	<!-- Footer -->
				<hr>
				<div class="bienvenue text-center">Coordonnées</div> <br>
				<hr>

	<footer class="footer">
		<div class="container">
			<div class="row offering_row">
				
				<!-- coord -->
				<div class="col-xl-4 col-md-6">
					
						<div class="card shadow" style="width: 20rem,height: 30em">
								<div class="inner im">
							 		<img class="card-img-top" src="images/check.png" alt="">
							 	</div>
							  <div class="card-body">
							  	<p>Le siège social est fixé  au 10, Avenue Paul Appel 75014 Paris – France</p>
							  </div>
							</div>
						
				</div>

				<!-- coord -->
				<div class="col-xl-4 col-md-6">
					<div class="card shadow" style="width: 20rem,height: 40em;">
							  <div class="inner im">
							 		<img class="card-img-top" src="images/siret.jpg" alt="">
							 	</div>
							  <div class="card-body">
								<p class="card-text">Identification INSEE : N° de SIRET 484 104237 00017, Code APE  913E</p>
							  </div>
							</div>
						
				</div>
				<div class="col-xl-4 col-md-6">
					<div class="card shadow" style="width: 20rem,height: 40em;">
							  <div class="inner im">
							 		<img class="card-img-top" src="images/mail.png" alt="">
							 	</div>
							  <div class="card-body">
								<p class="card-text"> vous pouvez également nous contacter par mail au :contact@epa.com</p>
							  </div>
							</div>
						
				</div>
			</div>
		</div>
		<div class="text-center">
			<div class="footer_content">
				<p>&copy; Copyrights <strong>odile hamrioui - WEB Factory 2K20</strong>. All Rights Reserved</p> 
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