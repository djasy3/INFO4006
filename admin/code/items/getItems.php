<?php

    require_once('../4006_fns.php');
    //
    $afficherTableau = "<table border=\"0\" id=\"tab_items\" class=\"table table-striped\" >";
    $afficherTableau .= "<tr>
	<th>Option</th>
	<th>N° Item </th>
	<th>N° Cat</th>
	<th>Nom</th>
	<th>Description</th>
	<th>Image</th>
	<th>Prix</th>
	<th>Actif</th>
	<th>Date de Création</th>
	<th>Date de modification</th>
	<th>Operation</th>
	</tr>";
    $tab = get_produits();

    $compteur = count($tab);
    $i = 0;			//va permettre de référencer le tableau des checkboxes
    foreach($tab as list($ligne))
    {
	$tabCheckBox[] = $ligne[0];
	$afficherTableau .="<tr>
	<td><input type=\"checkbox\" id=\"tabCheckBox[$i]\" /></td>
	<td> $ligne[0] </td>
	<td> $ligne[1] </td>
	<td class=\"cellule\" ondblclick=\"editer('$ligne[0]',this, 'Nom', 'texte');\">" .utf8_decode($ligne[2]). "</td>
	<td class=\"cellule\" ondblclick=\"editer('$ligne[0]',this, 'Description', 'text-multi');\"> $ligne[3] </td>
	<td><img src=\"../images/".$ligne[4]."\" width=\"80\" height=\"80\"></td>
	<td class=\"cellule\" ondblclick=\"editer('$ligne[0]',this, 'Prix', 'texte');\"> $ligne[5] </td>
	<td><input type=\"checkbox\" $ligne[6] id=\"actif".$ligne[0]."\" onclick=\"editer('$ligne[0]',this,'Actif','check');\" /></td>
	<td>$ligne[7]</td>
	<td id=\"datemaj".$ligne[0]."\">$ligne[8]</td>
	<td><a href=\"#\" onclick=\"effacer('tabCheckBox[$i]', '$ligne[0]', '$i');\" >supprimer</a></td>
	</tr>";
	$i++;
    }
    $afficherTableau .="</table>";
    
    echo $afficherTableau;
?>
