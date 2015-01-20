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
	$titre = set_get_var("titre");
	$desc = set_get_var("desc");
	//connexion à la base de données
	$idcnx = cnx_bdd('eam6014', 'bddparm');
	//
	$result = $idcnx->exec("INSERT INTO Categorie (`TitreCat`, `Description`, `DateCreation`, `DateMaj`)
				VALUES ('".$titre."', '".$desc."',NOW(), NOW())");
	//
	if(!$result)
	{
	    $erreur = $idcnx->errorInfo();
	    echo $erreur[0];
	}
	$idcnx = NULL;
    }
?>