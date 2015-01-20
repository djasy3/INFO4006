<?php
    //fichier qui nous permet d'insérer
    require_once('../4006_fns.php');
    //
    if(!filled_out($_GET))
    {
	echo "Erreur de récupération des données";
    }
    else
    {
	$id = intval(set_get_var("id"));
	//connexion à la base de données
	$idcnx = cnx_bdd('eam6014', 'bddparm');
	//
	$result = $idcnx->exec("DELETE FROM Item WHERE IdItem =".$id."");
	//
	if(!$result)
	{
	    $erreur = $idcnx->errorInfo();
	    echo "Erreur d'exection de la requete";
	}
	$idcnx = NULL;
    }
?>