<?php include('connection.php');
	$msg="";
	if (isset($_POST['btnValider'])){
		if (isset($_GET['id'])){

			$sql= "UPDATE vehicule SET
			 immatriculation = '".$_POST['immatriculation']."',
			 puissance = '".$_POST['puissance']."',
			 energie = '".$_POST['energie']."',
			 marque= '".$_POST['marque']."',
			 id_client= '".$_POST['client']."' WHERE id=". $_GET['id'];
		}else{
		
			$sql="INSERT INTO vehicule (immatriculation,puissance,energie,marque,id_client)
			 VALUES ('".$_POST['immatriculation']."',
			 		 '".$_POST['puissance']."',
			 		  '".$_POST['energie']."',
			 		  '".$_POST['marque']."',
			 		  '".$_POST['client']."')";
		}
			$result=mysqli_query($link	,$sql);
			if ($result) {
				$msg='Insertion reussie';
			}else{
				$msg=mysqli_error($link);
			}
	}	
//MODIFICATION
	if (isset($_GET['id'])){
		$update= "SELECT * FROM vehicule WHERE id=".($_GET['id']);
		$res=mysqli_query($link ,$update);
		$dataU= mysqli_fetch_array($res);
	}
	//SUPPRESSION
	if (isset($_GET['sup'])){
		$delete= "DELETE  FROM vehicule WHERE id=".($_GET['sup']);
		$result=mysqli_query($link ,$delete);
		
	
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
						<legend>Formulaire du vehicule</legend>
						<span> <?php echo $msg; ?> </span>
					
						<div class="form-group">
							<label for="">immatriculation</label>
							<input name="immatriculation" type="text" class="form-control" id="" placeholder="immatriculation " value="<?php if(isset($_GET['id'])){ echo $dataU['immatriculation'];} ?>" required>
						</div>
						<div class="form-group">
							<label for="">puissance</label>
							<input value="<?php if(isset($_GET['id'])){ echo $dataU['puissance'];} ?>" name="puissance" type="text" class="form-control" id="" placeholder="puissance">
						</div>

						<div class="form-group">
							<label for="">energie</label>
							
							<select name="energie" class="form-control" id="" placeholder="energie">
								<option value="ess">
								essence	
								</option >
								<option value="gaz">
								gazoile
								</option>
							</select>
						</div>
						

						<div class="form-group">
							<label for="">marque</label>
							<input value="<?php if(isset($_GET['id'])){ echo $dataU['marque'];} ?>" name="marque" type="text" class="form-control" id="" placeholder="marque">
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
							<th>immatriculation</th>
							<th>puissance</th>
							<th>energie</th>
							<th>marque</th>
							<th>client</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$n=1;
							$list=" SELECT 
										immatriculation,
										vehicule.id,
										puissance,
										energie,
										marque,
										clients.Nom,
										clients.Prenom
									FROM vehicule
									INNER JOIN clients
									ON clients.id = vehicule.id_client";/*die($list);*/
							$res= mysqli_query($link,$list);
							while ($data = mysqli_fetch_array($res)){
							 ?>
						<tr>
							<td> <?php echo $n; ?> </td>
							<td><?php echo $data['immatriculation']; ?></td>
							<td><?php echo $data['puissance']; ?></td>
							<td><?php echo $data['energie']; ?></td>
							<td><?php echo $data['marque']; ?></td>
							<td><?php echo $data['Nom']." ".$data['Prenom']; ?></td>
							<td>
								<button type="button" class="btn btn-info"><a href="?id=<?php echo $data['id']; ?>">modifier</a></button>
								<button type="button" class="btn btn-danger"><a href="?sup=<?php echo $data['id']; ?>">suprimer</a></button>
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