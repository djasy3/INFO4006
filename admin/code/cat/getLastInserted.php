<?php
    require_once('../4006_fns.php');
    //on récupère le dernier élément inséré
    $ligne = getLastCat();
    $tabCheckBox[] = $ligne[0];
    $index = count(get_tab_Categories()) + 1;
    $i = 0;
    echo "
	<td><input type=\"checkbox\" id=\"tabCheckBox[$i]\" /></td>
	<td> $ligne[0] </td>
	<td class=\"cellule\" ondblclick=\"editer('$ligne[0]',this, 'TitreCat', 'texte');\"> $ligne[1] </td>
	<td class=\"cellule\" ondblclick=\"editer('$ligne[0]',this, 'Description', 'text-multi');\"> $ligne[2] </td>
	<td class=\"cellule\" > $ligne[3] </td>
	<td class=\"cellule\" > $ligne[4] </td>
	<td><a href=\"#\" onclick=\"effacer('tabCheckBox[$i]', '$ligne[0]', '$index');\" >supprimer</a></td>
    ";
?>