<?php
	require_once 'modeleExemplaire.php';
	require_once 'ConnexionALaBDD.php';

	/*Classe ExemplaireManager en PHP*/
	class ExemplaireManager
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

		//Créer un Exemplaire
		public function addExemplaire(Exemplaire $Exemplaire)
		{
			//Récupérer la connexion
			global $connexion;

			$req = "INSERT INTO Exemplaire (IDExemplaire, DateAchat, Prix,ISBN) VALUES
					(:IDEXEMPLAIRE,:DATEACHAT,:PRIX,:ISBN)";

			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.

				/*Avec bindValue*/
				$stmt->bindValue(":IDEXEMPLAIRE",$Exemplaire->getIDExemplaire(), PDO::PARAM_STR);
				$stmt->bindValue(":DATEACHAT",$Exemplaire->getDateAchat(), PDO::PARAM_STR);
				$stmt->bindValue(":PPRIX",$Exemplaire->getPrix(), PDO::PARAM_STR);
				$stmt->bindValue(":ISBN",$Exemplaire->getISBN(), PDO::PARAM_STR);

				//Exécuter la requête
				$stmt->execute();

				//On referme la base
				$stmt->closeCursor();

				//On indique que l'insertion s'est bien passée
				echo "<script>console.log(\"Insertion des données Exemplaire effectuée\");</script>";	
			}
			catch(PDOException $e)
			{
				echo "<script>console.log(\"Erreur : ".$e->getMessage()."\");</script>";
			}
		}

		//Retourne un Exemplaire si le IDExemplaire est correct
		public function getExemplaireByIDExemplaire($IDExemplaire)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "SELECT IDExemplaire, DateAchat, Prix, ISBN FROM Exemplaire WHERE IDExemplaire IN (\"$IDExemplaire\")";
			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.
				//Exécuter la requête
				$stmt->execute();

				$nb=$stmt->rowcount();
				$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);

				if ($nb==1)
				{
					$mExemplaire = array
					(
						"IDExemplaire" => $result['IDExemplaire'],
						"DateAchat" => $result['DateAchat'],
						"Prix" => $result['Prix'],
						"ISBN" => $result['ISBN']
					);

					$ExemplaireActuel = new Exemplaire;

					$ExemplaireActuel->hydrate($mExemplaire);

					return $ExemplaireActuel;
				}
				elseif ($nb<1)
				{
					//On indique qu'il y a eu un problième dans la récupération du Exemplaire.
					echo "<script>console.log(\"Aucun résultat pour : IDExemplaire = $IDExemplaire.\");</script>";
				}
				else
				{
					//On indique qu'il y a eu un problème dans la récupération de de l'Exemplaire.
					echo "<script>console.log(\"Erreur critique, plusieurs Exemplaires ayant le même IDExemplaire existent : IDExemplaire = $IDExemplaire.\");</script>";
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


		//Update un Exemplaire
		public function updateExemplaireDateAchat($IDExemplaire,$DateAchat)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "UPDATE Exemplaire SET DateAchat=\"$DateAchat\" WHERE IDExemplaire IN (\"$IDExemplaire\")";
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
			echo "<script>console.log(\"Votre DateAchat a bien été mise à jour.\");</script>";			
		}

		//Supprimer un Exemplaire
		public function deleteExemplaire(Exemplaire $Exemplaire)
		{
			$this->_db->exec('DELETE FROM Exemplaire WHERE IDExemplaire = '.$Exemplaire->getIDExemplaire());
		}
		//Supprimer un Exemplaire en renseignant l'ID
		public function deleteExemplaireById($id)
		{
			$this->_db->exec('DELETE FROM Exemplaire WHERE IDExemplaire = '.$id);
		}
	}

?>
