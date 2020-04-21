<?php 
session_start();
require 'inc/db2.php';
$reunion=$_GET['reunion'];
$id=$_GET['session'];
 
 try
{
	echo $reunion;
 $req =  $pdo->prepare('INSERT INTO notification_reunion (id_reunion,notification,date_notification) VALUES (?,?,CURRENT_DATE)');
    $req->execute([$reunion,"Nouvelle notification"]); 
    $req = $pdo->prepare('UPDATE reunion SET diffuse=:diff where id_reunion = :id_reunion')->execute(array(     
            ':diff' => 1,
            ':id_reunion' => $reunion));
     header('Location: secretaire.php?session='.$id.'&diffusion=ok');
 }
 catch(PDOException $e)
{
  $errMsg = $e->getMessage();
}
 ?>
