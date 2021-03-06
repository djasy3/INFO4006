<?php
    require_once('code/4006_fns.php');
    start_session();
    
?>
<!DOCTYPE html>
<html>
  <head>
    <title>administration - Produits</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <link rel="stylesheet" href="css/design.css" />
    <script src ="js/bdd2.js" type="text/javascript"> </script>
    <script src ="js/moment.min.js" type="text/javascript"> </script>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </head>
    <body onload="afficherItems();">
    <h3><a href="admin.html.php" >Page d'administration</a></h3>
    <div id="erreur">
    </div>
    <h3>Liste des produits</h3>
    <h4>Quelques consignes</h4>
    <p>
	<ol>
	    <li>Pour modifier un article, juste double cliquez à l'endroit où vous voulez apporter les modifications</li>
	    <li>Pour supprimer, la ligne de l'item doit être coché</li>
	    <li>Enfin, cliquez sur le lien Ajouter pour générer les champs d'ajouts pour un nouvel item</li>
	</ol>
    </p>
    <div id="tab">
    </div>
    <div>
	<ul>
	    <li><a href="#" onclick="ajouter();" >Ajouter un produit</a></li>
	    <li><a href="admin_categories.html.php" >Administrer les Catégories</a></li>
	</ul>
    </div>
    <h3><a href="../index.php" >Page d'acceuil</a></h3>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </body>
</html>