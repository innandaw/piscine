
<!DOCTYPE html> 
<head> 
	<title>ECE Amazon</title> 
	<meta charset="utf-8" /> 
	<link href="hautsFemmes.css" rel="stylesheet" type="text/css"/> 
	<link href="https://fonts.googleapis.com/css?family=Yantramanav" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		
			var $indexImgConn = 0;
			var $logoCompte = $('#logoCompte');
			var $imgConn = $('#logoCompte img');
			
			if('<?php echo $conn; ?>'==0)
			{		
				var $currentImgConn = $imgConn.eq(0); //image courante
				$imgConn.css('display', 'none');
				$currentImgConn.css('display', 'block');
			}
			else
			{
				var $currentImgConn = $imgConn.eq(1); //image courante
				$imgConn.css('display', 'none');
				$currentImgConn.css('display', 'block');
			}
		});
	</script>
	<script type="text/javascript" src="main.js"></script>


</head> 
 
<body>
	<div id="header">
		<div id="logo">
			<a href="mainPage.php"><img src="Images/Menu/logo.png" width="140" height="60"/></a>  
		</div>
		    
        <form id="barre">
            <input id="champ" type="text" value="Rechercher..."/>
            <input id="bouton" type="button"/>   
        </form> 
		
		<div id="logopanier">
			<img src="Images/Menu/panier.png" width="50" height="40"/>   
		</div>
		
		<div id="logoCompte">
			<ul>
				<li><a href="creerclient.php"><img src="Images/Menu/compte.png" width="50" height="40"/></a></li>   			 <!--creerclient.php-->
				<li><a href="monCompteAch.php"><img src="Images/Menu/compteConn.png" width="50" height="40"/></a></li>
			</ul>
		</div>
		
		<h1 id="pann">Mon panier</h1>
		<a href="creerclient.php"><h1 id="conn">Connexion</h1></a>
		
	</div>
	<div id="menu">
		<a href="categories.php"><img src="Images/Menu/categories.png" width="140" height="25" id="cat"/></a>
		<img src="Images/Menu/admin.png" width="140" height="25" id="admin"/>
		<img src="Images/Menu/ventesFlash.png" width="140" height="25" id="ventesFlash"/>
		<a href="ajouter_article.php"><img src="Images/Menu/vendre.png" width="140" height="25" id="vendre"/></a>
	</div>

	<h1 id="titre">Romans</h1>
	
	<link href="hautsFemmes1.css" rel="stylesheet" type="text/css"/> 
	<link href="https://fonts.googleapis.com/css?family=Yantramanav" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
	<script type="text/javascript" src="main.js"></script>

</head> 
 
<body>
	
	<?php include ("navbar.php") ?>

	<h1 id="titre">Romans</h1>
	
	<div id="cadre1">
	
	<?php 
	
	$user_name = "root";
	$password = "";
	$database = "eceamazon";
	$server = "localhost";
	
	$dbh=mysqli_connect($server, $user_name, $password,$database);
	

	$sql = "SELECT nom,description,prix,taille,photos,couleur, id FROM articles WHERE categorie='Livres' AND sous_cat='roman' GROUP BY nom";
	
	$result = mysqli_query($dbh,$sql);
	
	if (!$result) 
	{
	    echo "Impossible d'exécuter la requête ($sql) dans la base";
	    exit;
	}

	// dossier de destination
    $fichier_dossier = 'Images/livres/';
	
	while ($row = mysqli_fetch_assoc($result)) 
	{	
		$nom=$row["nom"];
		$description=$row["description"];
		$prix=$row["prix"];
	    $taille=$row["taille"];

	    $photos=$row["photos"];
	    $couleur=$row["couleur"];
	    $img=$row["photos"];
	    $id=$row["id"];

	    
        // on renomme le fichier, chemin d'acces
        $img1 = $fichier_dossier.$img;
		
		echo '<div id="photo1"><img src="'.$img1.'" width="130" height="170"/></div>';
        if($statut=='Ad')
		{
			echo '<a href ="supprArticle.php?idArticle='.$id.'&chemin=0"><div id="suppr"><img src="Images/supprime.png" width="70" height="70"/></div></a>';
		}
		echo '<div id="infos">
				<div id="gauche">
					<h2>'.$nom.'</h2>
					<h3 id="infos1">'.$description.'</h3>
				</div>
				<div id="droite">
					<h2 class="infos3">'.$prix.' €</h2>
					<a href="ajouterPanier.php?ident='.$id.'"><img src="Images/panier.png" width="70" height="70" class="infos3"/></a>
						

					<h2 id="infos5">Ajouter à mon panier</h2>
				</div>
			</div>';
		
	}
	
        // on renomme le fichier, chemin d'acces
        $img1 = $fichier_dossier.$img;
		
		echo '<div id="cadre1">
			<img src="'.$img1.'" width="130" height="170" id="photo1"/>';
			
			if($statut=='Ad')
			{
				echo '<a href ="supprArticle.php?idArticle='.$id.'&chemin=0"><div id="suppr"><img src="Images/supprime.png" width="70" height="70"/></div></a>';
			}
			
			echo '<div id="gauche">
				<div id="'.$id.'">
					<h2>'.$nom.'</h2>
					<h3 id="infos1">'.$description.'</h3>';
						
					$sql1 = "SELECT taille FROM articles WHERE nom='$nom' AND stock!=0 GROUP BY taille";
				
					$result1 = mysqli_query($dbh,$sql1);
				echo'</div>
			</div>
				
			<a href="ajouterPanier.php?ident='.$id.'"><div id="droite">
				<h2 class="infos3">'.$prix.' €</h2>
				<img src="Images/panier.png" width="70" height="70" class="infos3"/>

				<h2 id="infos5">Ajouter à mon panier</h2>
			</div></a>
		</div>';
	}
		

	mysqli_free_result($result);
	
	$dbh=null;?>

