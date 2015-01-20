<?php
//Page pour l'information de base des Items pour quand l'utilisateur est dans une categorie
require_once("./admin/code/4006_fns.php");
			$bdd = cnx_bdd('eam6014', 'bddparm');
	//Items appartenant a la categorie
	switch($_GET['sort'])
	{
		case 0:
			$fetchAllItems = $bdd->prepare('SELECT Item.idItem, Item.Nom, Item.Image, Item.Prix, Item.DateMaj, Item.Actif, scoreTotal.Score
											FROM Item LEFT JOIN (SELECT idItem, AVG( score ) AS score FROM Appreciation GROUP BY idItem) as scoreTotal
											ON Item.idItem=scoreTotal.idItem WHERE Item.Idcat = ?');
		break;
		case 1:
			$fetchAllItems = $bdd->prepare('SELECT Item.idItem, Item.Nom, Item.Image, Item.Prix, Item.DateMaj, Item.Actif, scoreTotal.Score
											FROM Item LEFT JOIN (SELECT idItem, AVG( score ) AS score FROM Appreciation GROUP BY idItem) as scoreTotal
											ON Item.idItem=scoreTotal.idItem WHERE Item.Idcat = ? ORDER BY nom ASC');
		break;
		case 2:
			$fetchAllItems = $bdd->prepare('SELECT Item.idItem, Item.Nom, Item.Image, Item.Prix, Item.DateMaj, Item.Actif, scoreTotal.Score
											FROM Item LEFT JOIN (SELECT idItem, AVG( score ) AS score FROM Appreciation GROUP BY idItem) as scoreTotal
											ON Item.idItem=scoreTotal.idItem WHERE Item.Idcat = ? ORDER BY nom DESC');
		break;
		case 3:
			$fetchAllItems = $bdd->prepare('SELECT Item.idItem, Item.Nom, Item.Image, Item.Prix, Item.DateMaj, Item.Actif, scoreTotal.Score
											FROM Item LEFT JOIN (SELECT idItem, AVG( score ) AS score FROM Appreciation GROUP BY idItem) as scoreTotal
											ON Item.idItem=scoreTotal.idItem WHERE Item.Idcat = ? ORDER BY prix ASC');
		break;
		case 4:
			$fetchAllItems = $bdd->prepare('SELECT Item.idItem, Item.Nom, Item.Image, Item.Prix, Item.DateMaj, Item.Actif, scoreTotal.Score
											FROM Item LEFT JOIN (SELECT idItem, AVG( score ) AS score FROM Appreciation GROUP BY idItem) as scoreTotal
											ON Item.idItem=scoreTotal.idItem WHERE Item.Idcat = ? ORDER BY prix DESC');
		break;
		case 5:
			$fetchAllItems = $bdd->prepare('SELECT Item.idItem, Item.Nom, Item.Image, Item.Prix, Item.DateMaj, Item.Actif, scoreTotal.Score
											FROM Item LEFT JOIN (SELECT idItem, AVG( score ) AS score FROM Appreciation GROUP BY idItem) as scoreTotal
											ON Item.idItem=scoreTotal.idItem WHERE Item.Idcat = ? ORDER BY DateMaj ASC');
		break;
		case 6:
			$fetchAllItems = $bdd->prepare('SELECT Item.idItem, Item.Nom, Item.Image, Item.Prix, Item.DateMaj, Item.Actif, scoreTotal.Score
											FROM Item LEFT JOIN (SELECT idItem, AVG( score ) AS score FROM Appreciation GROUP BY idItem) as scoreTotal
											ON Item.idItem=scoreTotal.idItem WHERE Item.Idcat = ? ORDER BY Score DESC');;
		break;
	}	


	$fetchAllItems->execute(array($_GET['categorie']));



if($fetchAllItems->rowCount() != 0)
	{
		echo "<table>
			  <tr><td colspan=\"2\"><hr></td></tr>";
		while($fetchAllItemsData = $fetchAllItems->fetch())
		{
			//On crée une liste des Items de la catégorie qui sont actifs
			if($fetchAllItemsData['Actif'] == 1)
			{
			
				echo "<tr>";
				if($fetchAllItemsData['Image'] == NULL)//verifier si il y a une photo
				{
					echo "<td><img src=\"images/nopicture.png\" width=\"300\" height=\"300\"></td>";
				}
				else
				{
					echo "<td><img src=\"images/" . $fetchAllItemsData['Image'] . "\" width=\"300\" height=\"300\"></td>";
				}
				echo "<td>" . $fetchAllItemsData['Nom'] . "</br>Prix: ".
				sprintf("%01.2f", $fetchAllItemsData['Prix']) . "$</br>
				Appreciation: ";
				if($fetchAllItemsData['Score'] == NULL )
					echo " -</br>";
				else
				{
					echo sprintf("%d", $fetchAllItemsData['Score']) . "/5</br>";
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
		echo "Pas d'items associés à cette catégorie ";
?>
