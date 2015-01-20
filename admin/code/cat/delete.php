<?php
    //fichier qui nous permet d'insérer
    require_once('../4006_fns.php');
    //
    if(!empty($_GET))
    {
	$id = intval(set_get_var("idCat"));
	//connexion à la base de données
	$idcnx = cnx_bdd('eam6014', 'bddparm');
	//
	$result = $idcnx->exec("DELETE FROM Categorie WHERE IdCat = $id");
	//
	if(!$result)
	{
	    $erreur = $idcnx->errorInfo();
	    echo $erreur[0]." erreur survenue ! pour id =".$id;
	}
	$idcnx = NULL;
    }
?>