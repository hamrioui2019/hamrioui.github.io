<?php 
session_start();
require 'inc/db2.php';
$id=$_GET['session'];

if(isset($_POST['submit'])){
	$nom=htmlspecialchars($_POST['theme']);	
    if(!empty($_POST)){
        $req=$pdo->prepare('INSERT INTO forum (theme) VALUES (?)')->execute([$nom]);
        header('Location: presidente.php?session='.$id.'forum=ok');
    }
    
 }
 ?>
 <?php require 'header.php' ?>
<main class="py-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                	<div class="card-header">Créer un forum</div>
                    <div class="card-body">
                    	 <form action="" method="POST">
                            <table class="table table-responsive table-hover">
                                <thead>
                                        <th></th>
                                </thead>
                               <tbody>
                                    <tr>
                                        <td>Theme</td>
                                            <td>
                                                <div class="form-group">
												  <select class="form-control" name="theme">
											      <option disabled="">choisissez parmis les themes</option>
											      <option value="Accueil des étudiants en France">Accueil des étudiants en France</option>
											      <option value="Education">Education</option>
											      <option value="Action Sociale et solidaire">Action Sociale et solidaire</option>
											      <option value="Santé et mutuelle">Santé et mutuelle</option>
											    </select>
												</div>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>

                                <button type="submit" name="submit" class="btn btn-success"> OK</button>&emsp;&emsp;&emsp;&emsp;
                                <button type="reset" class="btn btn-warning"> Effacer</button>&emsp;&emsp;&emsp;&emsp;
                                <a class="btn btn-danger" href=<?php echo "presidente.php?session=".$id?> >Annuler</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



 <?php require 'inc/footer.php' ?>