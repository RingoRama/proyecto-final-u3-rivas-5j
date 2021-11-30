<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM autos WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$fabricante=$_POST['fabricante'];
		$marca=$_POST['marca'];
		$modelo=$_POST['modelo'];
		$motor=$_POST['motor'];
		$trac=$_POST['trac'];
		$id=(int) $_GET['id'];

		if(!empty($fabricante) && !empty($marca) && !empty($modelo) && !empty($motor) && !empty($trac) ){
			
				$consulta_update=$con->prepare(' UPDATE autos SET  
					fabricante=:fabricante,
					marca=:marca,
					modelo=:modelo,
					motor=:motor,
					trac=:trac
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':fabricante' =>$fabricante,
					':marca' =>$marca,
					':modelo' =>$modelo,
					':motor' =>$motor,
					':trac' =>$trac,
					':id' =>$id
				));
				header('Location: index.php');
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}

?>

<?php include ("../header-crud.php")?>
<head>
	<meta charset="UTF-8">
	<title>Editar Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>Editar registro</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="fabricante" value="<?php if($resultado) echo $resultado['fabricante']; ?>" class="input__text">
				<input type="text" name="marca" value="<?php if($resultado) echo $resultado['marca']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="modelo" value="<?php if($resultado) echo $resultado['modelo']; ?>" class="input__text">
				<input type="text" name="motor" value="<?php if($resultado) echo $resultado['motor']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="trac" value="<?php if($resultado) echo $resultado['trac']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
<?php include("../footer-crud.php") ?>
</html>
