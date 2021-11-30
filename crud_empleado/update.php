<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM empleados WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellidos=$_POST['apellidos'];
		$fecha_nac=$_POST['fecha_nac'];
		$curp=$_POST['curp'];
		$domicilio=$_POST['domicilio'];
		$id=(int) $_GET['id'];

		if(!empty($nombre) && !empty($apellidos) && !empty($fecha_nac) && !empty($curp) && !empty($domicilio) ){
			
				$consulta_update=$con->prepare(' UPDATE empleados SET  
					nombre=:nombre,
					apellidos=:apellidos,
					fecha_nac=:fecha_nac,
					curp=:curp,
					domicilio=:domicilio
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':apellidos' =>$apellidos,
					':fecha_nac' =>$fecha_nac,
					':curp' =>$curp,
					':domicilio' =>$domicilio,
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
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				<input type="text" name="apellidos" value="<?php if($resultado) echo $resultado['apellidos']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="date" name="fecha_nac" value="<?php if($resultado) echo $resultado['fecha_nac']; ?>" class="input__text">
				<input type="text" name="curp" value="<?php if($resultado) echo $resultado['curp']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="domicilio" value="<?php if($resultado) echo $resultado['domicilio']; ?>" class="input__text">
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
