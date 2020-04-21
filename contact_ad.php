<?php 
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
$id_membre=$_GET['membre'];
try
{
	$req = $pdo->prepare('SELECT * FROM membrebureau where id_membre!=?');
	$req->execute([$id]);
	$membres = $req->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	$errMsg = $e->getMessage();
}
//envoyer 
if(isset($_POST['submit'])){ 

	$objet=$_POST['objet'];
	$message=$_POST['th'];
	if(!empty($_POST) ){
	    $req=$pdo->prepare('INSERT INTO messages_entre_adherent
        (id_user,objet,message,datemessage) VALUES(?,?,?,CURRENT_DATE)');
	            $req->execute([$id_membre,$objet,$message]);               
	            header('Location: contact_ad.php?session='.$id.'&membre='.$id_membre.'&env=ok');
	        }
}
     ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="icon" type="image/png" href="images/logo.jpg" />
  <title>Mon compte Ensemble pour l'Afrique</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
  <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
  <link rel="stylesheet" type="text/css" href="styles/responsive.css">
  <script href="../reserver.js"></script>
</head>
<body style="color: black">

        <a class="navbar-brand" href="#">
          <div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="100" height="100" style="margin-right: 100px"></div>
          </a>

  
    <main class="py-4">
    <div class="container">
          <button class="btn btn-danger" onclick="history.go(-1);"> <i class="fa fa-backward"></i> Retour</button>
     <br>
	<div class="row">
     <div class="col-md-7">
      <br>
       <div class="card">
            <?php
             if(isset($_GET['env']) && $_GET['env'] == 'ok')
             {
              echo '<div class="alert alert-warning" role="alert">
              votre message a été envoyé au membre.
              </div>';
            }?>
        <div class="card-header">Envoyer un message:</div>
        <div class="card-body">
        	 <form action="" method="POST">
         <table class="table table-responsive table-hover">
           <thead>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
                    <tr>
                    	<td>L'objet:</td>
                      <td>
                      	<div class="form-group">
                            <input type="text" name="objet" class="form-control" placeholder="Entrez l'objet" />
                        </div></td>
                    </tr>
                    <tr>
                    	<td>Message</td>
                    	<td>
                      	<div class="form-group">
		              		<textarea name="th" class="form-control" rows="5" cols="33">Merci de préciser votre nom et prenom à la fin de votre message
		              		</textarea>
		              		<br>
                		</div>
                      </td>
                    </tr>
              </tbody>
         </table>
         <button type="submit" name="submit" class="btn btn-primary"> Envoyer le message</button>
     </form>
       </div>
     </div>
   </div>
   <div class="col-md-4">
    <br>
     <div class="alert alert-primary">
       <p>Vous pouvez contactez un membre, en précisant l'objet de votre message et en signant avec votre nom et prénom à chaque fin de message.</p>
     </div>
   </div>
    
   </div>
</div>
</main>
<?php require 'inc/footer.php' ?>