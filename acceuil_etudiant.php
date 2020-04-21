<?php  
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
try
{
	   // les reunions diffusées
      $req =  $pdo->prepare('SELECT * FROM reunion where diffuse=1');
      $req->execute();
      $reunions = $req->fetchAll(PDO::FETCH_ASSOC);

      // liste des adhérents
        $req = $pdo->prepare('SELECT * FROM adherent');
        $req->execute();
        $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);

        // liste des documents de la réunion
         $req =  $pdo->prepare('SELECT * FROM doc_reunion');
        $req->execute();
        $docs = $req->fetchAll(PDO::FETCH_ASSOC);

        //listes des volontaires
         $req = $pdo->prepare('SELECT * FROM volontaire v,adherent a where v.id_user=a.id_user');
        $req->execute();
        $volontaires = $req->fetchAll(PDO::FETCH_ASSOC);

         //listes des liens
         $req = $pdo->prepare('SELECT * FROM links');
        $req->execute();
        $links = $req->fetchAll(PDO::FETCH_ASSOC);



}
	catch(PDOException $e)
{
  $errMsg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="icon" type="image/png" href="images/logo.jpg" />
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
          <div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="100" height="100" style="margin-right: 100px"></div>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href=<?php echo "acceuil_etudiant.php?session=".$_SESSION['id']?>>Profil <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo" modificationIP_m.php?session=".$_SESSION['id'].'?modif=ok'?>>Modifier mon profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo"forum_mbr.php?session=".$_SESSION['id']?>>Mon forum</a>
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
        <main class="py-3">
      <div class="container">
       <br>
       <div class="row">
        <div class="col-md-5">
         <div class="card">
          <div class="card-header">Mes reunions </div>
          <div class="card-body">          
            <table class="table table-responsive table-hover">
              <thead>
                <th>N°</th>
                <th>Lieu</th>
                <th>date</th>
                <th>Objet</th>
                <th></th>
              </thead>
              <tbody>
                <?php foreach ($reunions as $reunion){ ?>
                  <tr>
                    <?php if ($reunion['diffuse']==1) {?>
                      <td><?php echo $reunion['id_reunion']; ?></td>
                      <td><?php echo $reunion['lieu']; ?></td>
                      <td><?php echo $reunion['dat']; ?></td>
                      <td><?php echo $reunion['objet']; ?></td>
                    <?php } ?>
                  </tr>
                <?php }; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <table class="table table-responsive table-hover">
              <thead>
                <th>Ref reunion</th>
                <th>Nom document</th>
                <th></th>
              </thead>
              <tbody>
                <?php foreach ($docs as $doc){ ?>
                  <tr>
                    <td><?php echo $doc['id_reunion']; ?></td>
                    <td><?php echo $doc['name']; ?></td>
                    <td><a target="_blanck" class="btn btn-warning" href="<?php echo $doc['file_url'];?>">Consulter</a></td>  
                  </tr>
                <?php }; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
          <div class="col-md-7">
            <div class="card">
             <?php
             if(isset($_GET['modif']) && $_GET['modif'] == 'ok')
             {
              echo '<div class="alert alert-success" role="alert">
              votre modificationvous a été bien effectué .
              </div>';
            }
            ?>          
            <div class="card-header">Informations personnelles</div>
            <div class="card-body">

              <table class="table table-responsive table-hover">
                <thead>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>numéro Tél</th>
                  <th>Email</th>
                  <th>Pays d'origine</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php foreach ($utilisateurs as $utilisateur){ ?>
                    <tr>
                      <td><p><?php echo $utilisateur['nom'] ?></p></td>
                      <td><?php echo $utilisateur['prenom'] ?></td>
                      <td><?php echo $utilisateur['numtel'] ?></td>
                      <td><?php echo $utilisateur['email'] ?></td>
                      <td><?php echo $utilisateur['pays_origine'] ?></td>
                      <td>
                       <button class="btn btn-success"><a style="color: white" href=<?php echo "contact_mbr.php?session=".$_SESSION['id']."&membre=".$utilisateur['id_user']?>>Contacter</a>
                        </button>
                       </td>
                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
   </div>

      <br>
      <div class="row">
      	 <div class="col-md-7">
            <div class="card">   
            <div class="card-header">Adhérents volontaires</div>
            <div class="card-body">

              <table class="table table-responsive table-hover">
                <thead>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>numéro Tél</th>
                  <th>Email</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php foreach ($volontaires as $vol){ ?>
                    <tr>
                      <td><p><?php echo $vol['nom'] ?></p></td>
                      <td><?php echo $vol['prenom'] ?></td>
                      <td><?php echo $vol['numtel'] ?></td>
                      <td><?php echo $vol['email'] ?></td>
                      <td>
                       <button class="btn btn-success"><a style="color: white" href=<?php echo "contact_mbr.php?session=".$_SESSION['id']."&membre=".$utilisateur['id_user']?>>Contacter</a>
                        </button>
                       </td>
                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      	 <div class="col-md-4">
            <div class="card">   
            <div class="card-header">Liens vers utiles pour les etudiants <button class=" btn-primary"><i class="fa fa-share"></i>Partager</button></div>
            <div class="card-body">
            	<ul>
                  <?php foreach ($links as $link){ ?>
                      <li><a href=<?php echo $link['url'] ?>><?php echo $link['desc'] ?></a></li>

                  <?php }; ?>
              </ul>
            </div>
        </div></div></div></div></div></main>

        <?php require "inc/footer.php" ?>
