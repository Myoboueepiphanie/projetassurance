<?php include('connection.php');
	$msg="";
	if (isset($_POST['btnValider'])){
		$cedeao = 1000;
		$police = 3000 ;
		$taxe = 4230 ;
		$primenet = $_POST['mois']*7134;
		$prixtotal=$primenet+$cedeao+$police+$taxe;

		
		
			$sql="INSERT INTO informations (id_client,id_vehicule,prix,mois)
			 VALUES ('".$_POST['client']."',
			 		 '".$_POST['vehicule']."',
			 		  '".$prixtotal."',
			 		  '".$_POST['mois']."')";
		
			$result=mysqli_query($link	,$sql);
			if ($result) {
				$msg='Insertion reussie';
			}else{
				$msg=mysqli_error($link);
			}
	}	

?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>articles</title>

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
			<?php include('menu.php');?>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">

					<form action="" method="POST" role="form" enctype="multipart/form-data">
						<legend>Formulaire du contrat</legend>
						<span> <?php echo $msg; ?> </span>
					

						<div class="form-group">
							<label for="">periode</label>
							
							<select name="mois" class="form-control" id="" placeholder="energie">
								<option value="1">
								1 MOIS	
								</option >
								<option value="3">
								3 MOIS
								</option>
								<option value="6">
								6 MOIS
								</option>
								<option value="12">
								12 MOIS
								</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">client</label>
							<select name="client" class="form-control">
								<?php
								//recupere toutes les categories dans la bd
								$sqlcategorie="SELECT * FROM clients";
								//execute la requete et on la stock dans $repcategorie
								$repcategorie=mysqli_query($link,$sqlcategorie);
								//mysqli_fetch_array = permet de tran sformer le resultat $repcategorie en variable de type tableau $datacat
								// la boucle while nous permet de parcourir le tableau $datacat et de recuperer les valeurs de chaques elements du tableau $datacat
								while ($datacat=mysqli_fetch_array($repcategorie)) {
									?>
									<option value="<?php echo $datacat['id'];?>">
									<?php echo $datacat['Nom']." ".$datacat['Prenom'];?>
										
									</option>

									<?php
								}
								?>
								
							</select>
						</div>
						<div class="form-group">
							<label for="">vehicule</label>
							<select name="vehicule" class="form-control">
								<?php
								//recupere toutes les categories dans la bd
								$sqlcategorie="SELECT * FROM vehicule";
								//execute la requete et on la stock dans $repcategorie
								$repcategorie=mysqli_query($link,$sqlcategorie);
								//mysqli_fetch_array = permet de tran sformer le resultat $repcategorie en variable de type tableau $datacat
								// la boucle while nous permet de parcourir le tableau $datacat et de recuperer les valeurs de chaques elements du tableau $datacat
								while ($datacat=mysqli_fetch_array($repcategorie)) {
									?>
									<option value="<?php echo $datacat['id'];?>">
									<?php echo $datacat['immatriculation']." ".$datacat['marque'];?>
										
									</option>

									<?php
								}
								?>
								
							</select>
						</div>

				
						<button name="btnValider" type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
					</form>
				</div>
				<div class="col-md-2"></div>
			</div>
<br>
			<div class="row">
				<table class="table">
					<thead>
						<tr>
							<th>Numero</th>
							<th>Assuré</th>
							<th>Vehicule</th>
							<th>Mois</th>
							<th>Prix</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$n=1;
							$list=" SELECT 
										prix,
										informations.id,
										mois,
										vehicule.immatriculation,
										vehicule.marque,
										clients.Nom,
										clients.Prenom
									FROM informations
									INNER JOIN clients
									ON clients.id = informations.id_client
									INNER JOIN vehicule
									ON vehicule.id = informations.id_client";
							$res= mysqli_query($link,$list);
							while ($data = mysqli_fetch_array($res)){
							 ?>
						<tr>
							<td><?php echo $n; ?></td>
							<td><?php echo $data['Nom']." ".$data['Prenom']; ?></td>
							<td><?php echo $data['immatriculation']." ".$data['marque']; ?></td>
							<td><?php echo $data['mois']; ?></td>
							<td><?php echo $data['prix']; ?></td>
							<td>
								
								<button type="button" class="btn btn-success"><a href="impression.php?id=<?php echo $data['id']; ?>">imprimer</a></button>
							</td>
						</tr>
						<?php $n++;
						 } ?>
					</tbody>
				</table>

			</div>
			

		</div>
		

		<!-- jQuery -->
		<script src=""></script>
		<!-- Bootstrap JavaScript -->
		<script src=""></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>