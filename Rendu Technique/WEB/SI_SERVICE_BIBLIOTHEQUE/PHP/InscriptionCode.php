<?php
	require_once "ConnexionALaBDD.php";
	$connexion=ConnexionBDD();

	if (isset($_REQUEST["NomEmploye"]) and !empty($_REQUEST["NomEmploye"]))
	{
		$Manager = new EmployeManager($connexion);

		//Tableau des valeurs du client à créer
		$mEmploye = array
		(
			"NomEmploye" => $_REQUEST["NomEmploye"],
			"Adresse" => $_REQUEST["Adresse"],
			"NumeroTelephone" => $_REQUEST["NumeroTelephone"],
			"Service" => $_REQUEST["Service"]
		);

		$Employe = new Employe;

		$Employe->hydrate($mEmploye);

		$Manager->addEmploye($Employe);
	}
?>
