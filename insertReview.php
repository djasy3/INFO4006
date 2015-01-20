<?php

	require_once("./admin/code/4006_fns.php");
	$bdd = cnx_bdd('eam6014', 'bddparm');


$InsertReview = $bdd -> prepare('INSERT INTO Appreciation(IdItem, Score, Commentaire) VALUES(:id, :appreciation, :commentaire)');
$InsertReview -> execute(array(
		'id' => $_GET['id'],
		'commentaire' => $_GET['commentaire'],
		'appreciation' => $_GET['appreciation']
	));	
?>
