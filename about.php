	<?php 
		require_once 'inc/db.php';
	if(isset($_POST['submit'])){ 

		$email=htmlspecialchars($_POST['email']);
		$avis=htmlspecialchars($_POST['avis']);
		if(!empty($_POST) ){
			 $req=$pdo->prepare('INSERT INTO avis(email,avis,date_avis) VALUES(?,?,CURRENT_DATE)');
		            $req->execute([$email,$avis]);               
		            header('Location: about.php?&env=ok');
		        }
		}
	 ?>
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		  <link rel="icon" type="image/png" href="images/logo.jpg" />

	<title>Qui sommes Nous?</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/responsive.css">
	</head>
	<body>

	<div class="super_container">
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
		 <?php
	             if(isset($_GET['env']) && $_GET['env'] == 'ok')
	             {
	              echo '<div class="alert alert-warning" role="alert">
	              Merci d avoir émis votre avis.
	              </div>';
	            }?>
		<!-- Intro -->

		<div class="col-xl-10 offset-1 col-md-8">
			<div class="card shadow" style="width: 100%,height: 100px; margin-top: 100px; padding-top: 10px">
			    <div class="inner im2">
					<div class="bienvenue text-center">Qui sommes Nous?</div><br>
					</div>
					<div class="card-body">
					<div class="bienvenue text-center">Ensemble pour l'Afrique</div>
					<br>
						
				</div>
			</div>					
		</div>

	<br>
		<div class="intro">
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
			<div id="into" class="container">
				<div class="row row-eq-height">

					<!-- Intro Content -->
					<div class="col-lg-6">
						<div class="intro_content">
							<div class="section_title text-center">
								<div>Association</div>
								<h1>Les objectfs de l'association</h1>
							</div>
							<div  class="intro_text">
								<p> Agir ensemble pour l'Afrique est notre ambition.</p><p>Elle est née d’une prise de conscience collective (étudiants de la Cité Internationale Universitaire et habitués de la chapelle des Franciscains sise dans le 14ème arrondissement de Paris) devant la gravité des violences survenues au Rwanda en 1994, puis en Côte d'ivoire en 1999.</p><p>Pour conjurer le sentiment d'impuissance et de culpabilité ressenti en pareille circonstance, le meilleur moyen était de nous engager dans le projet de développement durable de l'Afrique.</p><p>Des textes fondateurs sont venus consolider notre volonté d'agir ensemble pour l'Afrique par exemple :</p>
								<ul style="list-style: square; margin-left: 30px;">
									<li>le Message de Gorée sur la purification de la mémoire </li>
									<li> ou encore le Rapport d'information du Sénat sur l'accueil « immédiat et chaleureux » des étudiants et stagiaires étrangers en France, notamment les primo-arrivants individuels</li>
								</ul>
								<br>
								<h3>Les principes de l'association:</h3>
								<p> Nous avons la volonté de partager des connaissances, des technologies, des compétences et des expériences dans les projets de solidarité entre le Nord et le Sud, en particulier dans le cadre de l’accueil immédiat et chaleureux des étudiants africains en région parisienne.</p> 
								<p>Nous mettons régulièrement en commun nos réflexions en vue de promouvoir l’accès aux soins de qualité  pour tous en Afrique, via un système de mutualisation. Le groupe de travail dédié à la préparation des dix ans d’EPA a réfléchi sur le sujet et a découvert des initiatives publiques et privées intéressantes en cours en Afrique de l’Ouest. Ceci peut constituer un champ d’observation et d’échanges intéressant pour le conseil d’administration (CA).</p><br>
								<h3>Les régles d'adhésion:</h3>
								<p>Une personne devient membre d’EPA par l’adhésion à nos valeurs et le règlement de la cotisation annuelle.
								</p><p>Elle perd cette qualité par le défaut de paiement.Pour la suite se référer aux Statuts de l’Association en <a href="annexes.html">Annexe</a></p>
								<br>
							</div>
						</div>
					</div>

					<!-- Intro Image -->
					<div class="col-lg-6">
						<div class="intro_image">
							<div class="background_image">
								<img src="images/logo.jpg" style="border: solid 2px green;" alt="">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<h3>Projets aidés:</h3>
								<br>
								<ul style="list-style: square; margin-left: 30px;">
									<li> <p>"L'eau de la vie, l'eau de tous les espoirs" - Convention de Partenariat EPA Ensemble Pour l'Afrique /  groupe Total (18/12/2006). -Subvention d'entreprise à projet 2007 : l'eau de la vie = 5000€. Action humanitaire, projet de développement rural à Yokélé, Fada-Copé-Zone géographique : Afrique de l'Ouest, Pays : Togo;</p></li>
									<li> <p>Concert de Jazz et de musique classique 16/06/2007 (prestation offerte). Au profit de l'association Ensemble Pour l'Afrique pour le financement d'un projet de développement rural à Yokélé, (Togo). Sous la direction de M. Cyril GUIGNIER, professeur de musique et membre des "Violons de France"...</p></li>
									<li><p>Projet de mise en place d'une structure d'accueil pour les étudiants et stagiaires de passage à Paris et sa Région en partenariat avec la Maison des Associations de Paris 14 - 1ère ébauche 08/08/2008 (document à venir par courriel).</p></li>
									<li><p>Projet présenté au Conseil d'Arrondissement de Paris 14, réuni en formation CICA (élus municipaux et associations)  le 06/12/2012. Présenté à l'Adjoint du Maire de Paris Chargé de la Vie Etudiante - en vue d'intégrer la plateforme d'Accueil et de Service de la Ville de Paris, du CROUS et la Cité Universitaire internationale de Paris le 23/06/2013.</p></li>
								</ul>
							</div>
							<div class="col-lg-5 offset-1">
								<h3>Nombre d'étudiants étrangers aidés:</h3>
								<p>Nous n'avons pas encore établi de statistiques, faute de moyens, notamment en nombre de bénévoles  compétents.
								</p> <p>Au plan de la communication il s'agit davantage, jusqu'à présent, d'action de proximité. C'est-à-dire sans support publicitaire ou médiatique. De plus notre stratégie tend plutôt  à faire connaître et à privilégier les moyens existants, notamment à partir de la Plateforme d'accueil et de service pour les étudiants du monde. Nous espérons changer notre stratégie grâce au futur portail numérique; il doit nous permettre de développer notre produit cible "l'accueil immédiat et chaleureux".</p><p>Ceci étant EPA est sollicitée, actuellement, par une vingtaine de personnes davantage par relation : connaissances, familles, d'autres associations du 14ème, des étudiants. Les demandes concernent l'information générale, la recherche de logement, d'emploi étudiant, de stage en entreprise etc.</p>
							</div>
				<!-- intro fin -->
				</div>
			</div>
		</div>


	<!-- avis -->
	<div class="container bienvenue" style="margin-bottom: 10px; height: 200px;font-size: 1.5rem">
		<div class="form-row">
						<div class="form-group col-md-4 ">
							<form method="post">
								<label for=""> Email *  </label>
								<!--ici required indique que le champ est obligatoire -->
								<input type="email" name="email" placeholder="Entrez votre mail" class="form-control" required="" />
							</div>
							<div class="form-group col-md-4 offset-1">
								<label for="">Avis </label>
								<!--ici required indique que le champ est obligatoire -->
								<textarea name="avis" placeholder="Entrez votre avis" rows="3" cols="40" class="form-control" required=""></textarea>
							</div>	
							<div class="form-group col-md-2 offset-1">
								<button type="submit" name="submit" class="btn btn-primary"> Envoyer</button>	
							</div>	
				</div>
				
			</form>
			</div>
		</div>
		<!-- Offering -->

		<div class="conteneur">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section_title text-center">
							<div>Découvertes</div>
							<h1>Découvrez nos projets et travaux</h1>
						</div>
					</div>
				</div>
				<br>
				<div class="row offering_row">
					
					<!-- Offer Item -->
					<div class="col-xl-4 col-md-6">
						
							<div class="card shadow" style="width: 20rem,height: 30em">
									<div class="inner im2">
								 		<img class="card-img-top" src="images/togo.jpg" alt="">
								 	</div>
								 <div class="card-body">
								  	<p>Projets au TOGO</p>
									<p class="card-text"><a href="projets.html"> cliquez ici</a> </p>
								 </div>
							</div>
							
					</div>

					<div class="col-xl-4 col-md-6">
						<div class="card shadow" style="width: 20rem,height: 30em">
							<div class="inner im2">
								 <img class="card-img-top" src="images/fr.jpg" alt="">
								 	</div>
								 <div class="card-body">
								  	<p>Projets en France</p>
									<p class="card-text"><a href="projets.html"> cliquez ici</a> </p>
							 </div>
						</div>
					</div>

					<div class="col-xl-4 col-md-6">
						<div class="card shadow" style="width: 20rem,height: 30em">
									<div class="inner im2">
								 		<img class="card-img-top" src="images/im6.jpg" alt="">
								 	</div>
								 <div class="card-body">
								  	<p>Nos évènements </p>
									<p class="card-text"><a href="projets.html"> cliquez ici</a> </p>
								 </div>
							</div>			
					</div>
					</div>
				</div>
			</div>
			<br><br>

<br><br><br><br><br><br>
		<!-- Footer -->
	<div class="container">	
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

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/menu.js"></script>
	<script src="styles/bootstrap-4.1.2/popper.js"></script>
	<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>>
	<script src="plugins/jquery-ui.js"></script>
	</body>
	</html>