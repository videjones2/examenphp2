<?php 
require 'conex.php';
//Se toman todos los datos capturados en el formulario
$curp=$_POST['curp'];
$correo=$_POST['correo'];

	//Busca si existe un solicitante con el mismo correo o curp, tienen que ser unicos
	$buscacurp=mysqli_query($mysqli,"SELECT * FROM solicitantes where curp='$curp' or correo='$correo'");
	$cuantoscurp=mysqli_num_rows($buscacurp);
	//El programa se detendra una vez encuentre un correo o curp repetidos
	if($cuantoscurp>0){ 
	echo("Este CURP o correo electronico ya fue registrado, intenta con otro <br>");
	?>
	<a href="index.php?action=register">Volver</a>
	<?php
	exit();
	}
	//En caso contrario realiza el registro
	$nombre=$_POST['nombre'];
	$apellidos=$_POST['apellido'];
	$fechanacimiento=$_POST['fecha_nacimiento'];
	$sexo=$_POST['sexo'];
	$estado=$_POST['estado'];
	$codigopostal=$_POST['codigo_postal'];
	$direccion=$_POST['direccion'];
	if($registra=mysqli_query($mysqli,"INSERT into solicitantes(curp,nombre,apellidos,fecha_nacimiento,sexo,correo,estado,codigo_postal,domicilio) values('$curp','$nombre','$apellidos','$fechanacimiento','$sexo','$correo','$estado','$codigopostal','$direccion')")){ 

		echo("Los datos del solicitante han sido registrados <br>");
	}


?>

<a href="index.php?action=register">Volver</a>