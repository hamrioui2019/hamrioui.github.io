<?php 
require "inc/functions.php"; 
require 'inc/db2.php';
session_start();
$id_user=$_GET['session'];
try
{

    //volontaires 

 $req = $pdo->prepare('SELECT * FROM messages_entre_adherent where id_user=?');
 $req->execute([$id_user]);
 $messages = $req->fetchAll(PDO::FETCH_ASSOC);
}
 catch(PDOException $e)

 {
  $errMsg = $e->getMessage();
}?>
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
     <br>
     <div class="alert alert-primary">
       <p>Dans cette section vous pouvez visualiser les message envoyé par d'autres adhérents si vous le souhaitez</p>
     </div>
       <div class="row">
        <div class="col-md-7">
          <br>
          <div class="card">
          <div class="card-header alert-danger"> Message reçu de </div>
          <div class="card-body">
                <table class="table table-responsive table-hover">
                <thead>
                  <th>Objet</th>
                  <th>Message</th>
                  <th>date</th>
                </thead>
                <tbody>
                  <?php foreach ($messages as $not){ ?>
                    <tr>
                      <td><?php echo $not['objet'] ?></td>
                      <td><?php echo $not['message'] ?></td>
                      <td><?php echo $not['datemessage'] ?></td>

                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
              </div>
         </div>
       </div>
     </div>
   </div>
 </main>