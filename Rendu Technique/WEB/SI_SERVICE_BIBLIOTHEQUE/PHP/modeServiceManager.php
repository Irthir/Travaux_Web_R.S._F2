<?php
	require_once 'modeleService.php';
	require_once 'ConnexionALaBDD.php';

	/*Classe ServiceManager en PHP*/
	class ServiceManager
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

		//Créer un Service
		public function addService(Service $Service)
		{
			//Récupérer la connexion
			global $connexion;

			$req = "INSERT INTO Service (NomService, Localisation, NumeroTelephone,NomService) VALUES
					(:NOMSERVICE,:LOCALISATION)";

			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.

				/*Avec bindValue*/
				$stmt->bindValue(":NOMSERVICE",$Service->getNomService(), PDO::PARAM_STR);
				$stmt->bindValue(":LOCALISATION",$Service->getLocalisation(), PDO::PARAM_STR);

				//Exécuter la requête
				$stmt->execute();

				//On referme la base
				$stmt->closeCursor();

				//On indique que l'insertion s'est bien passée
				echo "<script>console.log(\"Insertion des données Service effectuée\");</script>";
			}
			catch(PDOException $e)
			{
				echo "<script>console.log(\"Erreur : ".$e->getMessage()."\");</script>";
			}
		}

		//Retourne un Service si le NomService est correct
		public function getServiceByNomService($NomService)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "SELECT NomService, Localisation FROM Service WHERE NomService IN (\"$NomService\")";
			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.
				//Exécuter la requête
				$stmt->execute();

				$nb=$stmt->rowcount();
				$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);

				if ($nb==1)
				{
					$mService = array
					(
						"NomService" => $result['NomService'],
						"Localisation" => $result['Localisation'],
					);

					$ServiceActuel = new Service;

					$ServiceActuel->hydrate($mService);

					return $ServiceActuel;
				}
				elseif ($nb<1)
				{
					//On indique qu'il y a eu un problième dans la récupération du Service.
					echo "<script>console.log(\"Aucun résultat pour : NomService = $NomService.\");</script>";
				}
				else
				{
					//On indique qu'il y a eu un problème dans la récupération du Service.
					echo "<script>console.log(\"Erreur critique, plusieurs Services ayant le même NomService existent : NomService = $NomService.\");</script>";
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


		//Update un Service
		public function updateServiceLocalisation($NomService,$Localisation)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "UPDATE Service SET Localisation=\"$Localisation\" WHERE NomService IN (\"$NomService\")";
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
			echo "<script>console.log(\"Votre Localisation a bien été mise à jour.\");</script>";
		}

		//Supprimer un Service
		public function deleteService(Service $Service)
		{
			$this->_db->exec('DELETE FROM Service WHERE NomService = '.$Service->getNomService());
		}
		//Supprimer un Service en renseignant l'ID
		public function deleteServiceById($id)
		{
			$this->_db->exec('DELETE FROM Service WHERE NomService = '.$id);
		}
	}

?>
