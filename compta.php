<?php 
	require 'inc/db2.php';
	session_start();
  $id=$_GET['session'];
	try
    {
      // les demandes de résiliation
    $req =  $pdo->prepare(' SELECT * FROM demande_resiliation');
    $req->execute();
    $demandes = $req->fetchAll(PDO::FETCH_ASSOC);

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
                <a class="nav-link" href=<?php echo "compta.php?session=".$_SESSION['id']?>>Profil <span class="sr-only">(current)</span></a>
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
    <main class="py-4">
      <div class="container-fluid">
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
     <div class="col-md-5">
       <div class="card">
         <div class="card-header">Les demandes de résiliation</div>
         <div class="card-body">
                       <table class="table table-responsive table-hover">
              <thead>
                <th>N°demande</th>
                <th>Id adhérent</th>
                <th>nom</th>
                <th>prenom</th>
                <th></th>
              </thead>
              <tbody>
                <?php foreach ($demandes as $dem){ ?>
                  <tr>
                    <td><?php echo $dem['id_res']; ?></td>
                    <td><?php echo $dem['id_user']; ?></td>
                    <td><?php echo $dem['nom']; ?></td>
                    <td><?php echo $dem['prenom']; ?></td>
                   <?php if ($dem['traite']==0) {?>
                    <td><a class="btn btn-warning" id="numch" style="margin-left: 10px; margin-right:10px " href=<?php echo "traiter.php?session=".$id."&dem=".$dem['id_res']?>>traiter</a>
                    </td>
                  <?php }else {?>
                     <td>
                      <a class="btn btn-success" id="numch" style="margin-left: 10px; margin-right:10px " href="#numch">Traité</a>
                    </td>
                    <?php }; ?>

                  </tr>
                <?php }; ?>
              </tbody>
            </table>
         </div>
       </div>
     </div>
     </div>
         <div class="row">
          <div class="col-md-9">
            <div class="card">
             <?php
             if(isset($_GET['rappel']) && $_GET['rappel'] == 'ok')
             {
              echo '<div class="alert alert-success" role="alert">
              votre notification a été envoyé .
              </div>';
            }?>        
            <div class="card-header">Liste des adhérents</div>
            <div class="card-body">

              <table class="table table-responsive table-hover">
                <thead>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>numéro Tél</th>
                  <th>Date de cotisation</th>
                  <th></th>
                  <th>Rappel paiement</th>  
                </thead>
                <tbody>
                  <?php foreach ($utilisateurs as $utilisateur){?>
                    <tr>
                      <td><?php echo $utilisateur['id_user'] ?></td>
                      <td><p><?php echo $utilisateur['nom'] ?></p></td>
                      <td><?php echo $utilisateur['prenom'] ?></td>
                      <td><?php echo $utilisateur['numtel'] ?></td>
                       <?php if ($utilisateur['dateCotisation']==NULL) {?>
                      <td>
                          <a class="btn btn-primary" href=<?php echo "savedate.php?session=".$id."&user=".$utilisateur['id_user'];  ?>>Enregistrer</a>
                       <?php }else{ ?>
                           <td><?php echo $utilisateur['dateCotisation'] ?></td>
                      </td>
                      <?php }; ?>
                      <td>
                        <button class="btn btn-success"><a style="color: white" href=<?php echo "contact_mbr.php?session=".$_SESSION['id']."&membre=".$utilisateur['id_user']?>>Contacter</a>
                        </button>
                      </td>
                      <td>
                        <button class="btn btn-sm btn-warning"><a style="color: white" href=<?php echo 'rappelT.php?session='.$id.'&membre='.$utilisateur['id_user']?>>
                          Rappel paiement
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
 </main>
<?php require "inc/footer.php" ?>