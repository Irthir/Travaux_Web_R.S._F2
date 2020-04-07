<?php
	session_start();
	require_once 'modeleEmploye.php';
	if (!isset($_SESSION['Utilisateur']))
	{
		header("Location:./Deconnexion.php");
	}
	else
	{
		if ($_SESSION["Utilisateur"]!="Admin")
		{
			header("Location:./Deconnexion.php");
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
		<TITLE>Admin</TITLE>
	</HEAD>

	<BODY>
		<h1>Ceci est une page PHP pour l'admin.</h1>

		<?php
			if (isset($_SESSION["Utilisateur"]))
			{
				echo "<h2>Bonjour ".$_SESSION['Utilisateur'].".</h2><br/>";
			}
		?>

		<a href="./Deconnexion.php">Deconnexion</a><br/>
		<footer>
		<h3>Contacts :</h3>
			<ul><li>r.schlotter@ludus-academie.com</li></ul>
		</footer>
	</BODY>
</HTML>