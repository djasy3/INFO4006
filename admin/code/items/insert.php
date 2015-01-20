<?php
    //fichier qui nous permet d'insérer
    require_once('../4006_fns.php');
    //
    if(!filled_out($_GET))
    {
	echo "Veuillez remplir tous les champs requis";
    }
    else
    {
	$idCat = intval(set_get_var("cat"));
	$desc = set_get_var("desc");
	$nom = set_get_var("nom");
	$prix = floatval(set_get_var("prix"));
	$cat = intval(set_get_var("act"));
	//connexion à la base de données
	$idcnx = cnx_bdd('eam6014', 'bddparm');
	//
	$result = $idcnx->exec("INSERT INTO Item (`IdCat`, `Nom`, `Description`, `Prix`, `Actif`, `DateCreation`, `DateMaj`)
				VALUES ('".$idCat."', '".$nom."', '".$desc."', '".$prix."', '".$cat."', NOW(), NOW())");
	//
	if(!$result)
	{
	    $erreur = $idcnx->errorInfo();
	    echo $erreur[0];
	}
	$idcnx = NULL;
    }
?>