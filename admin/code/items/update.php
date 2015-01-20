<?php

    require_once('../4006_fns.php');
    //fonction pour update;contiendra les valeurs venant de ajax
    
    if(!filled_out($_GET))
    {
	echo "Erreur lors de la récupération des données<br />mise-à-jour échouée";
    }
    else
    {
	$id = intval(set_get_var("id"));
	$type = set_get_var("type");
	$champ = set_get_var("champ");
	$valeur = set_get_var("valeur");
	
	if($champ == 'Prix') 
	{
	    $valeur = floatval($valeur);
	}
	if($champ == 'Actif')
	{
	    $valeur = intval($valeur);
	}
	//on se connecte à la bdd
	$idcnx = cnx_bdd('eam6014', 'bddparm');
	//$idcnx->beginTransaction();//transaction pour faire deux insertions à même temps
	//
	if(($type == 'texte') || ($type == 'text-multi') || ($type == 'check'))
	{
	    $result = $idcnx->exec("UPDATE Item
				    SET ".$champ."='".$valeur."'
				    WHERE IdItem = '".$id."'");//on met à jour le champs concerné
	    if($result)
	    {
		//$idcnx->commit();//on confirme l'insertion
		$idcnx = NULL;
		echo "modification réussie";
	    }
	    else
	    {
		//$idcnx->rollBack();//on retourne les erreurs
		$erreur = $idcnx->errorInfo();
		$idcnx = NULL;
		return $erreur[0]+"\\n"+$erreur[2];
	    }
	}
    }
?>