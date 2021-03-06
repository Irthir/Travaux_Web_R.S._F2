<?php
	require_once "ConnexionALaBDD.php";
	require_once "Objets_PHP/modeEmployeManager.php";
	$connexion=ConnexionBDD();
	if (isset($_REQUEST['NomEmploye']))
	{
		if ($_REQUEST['NomEmploye']=="Admin")
		{
			session_start();
			$_SESSION["Utilisateur"]=$_REQUEST['NomEmploye'];
			header('Location:Admin.php');
			exit();
		}
		$Manager = new EmployeManager($connexion);
		$Utilisateur = $Manager->getEmployeByNomEmploye($_REQUEST['NomEmploye']);
		if (isset($Utilisateur) AND !empty($Utilisateur))
		{
			session_start();
			$_SESSION["Utilisateur"]=$_REQUEST['NomEmploye'];
			header('Location:Utilisateur.php');
			exit();
		}
	}
?>

<!DOCTYPE html>
<HTML>
	<HEAD>
		<link rel="stylesheet" type="text/css" href="../CSS/Index.CSS" charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../Contenus/images/cirno9.jpg"/>
		<meta charset="utf-8"/>
		<lang="fr"/>
		<TITLE>Bibliothèque</TITLE>
	</HEAD>

	<BODY>
		<h1>Bienvenue !</h1>

		<form id='connexion' name='connexion' method='POST' autocomplete="on" action="#">
		<fieldset>
			<LEGEND>Connexion : </LEGEND>
			<div><label for="NomEmploye">Nom : </label>
			<input type="text" name="NomEmploye" id="NomEmploye" required></input></div><br/>
			<div><input type="submit" class="boutonsFormulaires" name="submit" value="Connexion" style="left: 0%">
				<input type="button" class="boutonsFormulaires" name="inscription" value="Inscription" onclick="location.href='Inscription.php'" style="right: 0%"></div>
		</fieldset>
		</form>

		
		<footer>
			<h3>Contact :</h3>
			<ul><li>r.schlotter@ludus-academie.com</li>
			</ul>
		</footer>
	</BODY>
</HTML>