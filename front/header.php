		<!-- header -->
		<header>
			<h1><a href="index.php" >INFO4006</a></h1>
		</header>

		<?php
		//fetch categorie titre
			require_once("./admin/code/4006_fns.php");
			$bdd = cnx_bdd('eam6014', 'bddparm');
		?>

		<!-- menu -->
		<nav>
			<?php	

			//aller chercher les categories de la base de donné
			$fetchAllCategories = $bdd->query('SELECT IdCat,TitreCat FROM Categorie');
			
				while($fetchAllCategoriesData = $fetchAllCategories->fetch())
				{
					
					//On crée une liste des catégories
						echo "<input type=\"button\" onclick=\"getCategorieItems(".$fetchAllCategoriesData['IdCat']. 
							")\" value=\"" . $fetchAllCategoriesData['TitreCat'] . "\">";
				}

				$fetchAllCategories->closeCursor();
			?>
			<!--Search Bar-->
			<span class="search"><input id="searchBar" type="search" placeholder="Rechercher..." results="5"></input><button type="submit" class="searchButton" style="border: 0; background: transparent" onclick="getSearchResults()"><img src="images/search.png" width="20" height="20" alt="submit" /></button></span>
		</nav>
