<?php 
   require "inc/functions.php"; 
   require 'inc/db2.php';
   session_start();
   try
   {

    //volontaires 

     $req = $pdo->prepare('SELECT * FROM volontaire v,adherent a where v.id_user=a.id_user');
        $req->execute();
        $volontaires = $req->fetchAll(PDO::FETCH_ASSOC);

    //documents de traitement de résiliation
  $req =  $pdo->prepare('SELECT * FROM doc_resiliation join demande_resiliation where id_user=?');
  $req->execute([$_SESSION['id']]);
  $docs = $req->fetchAll(PDO::FETCH_ASSOC);

    //demandes de résiliation
     $req = $pdo->prepare('SELECT * FROM traitement_resiliation join demande_resiliation where id_user=?');
    $req->execute([$_SESSION['id']]);
    $traitements= $req->fetchAll(PDO::FETCH_ASSOC);

    //notification de paiement
    $req = $pdo->prepare('SELECT * FROM notification_paiement where id_user=?');
    $req->execute([$_SESSION['id']]);
    $notifications = $req->fetchAll(PDO::FETCH_ASSOC);
    //demandes de résiliation 
    $req = $pdo->prepare('SELECT id_user FROM demande_resiliation');
    $req->execute();
    $resiliations = $req->fetchAll(PDO::FETCH_ASSOC);
    
    //adhérents
    $req = $pdo->prepare('SELECT * FROM adherent where email = :email');
    $req->execute(array(
     ':email' => $_SESSION['email'] 
   ));
    $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);
    $req = $pdo->prepare('SELECT * FROM adherent where id_user = :id_user ' );
    $req->execute(array(
     ':id_user' => $_SESSION['id']
   ));
    $adherents = $req->fetchAll(PDO::FETCH_ASSOC);
     $req = $pdo->prepare('SELECT * FROM doc_paiement where id_user = :id_user ' );
    $req->execute(array(
     ':id_user' => $_SESSION['id']
   ));
    $documents = $req->fetchAll(PDO::FETCH_ASSOC);

//message de la part des adhérents
//messages de la part des membres 
   $req = $pdo->prepare('SELECT * FROM messageadherent where id_user = :id_user ' );
    $req->execute(array(
     ':id_user' => $_SESSION['id']
   ));
    $messages = $req->fetchAll(PDO::FETCH_ASSOC);
   $req = $pdo->prepare('SELECT * FROM theme_abonne where id_user=?' );
    $req->execute([$_SESSION['id']]);
    $themes=$req->fetchAll(PDO::FETCH_ASSOC);
    }
  catch(PDOException $e)

  {
    $errMsg = $e->getMessage();
  }
  if(isset($_POST['idAmodifier']))
  {   
    header('Location: modificationIP.php?session='.$_SESSION['id']);
  }
//abonnement aux themes
  if(isset($_POST['idAbonner']))
  {
    $req = $pdo->prepare('SELECT * FROM theme_abonne WHERE id_theme=?' );
    $req->execute([$_POST['idAbonner']]);
    $theme_ab=$req->fetchAll(PDO::FETCH_ASSOC);
   if($theme_ab == TRUE){
      $errors['nomTheme']="Vous etes déja abonné a ce theme ";    
    }
    else{
    $req = $pdo->prepare('INSERT INTO theme_abonne (id_theme,id_user,nomTheme) VALUES (?,?,?)');
    $req->execute([$_POST['idAbonner'],$id,$_POST['nomTheme']]);
    header('Location: account.php?session='.$id.'?'.'abonne=ok');
  }
}

