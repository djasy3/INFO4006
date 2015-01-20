<?php
//Page pour l'information de base des Items pour quand l'utilisateur est dans une categorie
require_once("./admin/code/4006_fns.php");
			$bdd = cnx_bdd('eam6014', 'bddparm');
	//Items appartenant a le resultat de la recherche
			$fetchAllItems = $bdd->prepare('SELECT Item.idItem, Item.Nom, Item.Image, Item.Prix, Item.DateMaj, Item.Actif, scoreTotal.Score
											FROM Item LEFT JOIN (SELECT idItem, AVG( score ) AS score FROM Appreciation GROUP BY idItem) as scoreTotal
											ON Item.idItem=scoreTotal.idItem WHERE Item.nom  LIKE :search OR Item.description LIKE :search');
	
			$fetchAllItems->execute(array(':search' => '%'.$_GET['query'].'%'));


if($fetchAllItems->rowCount() != 0)
	{
		echo "<table>
		";
		while($fetchAllItemsData = $fetchAllItems->fetch())
		{
			if($fetchAllItemsData['Actif'] == 1)
			{
				//On crée une liste des Items d'apres la querry
				echo "<tr><td><img src=\"images/" . $fetchAllItemsData['Image'] . "\" width=\"300\" height=\"300\"></td>
				<td>" . $fetchAllItemsData['Nom'] . "</br>Prix: ".
				sprintf("%01.2f", $fetchAllItemsData['Prix']) . "$</br>
				Appreciation: ";
				if($fetchAllItemsData['Score'] == NULL )
					echo " -</br>";
				else
				{
					echo sprintf("%01.1f", $fetchAllItemsData['Score']) . "/5</br>";
				}
				echo "Date modifié: " . $fetchAllItemsData['DateMaj'] . "</br>
				<input type=\"button\" onclick=\"getItemData(".$fetchAllItemsData['idItem'].")\" value=\"Voir les détails \"></td></tr>
				<tr><td colspan=\"2\"><hr></td></tr>";
			}
		}

			$fetchAllItems->closeCursor();
				 		
			echo "</table>";
	}
	else
		echo "Aucun Item trouver!";
?>
