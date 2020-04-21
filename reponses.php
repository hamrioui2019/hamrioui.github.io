<?php 
require_once 'inc/db.php';?>

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
	            	<div class="logo">
	            		<a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="100" height="100" style="margin-right: 400px">
	            		</a>
	            	</div>
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
						</li>
						<li class="nav-item">
							<a class="nav-link"  href="adhesion.php" style="margin-right: 5px">Adhésion</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
	</div>

	<div id="scroll">
		<nav class="fixed-bottom text-right" style="width: 100%">
	  		<a class="nav-item" href="#top" title="haut de page"> 
	    		<img src="images/ret.jpg" width="90" height="90" alt="">
	  		</a>
		</nav>     
	</div>
	<br>
	<div class="bienvenue text-center">Forum</div> <br>
	<main class="py-4">
        <div class="container">
            <div class="row">
            	 <?php
            if(isset($_GET['reponse']) && $_GET['reponse'] == 'ok')
             {
              echo '<div class="alert alert-success container" role="alert">
              Vous avez répondu au message.
              </div>';
            }
            ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">Discussion</div>
                    	<div class="card-body">
                        	<table class="table table-responsive table-hover">
                                <thead>
                                    <th>User</th>
                                    <th>Titre</th>
                                    <th>Text</th>
                                    <th>Date</th>
                                    <th></th>
                                </thead>

                                <tbody>
							       <?php


							        	$req1 = "SELECT * FROM forum_sujets where id=".$_GET['id_sujet'];
							        	$exe1 = $pdo->prepare($req1);
									    $exe1->execute();

							        	while($row = $exe1->fetch()){

							        		echo '<tr>';

							        		echo '<th scope="row">';
							        		echo $row['pseudo']."			";
							        		echo '</th>';

							        		echo '<th scope="row">';
							        		echo $row['titre']."			";
							        		echo '</th>';

							        		echo '<th scope="row">';
							        		echo $row['message']."			";
							        		echo '</th>';

							        		echo '<th scope="row">';
							        		echo $row['date_ajout']."			";
							        		echo '</th>';
							        	}


							        	$req2 = "SELECT * FROM forum_reponses where forum_sujet=".$_GET['id_sujet']." order by id";
									    $exe2 = $pdo->prepare($req2);
									    $exe2->execute();
							        	while($row2 = $exe2->fetch()){

							        		echo '<tr>';

							        		echo '<th scope="row">';
							        		echo $row2['pseudo']."			";
							        		echo '</th>';

							        		echo '<th scope="row">';
							        		echo "			";
							        		echo '</th>';

							        		echo '<th scope="row">';
							        		echo $row2['message']."			";
							        		echo '</th>';

							        		echo '<th scope="row">';
							        		echo $row2['date_reponse']."			";
							        		echo '</th>';

							        		echo '</tr>';
							        	}
						        	?>

						        	<form action="inserer_reponse.php/?id_sujet=<?php echo $_GET['id_sujet'];?>" method="post">
						        		<tr>
	                                		<input class="form-control" id="main" name="mail" placeholder="Saisissez votre adresse mail"required="Veuillez completer ce champs"></input>
	                                	</tr>

	                                	<tr>
	                                		<td>
	                                			<input class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" rows="2" cols="10" required="Veuillez completer ce champs"></input>
	                                		</td>

	                                		<td></td>

											<td>
		                                		<textarea class="form-control" id="text" name="text" placeholder="TEXT"rows="5" cols="70" required="Veuillez completer ce champs"></textarea>
	                                		</td>

	                                		<td>
	                                			<div class="form-group col-md-4">
													<button class="btn btn-success" type="submit">Repondre</button>
												</div>
	                                		</td>  
	                                	</tr>
	                                </form>
                                </tbody>
                        	</table>
                		</div>
                	</div>
            	</div>
        	</div>
        </div>
    </main>
	<?php require 'inc/footer.php';?>

	<script src="js/menu.js"></script>
	<script src="styles/bootstrap-4.1.2/popper.js"></script>
	<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
	<script src="plugins/jquery-ui.js"></script>
	<script src="js/index.js"></script>
</body>
</html>