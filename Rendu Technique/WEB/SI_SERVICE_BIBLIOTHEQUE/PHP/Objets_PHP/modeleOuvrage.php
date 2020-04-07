<?php
	/*Classe Ouvrage en PHP*/

	class Ouvrage
	{
		/*Les membres de l'Ouvrage*/
		/*Identificateur de l'Ouvrage, son ISBN*/
		private $ISBN;
		/*Titre de l'Ouvrage*/
		private $Titre;
		/*Pseudo de l'auteur de l'Ouvrage*/
		private $Pseudo;

		/*Le constructeur*/
		/*Pas de constructeur vu qu'on hydrate.*/

		/*Le destructeur*/
		public function __destruct()
		{
			echo "<script>console.log(\"Destruction de la classe Ouvrage\");<script>";
		}

		/*Les getters*/
		public function getISBN()
		{
			return $this->ISBN;
		}
		public function getTitre()
		{
			return $this->Titre;
		}
		public function getPseudo()
		{
			return $this->Pseudo;
		}

		/*Les setters*/
		public function setISBN($ISBN)
		{
			$this->ISBN=$ISBN;
		}
		public function setTitre($Titre)
		{
			$this->Titre=$Titre;
		}
		public function setPseudo($Pseudo)
		{
			$this->Pseudo=$Pseudo;
		}

		/*Fonction d'affichage de l'Ouvrage*/
		public function __toString()
		{
			return "Ouvrage : ISBN=".$this->getISBN().", Titre=".$this->getTitre().". Pseudo=".$this->getPseudo().".";
		}

		/*Fonction de comparaison entre deux Ouvrages*/
		public function equals(Ouvrage $Ouvrage)
		{
			return ($this->getISBN()==$Ouvrage->getISBN());
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
