<?php
//display détailer de un item
			require_once("./admin/code/4006_fns.php");
			$bdd = cnx_bdd('eam6014', 'bddparm');
			//Informations à propos de l'item selon le item ID du URL
			 $fetchItem = $bdd->prepare('SELECT Nom, Description, Image, Prix FROM Item where IdItem = ?');
			 $fetchItem -> execute(array($_GET['id']));

			 if($fetchItem->rowCount() != 0) //s'assurer que l'item existe
			 { 
				 $fetchItemData = $fetchItem -> fetch();

				 echo "<img src=\"images/" . $fetchItemData['Image'] . "\" width=\"300\" height=\"300\">
				 <h2>" . $fetchItemData['Nom'] ."</h2></br>" . $fetchItemData['Description'] .
				"</br>Prix: " . sprintf("%01.2f", $fetchItemData['Prix']) . "$";


			$fetchItem -> closeCursor();

			//reviews existantes
			echo "<div id=\"review\">";
				include("getReviews.php");
			echo "</div>";
			?>

			<!--Menu ajouter review-->
			<div class="addComment">
			<form>
				<fieldset>
				<legend>Mon Appreciation du produit</legend>
				  Commentaire:</br><textarea style="resize: none; width: 350px; height: 150px;"name="commentaire" id="commentaire"></textarea></br>
				  Appreciation: <select name="appreciation" id="appreciation">
					  				<option value="-">-</option>
					  				<option value="1">1</option>
					  				<option value="2">2</option>
					  				<option value="3">3</option>
					  				<option value="4">4</option>
					  				<option value="5">5</option>
				  				</select>
				  				</br>
				  <?php echo "<input type=\"hidden\" value=\"".$_GET['id']."\" id=\"id\">";?>
				  <input type="button" value="Soumettre" onclick="insererReview()"/>
				  <div style="color: red;" id="error"></div>
				</fieldset>		
			</form>
			</div>	
			<?php
			}
			else 
			{
				echo "L'item n'existe pas!";
			}
?>
