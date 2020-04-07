<?php
	require "ConnexionALaBDD.php";
	$connexion=ConnexionBDD();
	require_once 'InscriptionCode.php';
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<style type="text/css">
			.labelspan
			{
				display: inline-block;
				align: left;
				width: 50%;
			}
			.inputspan
			{
				display: inline-block;
				align: right;
				width: 50%;
			}
			/*Ca ne donne pas ce que je veux car inline-block fait se comporter le span comme un div ou un p, mais j'aime bien le résultat.*/
		</style>
		<link rel="stylesheet" type="text/css" href="../CSS/Index.CSS" charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../Contenus/images/cirno9.jpg"/>
		<meta charset="utf-8"/>
		<lang="fr"/>
		<TITLE>Inscription</TITLE>
	</HEAD>

	<BODY>
		<h1>Inscription</h1>

		<form id='inscription' name='inscription' method='POST' autocomplete="on" action="#">
		<fieldset>
			<LEGEND>Inscription : </LEGEND>
			<div><span class="labelspan"><label for="NomEmploye">Nom : </label></span>
			<span class="inputspan"><input type="text" name="NomEmploye" id="NomEmploye" required></input></span></div>
			<div><span class="labelspan"><label for="Adresse">Adresse : </label></span>
			<span class="inputspan"><input type="text" name="Adresse" id="Adresse"></input></span></div>
			<div><span class="labelspan"><label for="NumeroTelephone">Numéro de Téléphone : </label></span>
			<span class="inputspan"><input type="varchar" min="10" max="15" name="NumeroTelephone" id="NumeroTelephone"></input></span></div>
			<div><span class="labelspan"><label for="NomService">Service : </label></span>
			<span class="inputspan"><input type="text" name="NomService" id="NomService"></input></span></div>
			<br/>
			<div><input type="submit" class="boutonsFormulaires" name="submit" value="Valider" style="left: 0%">
				<input type="reset" class="boutonsFormulaires" name="reset" value="Réinitialiser" onclick="location.href='Inscription.php'" style="right: 0%"></div>
		</fieldset>
		</form>

		<a href="../index.php">Accueil</a><br/>
		
		<footer>
		<h3>Contact :</h3>
			<ul><li>r.schlotter@ludus-academie.com</li></ul>
		</footer>
	</BODY>
</HTML>