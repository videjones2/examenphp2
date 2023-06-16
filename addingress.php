<?php 
require 'conex.php';
//Se toman todos los datos capturados en el formulario
$id=$_POST['id'];
	//Busca si existe un ingreso con el mismo id, tienen que ser unicos
	$busca=mysqli_query($mysqli,"SELECT * FROM ingresos where id='$id'");
	$cuantos=mysqli_num_rows($busca);
	//El programa se detendra una vez encuentre un id repetido
	if($cuantos>0){ 
	echo("Este ingreso ya fue registrado, no es necesario registrarlo de nuevo <br>");
	?>
	<a href="index.php?action=addingress">Volver</a>
	<?php
	exit();
	}
	//En caso contrario realiza el registro
	$solicitante=$_POST['curp'];
	$nombreempresa=$_POST['nombre_empresa'];
	$tipoempleo=$_POST['tipo_empleo'];
	$tipocomprobante=$_POST['comprobante_ingresos'];
	$salarion=$_POST['salario_n'];
	$fechainicio=$_POST['fecha_inicio'];

	if($add=mysqli_query($mysqli,"INSERT into ingresos (id,solicitante,empresa,comprobante_ingresos,salario_n,tipo_empleo,fecha_inicio) values('$id','$solicitante','$nombreempresa','$tipocomprobante','$salarion','$tipoempleo','$fechainicio')")){ 

		echo("Se han registrado los datos del ingreso <br>");
	}
?>
	<a href="index.php?action=addingress">Volver</a>