<?php
	function AfficheTable($table, $Conn)
	//BUT : Afficher une table d'une BDD.
	//ENTREE : Le nom de la table.
	//SORTIE : La table affichée.
	{
		$mareq='SELECT * FROM '.$table.';';
		$statement=$Conn->prepare($mareq);
		$statement->execute();
		$nb=$statement->rowcount();
		if ($nb>0)
		{
			$result = $statement->setFetchMode(PDO::FETCH_ASSOC);
			//vérifier result si le fetch a fonctionné.
			echo "<table class='TableAffiche'><caption>".$table."</caption><thead><tr>";
			foreach (array_keys($statement->fetchAll()[0]) as $value)
			//Vérifier le fetchAll et le array keys
			{
				echo "<th>".$value."</th>";
			}
			$statement=$Conn->prepare($mareq);
			$statement->execute();
			$result = $statement->setFetchMode(PDO::FETCH_ASSOC); //permet de passer en tableau associatif uniquement.
			echo "</tr></thead>";
			echo "<tbody>";
			foreach ($statement as $row)
			{
				echo "<tr>";
				foreach ($row as $key => $value)
				{
					echo"<td class='".$key."'>".$value."</td>";
				}
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
		}
	}
?>