// acces au forum
  if(isset($_POST['idForum']))
  {   
    header('Location:forum.php?session='.$_SESSION['id']);
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
                <a class="nav-link" href="#">Profil <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo" modificationIP.php?session=".$_SESSION['id']?>>Modifier mon profil</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href=<?php echo" message.php?session=".$_SESSION['id']?>>Messages des adhérents</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href=<?php echo"forum.php?session=".$_SESSION['id']?>>Mon forum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo" mbr_dispo.php?session=".$_SESSION['id']?>>Membres disponnibles</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo "accesDoc.php?session=".$_SESSION['id']?>>Acceder a mes docoments</a>
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
        $req=$pdo->prepare('INSERT INTO doc_paiement(id_user,name,file_url) VALUES(?,?,?)');
        $req->execute([$_SESSION['id'],$files_name,$file_dest]); 
        header('Location:account.php?session='.$_SESSION['id'].'&env=ok');
            }
    }
    else{
      echo "Seul les fichier PDF sont autorisées";
    }
}
 ?>
    <!-- je personnalise un peut mon message de bienvenue en l'adaptant à chaque utilisateur -->
    <div class="col-lg-8 offset-2 centered">
      <h1 class="text-center" style="color: black">Bonjour <?php echo $_SESSION['name'];?></h1>
      <h3>Vous etes connecté ainsi vous pouvez acceder à toutes vos informations</h3>
    </div>
    <?php if (isset($_GET['env']) && ($_GET['env']=='ok')) {

     echo '<div class="alert alert-success" role="alert">
             le chargement a été bien effectué .
              </div>';
    } ?>
     <?php if (isset($_GET['res']) &&($_GET['res']=='ok')) {

     echo '<div class="alert alert-warning" role="alert">
             le changement a été bien effectué .
              </div>';
    } ?>

    <main class="py-4">
      <div class="container">
        <div class="row">
              <?php  if(empty($documents)){?> 
        <div class="col-md-5">
         <div class="card">
          <div class="card-header">Important </div>
          <div class="card-body">
                <div class="alert alert-danger"> merci de renseigner les documents requis relatif a votre paiement
                <p>Merci de joindre votre RIB / mondat cheque</p>
                  <form method="POST" enctype="multipart/form-data">
                  <input type="file" name="fichier"/>
                  <input type="submit" name=" envoyer le fichier">
                </form>
              </div>
         </div>
       </div>
     </div>
   <?php };?>
   <?php  if(!empty($notifications)){?> 
        <div class="col-md-5">
         <div class="card">
          <div class="card-header alert-danger">Notification de paiement </div>
          <div class="card-body">
                <table class="table table-responsive table-hover">
                <thead>
                  <th>Note</th>
                  <th>date de la notification</th>
                </thead>
                <tbody>
                  <?php foreach ($notifications as $not){ ?>
                    <tr>
                      <td><?php echo $not['note'] ?></td>
                      <td><?php echo $not['date_note'] ?></td>

                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
              </div>
         </div>
       </div>
     </div>
   <?php };?>
   <br>
    <div class="row">
          <div class="col-md-12">
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
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>numéro Tél</th>
                  <th>Email</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php foreach ($utilisateurs as $utilisateur){ ?>
                    <tr>
                      <td><?php echo $utilisateur['id_user'] ?></td>
                      <td><p><?php echo $utilisateur['nom'] ?></p></td>
                      <td><?php echo $utilisateur['prenom'] ?></td>
                      <td><?php echo $utilisateur['numtel'] ?></td>
                      <td><?php echo $utilisateur['email'] ?></td>
                      <td>
                        <button class="btn btn-success" form="modificationIP" >
                          <i class="fa fa-edit"></i> modifier
                        </button>
                        <form method="post" action="" hidden id="modificationIP">
                          <input name="idAmodifier" value="<?php echo $utilisateur['id_user'] ?>">
                        </form>
                      </td>
                      <?php if (!empty($resiliations)) {?>
                        <?php foreach ($resiliations as $res) {
                          if ($res['id_user']!=$utilisateur['id_user']) {?>
                        <td><a class="btn btn-warning" href=<?php echo "resiliation.php?session=".$_SESSION['id']."&nom=".$utilisateur['nom']."&prenom=".$utilisateur['prenom']; ?>>Demande de résiliation</a></td>
                      <?php }else{?>
                        <td><a class="btn btn-primary" href="#">résiliation en cours de traitement</a></td>
                    <?php }}}else{ ?>
                      <td><a class="btn btn-warning" href=<?php echo "resiliation.php?session=".$_SESSION['id']."&nom=".$utilisateur['nom']."&prenom=".$utilisateur['prenom']; ?>>Demande de résiliation</a></td>
                    <?php }; ?>
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
     <div class="col-md-6">
       <div class="card">
        <div class="card-header">
          <p class="text-center">Liste des abonnement aux themes </p>
        </div>
        <div class="card-body">
   
         <p></p>
         <table class="table table-responsive table-hover">
          <thead>
            <th>Themes</th>
            <th></th>
          </thead>
          <tbody>
           <?php foreach ($themes as $theme){ ?>
            <tr>
              <td> 
                <?php echo $theme['nomTheme'] ?>
                <form method="post" action="" hidden id="abonnementIP">
                <input name="nomTheme" value="<?php echo $theme['nomTheme'] ?>">
                </form></td>
              <td></td>
            </tr>
           <?php }; ?>
          </tbody>
         </table>
         <div class="card-footer text-center">
            <button class="btn btn-warning"><a style="color: white" href=<?php echo "ajoutetheme_mbr.php?session=".$_SESSION['id']?>>Ajouter un theme</a></button>
         </div>
       </div>
     </div>
   </div>
    <?php  if(!empty($messages)){?> 
        <div class="col-md-6">
         <div class="card">
          <div class="card-header alert-success">Messages de l'association </div>
          <div class="card-body">
                <table class="table table-responsive table-hover">
                <thead>
                  <th>Objet</th>
                  <th>Message</th>
                  <th>Date</th>
                </thead>
                <tbody>
                  <?php foreach ($messages as $message){ ?>
                    <tr>
                      <td><?php echo $message['objet'] ?></td>
                      <td><p><?php echo $message['message'] ?></p></td>
                      <td><?php echo $message['date'] ?></td>
                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
              </div>
         </div>
       </div>
     </div>
   <?php };?>
</div>
</main>
<main class="py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">Dernières activités de l'association</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <img src="images/im8.jpg">
              </div>
              <div class="col-md-6">
                <img src="images/im9.jpg">
              </div>
            </div>
         </div>
         <div class="card-footer">
          <p class="text-center">Activité culturelles</p>
          </div>
       </div>
     </div>
     <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">Message de la comptabilité</div>
           <div class="card-body">
              <table class="table table-responsive table-hover">
              <thead>
                <th>Objet</th>
                <th>Message</th>
                <th>Num de demande</th>
                <th>date traitement</th>
              </thead>
              <tbody>
                <?php foreach ($traitements as $trait){ ?>
                  <tr>
                    <td><?php echo $trait['objet']; ?></td>
                    <td><?php echo $trait['message']; ?></td>
                    <td><?php echo $trait['id_res']; ?></td>
                    <td><?php echo $trait['datetrait']; ?></td>
                  </tr>
                <?php }; ?>
                </tbody>
              </table>
           </div>
           <div class="card-footer">
             <table class="table table-responsive table-hover">
              <thead>
                <th>Ref demande</th>
                <th>Nom document</th>
                <th></th>
              </thead>
              <tbody>
                <?php foreach ($docs as $doc){ ?>
                  <tr>
                    <td><?php echo $doc['id_res']; ?></td>
                    <td><?php echo $doc['name']; ?></td>
                    <td><a target="_blanck" class="btn btn-warning" href="<?php echo $doc['file_url'];?>">Consulter</a></td>  
                  </tr>
                <?php }; ?>
              </tbody>
            </table>
           </div>
        </div>
      </div>


 </div>

</main> 


</body>
</html>

<?php require 'inc/footer.php';?>