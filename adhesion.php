<?php 
require_once 'inc/db.php';
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
</head>
<body>
	<?php 
	/*on va d'abord vérifier est et ce que des données ont été postés*/
	if(!empty($_POST)){
		/*phase de traitement*/
		$errors=array();

		if(empty($_POST['nom']) and empty($_POST['prenom'])  || !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['nom'])){
			$errors['nom']="Le nom entré n'est pas valide (alphanumerique)";
		}
		/*MAINTENANT ON VALIDE L EMAIL POUR CELA ON FAIT UN TEST AVEC UNE FONCTION PHP FILTER_VAR QUI RENVERRA TRUE SI C4EST VALIDE ET FALSE SINON*/
		if(empty($_POST['password']) || ($_POST['password'] != $_POST['password_confirm'])){
			$errors['password']=" le mot de passe n'est pas valide";
		}
		if (empty($errors)){
			$nom=htmlspecialchars($_POST['nom']);
			$prenom=htmlspecialchars($_POST['prenom']);
			$dnaissance=htmlspecialchars($_POST['dnaissance']);
			$email=htmlspecialchars($_POST['email']);
			$tel=htmlspecialchars($_POST['tel']);
			$cpaiement=htmlspecialchars($_POST['paiement']);	
			$sexe=htmlspecialchars($_POST['sexe']);		
			$payso=htmlspecialchars($_POST['payso']);					
			$password=md5($_POST['password']);

			$stmt = $pdo->prepare('SELECT id_user, nom, prenom, date_naissance, email, password,choix_paiement FROM adherent WHERE email = :email');
			$stmt->execute(array(
				':email' => $email
			));
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			if($data == TRUE){
				$errors['email']="L'email est déja utilisé ";

			}
		// je veux tester si la date saisie est bien valide ou pas dans ce cas j'effectue ce test
			else{
				$datefor="2020-01-01";
				$datesaisie=$_POST['dnaissance'];
				$stdatefor=strtotime($datefor);
				$stdatesaisie=strtotime($datesaisie);
				$nbj=$stdatefor-$stdatesaisie;
				if( $nbj=== 0)
				{
					$errors['dnaissance']="erreur de saisie de votre date de naissance";
				}
				else{

					/*j'utilise des requetes préparé ici si tout se passe bien et que l'utilisateur rentre des données accepté j'insert ses informations dans ma base de données*/
					$req=$pdo->prepare("INSERT INTO adherent SET nom=?,prenom=?,date_naissance=?,sexe=?,pays_origine=?, password=?, numtel=?, email=?,choix_paiement=?, dateInscription=CURRENT_DATE, valide=FALSE");
					/*on va eviter de stocker le mot de passe en claire dans la base de données on va donc hacher le mot de passe pour que le compte soit plus sécurisé on va utiliser les fonctions de hashage disponible sur php password_hash ou crypt on va utiliser le mode BCRYPT car en lisant la doc le mode par defaut change dans le temps et ce n'est pas ce qu'on veut*/
					$req->execute([$nom,$prenom,$dnaissance,$sexe,$payso,$password,$tel,$email,$cpaiement]);
				}
		/*une fois que tout est bon on va rediriger l'utilisateur vers la page d'accueil il ne sera pas 
		possible de se connecter jusqu'à validation du compte par le service*/
		if (isset($_POST['submit'])){
			if ($_POST['dnaissance']=="2018-07-22") {
				$errors['dnaissance']="<div class='alert alert-warning'>
				<p>Erreur lors de la saisie de la Période </p></div>";
			}}
			$req=$pdo->prepare("SELECT MAX(id_user) as maxy FROM adherent");
			$resp=$req->execute();
			if($resp!== FALSE)
			{
				while ($data = $req->fetch()) 
				{
					$id_user=$data['maxy'];
					header('Location: ajouterTheme.php?session='.$id_user);
				}
			}
			/*et on met la fin de notre script*/
			exit();
		}
	}

	/*je vais créer une fonction afin de debeguer les erreurs*/
	
}
?>
<div class="super_container">
	
	<?php require 'head.php' ?>


	<div class="container w" style="background-color: white; color: black; margin-top: 100px">
		<div class="row centered">
			<br><br>
			<div class="col-lg-8  monform">
				<form action="" method="POST">
					<p style="color: red">Les champs marqués d'un astérisque (*) doivent etre renseigné</p>
					<?php if ( !empty($errors) AND $_POST): ?>
						<div class="alert alert-warning">
							<p>Le formulaire n'a pas été rempli correctement</p>
							<ul>
								<?php foreach ($errors as $error): ?>
									<li><?= $error; ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
					<br>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for=""> Sexe </label>
							<!--ici required indique que le champ est obligatoire -->
							<select name="sexe" class="form-control">
								<option value="">--</option>
								<option value="F">Féminin</option>
								<option value="M">Masculin</option>
							</select>
						</div>	
						<div class="form-group col-md-4">
							<label for="">NOM  </label>
							<!--ici required indique que le champ est obligatoire -->
							<input type="text" name="nom" placeholder="entrez votre Nom" class="form-control" />
						</div>
						<div class="form-group 4">
							<label for="">PRENOM </label>
							<!--ici required indique que le champ est obligatoire -->
							<input type="text" name="prenom" placeholder="entrez votre Prénom" class="form-control"/>
						</div>		
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="">Date de naissance  </label>
							<!--ici required indique que le champ est obligatoire -->
							<input type="date" name="dnaissance" value="2020-01-01"class="form-control" />
						</div>
						<div class="form-group col-md-6">
							<label for=""> Pays </label>
							<!--ici required indique que le champ est obligatoire -->
							<select class="form-control" name="payso">
								<option value="Afghanistan">Afghanistan</option>
								<option value="Afrique_du_Sud">Afrique du Sud</option>
								<option value="Albanie">Albanie</option>
								<option value="Algerie">Algérie</option>
								<option value="Allemagne">Allemagne</option>
								<option value="Andorre">Andorre</option>
								<option value="Angola">Angola</option>
								<option value="Antigua-et-Barbuda">Antigua-et-Barbuda</option>
								<option value="Arabie_saoudite">Arabie saoudite</option>
								<option value="Argentine">Argentine</option>
								<option value="Armenie">Arménie</option>
								<option value="Australie">Australie</option>
								<option value="Autriche">Autriche</option>
								<option value="Azerbaidjan">Azerbaïdjan</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bahrein">Bahreïn</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="Barbade">Barbade</option>
								<option value="Belau">Belau</option>
								<option value="Belgique">Belgique</option>
								<option value="Belize">Belize</option>
								<option value="Benin">Bénin</option>
								<option value="Bhoutan">Bhoutan</option>
								<option value="Bielorussie">Biélorussie</option>
								<option value="Birmanie">Birmanie</option>
								<option value="Bolivie">Bolivie</option>
								<option value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
								<option value="Botswana">Botswana</option>
								<option value="Bresil">Brésil</option>
								<option value="Brunei">Brunei</option>
								<option value="Bulgarie">Bulgarie</option>
								<option value="Burkina">Burkina</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodge">Cambodge</option>
								<option value="Cameroun">Cameroun</option>
								<option value="Canada">Canada</option>
								<option value="Cap-Vert">Cap-Vert</option>
								<option value="Chili">Chili</option>
								<option value="Chine">Chine</option>
								<option value="Chypre">Chypre</option>
								<option value="Colombie">Colombie</option>
								<option value="Comores">Comores</option>
								<option value="Congo">Congo</option>
								<option value="Cook">Cook</option>
								<option value="Coree_du_Nord">Corée du Nord</option>
								<option value="Coree_du_Sud">Corée du Sud</option>
								<option value="Costa_Rica">Costa Rica</option>
								<option value="Cote_Ivoire">Côte d'Ivoire</option>
								<option value="Croatie">Croatie</option>
								<option value="Cuba">Cuba</option>
								<option value="Danemark">Danemark</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominique">Dominique</option>
								<option value="Egypte">Égypte</option>
								<option value="Emirats_arabes_unis">Émirats arabes unis</option>
								<option value="Equateur">Équateur</option>
								<option value="Erythree">Érythrée</option>
								<option value="Espagne">Espagne</option>
								<option value="Estonie">Estonie</option>
								<option value="Etats-Unis">États-Unis</option>
								<option value="Ethiopie">Éthiopie</option>
								<option value="Fidji">Fidji</option>
								<option value="Finlande">Finlande</option>
								<option value="France">France</option>
								<option value="Gabon">Gabon</option>
								<option value="Gambie">Gambie</option>
								<option value="Georgie">Géorgie</option>
								<option value="Ghana">Ghana</option>
								<option value="Grèce">Grèce</option>
								<option value="Grenade">Grenade</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guinee">Guinée</option>
								<option value="Guinee-Bissao">Guinée-Bissao</option>
								<option value="Guinee_equatoriale">Guinée équatoriale</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haïti</option>
								<option value="Honduras">Honduras</option>
								<option value="Hongrie">Hongrie</option>
								<option value="Inde">Inde</option>
								<option value="Indonesie">Indonésie</option>
								<option value="Iran">Iran</option>
								<option value="Iraq">Iraq</option>
								<option value="Irlande">Irlande</option>
								<option value="Islande">Islande</option>
								<option value="Israël">Israël</option>
								<option value="Italie">Italie</option>
								<option value="Jamaique">Jamaïque</option>
								<option value="Japon">Japon</option>
								<option value="Jordanie">Jordanie</option>
								<option value="Kazakhstan">Kazakhstan</option>
								<option value="Kenya">Kenya</option>
								<option value="Kirghizistan">Kirghizistan</option>
								<option value="Kiribati">Kiribati</option>
								<option value="Koweit">Koweït</option>
								<option value="Laos">Laos</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Lettonie">Lettonie</option>
								<option value="Liban">Liban</option>
								<option value="Liberia">Liberia</option>
								<option value="Libye">Libye</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lituanie">Lituanie</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macedoine">Macédoine</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malaisie">Malaisie</option>
								<option value="Malawi">Malawi</option>
								<option value="Maldives">Maldives</option>
								<option value="Mali">Mali</option>
								<option value="Malte">Malte</option>
								<option value="Maroc">Maroc</option>
								<option value="Marshall">Marshall</option>
								<option value="Maurice">Maurice</option>
								<option value="Mauritanie">Mauritanie</option>
								<option value="Mexique">Mexique</option>
								<option value="Micronesie">Micronésie</option>
								<option value="Moldavie">Moldavie</option>
								<option value="Monaco">Monaco</option>
								<option value="Mongolie">Mongolie</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Namibie">Namibie</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Népal</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Niger">Niger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Niue">Niue</option>
								<option value="Norvège">Norvège</option>
								<option value="Nouvelle-Zelande">Nouvelle-Zélande</option>
								<option value="Oman">Oman</option>
								<option value="Ouganda">Ouganda</option>
								<option value="Ouzbekistan">Ouzbékistan</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Panama">Panama</option>
								<option value="Papouasie-Nouvelle_Guinee">Papouasie - Nouvelle Guinée</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Pays-Bas">Pays-Bas</option>
								<option value="Perou">Pérou</option>
								<option value="Philippines">Philippines</option>
								<option value="Pologne">Pologne</option>
								<option value="Portugal">Portugal</option>
								<option value="Qatar">Qatar</option>
								<option value="Republique_centrafricaine">République centrafricaine</option>
								<option value="Republique_dominicaine">République dominicaine</option>
								<option value="Republique_tcheque">République tchèque</option>
								<option value="Roumanie">Roumanie</option>
								<option value="Royaume-Uni">Royaume-Uni</option>
								<option value="Russie">Russie</option>
								<option value="Rwanda">Rwanda</option>
								<option value="Saint-Christophe-et-Nieves">Saint-Christophe-et-Niévès</option>
								<option value="Sainte-Lucie">Sainte-Lucie</option>
								<option value="Saint-Marin">Saint-Marin </option>
								<option value="Saint-Siège">Saint-Siège, ou leVatican</option>
								<option value="Saint-Vincent-et-les_Grenadines">Saint-Vincent-et-les Grenadines</option>
								<option value="Salomon">Salomon</option>
								<option value="Salvador">Salvador</option>
								<option value="Samoa_occidentales">Samoa occidentales</option>
								<option value="Sao_Tome-et-Principe">Sao Tomé-et-Principe</option>
								<option value="Senegal">Sénégal</option>
								<option value="Seychelles">Seychelles</option>
								<option value="Sierra_Leone">Sierra Leone</option>
								<option value="Singapour">Singapour</option>
								<option value="Slovaquie">Slovaquie</option>
								<option value="Slovenie">Slovénie</option>
								<option value="Somalie">Somalie</option>
								<option value="Soudan">Soudan</option>
								<option value="Sri_Lanka">Sri Lanka</option>
								<option value="Sued">Suède</option>
								<option value="Suisse">Suisse</option>
								<option value="Suriname">Suriname</option>
								<option value="Swaziland">Swaziland</option>
								<option value="Syrie">Syrie</option>
								<option value="Tadjikistan">Tadjikistan</option>
								<option value="Tanzanie">Tanzanie</option>
								<option value="Tchad">Tchad</option>
								<option value="Thailande">Thaïlande</option>
								<option value="Togo">Togo</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinite-et-Tobago">Trinité-et-Tobago</option>
								<option value="Tunisie">Tunisie</option>
								<option value="Turkmenistan">Turkménistan</option>
								<option value="Turquie">Turquie</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Ukraine">Ukraine</option>
								<option value="Uruguay">Uruguay</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Viet_Nam">Viêt Nam</option>
								<option value="Yemen">Yémen</option>
								<option value="Yougoslavie">Yougoslavie</option>
								<option value="Zaire">Zaïre</option>
								<option value="Zambie">Zambie</option>
								<option value="Zimbabwe">Zimbabwe</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="">Email * </label>
							<input type="text" name="email" class="form-control" placeholder="entrez une adresse mail valide" required="" />
						</div>
						<div class="form-group col-md-6">
							<label for="">Téléphone * </label>
							<input type="text" name="tel" placeholder="entrez votre numero de telephone" class="form-control" /> <h5>numéro de téléphone mobile</h5>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="">Mot de passe *</label>
							<input type="password" name="password" placeholder="saisissez un mot de passe" class="form-control" required="" />
						</div>
						<div class="form-group col-md-6">
							<label for="">Confirmation du Mot de passe *</label>
							<input type="password" name="password_confirm" placeholder="" class="form-control" required="" />
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="">Choix de paiement * </label>
							<!--ici required indique que le champ est obligatoire -->
							<select name="paiement" class="form-control">
								<option value="" disabled selected>Choisissez votre mode de paiement</option>
								<option value="cheque">Chèque</option>
								<option value="prelevement">Prélèvement</option>
							</select>
						</div>
					</div>
					<button type="submit" class="btn btn-danger"> Renseigner</button>
					<button type="reset" class="btn btn-success"> Effacer</button>
					<button class="btn btn-warning	"><a class="btn-warning" href="index.html">Annuler</a></button>
				</form><br>
			</div>
			<div class="col-lg-4 ">
				<div class="alert alert-success">
					<h3>Important </h3>
					<br><br>
					<div>
						Merci de renseigner toutes les informations demandées afin que nous puissions valider votre inscription
					</div>
					<br>
					<ul style="list-style: square;">
						<br>
						<li> Renseigner vos Information personnelles</li>
						<br>
						<li> Contactez nous pour valider si vous rencontrez des difficulté d'inscription dans la rubrique <a href="contact.html">"Contact"</a></li><br>
						<li> Consultez et modifiez vos information si besoin </li><br>
						<li> Le désabonnement se fait par les directives mise en <a href="annex.html">"Annexe"</a></li>
					</ul>
					<br>
					<p class="text-center">Merci <i class="fa fa-heart"></i></p>
				</div>
			</div>
		</div>
	</div>

	<?php require 'inc/footer.php'; ?>