<?php
	/*Classe Emprunt en PHP*/

	class Emprunt
	{
		/*Les membres de l'Emprunt*/
		/*Identificateur de l'Emprunt, son ID*/
		private $IDEmprunt;
		/*DateDebut de l'Emprunt*/
		private $DateDebut;
		/*date d'achat de l'Emprunt*/
		private $DateFin;
		/*NomEmploye de l'Emprunt*/
		private $NomEmploye;
		/*IDExemplaire de l'Emprunt*/
		private $IDExemplaire;

		/*Le constructeur*/
		/*Pas de constructeur vu qu'on hydrate.*/

		/*Le destructeur*/
		public function __destruct()
		{
			echo "<script>console.log(\"Destruction de la classe Emprunt\");<script>";
		}

		/*Les getters*/
		public function getIDEmprunt()
		{
			return $this->IDEmprunt;
		}
		public function getDateDebut()
		{
			return $this->DateDebut;
		}
		public function getDateFin()
		{
			return $this->DateFin;
		}
		public function getNomEmploye()
		{
			return $this->NomEmploye;
		}
		public function getIDExemplaire()
		{
			return $this->IDExemplaire;
		}

		/*Les setters*/
		public function setIDEmprunt($IDEmprunt)
		{
			$this->IDEmprunt=$IDEmprunt;
		}
		public function setDateDebut($DateDebut)
		{
			$this->DateDebut=$DateDebut;
		}
		public function setDateFin($DateFin)
		{
			$this->DateFin=$DateFin;
		}
		public function setNomEmploye($NomEmploye)
		{
			$this->NomEmploye=$NomEmploye;
		}
		public function setIDExemplaire($IDExemplaire)
		{
			$this->IDExemplaire=$IDExemplaire;
		}

		/*Fonction d'affichage de l'Emprunt*/
		public function __toString()
		{
			return "Emprunt : IDEmprunt=".$this->getIDEmprunt().", DateDebut=".$this->getDateDebut().", DateFin=".$this->getDateFin().", NomEmploye=".$this->getNomEmploye().", IDExemplaire=".$this->getIDExemplaire().".";
		}

		/*Fonction de comparaison entre deux Emprunts*/
		public function equals(Emprunt $Emprunt)
		{
			return ($this->getIDEmprunt()==$Emprunt->getIDEmprunt());
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
