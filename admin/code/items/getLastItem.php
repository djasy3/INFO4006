<?php
    require_once('../4006_fns.php');
    //
    $idcnx = cnx_bdd('eam6014', 'bddparm');
    $result = $idcnx->query("SELECT * FROM Item  ORDER BY `IdItem` DESC limit 1 ");//on récupère le dernier élément
    $index = count(get_produits()) + 1;
    $i = 0;
    if(!$result)
    {
	$erreur = $idcnx->errorInfo();
	throw new Exception($erreur[0]);
    }
    $row = $result->fetchObject();
    $tabCheckBox[] = $row->IdItem;
    
    if($row->Actif == 1) $varActif = "checked=\"checked\" value=\"1\"";
		else $varActif = "value=\"0\"";
    echo "
	<td><input type=\"checkbox\" id=\"tabCheckBox[$i]\" /></td>
	<td>".$row->IdItem."</td>
	<td>".$row->IdCat."</td>
	<td class=\"cellule\" ondblclick=\"editer(".$row->IdItem.",this, 'Nom', 'texte');\">".$row->Nom."</td>
	<td class=\"cellule\" ondblclick=\"editer(".$row->IdItem.",this, 'Description', 'text-multi');\">".$row->Description."</td>
	<td><img src=\"../images/".$row->Image."\" width=\"80\" height=\"80\" /></td>
	<td class=\"cellule\" ondblclick=\"editer(".$row->IdItem.",this, 'Prix', 'texte');\">".$row->Prix."</td>
	<td><input type=\"checkbox\" $varActif id=\"actif".$row->IdItem."\" onclick=\"editer(".$row->IdItem.",this,'Actif','check');\" /></td>
	<td>".$row->DateCreation."</td>
	<td id=\"datemaj".$row->IdItem."\">".$row->DateMaj."</td>
	<td><a href=\"#\" onclick=\"effacer('tabCheckBox[$i]', ".$row->IdItem.", '$index');\" >supprimer</a></td>
    ";
    $result->closeCursor();
    $idcnx = NULL;
?>