 <?php 
    
    require_once 'inc/db2.php';
/*on va verifier si des données ont été posté*/
if(isset($_POST['acceder'])){
   
  $email = $_POST['email'];
  $password = $_POST['password'];

  try{
    //on verifie s'il existe dans la liste d'adhérent en verifiant la compatibilité entre le mail et mdp mais aussi si le compte est activé ou pas avec le champs valide si valide == 0 donc le compte n'a pas encore été validé 

    //final test pour avoir accès il faut tester que son compte est validé par le CA
            $stmt = $pdo->prepare('SELECT id_user, nom, prenom, email, password FROM adherent WHERE email = :email');
            $stmt->execute(array(
                ':email' => $email
            ));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if($data == false)
            {
              $errors['email']="<div class='alert alert-warning'>
              <p>E-mail ou mot de passe erroné </p></div>";            
            }
            else
            {
                if(md5($password) == $data['password'])
                {
                    session_start();
                    $_SESSION['name'] = $data['nom'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['id'] = $data['id_user'];
                    $_SESSION['civilite']= $data['civilite']; 
                    // on redirige vers le compte de l'utilisateur qui se connecte en récupéron son id                   
                    header('Location: account.php?session='.$_SESSION['id']);
                    exit;
                }
                else
                {
                  $errors['password']="<div class='alert alert-warning'>
                  <p>E-mail ou mot de passe erroné ou compte pas encore activé</p></div>";            
                    }
            }
        }
        catch(PDOException $e)
        {
            $errMsg = $e->getMessage();
        }


  }
    
 ?> 
<!DOCTYPE html>
<html>
<head>
    <title>Mon compte</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="EPA">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->

    <!-- Custom styles -->
    <link href="login.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-reserv" action="" method="POST">
      <img class="mb-4" src="images/logo.jpg" alt="" width="200" height="200">
      <input type="email" name="email" class="form-control" placeholder="Votre email" required autofocus>
      <br>
      <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" required autofocus>
      <br>     
      <input type="submit" name="acceder" class="btn btn-lg btn-danger btn-block" value="Accéder"> <br> 
       <a href="index.php" class="btn btn-success btn-lg btn-block"> Retour à l'accueil</a>    
        <?php if (!empty($errors) AND $_POST): ?>
            <div class="alert alert-warning">
              <p>Le formulaire n'a pas été rempli correctement</p>
              <ul>
                <?php foreach ($errors as $error): ?>
                  <li><?= $error; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?> 
      <p class="mt-5 mb-3 text-muted">&copy; 2020 by Web Factory <i class="fa fa-heart-o" aria-hidden="true"></i></p>
     
    </form>
  </body>
</html> 