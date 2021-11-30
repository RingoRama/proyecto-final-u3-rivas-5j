<?php include ("../header-crud.php")?>

<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellidos=$_POST['apellidos'];
		$telefono=$_POST['telefono'];
		$curp=$_POST['curp'];
		$domicilio=$_POST['domicilio'];

		if(!empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($curp) && !empty($domicilio) ){
				$consulta_insert=$con->prepare('INSERT INTO clientes(nombre,apellidos,telefono,curp,domicilio) VALUES(:nombre,:apellidos,:telefono,:curp,:domicilio)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':apellidos' =>$apellidos,
					':telefono' =>$telefono,
					':curp' =>$curp,
					':domicilio' =>$domicilio
				));
				header('Location: index.php');
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>Ingrese sus datos</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="apellidos" placeholder="Apellidos" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" placeholder="Teléfono" class="input__text">
				<input type="text" name="curp" placeholder="CURP" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="domicilio" placeholder="Domicilio" class="input__text">
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
