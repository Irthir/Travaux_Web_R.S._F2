<?php
	session_start();

	require_once "ConnexionALaBDD.php";
	$connexion=ConnexionBDD();
	
	require_once "Objets_PHP/modeEmployeManager.php";
	require_once "Objets_PHP/modeEmpruntManager.php";
	require_once "Objets_PHP/modeExemplaireManager.php";
	require_once "Objets_PHP/modeAuteurManager.php";
	require_once "Objets_PHP/modeOuvrageManager.php";
	require_once "Objets_PHP/modeServiceManager.php";

	require_once "FonctionAffichage.php";

	if (!isset($_SESSION['Utilisateur']))
	{
		header("Location:./Deconnexion.php");
		exit();
	}
	if ($_SESSION["Utilisateur"]!="Admin")
	{
		header("Location:./Deconnexion.php");
		exit();
	}
?>

<!DOCTYPE html>
<HTML>
	<HEAD>
		<link rel="stylesheet" type="text/css" href="../CSS/Index.CSS" charset="utf-8"/>
		<style type="text/css">
			table
			{
				border-collapse: collapse;
				text-align: center;
				width: 50%;
				margin: auto;
			}

			table, th, td
			{
				border: 1px solid black;
			}
		</style>
		<link rel="shortcut icon" type="image/x-icon" href="../Contenus/images/cirno9.jpg"/>
		<meta charset="utf-8"/>
		<lang="fr"/>
		<TITLE>Admin</TITLE>
	</HEAD>

	<BODY>
		<div class="TailleHeader"></div>
		<header><a class="LienDeconnexion" href="./Deconnexion.php">Deconnexion</a><br/></header>
		
		<h1>Ceci est une page PHP pour l'admin.</h1>

		<?php
			echo "<h2>Bonjour ".$_SESSION['Utilisateur'].".</h2><br/>";
		?>

		<?php
			if (isset($_REQUEST['submit']))
			{
				echo "<h2>Les tables demandées : </h2>";
			}
			if (isset($_REQUEST['Service']))
			{
				AfficheTable('Service',$connexion);
			}
			if (isset($_REQUEST['Employe']))
			{
				AfficheTable('Employe',$connexion);
			}
			if (isset($_REQUEST['Emprunt']))
			{
				AfficheTable('Emprunt',$connexion);
			}
			if (isset($_REQUEST['Exemplaire']))
			{
				AfficheTable('Exemplaire',$connexion);
			}
			if (isset($_REQUEST['Ouvrage']))
			{
				AfficheTable('Ouvrage',$connexion);
			}
			if (isset($_REQUEST['Auteur']))
			{
				AfficheTable('Auteur',$connexion);
			}
		?>

		<h2>Afficher les tables :</h2>
		<form id="formAdmin" nom="formAdmin" style="width: 100%;">
			<fieldset style="width: 40%;">
				<LEGEND> Les tables à afficher : </LEGEND>
				<div>
					<label for="Service">Service : </label>
					<input type="checkbox" name="Service" id="Service" value="Service">
				</div>
				<div>
					<label for="Employe">Employe : </label>
					<input type="checkbox" name="Employe" id="Employe" value="Employe">
				</div>
				<div>
					<label for="Emprunt">Emprunt : </label>
					<input type="checkbox" name="Emprunt" id="Emprunt" value="Emprunt">
				</div>
				<div>
					<label for="Exemplaire">Exemplaire : </label>
					<input type="checkbox" name="Exemplaire" id="Exemplaire" value="Exemplaire">
				</div>
				<div>
					<label for="Ouvrage">Ouvrage : </label>
					<input type="checkbox" name="Ouvrage" id="Ouvrage" value="Ouvrage">
				</div>
				<div>
					<label for="Auteur">Auteur : </label>
					<input type="checkbox" name="Auteur" id="Auteur" value="Auteur">
				</div>
				<br/>
				<div>
					<input type="submit" class="boutonsFormulaires" name="submit" value="Valider" style="left: 0%">
					<input type="button" class="boutonsFormulaires" name="Reset" value="Réinitialiser" onclick="location.href='Admin.php'" style="right: 0%">
				</div>
			</fieldset>
		</form>

		<a href="./Deconnexion.php">Deconnexion</a><br/>
		<footer>
		<h3>Contact :</h3>
			<ul><li>r.schlotter@ludus-academie.com</li></ul>
		</footer>
	</BODY>
</HTML>