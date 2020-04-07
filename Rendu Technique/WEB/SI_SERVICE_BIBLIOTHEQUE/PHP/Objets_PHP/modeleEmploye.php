<?php
	/*Classe Employe en PHP*/

	class Employe
	{
		/*Les membres de l'Employe*/
		/*Identificateur de l'employe, son nom*/
		private $NomEmploye;
		/*Adresse de l'employé*/
		private $Adresse;
		/*Numéro de téléphone de l'employé*/
		private $NumeroTelephone;
		/*NomService dans lequel travaille l'employé*/
		private $NomService;

		/*Le constructeur*/
		/*Pas de constructeur vu qu'on hydrate.*/

		/*Le destructeur*/
		public function __destruct()
		{
			echo "<script>console.log(\"Destruction de la classe Employé\");<script>";
		}

		/*Les getters*/
		public function getNomEmploye()
		{
			return $this->NomEmploye;
		}
		public function getAdresse()
		{
			return $this->Adresse;
		}
		public function getNumeroTelephone()
		{
			return $this->NumeroTelephone;
		}
		public function getNomService()
		{
			return $this->NomService;
		}

		/*Les setters*/
		public function setNomEmploye($NomEmploye)
		{
			$this->NomEmploye=$NomEmploye;
		}
		public function setAdresse($Adresse)
		{
			$this->Adresse=$Adresse;
		}
		public function setNumeroTelephone($NumeroTelephone)
		{
			$this->NumeroTelephone=$NumeroTelephone;
		}
		public function setNomService($NomService)
		{
			$this->NomService=$NomService;
		}

		/*Fonction d'affichage de l'Employe*/
		public function __toString()
		{
			return "Employé : NomEmploye=".$this->getNomEmploye().", Adresse=".$this->getAdresse().". NumeroTelephone=".$this->getNumeroTelephone().", NomService=".$this->getNomService().".";
		}

		/*Fonction de comparaison entre deux employés*/
		public function equals(Employe $Employe)
		{
			return ($this->getNomEmploye()==$Employe->getNomEmploye());
		}

		public function hydrate(array $donnees)
		{
			foreach ($donnees as $key => $value)
			{
				//On récupère le nom du setter correcpondant à l'attribut.
				$method = 'set'.ucfirst($key);

				//Si le setter correspondant existe.
				if (method_exists($this, $method))
				{
					//On appelle le setter.
					$this->$method($value);
				}
			}
		}
	}
?>
