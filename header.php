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
        <style type="text/css">
      .nav-link{
        color: white;
      }
      .nav-item:hover .nav-link {
       background-color: lightgreen;
       color: white;
        }
    </style>

    <script href="../reserver.js"></script>
  </head>
  <body style="color: black">
    <div class="super_container" >
      <header class="header1" style="background-color: white">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">
            <div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="100" height="100"></a></div>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item active">
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
                        };?>>Profil <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo" modificationIP_m.php?session=".$id?>>Modifier mon profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo"forum_mbr.php?session=".$id?>>Accès au forum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo"creer_forum.php?session=".$id?>>Créer un forum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo "theme.php?session=".$id?>>Creer un theme </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo "accesDoc_m.php?session=".$id?>>Acceder a mes docoments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo "reunion.php?session=".$id?>>Planifier une réunion</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php
                        switch ($id) {
                            case '1':
                                echo "index_m.php?session=".$id;
                                break;
                            case '2':
                                echo "index_m.php?session=".$id;
                                break;
                            case '3':
                                echo "index_m.php?session=".$id;
                                break;
                            case '4':
                                echo "index_m.php?session=".$id;
                                break;
                            default:
                                # code...
                                break;
                        };?>>Plateforme </a>
              </li>
              <?php if($id=='1') { ?>
                <li class="nav-item">
                   <a class="nav-link" href=<?php
                        echo "avis.php?session=".$id?>>
                           Avis</a>
              </li>
            <?php }; ?>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Déconnexion</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>