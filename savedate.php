<?php 
require 'inc/db2.php';
session_start();
$id=$_GET['session'];
$user=$_GET['user'];
$req=$pdo->prepare("UPDATE adherent SET dateCotisation=CURRENT_DATE where id_user =:id_user")->execute(array(
            ':id_user' => $user
        ));               
 header('Location:compta.php?session='.$id.'&modif=ok');
?>
