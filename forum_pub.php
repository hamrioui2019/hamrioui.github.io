<?php 
require_once 'inc/db.php';
$id = $_GET['session'];
if(isset($id) and !empty($id)){
	
	$reqU = "SELECT * FROM adherent WHERE id_user =".$id;
	$exeU = $pdo->prepare($reqU);
	$exeU->execute();
	while($data = $exeU->fetch()){
		$user_mail = $data['email'];
		$user_pseudo = $data['nom'];

if (isset($_POST['ajout']) AND !empty($_POST['theme_id'])) {
	header('Location:inserer_forum.php?session='.$id.'&id_theme='.$_POST['theme_id'].'&email='.$user_mail.'&pseudo='.$user_pseudo.'&titre='.$_POST['titre'].'&text='.$_POST['text']);
		}
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
					<div class="logo">
						<a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="100" height="100" style="margin-right: 400px">
						</a>
					</div>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 400px">
					<ul class="navbar-nav active">
						<li class="nav-item">
							<a class="nav-link" onclick="history.go(-1);"> Retour</a>
						</li>
						<li class="nav-item">
							<a class="nav-link"  href="logout.php" style="margin-right: 5px">Deconnexion</a>
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
	<br>
<div class="container">
	<form action="" method="post">

		<div class="row">
			<div class="col-md-8">
				<div class="form-group col-md-6">
					<select id="inputState" name="theme_id"  class="form-control">
						<option selected>Veuillez choisir un thème</option>
						<?php 
								    // recuperation des themes:
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
				<button class="btn btn-success" name="search" type="submit">Search</button>
			</div>	
		</div>
	</form>
</div>
<?php if (isset($_POST['search'])) { ?>
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
							        	if ($_POST['theme_id']) {
							        		$req = "SELECT * FROM forum_sujets where id_theme =? order by date_ajout desc";
    										    $exe = $pdo->prepare($req);
									    	 $exe->execute([$_POST['theme_id']]);
										}
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
<?php }; ?>
<main class="py-4">
	<div class="container">
		<div class="row">
			 <?php
            if(isset($_GET['message']) && $_GET['message'] == 'envoye')
             {
              echo '<div class="alert alert-success container" role="alert">
              Vous avez publié un message.
              </div>';
            }
            ?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header text-center"><strong>Ajouter un nouveau sujet</strong></div>

					<div class="card-body">

						<form action="" method="post">
							<table class="table table-responsive table-hover">
								<thead>
									<th>User</th>
									<th>Titre</th>
									<th>Message</th>
									<th></th>
									<th></th>
								</thead>

								<tbody>
									<tr>
										<div class="row">
											<div class="form-group col-md-6">
													<select id="inputState" name="theme_id"  class="form-control">
														<option value=0 selected>Veuillez choisir un thème</option>
														<?php 
															    // recuperation des themes:
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
												<div class="form_group col-md-4">
													<input class="form-control" id="main" name="mail" placeholder="Saisissez votre adresse mail" value="<?php echo $user_mail; ?>" required="Veuillez completer ce champs"/>
												</div>
											</div>
									</tr>

									<tr>
										<td>
											<input class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" rows="2" cols="10" value="<?php echo $user_pseudo; ?>" required="Veuillez completer ce champs"></input>
										</td>

										<td>
											<textarea class="form-control" id="titre" name="titre" placeholder="Titre" rows="2" cols="50" required="Veuillez completer ce champs"></textarea>
										</td>

										<td>
											<textarea class="form-control" id="text" name="text" placeholder="TEXT"rows="5" cols="70" required="Veuillez completer ce champs"></textarea>
										</td>

										<td>
											<div class="form-group col-md-4">
												<button class="btn btn-success" name="ajout">Ajouter</button>
											</div>
										</td>  
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script src="js/menu.js"></script>
<script src="styles/bootstrap-4.1.2/popper.js"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="plugins/jquery-ui.js"></script>
<script src="js/index.js"></script>
</body>
</html>