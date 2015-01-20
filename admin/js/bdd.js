var editing = false;		//permet d'éditer qu'une valeur à la fois
var saved   = false;		//permet de coché le bouton radio pour indiquer que la modification peut être faite
var cpt = 0;			//comptabilise le nombre de fois que les objets sont générés en js
var nbreLigne = 0;

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function ajouter()
{
    ++nbreLigne;
    var tableau = document.getElementById("tab_produits");
    var ligne = tableau.insertRow(-1);
    var cell1 = ligne.insertCell(0);//option
    var cell2 = ligne.insertCell(1);
    var cell3 = ligne.insertCell(2);
    var cell4 = ligne.insertCell(3);
    var cell5 = ligne.insertCell(4);
    var cell6 = ligne.insertCell(5);
    var cell7 = ligne.insertCell(6);
    cell1.innerHTML = "<input type=\"checkbox\" checked id=\"optCat"+cpt+"\"/>";
    cell2.innerHTML = "<span id=\"A"+nbreLigne+"\" >Auto</span>";//id categorie
    cell3.innerHTML = "<input type=\"text\" id =\"titre"+cpt+"\" required />";//titre
    cell4.innerHTML = "<input type=\"text\" maxlength =\"50\" id=\"description"+cpt+"\" />";//description
    cell5.innerHTML = moment().format('YYYY-MM-DD H:mm:ss');//date de création champs date automatique
    cell6.innerHTML = moment().format('YYYY-MM-DD H:mm:ss');//date de modification champs automatique
    cell7.innerHTML = "<a href=\"#\" onclick=\"insererCategorie('optCat"+cpt+"','titre"+cpt+"', 'description"+cpt+"')\">ajouter une categorie</a>";
    //
}
//Suppression des espaces/sauts de ligne inutiles (http://www.breakingpar.com/bkp/home.nsf/0/87256B280015193F87256C0C0062AC78)
function trim(value) {
   var temp = value;
   var obj = /^(\s*)([\W\w]*)(\b\s*$)/;
   if (obj.test(temp)) { temp = temp.replace(obj, '$2'); }
   var obj = /  /g;
   while (temp.match(obj)) { temp = temp.replace(obj, " "); }
   return temp;
}
//fonction modifier
function getKeyCode(evenement)
{
    for(prop in evenement)
    {
	if(prop == 'which') 
	{
	    return evenement.which;
	}
    }
    return evenement.keyCode;
}
//function pour obtenir la largeur en pixels du texte donnée
function getTextWidth(texte)
{
    //valeur par défaut en pixel = 150 px
    var largeur = 150;
    //
    if(trim(texte) == "")
    {
	return largeur;
    }
    //création d'un span caché que l'on va mesurer
    var span = document.createElement("span");
    span.style.visibility = "hidden";
    span.style.position = "absolute";
    //on ajoute du texte dans le span puis du span dans le corps de la page
    span.appendChild(document.createTextNode(texte));
    document.getElementsByTagName("body")[0].appendChild(span);
    
    //ajout de texte dans le span puis du span dans le corps de la page
    largeur = span.offsetWidth;
    //on supprime le span
    document.getElementsByTagName("body")[0].removeChild(span);
    span = null;
    //on retourne la largeur
    return largeur;
}
//fonction éditer en l'élément du tableau sur lequel on a cliqué et effecture directement le changemnent dans la base de données
function editer(id,obj, nomValeur, type)
{
    if(editing) 
    {
	return false;
    }
    else
    {
	editing = true;
	saved = false;
    }
    var input = null;			//objet qui sert à éditer la valeur dans la page
    //un composant différent selon le type de la valeur à modifier
    switch(type)
    {
	case "texte":
	    input = document.createElement("input");
	    break;
	case "text-multi":
	    input = document.createElement("textarea");
	    break;
    }
    //ensuite on assigne la valeur au nouveau type créé
    if(obj.innerText)
	input.value = obj.innerText;
    else
	input.value = obj.textContent;
    
    input.value = trim(input.value);
    
    input.style.width = getTextWidth(input.value) + 30 + "px";
    
    obj.replaceChild(input, obj.firstChild);
    input.focus();			//on donne le focus  et on selectionne  le text qu'il contient
    input.select();
    //lorsqu'on quitte le input
    input.onblur = function sortir()
    {
	updateCategorie(id, obj,nomValeur, input.value, type);
	delete input;
    };
    //lorsqu'on appuye sur Enter
    input.onKeydown = function keyDown(event)
    {
	if(!event && window.event) 
	{
	    event = window.event;
	}
	//
	if(getKeyCode(event) == 13)
	{
	    updateCategorie(id, obj,nomValeur, input.value, type);
	    delete input;
	}
    };
}
//fonction ieSansCache renvoi une valeur aléatoire qui force le navigateur à envoyer la requête sans utiliser son cache
//pour internet explorer par example.
function ieSansCache(sep)
{
    var d = new Date();
    val = d.getYear() + "ie" + d.getMonth() + "sa" + d.getDate() + "ns" + d.getHours() + "ca" + d.getMinutes() + "ch" +d.getSeconds() + "e" + d.getMilliseconds();
    //
    if(sep != "?")
    {
	sep = "&";
    }
    return sep + "iesanscache=" + val;
}
//fonction pour ajouter à travers ajax
function getXMLHTTP()
{
    var xhr = null;
    if(window.XMLHttpRequest)
    {
	//pour firefox et les autres
	xhr = new XMLHttpRequest();
    }
    else if(window.ActiveXObject)
    {
	//IE
	try{
	    xhr = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
	    try
	    {
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	    catch(ee)
	    {
		xhr = null;
	    }
	}
    }
    else
    {
	//xmlhttprequest non supporté
	alert("navigateur non supporté");
    }
    return xhr;
}
//objet xmlhttprequest
var XHR = null;
//fonction update
function updateCategorie(id, objet,nomValeur, valeur, type)
{
    
    if(saved)
    {
	return false;
    }
    else
    {
	saved = true;
    }
    //si l'objet exite déjà, on abandonne la requête et on le supprime
    if(XHR && XHR.readyState != 0)
    {
	XHR.abort();
	delete XHR;
    }
    //création de l'objet XMLHttpRequest
    XHR = getXMLHTTP();
    
    if(!XHR)
    {
	return false;
    }
    //URL du script de sauvegarde auquel on passe la valeur à modifier
    XHR.open("GET", "code/cat/maj.php?id="+id+"&champ="+nomValeur+"&valeur="+escape(valeur)+"&type="+type+ieSansCache(), true);
    //on se sert de l'événement on readyStatechange pour supprimet l'input et le replacerpar son contenue
    XHR.onreadystatechange = function()
    {
	//si le changement est terminé
	if(XHR.readyState == 4)
	{
	    //réinitialisation de la valeur d'initialisation
	    editing = false;
	    //date de modification champs automatique
	    var dateMaj = document.getElementById("datemaj"+id).innerHTML = moment().format('YYYY-MM-DD H:mm:ss'); //y+"-"+mt+"-"+j+" "+h+":"+m+":"+s;
	    //remplacement de l'input par le texte qu'il contient
	    objet.replaceChild(document.createTextNode(valeur), objet.firstChild);
	    //on vérfie s'il le serveur nous renvoi une chaine
	    if(XHR.responseText)
	    {
		document.getElementById("erreur").innerHTML = XHR.responseText;
                saved = false;
                return false;
	    }
	}
    }
    //Envoi de la requête
    XHR.send(null);
}
//fonction pour insérer la catégorie
function insererCategorie(optCat,titre, description)
{
    //insérerons
    var idCat = document.getElementById(optCat).checked;
    var titreCat = document.getElementById(titre).value;
    var desCat = document.getElementById(description).value;
    if(idCat)
    {
	//si l'objet exite déjà, on abandonne la requête et on le supprime
	if(XHR && XHR.readyState != 0)
	{
	    XHR.abort();
	    delete XHR;
	}
	//création de l'objet XMLHttpRequest
	XHR = getXMLHTTP();
	
	if(!XHR)
	{
	    return false;
	}
	//URL du script d'insertion auquel on passe la valeur à modifier
	XHR.open("GET", "code/cat/insert.php?titre="+escape(titreCat)+"&desc="+escape(desCat), true);
	//
	 XHR.onreadystatechange = function()
	{
	    //si le changement est terminé
	    if(XHR.readyState == 4)
	    {
		//on vérfie s'il le serveur nous renvoi une chaine
		if(!XHR.responseText)
		{
		    afficherLastInsert();
		    //return false;
		}
		else
		{
		    document.getElementById("erreur").innerHTML = XHR.responseText;
		}
	    }
	}
	//Envoi de la requête
	XHR.send(null);
    }
    else
    {
	alert("veuillez cocher la case pour insérer");
    }
}
//supprimer un seul élément
function effacer(id, idCat, index)
{
    var check = document.getElementById(id).checked;//obtient la valeur si la case est cochée
    var idx = parseInt(index) + 1;
    if(check == false)
    {
	alert("vous devez cocher la case pour supprimer la ligne ");
	return;
    }
    else
    {
	//si la case à été coché
	if(XHR && XHR.readyState != 0 )
	{
	    XHR.abort();
	    delete XHR;
	}
	//création de l'objet XMLHttpRequest
	XHR = getXMLHTTP();
	
	if(!XHR)
	{
	    return false;
	}
	XHR.open("GET", "code/cat/delete.php?idCat="+idCat, true);
	//
	 XHR.onreadystatechange = function()
	{
	    //si le changement est terminé
	    if(XHR.readyState == 4)
	    {
		//on vérfie s'il le serveur nous renvoi une chain
		if(!XHR.responseText)
		{
		    document.getElementById("tab_produits").deleteRow(idx);
		}
		else
		{
		    document.getElementById("erreur").innerHTML = XHR.responseText;
		}
	    }
	}
	//Envoi de la requête
	XHR.send(null);
    }
}
//fonction pour afficher la table catégorie
function afficherCategorie()
{
    //si l'objet exite déjà, on abandonne la requête et on le supprime
	if(XHR && XHR.readyState != 0)
	{
	    XHR.abort();
	    delete XHR;
	}
	//création de l'objet XMLHttpRequest
	XHR = getXMLHTTP();
	
	if(!XHR)
	{
	    return false;
	}
	XHR.open("GET", "code/cat/getCat.php", true);
	//
	 XHR.onreadystatechange = function()
	{
	    //si le changement est terminé
	    if(XHR.readyState == 4)
	    {
		//on vérfie s'il le serveur nous renvoi une chain
		if(XHR.responseText)
		{
		    document.getElementById("tab").innerHTML = XHR.responseText;
		    //return false;
		}
	    }
	}
	//Envoi de la requête
	XHR.send(null);
}
//
function afficherLastInsert()
{
    //si l'objet exite déjà, on abandonne la requête et on le supprime
	if(XHR && XHR.readyState != 0)
	{
	    XHR.abort();
	    delete XHR;
	}
	//création de l'objet XMLHttpRequest
	XHR = getXMLHTTP();
	
	if(!XHR)
	{
	    return false;
	}
	XHR.open("GET", "code/cat/getLastInserted.php", true);
	//
	XHR.onreadystatechange = function()
	{
	    //si le changement est terminé
	    if(XHR.readyState == 4)
	    {
		//on vérfie s'il le serveur nous renvoi une chain
		if(XHR.responseText)
		{
		    document.getElementById("tab_produits").deleteRow(-1);
		    document.getElementById("tab_produits").insertRow(-1).innerHTML = XHR.responseText;
		}
	    }
	}
	//Envoi de la requête
	XHR.send(null);
}