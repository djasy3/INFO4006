<?php

	require_once("./admin/code/4006_fns.php");

	$bdd = cnx_bdd('eam6014', 'bddparm');
	$fetchAllReviews = $bdd -> prepare('SELECT Score, Commentaire FROM Appreciation where IdItem = ?');
	$fetchAllReviews -> execute(array($_GET['id']));

	$fetchAllReviewsData = $fetchAllReviews -> fetch();

	if($fetchAllReviews->rowCount() == 0) //aucune review
		echo "</br>Aucune Appreciation, soyez le premier!";
	else
	{
		echo "<ul>";
		do
		{
			//On crée une liste des reviews
			echo "Score: " . $fetchAllReviewsData['Score'] . "/5</br>
			Commentaire: " . $fetchAllReviewsData['Commentaire'] . "</br></br>";
		}while($fetchAllReviewsData = $fetchAllReviews -> fetch());
		echo "</ul>";
	}
?>
