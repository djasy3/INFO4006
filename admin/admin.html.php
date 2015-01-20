<?php
    require_once('code/4006_fns.php');
    start_session();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>administration</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <link rel="stylesheet" href="css/design.css" />
    <script src ="js/moment.min.js" type="text/javascript"> </script>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <h3>Page d'administration</h3>
    <ul>
	<li><a href="admin_categories.html.php">Administrer les categories</a></li>
	<li><a href="admin_items.html.php">Administrer les produits</a></li>
    </ul>
    <h3><a href="../index.php" >Page d'acceuil</a></h3>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </body>
</html>
