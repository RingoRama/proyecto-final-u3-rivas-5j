<?php include ("../header-crud.php")?>

<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$cliente=$_POST['cliente'];
		$empleado=$_POST['empleado'];
		$fecha_ven=$_POST['fecha_ven'];
		$modelo=$_POST['modelo'];
		$marca=$_POST['marca'];

		if(!empty($cliente) && !empty($empleado) && !empty($fecha_ven) && !empty($modelo) && !empty($marca) ){
				$consulta_insert=$con->prepare('INSERT INTO ventas(cliente,empleado,fecha_ven,modelo,marca) VALUES(:cliente,:empleado,:fecha_ven,:modelo,:marca)');
				$consulta_insert->execute(array(
					':cliente' =>$cliente,
					':empleado' =>$empleado,
					':fecha_ven' =>$fecha_ven,
					':modelo' =>$modelo,
					':marca' =>$marca
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
				<input type="text" name="cliente" placeholder="Cliente que realizó la compra" class="input__text">
				<input type="text" name="empleado" placeholder="Empleado que realizó la venta" class="input__text">
			</div>
			<div class="form-group">
				<input type="date" name="fecha_ven" class="input__text">
				<input type="text" name="modelo" placeholder="Modelo" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="marca" placeholder="Marca" class="input__text">
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
