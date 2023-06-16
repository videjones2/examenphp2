<?php 
require 'conex.php';
//Se toman todos los datos capturados en el formulario
	$id=$_POST['id'];
	$solicitante=$_POST['curp'];
	$fecharegistro=$_POST['fecha_registro'];
	$destino=$_POST['destino'];
	$monto=$_POST['monto'];
	$plazo=$_POST['plazo'];
	//Busca si existe un ingreso con el mismo destino, tienen que ser solo un pedido por destino
	$busca=mysqli_query($mysqli,"SELECT * FROM pedidos where solicitante='$solicitante' and destino='$destino'");
	$cuantos=mysqli_num_rows($busca);
	//El programa se detendra una vez encuentre un pedido con mas de un destino igual
	if($cuantos>1){ 
	echo("Ya esta registrado un pedido con el destino ".$destino.", liquida dicho pedido o solicita otro con un destino diferente <br>");
	?>
	<a href="index.php?action=show">Volver</a>
	<?php
	exit();
	}
	//Se calculan los ingresos netos del solicitante, sumando todos sus sueldos netos
	$ingresoquery=mysqli_query($mysqli,"SELECT solicitante,sum(salario_n) as ingresos_netos FROM ingresos where solicitante='$solicitante'");
	$ingresoarray=mysqli_fetch_array($ingresoquery);
	//Dependiendo del destino se define el ingreso minimo para continuar la operacion, y el monto maximo permitido
	switch ($destino) {
			case 'Tarjeta':
			$ingresominimo=20000;
			$montomaximo=20000;
			break;
			case 'Prestamo':
			$ingresominimo=20000;
			$montomaximo=50000;
			break;
			case 'Auto':
			$ingresominimo=30000;
			$montomaximo=50000;
			break;
			case 'Casa':
			$ingresominimo=50000;
			$montomaximo=200000;
			break;
	}
	//Si los ingresos netos del solicitante estan por debajo del ingreso minimo, la operacion se cancela
	if($ingresoarray['ingresos_netos']<$ingresominimo){ 

	echo("No cumples con el ingreso minimo del Destino, debes contar con al menos ".$ingresominimo." mensuales, tus ingresos netos son ".$ingresoarray['ingresos_netos']." mensuales <br>");
	?>
	<a href="index.php?action=show">Volver</a>
	<?php
	exit();
	}
	//Si el monto solicitado es mayor que el monto maximo permitido, la operacion tambien se cancela
	if($monto>$montomaximo){ 

	echo("El monto solicitado excede el monto maximo de ".$montomaximo.", intenta con otro monto<br>");
	?>
	<a href="index.php?action=show">Volver</a>
	<?php
	exit();
	}
	//Despues de los filtros y casos de salida, se realiza el registro del pedido
	if($add=mysqli_query($mysqli,"UPDATE pedidos set solicitante='$solicitante', fecha_registro='$fecharegistro', destino='$destino', monto='$monto', plazo='$plazo' where id='$id' ")){ 

		echo("Se han actualizado los datos del pedido, gracias por usar el servicio <br>");
	}
?>
	<a href="index.php?action=show">Volver</a>