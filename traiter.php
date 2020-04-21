<?php 
require 'inc/db2.php';
	session_start();
  $id=$_GET['session'];
  $id_dem=$_GET['dem'];
	try
    {
    $req =  $pdo->prepare(' SELECT * FROM demande_resiliation');
    $req->execute();
    $demandes = $req->fetchAll(PDO::FETCH_ASSOC);
}
 	catch(PDOException $e)
	{
		$errMsg = $e->getMessage();
	}
	if(isset($_POST['env'])){ 

	$objet=$_POST['obj'];
	$message=$_POST['mes'];
	if(!empty($_POST) ){
	    $req=$pdo->prepare('INSERT INTO traitement_resiliation(id_res,message,objet,datetrait) VALUES(?,?,?,CURRENT_DATE)');
	            $req->execute([$id_dem,$message,$objet]);
	        $req=$pdo->prepare('UPDATE demande_resiliation SET traite=:trait where id_res = :id_res')->execute(array(     
            ':trait' => 1,
            ':id_res' => $id_dem
        ));               
	            header('Location: traiter.php?session='.$id.'&dem='.$id_dem.'&env=ok');
	        }
}
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ensemble pour l'Afrique</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
    <script href="../reserver.js"></script>
</head>
<body>

    <div class="super_container" style="color: black">
       <div class="super_container" style="color: black">
          <header class="header1" style="background-color: white">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="#">
                <div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="50" height="50"></div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item ">
                        <a class="nav-link" href=<?php
                        switch ($id) {
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
                        };
                        ?>>Profil </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href=<?php echo" modificationIP_m.php?session=".$_SESSION['id']?>>Modifier mon profil<span class="sr-only">(current)</span></a>
                    </li>
                  <li class="nav-item">
                    <a class="nav-link" href=<?php echo "accesDoc_m.php?session=".$_SESSION['id']?>>Acceder a mes docoments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
</header>  
<?php 
	//on verifie si notre fichier est bien chargé dans notre page
      //var_dump($_FILES);

      //pour avoir acces au nom de mon fichier il suffit d'accedes via $_files
      if (!empty($_FILES)) {
        $files_name= $_FILES['fichier']['name'];
        // $files_type= $_FILES['fichier']['type'];
        $file_extension=strrchr($files_name,".");
        //echo "NOM: ".$files_name.'<br>';
        // echo "Type: ".$files_type;
        $extensions_autorisees=array('.pdf','.PDF');
        $file_tmp_name=$_FILES['fichier']['tmp_name'];
        $file_dest='doc/'.$files_name;

        if (in_array($file_extension, $extensions_autorisees)) {
          //pour envoyer le fichier on utilise la fonction move_upload_file on deplace le fichier du repertoir temporaire (chemin qu'on a visualisé a l'aide de var_dump) et on le mets dans le repertoire destinataire que j'ai crée nomé doc
          if (move_uploaded_file($file_tmp_name, $file_dest)) {
            $req=$pdo->prepare('INSERT INTO doc_resiliation(id_res,name,file_url) VALUES(?,?,?)');
            $req->execute([$id_dem,$files_name,$file_dest]); 
            echo '<div class="alert alert-success" role="alert">
                 le chargement a été bien effectué .
                  </div>';
                }
			header('Location:traiter.php?session='.$id.'&dem='.$id_dem."&doc=ok");     
		   }
        else{
          echo "Seul les fichier PDF sont autorisées";
        }
}
     ?>

<main class="py-4">
		<?php
             if(isset($_GET['doc']) && $_GET['doc'] == 'ok')
             {
              echo '<div class="alert alert-success" role="alert">
              le document a bien été transmis .
              </div>';
            }?>
            <?php
             if(isset($_GET['env']) && $_GET['env'] == 'ok')
             {
              echo '<div class="alert alert-warning" role="alert">
              le mesage a bien été transmis .
              </div>';
            }?>
    <div class="container">
    	<button class="btn btn-success" onclick="history.go(-1);">Retour</button>
        <div class="row">
            <div class="col-md-6">
            	<br>
                <div class="card">
                <div class="card-header">Transmettre des documents</div>
                 <div class="card-body">
                    <p>Joindre un fichier PDF</p>
                                <br>
                    <form method="POST" enctype="multipart/form-data">
                    <input type="file" name="fichier"/>
                                  <br><br>
                    <input type="submit" value =" Enregistrer le fichier"  class="btn btn-primary">
                               </form>
                  </div>	
                	
            </div>
        </div>
                <div class="col-md-6">
                    	        <br>

                <div class="card">
                <div class="card-header">Message</div>
                 <div class="card-body">
                 	<form method="POST">
                 		Objet:<input class="form-control" type="text" name="obj">
                 		Message:
                 	<textarea name="mes" class="form-control" rows="15">Entrez votre texte</textarea>
                 	<br>
                 	<div class="text-center">
                 	<button name="env" class="btn btn-success" >Envoyer</button></div>
                    </form>
                    </div>

    </div>