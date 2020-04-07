<?php
	require_once 'modeleEmploye.php';
	require_once 'ConnexionALaBDD.php';

	/*Classe EmployeManager en PHP*/
	class EmployeManager
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

		//Créer un Employe
		public function addEmploye(Employe $Employe)
		{
			//Récupérer la connexion
			global $connexion;

			$req = "INSERT INTO Employe (NomEmploye, Adresse, NumeroTelephone,NomService) VALUES
					(:NOMEMPLOYE,:ADRESSE,:NUMEROTELEPHONE,:NOMSERVICE)";

			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.

				/*Avec bindValue*/
				$stmt->bindValue(":NOMEMPLOYE",$Employe->getNomEmploye(), PDO::PARAM_STR);
				$stmt->bindValue(":ADRESSE",$Employe->getAdresse(), PDO::PARAM_STR);
				$stmt->bindValue(":NUMEROTELEPHONE",$Employe->getNumeroTelephone(), PDO::PARAM_STR);
				$stmt->bindValue(":NOMSERVICE",$Employe->getNomService(), PDO::PARAM_STR);

				//Exécuter la requête
				$stmt->execute();

				//On referme la base
				$stmt->closeCursor();

				//On indique que l'insertion s'est bien passée
				echo "<script>console.log(\"Insertion des données Employe effectuée\");</script>";
				echo "<h2 style='color : green'>Inscription réussie !</h2>";			
			}
			catch(PDOException $e)
			{
				echo "<script>console.log(\"Erreur : ".$e->getMessage()."\");</script>";
				echo "<h2 style='color : red'>Nom Employe : \"".$Employe->getNomEmploye()."\" déjà enregistré, ou Nom de Service non existant : \"".$Employe->getNomService()."\".</h2>";
			}
		}

		//Retourne un Employe si le NomEmploye est correct
		public function getEmployeByNomEmploye($NomEmploye)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "SELECT NomEmploye, Adresse, NumeroTelephone, NomService FROM Employe WHERE NomEmploye IN (\"$NomEmploye\")";
			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.
				//Exécuter la requête
				$stmt->execute();

				$nb=$stmt->rowcount();
				$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);

				if ($nb==1)
				{
					$mEmploye = array
					(
						"NomEmploye" => $result['NomEmploye'],
						"Adresse" => $result['Adresse'],
						"NumeroTelephone" => $result['NumeroTelephone'],
						"NomService" => $result['NomService']
					);

					$EmployeActuel = new Employe;

					$EmployeActuel->hydrate($mEmploye);

					return $EmployeActuel;
				}
				elseif ($nb<1)
				{
					//On indique qu'il y a eu un problième dans la récupération du Employe.
					echo "<script>console.log(\"Aucun résultat pour : NomEmploye = $NomEmploye.\");</script>";
					echo "<h2 style='color : red'>NomEmploye Incorrect.</h2>";
				}
				else
				{
					//On indique qu'il y a eu un problème dans la récupération de de l'Employe.
					echo "<script>console.log(\"Erreur critique, plusieurs Employes ayant le même NomEmploye existent : NomEmploye = $NomEmploye.\");</script>";
				}

				//On referme la base
				$stmt->closeCursor();

				//On indique que l'insertion s'est bien passée
				echo "<script>console.log(\"Requête effectuée.\");</script>";

			}
			catch(PDOException $e)
			{
				echo "<h1 style='color : red'>Erreur : ".$e->getMessage()."<h1>";
			}
		}


		//Update un Employe
		public function updateEmployeAdresse($NomEmploye,$Adresse)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "UPDATE Employe SET Adresse=\"$Adresse\" WHERE NomEmploye IN (\"$NomEmploye\")";
			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.
				//Exécuter la requête
				$stmt->execute();
			}
			catch(PDOException $e)
			{
				echo "<h1 style='color : red'>Erreur : ".$e->getMessage()."</h1>";
				echo "<h2 style='color : red'>Erreur, mise à jour de l'adresse impossible.</h2>";
			}
			echo "<h2 style='color : green'>Votre adresse a bien été mise à jour.</h2>";
		}

		//Supprimer un Employe
		public function deleteEmploye(Employe $Employe)
		{
			$this->_db->exec('DELETE FROM Employe WHERE NomEmploye = '.$Employe->getNomEmploye());
		}
		//Supprimer un Employe en renseignant l'ID
		public function deleteEmployeById($id)
		{
			$this->_db->exec('DELETE FROM Employe WHERE NomEmploye = '.$id);
		}
	}

?>
