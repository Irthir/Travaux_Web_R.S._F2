<?php
	define("SERVERNAME", "localhost"); //Nom du serveur.
	define("USERNAME", "root"); //Nom d'utilisateur.
	define("PASSWORD", ""); //Mot de Passe.
	define("DBNAME", "DB_SI_SERVICE_BIBLIOTHEQUE"); //Nom de la Base de Donnée.

	function ConnexionBDD()
	{
		$dsn="mysql:host=".SERVERNAME.";dbname=".DBNAME;//Data Source Name.
		try //Block try à voir ce que c'est.
		{
		    $conn = new PDO($dsn,USERNAME,PASSWORD);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    echo "<script>console.log(\"Connexion réussie à la base ".DBNAME." !\");</script>"; //Si l'erreur n'est pas catch, on envoie ce message.
		}
		catch(PDOException $e) //Block catch à voir ce que c'est.
		{
		    echo "<h1 style='color: red;'>Connexion échouée: " . $e->getMessage()."</h1>"; //Connexion échouée puis le message d'erreur.
		}
		return $conn;
	}
?>