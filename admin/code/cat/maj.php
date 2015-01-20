<?php

    require_once('../4006_fns.php');
    //fonction pour update;contiendra les valeurs venant de ajax
    
    if(!filled_out($_GET))
    {
	echo "Veuillez remplir tous les champs requis";
    }
    else
    {
	$id = intval(set_get_var("id"));
	$type = set_get_var("type");
	$champ = set_get_var("champ");
	$valeur = set_get_var("valeur");
	//on se connecte à la bdd
	$idcnx = cnx_bdd('eam6014', 'bddparm');
	//$idcnx->beginTransaction();//transaction pour faire deux insertions à même temps
	//
	if($type == 'texte' || $type == 'text-multi' )
	{
	    $result = $idcnx->exec("UPDATE Categorie
				    SET ".$champ."='".$valeur."'
				    WHERE IdCat = '".$id."'");//on met à jour le champs concerné
				    
	   // $result += $idcnx->exec("UPDATE Categorie
				     //SET DateMaj = NOW()
				     //WHERE IdCat = '".$id."'");//on met à jour la date de la dernière modification
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