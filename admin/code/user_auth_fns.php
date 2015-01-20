<?php

    require_once('4006_fns.php');
    
    function cnx_bdd($base, $param)
    {
	//inclusion des paramètres de connexion
	require_once($param.".inc.php");
	//connexion au serveur
	$dsn = "mysql:host=".MYHOST.";dbname=".$base;//data source name
	$user= MYUSER;
	$pass= MYPASS;
	
	try{
	    $idcnx= new PDO($dsn, $user, $pass);
	    $idcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return $idcnx;
	}
	catch(PDOException $ex){
	    
	    echo "Echec de la connexion ".$ex->getMessage();
	    return false;
	}
    }
    //obtenir les categories
    function get_tab_Categories()
    {
	$idcnx = cnx_bdd('eam6014', 'bddparm');
	//requete au serveur
	$result = $idcnx->query("SELECT IdCat, TitreCat, Description, DateCreation, DateMaj FROM Categorie");
	//
	if(!$result)
	{
	    $erreur = $idcnx->errorInfo();
	    throw new Exception("Lecture Impossible");
	}
	else
	{
	    $tableauObjets = $result->fetchObject();
	   	//on récupère les résultat à travers un tableau d'objet
	    do
	    {
		
		$ligne = [$tableauObjets->IdCat,
			  $tableauObjets->TitreCat,
			  $tableauObjets->Description,
			  $tableauObjets->DateCreation,
			  $tableauObjets->DateMaj];
		$sortie[] = [$ligne];//on rend le tableau bidimensionnel
		
	    }while($tableauObjets = $result->fetchObject());
	}
	$result->closeCursor();
	$idcnx = NULL;
	
	return $sortie;
    }
    //renvoi la dernière ligne insérée
    function getLastCat()
    {
	$idcnx = cnx_bdd('eam6014', 'bddparm');
	
	$result = $idcnx->query("SELECT * FROM Categorie  ORDER BY `IdCat` DESC limit 1 ");
	if(!$result)
	{
	    $erreur = $idcnx->errorInfo();
	    throw new Exception($erreur[0]);
	}
	$row = $result->fetchObject();
	$ligne = [$row->IdCat,
		$row->TitreCat,
		$row->Description,
		$row->DateCreation,
		$row->DateMaj];
		
	$result->closeCursor();
	$idcnx = NULL;
	
	return $ligne;
    }
    
    //obtenir les produits
    function get_produits()
    {
	$idcnx = cnx_bdd('eam6014', 'bddparm');
	$result = $idcnx->query("SELECT * FROM Item");
	
	if(!$result)
	{
	    $erreur = $idcnx->errorInfo();
	    throw new Exception("Lecture Impossible");
	}
	else
	{
	    $tab = $result->fetchObject();
	    do
	    {
		if($tab->Actif == 1) $varActif = "checked=\"checked\" value=\"1\"";
		else $varActif = "value=\"0\"";
		
		$ligne = [$tab->IdItem,
			    $tab->IdCat,
			    $tab->Nom,
			    $tab->Description,
			    $tab->Image,
			    $tab->Prix,
			    $varActif,
			    $tab->DateCreation,
			    $tab->DateMaj,
			  ];
		$sortie[] = [$ligne];
		
	    }while($tab = $result->fetchObject());
	}
	
	$result->closeCursor();
	$idcnx = NULL;
	return $sortie;
    }
   
?>
