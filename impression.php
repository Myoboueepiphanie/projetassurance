<?php include('connection.php');
	if (isset($_GET['id'])){
		$list= " SELECT 
						prix,
						informations.id,
						mois,
						vehicule.immatriculation,
						vehicule.marque,
						vehicule.puissance,
						vehicule.energie,
						clients.Nom,
						clients.Contact,
						clients.Prenom
					FROM informations
					INNER JOIN clients
					ON clients.id = informations.id_client
					INNER JOIN vehicule
					ON vehicule.id = informations.id_client WHERE informations.id=".($_GET['id']);
		$res=mysqli_query($link ,$list);
		$dataU= mysqli_fetch_array($res);
	}
		
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CONTRAT D'ASSURANCE <?php echo $dataU['Nom']." ".$dataU['Prenom'];?></title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.css" >
		<link rel="stylesheet" href="css/styles.css" >

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="row">
				<br></br>
				nom:<?php echo $dataU['Nom'];?><br></br>
				prenom:<?php echo $dataU['Prenom'];?><br></br>
				contact:<?php echo $dataU['Contact'];?><br></br>

			</div>

			<div class="row">

				immatriculation:<?php echo $dataU['immatriculation'];?><br></br>
				marque:<?php echo $dataU['marque'];?><br></br>
				energie:<?php echo $dataU['energie'];?><br></br>
				puissance:<?php echo $dataU['puissance'];?><br></br>
				
			
			</div>

			<div class="row">	
				mois:<?php echo $dataU['mois'];?><br></br>
				prix:<?php echo $dataU['prix'];?><br></br>

			</div>

			<br></br>
			<a href="#" onclick="javascript:window.print()"> <button>imprimer</button> </a>

		</div>
	</body>
</html>