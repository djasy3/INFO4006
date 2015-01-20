<?php
//aller chercher les items de la categorie dont l'utilisateur est présentement
	require_once("./admin/code/4006_fns.php");
			$bdd = cnx_bdd('eam6014', 'bddparm');

	?><?php
	echo "<input type=\"hidden\" value=\"".$_GET['categorie']."\" id=\"id\">";

			$fetchAllItems = $bdd->prepare('SELECT idItem, Nom, Image, Prix, DateMaj FROM Item where IdCat = ?');

	$fetchAllItems->execute(array($_GET['categorie']));

echo "Trier par: <select id=\"trier\" onchange=\"getSortedItems(".$_GET['categorie'].")\">"; ?>
					<option value="0">-</option>
					<option value="1">Nom (ascendant)</option>
					<option value="2">Nom (descendant)</option>
					<option value="3">Prix (ascendant)</option>
					<option value="4">Prix (descendant)</option>
					<option value="5">Date</option>
					<option value="6">Popularité</option>

   <?php echo "</select>";

   //display des items de la categorie
   	echo "<div id=\"innerContent\">";
		include("itemInfo.php");
	echo "</div>";
?>
