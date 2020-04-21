
<?php  
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
try
{
  $req = $pdo->prepare('SELECT * FROM adherent where valide = 1');
  $req->execute();
  $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);

  //filtrer les adhérents

  $adherents = [];

  if (isset($_POST['q']) AND !empty($_POST['q'])) {
    $q=htmlspecialchars($_POST['q']);
     $req = $pdo->prepare('SELECT * FROM adherent WHERE nom LIKE ? AND valide=1 ORDER BY id_user DESC' );
     $req->execute(['%'.$q.'%']);
    $adherents = $req->fetchAll(PDO::FETCH_ASSOC);
     
     // header('Location: secretaire.php?session='.$id);
  }

         //j'affiche les reunions
  $req =  $pdo->prepare('SELECT * FROM reunion');
  $req->execute();
  $reunions = $req->fetchAll(PDO::FETCH_ASSOC);

  $req =  $pdo->prepare('SELECT * FROM doc_reunion');
  $req->execute();
  $docs = $req->fetchAll(PDO::FETCH_ASSOC);

      //message de la présidente
  $req =  $pdo->prepare('SELECT * FROM messagemembre WHERE id_membre=?');
  $req->execute([$id]);
  $messages = $req->fetchAll(PDO::FETCH_ASSOC);
if(isset($_POST['submit'])){ 
    //communiquer l'ordre du jour 
    $ordre=$_POST['ordre1'];
    $req =  $pdo->prepare('INSERT INTO ordredujour (ordre,date_ordre) VALUES (?,CURRENT_DATE)');
    $req->execute([$ordre]); 
    
 $req =  $pdo->prepare('SELECT * FROM ordredujour where date_ordre=CURRENT_DATE');
     $req->execute(); 
     $ordre=$req->fetchAll(PDO::FETCH_ASSOC);
  }
 //resiliation
    $req =  $pdo->prepare(' SELECT * FROM demande_resiliation');
    $req->execute();
    $demandes = $req->fetchAll(PDO::FETCH_ASSOC);


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
                <a class="nav-link" href=<?php echo "secretaire.php?session=".$_SESSION['id']?>>Profil <span class="sr-only">(current)</span></a>
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
            <?php
            if(isset($_GET['diffusion']) && $_GET['diffusion'] == 'ok')
             {
              echo '<div class="alert alert-success" role="alert">
              Réunion a été communiqué aux membres .
              </div>';
            }
            ?>
            
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
                    <td><?php echo $reunion['id_reunion']; ?></td>
                    <td><?php echo $reunion['lieu']; ?></td>
                    <td><?php echo $reunion['dat']; ?></td>
                    <td><?php echo $reunion['objet']; ?></td>
                   <?php if ($reunion['diffuse']==0) {?>
                    <td><a class="btn btn-primary" id="numch" style="margin-left: 10px; margin-right:10px " href=<?php echo "diff.php?session=".$id."&reunion=".$reunion['id_reunion']?>>diffuser</a>
                    </td>
                  <?php }else {?>
                     <td>
                      <a class="btn btn-danger" id="numch" style="margin-left: 10px; margin-right:10px " href="#numch">diffusé</a>
                    </td>
                    <?php }; ?>

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
      <div class="card-header"> Rédiger une note</div>
      <div class="card-body">

        <form action="" method="POST">
          <table class="table table-responsive table-hover">
            <thead>
              <th>En date du : <?php echo date("d.m.yy"); ?> </th>
            </thead>
            <tbody>
             
              <tr>
                <td>
                  <div class="form-group">
                    <textarea name="ordre1" class="form-control" placeholder="Text..." cols="70" rows="10"></textarea>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <button type="submit" name="submit" class="btn btn-primary"> Communiquer</button>
        </form>
      </div>
      <div class="card-footer">
        <?php if (!empty($ordre)) {
        ?>
         <table class="table table-responsive table-hover">
          <thead>
            <th>Vous avez communiquer:</th>
          </thead>
              <tbody>
                <?php foreach ($ordre as $o){ ?>
                  <tr>
                    <td><?php echo $o['ordre'] ?></td>
                  </tr>
                <?php }; ?>
                </tbody>
          </table>
        <?php }; ?>
      </div>
    </div>
  </div>
