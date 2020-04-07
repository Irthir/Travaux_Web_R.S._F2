<?php
	require_once 'modeleOuvrage.php';
	require_once 'ConnexionALaBDD.php';

	/*Classe OuvrageManager en PHP*/
	class OuvrageManager
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

		//Créer un Ouvrage
		public function addOuvrage(Ouvrage $Ouvrage)
		{
			//Récupérer la connexion
			global $connexion;

			$req = "INSERT INTO Ouvrage (ISBN, Titre, Pseudo) VALUES
					(:ISBN,:TITRE,:PSEUDO)";

			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.

				/*Avec bindValue*/
				$stmt->bindValue(":ISBN",$Ouvrage->getISBN(), PDO::PARAM_STR);
				$stmt->bindValue(":Titre",$Ouvrage->getTitre(), PDO::PARAM_STR);
				$stmt->bindValue(":Pseudo",$Ouvrage->getPseudo(), PDO::PARAM_STR);

				//Exécuter la requête
				$stmt->execute();

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

		//Retourne un Ouvrage si le ISBN est correct
		public function getOuvrageByISBN($ISBN)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "SELECT ISBN, Titre, Pseudo FROM Ouvrage WHERE ISBN IN (\"$ISBN\")";
			try
			{
				$stmt= $connexion->prepare($req); //On prépare la requête dans un statement, avec la connexion.
				//Exécuter la requête
				$stmt->execute();

				$nb=$stmt->rowcount();
				$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);

				if ($nb==1)
				{
					$mOuvrage = array
					(
						"ISBN" => $result['ISBN'],
						"Titre" => $result['Titre'],
						"Pseudo" => $result['Pseudo']
					);

					$OuvrageActuel = new Ouvrage;

					$OuvrageActuel->hydrate($mOuvrage);

					return $OuvrageActuel;
				}
				elseif ($nb<1)
				{
					//On indique qu'il y a eu un problème dans la récupération du Ouvrage.
					echo "<script>console.log(\"Aucun résultat pour : NomService = $NomService.\");</script>";
				}
				else
				{
					//On indique qu'il y a eu un problème dans la récupération de de l'Ouvrage.
					echo "<script>console.log(\"Erreur critique, plusieurs Ouvrages ayant le même ISBN existent : ISBN = $ISBN.\");</script>";
				}

				//On referme la base
				$stmt->closeCursor();

				//On indique que l'insertion s'est bien passée
				echo "<script>console.log(\"Requête effectuée.\");</script>";

			}
			catch(PDOException $e)
			{
				eecho "<script>console.log(\"Erreur : ".$e->getMessage()."\");</script>";
			}
		}


		//Update un Ouvrage
		public function updateOuvrageTitre($ISBN,$Titre)
		{
			//Récupérer la connexion
			$connexion=$this->_db;

			$req = "UPDATE Ouvrage SET Titre=\"$Titre\" WHERE ISBN IN (\"$ISBN\")";
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
			echo "<script>console.log(\"Votre Titre a bien été mise à jour.\");</script>";
		}

		//Supprimer un Ouvrage
		public function deleteOuvrage(Ouvrage $Ouvrage)
		{
			$this->_db->exec('DELETE FROM Ouvrage WHERE ISBN = '.$Ouvrage->getISBN());
		}
		//Supprimer un Ouvrage en renseignant l'ID
		public function deleteOuvrageById($id)
		{
			$this->_db->exec('DELETE FROM Ouvrage WHERE ISBN = '.$id);
		}
	}

?>
