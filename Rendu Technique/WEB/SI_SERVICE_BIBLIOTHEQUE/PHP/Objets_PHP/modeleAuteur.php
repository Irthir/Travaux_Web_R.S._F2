<?php

	class Auteur
	{
		/*Les membres de Auteur*/
		/*Identificateur de Auteur, son Pseudo*/
		private $Pseudo;
		/*NomAuteur de Auteur*/
		private $NomAuteur;

		/*Le constructeur*/
		/*Pas de constructeur vu qu'on hydrate.*/

		/*Le destructeur*/
		public function __destruct()
		{
			echo "<script>console.log(\"Destruction de la classe Auteur\");<script>";
		}

		/*Les getters*/
		public function getPseudo()
		{
			return $this->Pseudo;
		}
		public function getNomAuteur()
		{
			return $this->NomAuteur;
		}
		

		/*Les setters*/
		public function setPseudo($Pseudo)
		{
			$this->Pseudo=$Pseudo;
		}
		public function setNomAuteur($NomAuteur)
		{
			$this->NomAuteur=$NomAuteur;
		}
		

		/*Fonction d'affichage de Auteur*/
		public function __toString()
		{
			return "Auteur : Pseudo=".$this->getPseudo().", NomAuteur=".$this->getNomAuteur().".";
		}

		/*Fonction de comparaison entre deux Auteurs*/
		public function equals(Auteur $Auteur)
		{
			return ($this->getPseudo()==$Auteur->getPseudo());
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
