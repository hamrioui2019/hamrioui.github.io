<?php 
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
$id_user=$_GET['membre'];
try
{
	$req = $pdo->prepare('SELECT * FROM adherent');
	$req->execute();
	$adherents = $req->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	$errMsg = $e->getMessage();
}
if(isset($_POST['submit'])){ 

	$objet=$_POST['objet'];
	$message=$_POST['th'];
	if(!empty($_POST) ){
	    $req=$pdo->prepare('INSERT INTO messageadherent(id_user,objet,message,date) VALUES(?,?,?,CURRENT_DATE)');
	            $req->execute([$id_user,$objet,$message]);               
	            header('Location: contact_mbr.php?session='.$id.'&membre='.$id_user.'&env=ok');
	        }
}
//diffuser a tous les membres
if(isset($_POST['diffuser'])){ 

	$objet=$_POST['objet'];
	$message=$_POST['th'];
	if(!empty($_POST) ){
		foreach ($adherents as $adherent) {
	   	 $req=$pdo->prepare('INSERT INTO messageadherent(id_user,objet,message,date) VALUES(?,?,?,CURRENT_DATE)');
	            $req->execute([$adherent['id_user'],$objet,$message]);               
	           
	        }
	        header('Location:contact_mbr.php?session='.$id.'&membre='.$id_user.'&diff=ok');
	    }
}
     ?>
<?php require 'header.php' ?>

<br>
<main >
	<div class="container-fluid">
    <button class="btn btn-danger" onclick="history.go(-1);"> Retour</button>
    <br>
	<div class="row">
     <div class="col-md-7">
          <br>

       <div class="card">
       	<?php
             if(isset($_GET['diff']) && $_GET['diff'] == 'ok')
             {
              echo '<div class="alert alert-success" role="alert">
              votre message a bien été diffusé .
              </div>';
            }?>
            <?php
             if(isset($_GET['env']) && $_GET['env'] == 'ok')
             {
              echo '<div class="alert alert-warning" role="alert">
              votre message a été envoyé au membre.
              </div>';
            }?>
        <div class="card-header">Envoyer un message :</div>
        <div class="card-body">
        	 <form action="" method="POST">
         <table class="table table-responsive table-hover">
           <thead>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
                    <tr>
                    	<td>L'objet:</td>
                      <td>
                      	<div class="form-group">
                            <input type="text" name="objet" class="form-control" placeholder="Entrez l'objet" />
                        </div></td>
                    </tr>
                    <tr>
                    	<td>Message</td>
                    	<td>
                      	<div class="form-group">
		              		<textarea name="th" class="form-control" rows="5" cols="33" placeholder="Entrez votre message">
		              		</textarea>
		              		<br>
                		</div>
                      </td>
                    </tr>
              </tbody>
         </table>
         <button type="submit" name="submit" class="btn btn-primary"> Envoyer le message</button>
     	  <button name="diffuser" class="btn btn-success">Diffuser a tous les adhérents</button>
     </form>
       </div>
     </div>
   </div>
    <div class="col-md-5">
       <div class="card">
        <div class="card-header">Liste des adhérents</div>
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
                  <?php foreach ($adherents as $adherent){ ?>
                    <tr>
                      <td><?php echo $adherent['id_user'] ?></td>
                      <td><p><?php echo $adherent['nom'] ?></p></td>
                      <td><?php echo $adherent['prenom'] ?></td>
                      <td><?php echo $adherent['numtel'] ?></td>
                      <td><?php echo $adherent['email'] ?></td>
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
<?php require 'inc/footer.php' ?>