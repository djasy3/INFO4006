<?php

    require_once('../4006_fns.php');
    
    $afficherTableau = "<table border=\"0\" id=\"tab_produits\" class=\"table table-striped\" >";
    $afficherTableau .= "<tr>
	<th>option</th>
	<th>ID </th>
	<th>Titre</th>
	<th>Description</th>
	<th>Date de création</th>
	<th>Date de Mise à jour</th>
	<th>Operation</th>
	</tr>";
    $tab = get_tab_Categories();

    $compteur = count($tab);
    $i = 0;			//va permettre de référencer le tableau des checkboxes
    foreach($tab as list($ligne))
    {
	$tabCheckBox[] = $ligne[0];
	$afficherTableau .="<tr>
	<td><input type=\"checkbox\" id=\"tabCheckBox[$i]\" /></td>
	<td> $ligne[0] </td>
	<td class=\"cellule\" ondblclick=\"editer('$ligne[0]',this, 'TitreCat', 'texte');\"> $ligne[1] </td>
	<td class=\"cellule\" ondblclick=\"editer('$ligne[0]',this, 'Description', 'text-multi');\"> $ligne[2] </td>
	<td class=\"cellule\" > $ligne[3] </td>
	<td class=\"cellule\" id=\"datemaj".$ligne[0]."\"> $ligne[4] </td>
	<td><a href=\"#\" onclick=\"effacer('tabCheckBox[$i]', '$ligne[0]', '$i');\" >supprimer</a></td>
	</tr>";
	$i++;
    }
    $afficherTableau .="</table>";
    
    echo $afficherTableau;
?>