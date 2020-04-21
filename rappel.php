<?php 
session_start();
require 'inc/db2.php';
$membre=$_GET['membre'];
$id=$_GET['session'];
 
 try
{
 $req =  $pdo->prepare('INSERT INTO notification_paiement (id_user,note,date_note) VALUES (?,?,CURRENT_DATE)');
    $req->execute([$membre,"rappel paiement"]); 
     header('Location: secretaire.php?session='.$id.'&rappel=ok');
 }
 catch(PDOException $e)
{
  $errMsg = $e->getMessage();
}
 ?>
