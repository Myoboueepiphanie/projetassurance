<?php include('connection.php'); 
	$msg="";
	//INSERTION
	if (isset($_POST['btnValider'])){

		if (isset($_GET['id'])){
			$sql= "UPDATE clients SET
			 Nom = '".$_POST['nom']."',
			 Prenom = '".$_POST['prenom']."',
			 Contact= '".$_POST['contact']."' WHERE id=". $_GET['id'];
		}else{
		$sql= "INSERT INTO clients (Nom,Prenom,Contact) VALUES ('".$_POST['nom']."','".$_POST['prenom']."','".$_POST['contact']."')";
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
		$update= "SELECT * FROM clients WHERE id=".($_GET['id']);
		$res=mysqli_query($link ,$update);
		$dataU= mysqli_fetch_array($res);
	}
	//SUPPRESSION
	if (isset($_GET['sup'])){
		$delete= "DELETE  FROM clients WHERE id=".($_GET['sup']);
		$result=mysqli_query($link ,$delete);
		
	}
 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>clients</title>

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
					
					<form action="" method="POST" role="form">
						<legend>Formulaire clients</legend>
						<span> <?php echo $msg; ?> </span>
					
						
						<div class="form-group">
							<label for="">nom</label>
							<input name="nom" type="text" class="form-control" id="" placeholder="Entrer le nom" value="<?php if(isset($_GET['id'])){ echo $dataU['Nom'];} ?>">
						</div>
						<div class="form-group">
							<label for="">prenom</label>
							<input name="prenom" type="text" class="form-control" id="" placeholder="Entrer le prenom " value="<?php if(isset($_GET['id'])){ echo $dataU['Prenom'];} ?>">
						</div>
						<div class="form-group">
							<label for="">contact</label>
							<input name="contact" type="text" class="form-control" id="" placeholder="Entrer votre Contact" value="<?php if(isset($_GET['id'])){ echo $dataU['Contact'];} ?>">
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
							<th>Nom</th>
							<th>Prenom</th>
							<th>contact</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$n=1;
							$list=" SELECT * FROM clients";
							$res= mysqli_query($link,$list);
	while ($data = mysqli_fetch_array($res)){
								
							
						 ?>
						<tr>
							<td> <?php echo $n; ?> </td>
							<td><?php echo $data['Nom']; ?></td>
							<td><?php echo $data['Prenom']; ?></td>
							<td><?php echo $data['Contact']; ?></td>
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