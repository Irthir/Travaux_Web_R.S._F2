<?php
	/*Classe Exemplaire en PHP*/

	class Exemplaire
	{
		/*Les membres de l'Exemplaire*/
		/*Identificateur de l'Exemplaire, son ID*/
		private $IDExemplaire;
		/*Prix de l'Exemplaire*/
		private $Prix;
		/*date d'achat de l'Exemplaire*/
		private $DateAchat;
		/*ISBN de l'Exemplaire*/
		private $ISBN;

		/*Le constructeur*/
		/*Pas de constructeur vu qu'on hydrate.*/

		/*Le destructeur*/
		public function __destruct()
		{
			echo "<script>console.log(\"Destruction de la classe Exemplaire\");<script>";
		}

		/*Les getters*/
		public function getIDExemplaire()
		{
			return $this->IDExemplaire;
		}
		public function getPrix()
		{
			return $this->Prix;
		}
		public function getDateAchat()
		{
			return $this->DateAchat;
		}
		public function getISBN()
		{
			return $this->ISBN;
		}

		/*Les setters*/
		public function setIDExemplaire($IDExemplaire)
		{
			$this->IDExemplaire=$IDExemplaire;
		}
		public function setPrix($Prix)
		{
			$this->Prix=$Prix;
		}
		public function setDateAchat($DateAchat)
		{
			$this->DateAchat=$DateAchat;
		}
		public function setISBN($ISBN)
		{
			$this->ISBN=$ISBN;
		}

		/*Fonction d'affichage de l'Exemplaire*/
		public function __toString()
		{
			return "Exemplaire : IDExemplaire=".$this->getIDExemplaire().", Prix=".$this->getPrix().". DateAchat=".$this->getDateAchat().", ISBN=".$this->getISBN().".";
		}

		/*Fonction de comparaison entre deux Exemplaires*/
		public function equals(Exemplaire $Exemplaire)
		{
			return ($this->getIDExemplaire()==$Exemplaire->getIDExemplaire());
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
