<?php
	require_once 'modeleEmprunt.php';
	require_once 'ConnexionALaBDD.php';

	/*Classe EmpruntManager en PHP*/
	class EmpruntManager
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

		//Créer un Emprunt
		public function addEmprunt(Emprunt $Emprunt)
		{
			//On ne renseigne pas l'IDEmprunt dans cette fonction car il s'incrémente tout seul.

			//Récupérer la connexion
			global $connexion;

			$req = "INSERT INTO Emprunt (DateDebut, DateFin,NomEmploye,IDExemplaire) VALUES
					(:IDEMPRUNT,:DATEDEBUT,:DATEFIN,:NOMEMPLOYE,:IDEXEMPLAIRE)";

			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.

				/*Avec bindValue*/
				$stmt->bindValue(":DATEDEBUT",$Emprunt->getDateDebut(), PDO::PARAM_STR);
				$stmt->bindValue(":DATEFIN",$Emprunt->getDateFin(), PDO::PARAM_STR);
				$stmt->bindValue(":NOMEMPLOYE",$Emprunt->getNomEmploye(), PDO::PARAM_STR);
				$stmt->bindValue(":IDEMPRUNTUNIQUE",$Emprunt->getNomEmploye(), PDO::PARAM_STR);

				//Exécuter la requête
				$stmt->execute();

				//On referme la base
				$stmt->closeCursor();

				//On indique que l'insertion s'est bien passée
				echo "<script>console.log(\"Insertion des données Emprunt effectuée\");</script>";	
			}
			catch(PDOException $e)
			{
				echo "<script>console.log(\"Erreur : ".$e->getMessage()."\");</script>";
			}
		}

		//Retourne un Emprunt si le IDEmprunt est correct
		public function getEmpruntByIDEmprunt($IDEmprunt)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "SELECT IDEmprunt, DateDebut, DateFin, NomEmploye, IDExemplaire FROM Emprunt WHERE IDEmprunt IN (\"$IDEmprunt\")";
			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.
				//Exécuter la requête
				$stmt->execute();

				$nb=$stmt->rowcount();
				$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);

				if ($nb==1)
				{
					$mEmprunt = array
					(
						"IDEmprunt" => $result['IDEmprunt'],
						"DateDebut" => $result['DateDebut'],
						"DateFin" => $result['DateFin'],
						"NomEmploye" => $result['NomEmploye'],
						"IDExemplaire" => $result['IDExemplaire']
					);

					$EmpruntActuel = new Emprunt;

					$EmpruntActuel->hydrate($mEmprunt);

					return $EmpruntActuel;
				}
				elseif ($nb<1)
				{
					//On indique qu'il y a eu un problième dans la récupération du Emprunt.
					echo "<script>console.log(\"Aucun résultat pour : IDEmprunt = $IDEmprunt.\");</script>";
				}
				else
				{
					//On indique qu'il y a eu un problème dans la récupération de de l'Emprunt.
					echo "<script>console.log(\"Erreur critique, plusieurs Emprunts ayant le même IDEmprunt existent : IDEmprunt = $IDEmprunt.\");</script>";
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


		//Update un Emprunt
		public function updateEmpruntDateFin($IDEmprunt,$DateFin)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "UPDATE Emprunt SET DateFin=\"$DateFin\" WHERE IDEmprunt IN (\"$IDEmprunt\")";
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
			echo "<script>console.log(\"Votre DateFin a bien été mise à jour.\");</script>";			
		}

		//Supprimer un Emprunt
		public function deleteEmprunt(Emprunt $Emprunt)
		{
			$this->_db->exec('DELETE FROM Emprunt WHERE IDEmprunt = '.$Emprunt->getIDEmprunt());
		}
		//Supprimer un Emprunt en renseignant l'ID
		public function deleteEmpruntById($id)
		{
			$this->_db->exec('DELETE FROM Emprunt WHERE IDEmprunt = '.$id);
		}
	}

?>
