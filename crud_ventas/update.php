<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM ventas WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$cliente=$_POST['cliente'];
		$empleado=$_POST['empleado'];
		$fecha_ven=$_POST['fecha_ven'];
		$modelo=$_POST['modelo'];
		$marca=$_POST['marca'];
		$id=(int) $_GET['id'];

		if(!empty($cliente) && !empty($empleado) && !empty($fecha_ven) && !empty($modelo) && !empty($marca) ){
			
				$consulta_update=$con->prepare(' UPDATE ventas SET  
					cliente=:cliente,
					empleado=:empleado,
					fecha_ven=:fecha_ven,
					modelo=:modelo,
					marca=:marca
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':cliente' =>$cliente,
					':empleado' =>$empleado,
					':fecha_ven' =>$fecha_ven,
					':modelo' =>$modelo,
					':marca' =>$marca,
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
				<input type="text" name="cliente" value="<?php if($resultado) echo $resultado['cliente']; ?>" class="input__text">
				<input type="text" name="empleado" value="<?php if($resultado) echo $resultado['empleado']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="date" name="fecha_ven" value="<?php if($resultado) echo $resultado['fecha_ven']; ?>" class="input__text">
				<input type="text" name="modelo" value="<?php if($resultado) echo $resultado['modelo']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="marca" value="<?php if($resultado) echo $resultado['marca']; ?>" class="input__text">
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
