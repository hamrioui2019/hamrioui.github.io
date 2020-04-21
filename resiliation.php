<?php 
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
$nom=$_GET['nom'];
$prenom=$_GET['prenom'];
 try
{
 $req =  $pdo->prepare('INSERT INTO demande_resiliation (id_user,nom,prenom,traite) VALUES (?,?,?,?)');
    $req->execute([$id,$nom,$prenom,0]); 
     header('Location: account.php?session='.$id.'&res=ok');
 }
 catch(PDOException $e)
{
  $errMsg = $e->getMessage();
}
 ?>
