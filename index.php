<?php 
require ('conex.php');
include_once('containers.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	if(!isset($_GET['action'])){ 
	headstyle("Pagina principal");
	}
	else{
		switch ($_GET['action']) {
			case 'register':
				headstyle("Alta de solicitante");
				break;
			case 'addingress':
				headstyle("Agregar Ingresos de solicitantes");
				break;
			case 'addrequest':
				headstyle("Registrar solicitud");
				break;
			case 'show':
				headstyle("Mostrar Solicitudes");
				break;
			case 'modify':
				headstyle("Modificar Solicitud");
				break;
		}
	}
	?>
</head>
<body>
	<div class="container">
		<h1>EXAMEN PHP SOC</h1>
			<button onclick="window.location.href = 'index.php?action=register'" class="btn btn-primary" >1) Alta de solicitante</button>
			<button onclick="window.location.href = 'index.php?action=addingress'" class="btn btn-success" >2) Registrar ingresos</button>
			<button onclick="window.location.href = 'index.php?action=addrequest'" class="btn btn-primary" >3) Registrar solicitud</button>
			<button onclick="window.location.href = 'index.php?action=show'" class="btn btn-secondary" >4) Visualizacion de Solicitantes</button>
			<?php 
			if(isset($_GET['action'])){
				switch ($_GET['action']) {
					case 'register':
					registrarSolicitante();	
					break;
					case 'addingress':
					agregarIngreso($mysqli);	
					break;
					case 'addrequest':
					agregarSolicitud($mysqli);
					break;
					case 'show':
					mostrarSolicitudes($mysqli);
					break;
					case 'modify':
					if(isset($_GET['target'])){
					modificarSolicitud($mysqli,$_GET['target']);
					}
					break;
				}
			}
			?>
	</div>
</body>
</html>