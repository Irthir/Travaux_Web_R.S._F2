<?php
	require_once 'modeleAuteur.php';
	require_once 'ConnexionALaBDD.php';

	/*Classe AuteurManager en PHP*/
	class AuteurManager
	{
		//Le manager a besoin d'une connexion.
		private $_db;

		//Constructeur du Manager
		public function __Construct($db)
		{
			$this->setDB($db);
		}

		public function setDB(PDO $db)
		{
			$this->_db=$db;
		}

		//Créer un Auteur
		public function addAuteur(Auteur $Auteur)
		{
			//Récupérer la connexion
			global $connexion;

			$req = "INSERT INTO Auteur (Pseudo, NomAuteur, NumeroTelephone,Pseudo) VALUES
					(:PSEUDO,:NOMAUTEUR)";

			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.

				/*Avec bindValue*/
				$stmt->bindValue(":PSEUDO",$Auteur->getPseudo(), PDO::PARAM_STR);
				$stmt->bindValue(":NOMAUTEUR",$Auteur->getNomAuteur(), PDO::PARAM_STR);

				//Exécuter la requête
				$stmt->execute();

				//On referme la base
				$stmt->closeCursor();

				//On indique que l'insertion s'est bien passée
				echo "<script>console.log(\"Insertion des données Auteur effectuée\");</script>";
			}
			catch(PDOException $e)
			{
				echo "<script>console.log(\"Erreur : ".$e->getMessage()."\");</script>";
			}
		}

		//Retourne un Auteur si le Pseudo est correct
		public function getAuteurByPseudo($Pseudo)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "SELECT Pseudo, NomAuteur FROM Auteur WHERE Pseudo IN (\"$Pseudo\")";
			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.
				//Exécuter la requête
				$stmt->execute();

				$nb=$stmt->rowcount();
				$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);

				if ($nb==1)
				{
					$mAuteur = array
					(
						"Pseudo" => $result['Pseudo'],
						"NomAuteur" => $result['NomAuteur']
					);

					$AuteurActuel = new Auteur;

					$AuteurActuel->hydrate($mAuteur);

					return $AuteurActuel;
				}
				elseif ($nb<1)
				{
					//On indique qu'il y a eu un problième dans la récupération du Auteur.
					echo "<script>console.log(\"Aucun résultat pour : Pseudo = $Pseudo.\");</script>";
				}
				else
				{
					//On indique qu'il y a eu un problème dans la récupération du Auteur.
					echo "<script>console.log(\"Erreur critique, plusieurs Auteurs ayant le même Pseudo existent : Pseudo = $Pseudo.\");</script>";
				}

				//On referme la base
				$stmt->closeCursor();

				//On indique que l'insertion s'est bien passée
				echo "<script>console.log(\"Requête effectuée.\");</script>";

			}
			catch(PDOException $e)
			{
				echo "<script>console.log(\"Erreur : ".$e->getMessage()."\");</script>";
			}
		}


		//Update un Auteur
		public function updateAuteurNomAuteur($Pseudo,$NomAuteur)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "UPDATE Auteur SET NomAuteur=\"$NomAuteur\" WHERE Pseudo IN (\"$Pseudo\")";
			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.
				//Exécuter la requête
				$stmt->execute();
			}
			catch(PDOException $e)
			{
				echo "<script>console.log(\"Erreur : ".$e->getMessage()."\");</script>";
			}
			echo "<script>console.log(\"Votre NomAuteur a bien été mise à jour.\");</script>";
		}

		//Supprimer un Auteur
		public function deleteAuteur(Auteur $Auteur)
		{
			$this->_db->exec('DELETE FROM Auteur WHERE Pseudo = '.$Auteur->getPseudo());
		}
		//Supprimer un Auteur en renseignant l'ID
		public function deleteAuteurById($id)
		{
			$this->_db->exec('DELETE FROM Auteur WHERE Pseudo = '.$id);
		}
	}

?>
