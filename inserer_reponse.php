<?php 
require_once 'inc/db.php';
// $id=$_GET['session'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>Inserer reponse</head>

<body>

	<?php

		$mail = '"'.htmlspecialchars($_POST['mail']).'"';
		$pseudo = '"'.htmlspecialchars($_POST['pseudo']).'"';
		$msg = '"'.htmlspecialchars($_POST['text']).'"';
		$date = '"'.date("Y-m-d H:i:s").'"';
		$forum_sujet = $_GET['id_sujet'];
		$requete = "INSERT INTO forum_reponses(message,date_reponse,forum_sujet,mail,pseudo) VALUES (".$msg.",".$date.",".$forum_sujet.",".$mail.",".$pseudo.")";
		$req=$pdo->prepare($requete);
		$req->execute();

		//on redirige vers la page d'accueil
		header('Location: ../reponses.php?id_sujet='.$forum_sujet.'&reponse=ok');

		// on termine le script courant
		exit;
	?>
</body>
</html>