<!DOCTYPE html> 
<head> 
	<title>ECE Amazon</title> 
	<meta charset="utf-8" /> 
	<link href="hautsFemmes1.css" rel="stylesheet" type="text/css"/> 
	<link href="https://fonts.googleapis.com/css?family=Yantramanav" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
	<script type="text/javascript" src="main.js"></script>

</head> 
 
<body>
	
	<?php include ("navbar.php") ?>

	<h1 id="titre">Romans</h1>
	
	<div id="cadre1">
	
	<?php 
	
	$user_name = "root";
	$password = "";
	$database = "eceamazon";
	$server = "localhost";
	
	$dbh=mysqli_connect($server, $user_name, $password,$database);
	
	$sql = "SELECT nom,description,prix,taille,photos,couleur, id FROM articles WHERE categorie='Livres' AND sous_cat='roman' GROUP BY nom";
	
	$result = mysqli_query($dbh,$sql);
	
	if (!$result) 
	{
	    echo "Impossible d'exécuter la requête ($sql) dans la base";
	    exit;
	}

	// dossier de destination
    $fichier_dossier = 'Images/livres/';
	
	while ($row = mysqli_fetch_assoc($result)) 
	{	
		$nom=$row["nom"];
		$description=$row["description"];
		$prix=$row["prix"];
	    $photos=$row["photos"];
	    $couleur=$row["couleur"];
	    $img=$row["photos"];
	    $id=$row["id"];

        // on renomme le fichier, chemin d'acces
        $img1 = $fichier_dossier.$img;
		
		echo '<div id="cadre1">
			<img src="'.$img1.'" width="130" height="170" id="photo1"/>';
			
			if($statut=='Ad')
			{
				echo '<a href ="supprArticle.php?idArticle='.$id.'&chemin=0"><div id="suppr"><img src="Images/supprime.png" width="70" height="70"/></div></a>';
			}
			
			echo '<div id="gauche">
				<div id="'.$id.'">
					<h2>'.$nom.'</h2>
					<h3 id="infos1">'.$description.'</h3>';
						
					$sql1 = "SELECT taille FROM articles WHERE nom='$nom' AND stock!=0 GROUP BY taille";
				
					$result1 = mysqli_query($dbh,$sql1);
				echo'</div>
			</div>
				
			<a href="ajouterPanier.php?ident='.$id.'"><div id="droite">
				<h2 class="infos3">'.$prix.' €</h2>
				<img src="Images/panier.png" width="70" height="70" class="infos3"/>

				<h2 id="infos5">Ajouter à mon panier</h2>
			</div></a>
		</div>';
	}
		
	mysqli_free_result($result);
	
	$dbh=null;?>

	</div>

	<?php include("footer.php"); ?>
	
	
</body> 
</html> 


