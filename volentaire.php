<?php  
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
$ad=$_GET['membre'];

try
{
	 // liste des adhérents
    $req = $pdo->prepare('INSERT INTO volontaire (id_user,date_vol) VALUES (?,CURRENT_DATE)');
    $req->execute([$ad]);
     header('Location: acceuil_etudiant.php?session='.$id.'&modif=ok');
}
	catch(PDOException $e)
{
  $errMsg = $e->getMessage();
}
?>