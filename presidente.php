<?php 
session_start();
require 'inc/db2.php';
$id=$_GET['session'];
try
{
  $req = $pdo->prepare('SELECT * FROM adherent');
  $req->execute();
  $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);

  $req =  $pdo->prepare('SELECT id_membre, nomM, prenomM,phone,email FROM membrebureau where id_membre!=?');
  $req->execute([$id]);
  $membres = $req->fetchAll(PDO::FETCH_ASSOC);

    //j'affiche les reunions
  $req =  $pdo->prepare('SELECT * FROM reunion');
  $req->execute();
  $reunions = $req->fetchAll(PDO::FETCH_ASSOC);

  $req1=$pdo->prepare('SELECT * FROM docPDF');
  $req1->execute();
  $fichiers= $req1->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
  $errMsg = $e->getMessage();
}

//valider un adherent 
if(isset($_POST['idAvalider']))
{   
  $req=$pdo->prepare('UPDATE adherent SET valide=:valide where id_user = :id_user')->execute(array(     
    ':valide' => 1,
    ':id_user' => $_POST['idAvalider']));
  header('Location: presidente.php?session='.$id);
}
  //modifier les information perso
if (isset($_POST['idAmod'])) {
  header('Location: modificationIP_m.php?session='.$_SESSION['id'].'?modif='.$_POST['idAmod']);
}
  //suprimer un adherent
if (isset($_POST['idAsupprimer'])) {
  $req=$pdo->prepare('DELETE FROM adherent WHERE id_user =?')->execute([$_POST['idAsupprimer']]);
  header('Location: presidente.php?session='.$id);
}
// acces au forum
if(isset($_POST['idForum']))
{   
  header('Location:forum.php?session='.$_SESSION['id']);
}
if(isset($_POST['idPJ']))
{   
 header('Location:reunion_doc.php?session='.$_SESSION['id'].'&reunion='.$_POST['idPJ']);
}
  //plannification d'une reunion
if(isset($_POST['idAplan']))
{   
 header('Location:reunion.php?session='.$_SESSION['id']);
}
//contacter un membre


?> 
<?php require 'header.php'?>

<!-- je personnalise un peut mon message de bienvenue en l'adaptant à chaque utilisateur -->
<div class="col-lg-8 offset-2 centered">
<br>
  <h3>Vous etes connecté ainsi vous pouvez acceder à toutes vos informations</h3>
</div>


