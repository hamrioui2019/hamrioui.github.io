<?php 
    session_start();
    require 'inc/db2.php';
    $id=$_GET['session'];
     try
    {
        $req = $pdo->prepare('SELECT * FROM avis');
        $req->execute(array(
            ':id_user' => $id 
        ));
        $avis = $req->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
        $errMsg = $e->getMessage();
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
            <div class="logo"><a href="#"><img class="logo_1" src="images/logo.jpg" alt="" width="150" height="150" style="margin-right: 100px"></div>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href=<?php echo "presidente.php?session=".$_SESSION['id']?>>Profil <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=<?php echo "accesDoc.php?session=".$_SESSION['id']?>>Acceder a mes docoments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout">Déconnexion</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header> 
         <main class="py-4" style="color: black">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Les Avis</div>
                            <div class="card-body">
                               <table class="table table-responsive table-hover">
                                  <thead>
                                    <th>email</th>
                                    <th>avis</th>
                                    <th>Date</th>
                                </thead>
                                <tbody>
                                	<?php foreach ($avis as $av){ ?>
                                	<tr>
                                		<td><?php echo $av['email'];?></td>
                                		<td><?php echo $av['avis'] ;?></td>
                                		<td><?php echo $av['date_avis'] ;?></td>
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
<?php require "inc/footer.php" ?>