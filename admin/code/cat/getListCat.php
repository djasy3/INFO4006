<?php

    require_once('../4006_fns.php');
    
    $idcnx = cnx_bdd('eam6014', 'bddparm');
    $result = $idcnx->query("SELECT IdCat FROM Categorie");
	
    if(!$result)
    {
	$erreur = $idcnx->errorInfo();
	throw new Exception("Erreur interne survenue");
    }
    //echo "<select id =\"idcat\" >";
    while($row = $result->fetchObject())
    {
	echo "<option value =\"$row->IdCat\" >".$row->IdCat."</option>";
    }
    //echo "</select>";
    $result->closeCursor();
    $idcnx = NULL;
?>