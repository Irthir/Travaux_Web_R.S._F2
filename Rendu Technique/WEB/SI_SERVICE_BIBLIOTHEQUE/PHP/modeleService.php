<?php
	/*Classe Employe en PHP*/

	class Service
	{
		/*Les membres de Service*/
		/*Identificateur de Service, son nom*/
		private $NomService;
		/*Localisation de Service*/
		private $Localisation;

		/*Le constructeur*/
		/*Pas de constructeur vu qu'on hydrate.*/

		/*Le destructeur*/
		public function __destruct()
		{
			echo "<script>console.log(\"Destruction de la classe Service\");<script>";
		}

		/*Les getters*/
		public function getNomService()
		{
			return $this->NomService;
		}
		public function getLocalisation()
		{
			return $this->Localisation;
		}
		

		/*Les setters*/
		public function setNomService($NomService)
		{
			$this->NomService=$NomService;
		}
		public function setLocalisation($Localisation)
		{
			$this->Localisation=$Localisation;
		}
		

		/*Fonction d'affichage de Service*/
		public function __toString()
		{
			return "Service : NomService=".$this->getNomService().", Localisation=".$this->getLocalisation().".";
		}

		/*Fonction de comparaison entre deux Services*/
		public function equals(Service $Service)
		{
			return ($this->getNomService()==$Employe->getNomService());
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
