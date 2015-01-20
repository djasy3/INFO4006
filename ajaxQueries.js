			function getCategorieItems(value){
				 try{
				   // Opera 8.0+, Firefox, Safari, chrome
				   var ajaxRequest = new XMLHttpRequest();
				 }catch (e){
				   // Internet Explorer Browsers
				   try{
				      var ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				   }catch (e) {
				      try{
				        var  ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				      }catch (e){
				         alert("Ajax n'est pas compatible avec votre fureteur!");
				         return false;
				      }
				   }
				 }
				 
				 //on envoie les données au serveur
				 ajaxRequest.open("GET", "getCatItems.php?categorie="+value+"&sort=0", true);
				 ajaxRequest.send(null); 

				 ajaxRequest.onreadystatechange = function(){
				   if(ajaxRequest.readyState == 4){

				      var ajaxDisplay = document.getElementById('content');
				        ajaxDisplay.innerHTML = ajaxRequest.responseText;
				   }
				 }
			}

			function getSortedItems(value){
				 try{
				   // Opera 8.0+, Firefox, Safari, chrome
				   var ajaxRequest = new XMLHttpRequest();
				 }catch (e){
				   // Internet Explorer Browsers
				   try{
				      var ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				   }catch (e) {
				      try{
				        var  ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				      }catch (e){
				         alert("Ajax n'est pas compatible avec votre fureteur!");
				         return false;
				      }
				   }
				 }
				 	
				 var sortOrder = document.getElementById('trier').value;
				 
				 //on envoie les données au serveur
				 ajaxRequest.open("GET", "itemInfo.php?categorie="+value+"&sort="+sortOrder, true);
				 ajaxRequest.send(null); 

				 ajaxRequest.onreadystatechange = function(){
				   if(ajaxRequest.readyState == 4){
				      var ajaxDisplay = document.getElementById('innerContent');
				        ajaxDisplay.innerHTML = ajaxRequest.responseText;
				   }
				 }
			}

			function getItemData(value){
				 try{


				   // Opera 8.0+, Firefox, Safari, chrome
				   var ajaxRequest = new XMLHttpRequest();
				 }catch (e){
				   // Internet Explorer Browsers
				   try{
				      var ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				   }catch (e) {
				      try{
				        var  ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				      }catch (e){
				         alert("Ajax n'est pas compatible avec votre fureteur!");
				         return false;
				      }
				   }
				 }
				 	
				 //on envoie les données au serveur
				 ajaxRequest.open("GET", "item.php?id=" + value, true);
				 ajaxRequest.send(null); 

				 ajaxRequest.onreadystatechange = function(){
				   if(ajaxRequest.readyState == 4){
				      var ajaxDisplay = document.getElementById('content');
				      ajaxDisplay.innerHTML = ajaxRequest.responseText;
				   }
				 }
			}

			function getReview(){
				 try{
				   // Opera 8.0+, Firefox, Safari, chrome
				   var ajaxRequest = new XMLHttpRequest();
				 }catch (e){
				   // Internet Explorer Browsers
				   try{
				      var ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				   }catch (e) {
				      try{
				        var  ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				      }catch (e){
				         alert("Ajax n'est pas compatible avec votre fureteur!");
				         return false;
				      }
				   }
				 }
				 	
				 //on envoie les données au serveur
				 ajaxRequest.open("GET", "getReviews.php?id=" + document.getElementById('id').value, true);
				 ajaxRequest.send(null); 

				 ajaxRequest.onreadystatechange = function(){
				   if(ajaxRequest.readyState == 4){
				      var ajaxDisplay = document.getElementById('review');
				        ajaxDisplay.innerHTML = ajaxRequest.responseText;
				   }
				 }
			}


			function insererReview(){
			 try{
			   // Opera 8.0+, Firefox, Safari, chrome
			   var ajaxRequest = new XMLHttpRequest();
			 }catch (e){
			   // Internet Explorer Browsers
			   try{
			      var ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			   }catch (e) {
			      try{
			        var  ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			      }catch (e){
			         alert("Ajax n'est pas compatible avec votre fureteur!");
			         return false;
			      }
			   }
			 }

				 ajaxRequest.onreadystatechange = function(){
				 	if(ajaxRequest.readyState == 4){
				   		getReview();
				   }
				 }

				 var appreciation = document.getElementById('appreciation').value;
				 var commentaire = document.getElementById('commentaire').value;
				 var errorLabel = document.getElementById('error');

				 //on envoie les données au serveur
				 if(appreciation != "-" && commentaire != "")
				 {
				 ajaxRequest.open("GET", "insertReview.php?id=" + document.getElementById('id').value +
				 "&commentaire=" + commentaire + "&appreciation=" + appreciation, true);
				 ajaxRequest.send(null); 
				 errorLabel.innerHTML = "";
				 }
				 else
				 {
				 	var errorLabel = document.getElementById('error');
				 	errorLabel.innerHTML = "Le commentaire et l'appreciation ne peut etre vide";
				 }
			}

			function getSearchResults(){
				 try{
				   // Opera 8.0+, Firefox, Safari, chrome
				   var ajaxRequest = new XMLHttpRequest();
				 }catch (e){
				   // Internet Explorer Browsers
				   try{
				      var ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				   }catch (e) {
				      try{
				        var  ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				      }catch (e){
				         alert("Ajax n'est pas compatible avec votre fureteur!");
				         return false;
				      }
				   }
				 }

				 var search = document.getElementById('searchBar').value;
				 //on envoie les données au serveur
				 ajaxRequest.open("GET", "getSearchResults.php?query="+search, true);
				 ajaxRequest.send(null); 

				 ajaxRequest.onreadystatechange = function(){
				   if(ajaxRequest.readyState == 4){

				      var ajaxDisplay = document.getElementById('content');
				        ajaxDisplay.innerHTML = ajaxRequest.responseText;
				   }
				 }
			}