</div>
<br> 
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
                  <th>Email</th>
                  <th>valide</th>
                  <th></th>
                  <th>Rappel paiement</th>  
                  <th>Modifier les info</th>
                </thead>
                <tbody>
                  <?php foreach ($utilisateurs as $utilisateur){?>
                    <tr>
                      <td><?php echo $utilisateur['id_user'] ?></td>
                      <td><p><?php echo $utilisateur['nom'] ?></p></td>
                      <td><?php echo $utilisateur['prenom'] ?></td>
                      <td><?php echo $utilisateur['numtel'] ?></td>
                      <td><?php echo $utilisateur['email'] ?></td>
                      <td><?php echo $utilisateur['valide'] ?></td>
                      <td>
                        <button class="btn btn-success"><a style="color: white" href=<?php echo "contact_mbr.php?session=".$_SESSION['id']."&membre=".$utilisateur['id_user']?>>Contacter</a>
                        </button>
                      </td>
                      <td>
                        <button class="btn btn-sm btn-warning"><a style="color: white" href=<?php echo 'rappel.php?session='.$id.'&membre='.$utilisateur['id_user']?>>
                          Rappel paiement
                        </button>
                       </td>
                       <td>
                        <button class="btn btn-sm btn-primary"><a style="color: white" href=<?php echo 'modificationIP.php?session='.$utilisateur['id_user']?>>
                          Modifier
                        </button>
                       </td>
                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
       <div class="col-md-3">
         <div class="card">
          <div class="card-header">
            <p>Rechercher le nom </p>
            <br>
          <form method="post">
            <input class="form-control" type="search" placeholder="Recherche.." name="q">
            <br>
            <input class="btn btn-danger" type="submit" value="valider">
          </form></div>
          <div class="card-body">
            <table class="table table-responsive table-hover">
            <thead>
              <th>Nom</th>
              <th>prenom </th>
              <th>email</th>
              <th></th>
            </thead>
            <tbody>
            voici le resultat de recherche :
            <?php foreach($adherents as $a) {?>
              <tr>
                <td><?php echo $a['nom']?></td>
                <td><?php echo $a['prenom']?></td>
                <td><?php echo $a['email']?></td>
              </tr>
           <?php }; ?>
         </tbody>
       </table>
          </div>
        </div>
    </div>
  </div>
<br>

<br>
    <div class="row">

      <div class="col-md-5">
       <div class="card">
        <div class="card-header alert-warning">  Demande de résiliation</div>
        <div class="card-body">

          <table class="table table-responsive table-hover">
            <thead>
              <th>Num idhérent</th>
              <th>Nom </th>
              <th>Prénom</th>
              <th></th>
            </thead>
            <tbody>
              <?php foreach ($demandes as $demande){ ?>
                <tr>
                  <td><?php echo $demande['id_user']; ?></td>
                  <td><?php echo $demande['nom']; ?></td>
                  <td><?php echo $demande['prenom']; ?></td>
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

      <div class="col-md-7">
       <div class="card">
        <div class="card-header alert-danger">  Messages de la présidente </div>
        <div class="card-body">

          <table class="table table-responsive table-hover">
            <thead>
              <th>Message</th>
                            <th></th>

              <th>Date</th>
            </thead>
            <tbody>
              <?php foreach ($messages as $message){ ?>
                <tr>
                  <td><?php echo $message['message']; ?></td>
                  <td></td>
                  <td><?php echo $message['datemes']; ?></td>
                </tr>
              <?php }; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
   


    <?php require 'inc/footer.php' ?>