<main class="py-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
         <?php
         if(isset($_GET['modif']) && $_GET['modif'] == 'ok')
         {
          echo '<div class="alert alert-success" role="alert">
          vos modifications ont bien été bien enregistrées .
          </div>';
        }
        if(isset($_GET['reunion']) && $_GET['reunion'] == 'ok')
        {
          echo '<div class="alert alert-success" role="alert">
          Réunion enregistrées .
          </div>';
        }

        ?>          
        <div class="card-header">Les adhérents en attentes de validation/ validés</div>
        <div class="card-body">

          <table class="table table-responsive table-hover">
            <thead>
              <th>ID</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>numéro Tél</th>
              <th>Email</th>
              <th>valide</th>
            </thead>
            <tbody>
              <?php foreach ($utilisateurs as $utilisateur){?>
                <tr>
                  <td><?php echo $utilisateur['id_user'] ?></td>
                  <td><p><?php echo $utilisateur['nom'] ?></p></td>
                  <td><?php echo $utilisateur['prenom'] ?></td>
                  <td><?php echo $utilisateur['numtel'] ?></td>
                  <td><?php echo $utilisateur['email'] ?></td>
                  <td><?php echo $utilisateur['valide'] ?></td>
                  <?php if ($utilisateur['valide']) {?>
                    <td></td>
                    <td>
                      <button class="btn btn-sm btn-danger" form="supprimerIP" >
                        <i class="fa fa-edit"></i> Supprimer
                      </button>
                      <form method="post" action="" hidden id="supprimerIP">
                        <input name="idAsupprimer" value="<?php echo $utilisateur['id_user'] ?>">
                      </form></td>

                    <?php }else{?>
                      <td>
                        <button id="bout" class="btn btn-sm btn-success" form="validationIP" >
                          <i class="fa fa-edit"></i> Valider
                        </button>
                        <form method="post" action="" hidden id="validationIP">
                          <input name="idAvalider" value="<?php echo $utilisateur['id_user'] ?>">
                        </form>
                      </td>
                      <td>
                        <button class="btn btn-sm btn-danger" form="supprimerIP" >
                          <i class="fa fa-edit"></i> Supprimer
                        </button>
                        <form method="post" action="" hidden id="supprimerIP">
                          <input name="idAsupprimer" value="<?php echo $utilisateur['id_user'] ?>">
                        </form></td>
                      <?php }; ?>
                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
         <div class="card">
          <div class="card-header">Mes reunions </div>
          <div class="card-body">

            <table class="table table-responsive table-hover">
              <thead>
                <th>N°</th>
                <th>Lieu</th>
                <th>date</th>
                <th>Objet</th>
                <th></th>
              </thead>
              <tbody>
                <?php foreach ($reunions as $reunion){ ?>
                  <tr>
                    <td><?php echo $reunion['id_reunion']; ?></td>
                    <td><?php echo $reunion['lieu']; ?></td>
                    <td><?php echo $reunion['dat']; ?></td>
                    <td><?php echo $reunion['objet']; ?></td>
                    <td><button class="btn btn-sm btn-success" form="pjIP">
                      <i class="fa fa-download"></i>PJ
                    </button>
                    <form method="post" action="" hidden id="pjIP">
                      <input name="idPJ" value=<?php echo $reunion['id_reunion'] ?>>
                    </form>

                  </td>
                </tr>
              <?php }; ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <button class="btn btn-sm btn-warning" form="reunionIP" >
            <i class="fa fa-edit"></i> Plannifier une réunion
          </button>
          <form method="post" action="" hidden id="reunionIP">
            <input name="idAplan">">
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
   <div class="col-md-8">
     <div class="card">
      <div class="card-header">Liste des membres du bureau</div>
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
          <?php foreach ($membres as $membre){ ?>
            <tr>
              <td><?php echo $membre['id_membre'] ?></td>
              <td><p><?php echo $membre['nomM'] ?></p></td>
              <td><?php echo $membre['prenomM'] ?></td>
              <td><?php echo $membre['phone'] ?></td>
              <td><?php echo $membre['email'] ?></td>
              <td>
                <button class="btn btn-success"><a style="color: white" href=<?php echo "contact_m.php?session=".$_SESSION['id']."&membre=".$membre['id_membre']?>>Contacter</a>
                </button>
              </td>
            </tr>
          <?php }; ?>
        </table>
      </div>
    </div>
  </div>

</br>
<div class="col-md-8 offset-2">
  <br>
  <div class="card">
    <div class="card-header">Modèle de documents</div>
    <div class="card-body">
     <table class="table table-responsive table-hover">
      <thead>
        <th>Decription</th>
        <th>Visualiser</th>
        <th>Decription</th>
        <th>Visualiser</th>
      </thead>
      <tbody>
        <tr>
          <td>Bulletin d'adhésion et Appel à cotisation</td>
          <td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/bulletin.pdf"><i class="fa fa-eye"></i> </a>
          </a></button>
        </td>

        <td>Modèle de recu de dons</td>
        <td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/don.pdf"><i class="fa fa-eye"></i> </a>
        </a></button>
      </td>
    </tr>
    <tr>
      <td>Convocation à l'assemblée générale et Pouvoir</td>
      <td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/convocation.pdf"><i class="fa fa-eye"></i> </a>
      </a></button>
    </td>

    <td>Procès-verbal d'assemblée générale</td>
    <td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/proces.pdf"><i class="fa fa-eye"></i> </a>
    </a></button>
  </td>
</tr>
<tr>
  <td>Déclaration de modification des status</td>
  <td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/statut.pdf"><i class="fa fa-eye"></i> </a>
  </a></button>
</td>

<td>Fiche de remboursement de frais</td>
<td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/frais.pdf"><i class="fa fa-eye"></i> </a>
</a></button>
</td>
</tr>
<tr>
  <td>Budget prévisionnel</td>
  <td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/budget.pdf"><i class="fa fa-eye"></i> </a>
  </a></button>
</td>

<td>Lettre de demande d'un devis d'assurance</td>
<td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/devis.pdf"><i class="fa fa-eye"></i> </a>
</a></button>
</td>
</tr>

<td>Lettre de demande d'ouverture d'un compte bancaire</td>
<td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/compte.pdf"><i class="fa fa-eye"></i> </a>
</a></button>
</td>

<td>Demande de subvention</td>
<td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/subvention.pdf"><i class="fa fa-eye"></i> </a>
</a></button>
</td>

</tr>
<tr>
  <td>Demande de mise à disposition d'un local municipal</td>
  <td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/local.pdf"><i class="fa fa-eye"></i> </a>
  </a></button>
</td>

<td>Loi du 1er Juillet 1901</td>
<td><button class="btn btn-success"><a target="_blanck" style="color: white" href="doc/adherent/loi.pdf"><i class="fa fa-eye"></i> </a>
</a></button>
</td>
</tr>
</tbody></table></div>

</div>
</div>
</main>
<main class="py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
         <div class="card-header">Evenement</div>
         <div class="card-body">
          <table class="table table-responsive table-hover">
            <thead>
              <th>Spectacles</th>
            </thead>
            <tbody>
              <tr>
                <td><img src="images/im8.jpg" alt="p0" width="300" height="400"></td>
                <td><img src="images/im9.jpg" alt="pl"  width="300" height="400"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Liens utiles</div>
        <div class="card-body">
         <ul>
           <li><a href="http://agencedys.com/wp-pass/">PASS </a></li>
           <li><a href="http://www.uam-afro.org/index.html">UAM</a></li>
           <li><a href="www.ove-national.education.fr">OVE </a></li>
           <li><a href="http://www.fondationgoree.org/memorial">Message de Gorée</a></li>
           <li><a href="http://www.rfi.fr/emission/20150108-togo-conducteurs-taxi-moto-mutuelle-transport-emploi-travail-cooperation-developpement">mutuelle innovante au Togo</a></li>
           <li><a href="http://www.ilo.org/secsoc/information-resources/publications-and-tools/Toolsandmodels/WCMS_SECSOC_106/lang--fr/index.htm">Guide de gestion pour les mutuelles de santé en Afrique</a></li>

         </ul>
       </div>
     </div>
   </div>


 </div>

</main> 


</body>
</html>

<?php require 'inc/footer.php';?>