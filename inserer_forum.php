<?php 
require_once 'inc/db.php';
$id=$_GET['session'];
$id_theme=$_GET['id_theme'];
$email=$_GET['email'];
$pseudo=$_GET['pseudo'];
$titre=$_GET['titre'];
$text=$_GET['text'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>Inserer forum</head>

<body>

	<?php
		
		// on teste la déclaration de nos variables
		if (!isset($id_theme) || !isset($email) || !isset($pseudo) ||  !isset($titre) || !isset($text)) {
			$erreur = 'Les variables nécessaires au script ne sont pas définies.';
		}
		else{
			// on teste si les variables ne sont pas vides
			if (empty($id_theme) || empty($titre) || empty($text) || empty($pseudo) || empty($email)) {
				$erreur = 'Au moins un des champs est vide.';
			}
			// si tout est bon, on peut commencer l'insertion dans la base
			else {
				$req=$pdo->prepare('INSERT INTO forum_sujets(titre,message,mail,pseudo,date_ajout,id_theme) VALUES (?,?,?,?,CURRENT_DATE,?)');
				$req->execute([$titre,$text,$email,$pseudo,$id_theme]);
				echo "ok";
				//on redirige vers la page d'accueil
				header('Location: forum.php?session='.$id.'&message=envoye');

				// on termine le script courant
				exit;
			}
		}

		if(!empty($erreur)){
			echo "<p>";
			echo $erreur;
			echo "</p>";
		}
	?>
</body>
</html>