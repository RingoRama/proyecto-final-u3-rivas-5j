<?php include ("../header-crud.php")?>

<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$fabricante=$_POST['fabricante'];
		$marca=$_POST['marca'];
		$modelo=$_POST['modelo'];
		$motor=$_POST['motor'];
		$trac=$_POST['trac'];

		if(!empty($fabricante) && !empty($marca) && !empty($modelo) && !empty($motor) && !empty($trac) ){
				$consulta_insert=$con->prepare('INSERT INTO autos(fabricante,marca,modelo,motor,trac) VALUES(:fabricante,:marca,:modelo,:motor,:trac)');
				$consulta_insert->execute(array(
					':fabricante' =>$fabricante,
					':marca' =>$marca,
					':modelo' =>$modelo,
					':motor' =>$motor,
					':trac' =>$trac
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
				<input type="text" name="fabricante" placeholder="Fabricante" class="input__text">
				<input type="text" name="marca" placeholder="Modelo" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="modelo" placeholder="Año del modelo" class="input__text">
				<input type="text" name="motor" placeholder="Tipo de motor (6,8,12 cilindros)" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="trac" placeholder="Tipo de tracción (Delantera, trasera, 4x4)" class="input__text">
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
