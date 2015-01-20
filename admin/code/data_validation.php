<?php
    
    //fonction qui teste si tous les champs de données ont été bien remplies
    //vérification du coté serveur, bien que la vérification du coté client soit aussi faites
    function filled_out($form_vars)
    {
	//teste si chaque champs du formulaire à une valeur
	foreach($form_vars as $key => $value)
	{
	    if((!isset($key)) || ($value == ''))
	    {
		return false;
	    }
	}
	return true;
    }
    //fonction qui vérifie si l'addresse e-mail est correcte
    //à l'aide des expressions régulières
    function valid_email($addresse)
    {
	if(ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$', $addresse))
	    return true;
	else
	    return false;
    }
    //fonction qui nous permet d'obtenir les valeur exacte des variables globales post
    function get_post_var($var)
    {
	$valeur = $_POST[$var];
	
	if(get_magic_quotes_gpc())
	    $valeur = stripslashes($valeur);
	
	return $valeur;
    }
    //fonction qui nous permet une insertion correcte dans la base de données
    function set_post_var($var)
    {
	$valeur = addslashes(trim($_POST[$var]));
	
	return $valeur;
    }
    function set_get_var($var)
    {
	$valeur = addslashes(trim($_GET[$var]));
	
	return $valeur;
    }
    //fonction qui personnalise les messages d'erreurs si les formulaires ne sont pas bien remplies
    function validation_erreur()
    {
	if(isset($_SESSION['erreur']))
	{
	    $erreur = $_SESSION['erreur'];//on met le message d'erreur dans une variable pour mieux le formater
	    echo "<font color='red'>".$erreur."</font>";
	}
	unset($_SESSION['erreur']);
    }
    //cette fonction permet d'ajouter une mesure de sécurité dans l'authentification des formulaires en vue de lutter contre le cross-site request forgery 
    function start_session()
    {
	//session_name(SESSION_NAME);
	session_start();
	if(empty($_SESSION['csrftoken']))
	{
	    $_SESSION['csrftoken']= bin2hex(openssl_random_pseudo_bytes(8));
	}
    }
    //fonction pour checker la sécurité
    function security_check() {
	if(isset($_SESSION) && (!isset($_POST['csrftoken']) || $_POST['csrftoken'] != $_SESSION['csrftoken']))
	    return false; 
	return true;
    }
    //fonction pour vérifier si le formulaire est correcte
    function authentic_form()
    {
	 if(isset($_SESSION['csrftoken']))
	    echo "<input type=hidden name=csrftoken value=".$_SESSION['csrftoken'].">";
    }
    //fonction qui permet d'avoir l'expéditeur pour l'envoi des e-mail
    function getFrom()
    {
	return "From: eam6014@umoncton.ca \r\n";
    }
?>