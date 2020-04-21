<?php 
session_start();
require_once 'inc/db.php';
$id=$_GET['session'];
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
	
	<div class="bienvenue text-center">Forum</div> <br>

		<form action="recherche_msg.php" method="post">
 
			<div class="row">
	                <div class="col-md-8">
						<div class="form-group col-md-6">
						    <select id="inputState" name="theme" class="form-control">
						        <option selected>Veuillez choisir un thème</option>
									<?php 
								    // recuperation des questions d'une certaine categorie
								    $req = "SELECT * FROM themes";
								    $exe = $pdo->prepare($req);
								    $exe->execute();
								    while($data = $exe->fetch())
								    {
								       	echo '<option value="'.$data['id_theme'].'">'.$data['nomTheme'].'</option>';
								    }
								?>
						     
						    </select>
					  	</div>
					 </div>

					 <!-- a voir apres -->
				 	<div class="form-group col-md-4">
							    <input class="mr-sm-5" name="search" type="text" placeholder="Search">
							    <button class="btn btn-success" type="submit">Search</button>
			 		</div>	
		    	</div>
	   	</form>
	</div>
		  <main class="py-4">
        <div class="container">
            <div class="row">
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
							        	if ($_POST['theme']) {
							        		if(empty($_POST['search'])){
							        			$req = "SELECT * FROM forum_sujets order by date_ajout desc";
							        		}else{
							        			$search = "'%".$_POST['search']."%'";
									    		$req = "SELECT * FROM forum_sujets where message like ".$search." order by date_ajout desc";
							        		}	
							        	}else{
								        	if(empty($_POST['search'])){
										    	$req = "SELECT * FROM forum_sujets where id_theme =".$_POST['theme']." order by date_ajout desc";
										    }else{
										    	$search = "'%".$_POST['search']."%'";
										    	$req = "SELECT * FROM forum_sujets where id_theme =".$_POST['theme']." AND message like ".$search." order by date_ajout desc";
										    }
										}

									    $exe = $pdo->prepare($req);
									    $exe->execute();
							        	while($row = $exe->fetch()){

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

							        		$lien = 'reponses.php?id_sujet='.$row['id'];

							        		?>

							        		<th scope="row">
							        		<a id="rep_a" href="<?php echo $lien;?>" >Répondre</a>

							        		</th>

							        		<?php
							        		echo '</tr>';


							        	}
						        	?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
	</div>
</main>
</div>

<script src="js/menu.js"></script>
<script src="styles/bootstrap-4.1.2/popper.js"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="plugins/jquery-ui.js"></script>
<script src="js/index.js"></script>
</body>
</html>