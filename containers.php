<?php
function Headstyle($whereami){
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo($whereami); ?> || Examen PHP SOC - Joshua </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<?php 
}

function registrarSolicitante(){
  $mexicoStates=file_get_contents('states.json');//toma un archivo json de todos los estados de la republica
  $statesData=json_decode($mexicoStates,true);//los datos se obtienen y se guardan en la variable
  ?>
  <h2>Registrar Solicitante</h2>
  <form action='registrar.php' method="POST">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre(s)</label>
    <input type="text" name="nombre" class="form-control" maxlength="20" id="nombre" aria-describedby="nombre_help" required>
    <div id="nombre_help" class="form-text">Coloca tu nombre</div>
  
  
    <label for="apellido" class="form-label">Apellido(s)</label>
    <input type="text" name="apellido" class="form-control" maxlength="20" id="apellido" aria-describedby="apellido_help" required>
    <div id="apellido_help" class="form-text">Coloca tu apellido</div>
  
    <label for="correo" class="form-label">Correo electronico</label>
    <input type="email" name="correo" class="form-control" maxlength="30" id="correo" aria-describedby="correo_help" required>
    <div id="apellido_help" class="form-text">Coloca tu correo</div>

    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento (dd/mm/aaaa)</label>
    <input max="2005-06-15" min="1923-06-15" type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento" aria-describedby="fecha_nacimiento_help" required>
    <div id="fecha_nacimiento_help" class="form-text">Coloca tu fecha de nacimiento</div>
  
  
    <label for="sexo" class="form-label">Sexo</label>
    <select id="sexo" class="form-select" name="sexo" required>
    <option disabled selected>Elige una opción</option>
    <option value="H">Hombre</option>
    <option value="M">Mujer</option>
    </select>
  
    <label for="CURP" class="form-label">CURP (Clave única de registro de población)</label>
    <input type="text" name="curp" class="form-control" minlength="18" maxlength="18" id="CURP" required aria-describedby="CURP_help">
    <div id="CURP_help" class="form-text">Clave que consta de 18 caracteres</div>
  
  
    <label for="codigo_postal" class="form-label">Código postal</label>
    <input type="number" name="codigo_postal" class="form-control" minlenght="5" maxlength="5" id="codigo_postal" aria-describedby="codigo_postal_help" required>
    <div id="codigo_postal_help" class="form-text">Coloca tu código postal</div>
  
    <label for="estado" class="form-label">Estado</label>
    <select id="estado" class="form-select" name="estado" required>
    <option disabled selected>Elige una opción</option>
    <?php 
    
    for($x=0;$x<sizeof($statesData);$x++){
      ?>
      <option value="<?php echo($statesData[$x]['nombre_entidad']); ?>"><?php echo($statesData[$x]['nombre_entidad']) ?></option>
      <?php
    }
    ?>
    </select>
  
    <label for="direccion_postal" class="form-label">Dirección</label>
    <textarea name="direccion" class="form-control" aria-describedby="direccion_help" placeholder="Escribe aqui tu Dirección"></textarea>
    <div id="direccion_help" class="form-text">Empieza por calle, numero exterior, numero interior, y colonia</div>
  
    <button type="submit" class="btn btn-primary">Registrar datos de solicitante</button>
  </div>
  </form>
  <?php

}

function agregarIngreso($mysqli){
?>
  <h2>Registrar Ingresos</h2>
  <form action='addingress.php' method="POST">
  <div class="mb-3">
    <?php 
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $id = substr(str_shuffle($permitted_chars), 0, 20);
    ?>
    <input type="hidden" name="id" value="<?php echo($id); ?>">
    <label for="solicitante" class="form-label">CURP del Solicitante</label>
    <select id="solicitante" class="form-select" name="curp" required>
      <option disabled selected>Elige una opción</option>
      <?php 
      $userquery=mysqli_query($mysqli,"SELECT curp, nombre, apellidos from solicitantes order by fecha_registrado DESC");
      while($userarray=mysqli_fetch_array($userquery)){
      ?>
      <option value="<?php echo($userarray['curp']) ?>"><?php echo($userarray['curp']." (".$userarray['nombre']." ".$userarray['apellidos'].")") ?></option>
      <?php 
      }
      ?>
    </select>

    <label for="nombre_empresa" class="form-label">Nombre de la empresa</label>
    <input type="text" name="nombre_empresa" class="form-control" maxlength="20" id="nombre_empresa" aria-describedby="nombre_empresa_help" required>
    <div id="nombre_empresa_help" class="form-text">Coloca el nombre de la empresa para quien trabaja</div> 

    <label for="tipo_empleo_empresa" class="form-label">Tipo de empleo</label>
    <input type="text" name="tipo_empleo" class="form-control" maxlength="20" id="tipo_empleo_empresa" aria-describedby="tipo_empleo_help" required>
    <div id="tipo_empleo_help" class="form-text">Define el tipo de empleo</div> 

    <label for="comprobante_ingresos_empresa" class="form-label">Tipo de Comprobante de Ingresos</label>
    <input type="text" name="comprobante_ingresos" class="form-control" maxlength="20" id="comprobante_ingresos_empresa" aria-describedby="comprobante_ingresos_help" required>
    <div id="comprobante_ingresos_help" class="form-text">Define el tipo de comprobante de ingresos</div> 

    <label for="salario_n" class="form-label">Ingreso mensual (Neto)</label>
    <input type="number" name="salario_n" min="5500" class="form-control" minlenght="4" maxlength="6" id="salario_n" aria-describedby="salario_n_help" required>
    <div id="salario_n_help" class="form-text">Coloca el sueldo mensual despues de impuestos</div>

    <label for="fecha_inicio" class="form-label">Fecha de inicio (dd/mm/aaaa)</label>
    <input max="2023-06-16" min="2005-06-15" type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" aria-describedby="fecha_inicio_help" required>
    <div id="fecha_inicio_help" class="form-text">Coloca tu fecha de inicio</div>
  </div>
  <button class="btn btn-primary" type="submit">Enviar datos</button>
  </form>
<?php
}

function agregarSolicitud($mysqli){
?>
  <h2>Registrar Solicitud</h2>
  <form action='addrequest.php' method="POST">
  <div class="mb-3">
    <?php 
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $id = substr(str_shuffle($permitted_chars), 0, 11);
    ?>
    <input type="hidden" name="id" value="<?php echo($id); ?>">
    <label for="solicitante" class="form-label">CURP del Solicitante</label>
    <select id="solicitante" class="form-select" name="curp" required>
      <option disabled selected>Elige una opción</option>
      <?php 
      $userquery=mysqli_query($mysqli,"SELECT curp, nombre, apellidos from solicitantes order by fecha_registrado DESC");
      while($userarray=mysqli_fetch_array($userquery)){
      ?>
      <option value="<?php echo($userarray['curp']) ?>"><?php echo($userarray['curp']." (".$userarray['nombre']." ".$userarray['apellidos'].")") ?></option>
      <?php 
      }
      ?>
    </select>

    <label for="fecha_registro" class="form-label">Fecha de registro (dd/mm/aaaa)</label>
    <input max="2023-06-16" min="2005-06-15" type="date" name="fecha_registro" class="form-control" id="fecha_registro" aria-describedby="fecha_registro_help" required>
    <div id="fecha_registro_help" class="form-text">Coloca tu fecha de registro</div>

    <label for="destino" class="form-label">Destino</label>
    <select id="destino" class="form-select" name="destino" required>
    <option value="Tarjeta">Tarjeta de credito</option>
    <option value="Prestamo">Prestamo</option>
    <option value="Auto">Auto</option>
    <option value="Casa">Casa</option>
    </select>

    <label for="monto" class="form-label">Monto Solicitado</label>
    <input step="100" type="number" name="monto" min="20000" max="200000" class="form-control" minlenght="5" maxlength="6" id="monto" aria-describedby="monto_help" required>
    <div id="monto_help" class="form-text">Coloca el Monto solicitado</div>

    <label for="plazo" class="form-label">Plazo de pago (Años)</label>
    <input type="number" name="plazo" min="1" max="10" class="form-control" id="plazo" aria-describedby="plazo_help" required>
    <div id="plazo_help" class="form-text">Coloca el Plazo en años</div>

  </div>
  <button class="btn btn-primary" type="submit">Enviar datos</button>
  </form>
<?php
}

function modificarSolicitud($mysqli,$id){
?>
  <h2>Registrar Solicitud</h2>
  <form action='modifyrequest.php' method="POST">
  <div class="mb-3">
    <input type="hidden" name="id" value="<?php echo($id); ?>">
    <?php
    $ogquery=mysqli_query($mysqli,"SELECT * FROM pedidos where id='$id'");
    $ogarray=mysqli_fetch_array($ogquery);
    $solicitante=$ogarray['solicitante'];
    ?>
    <label for="solicitante" class="form-label">CURP del Solicitante</label>
    <select id="solicitante" class="form-select" name="curp" required>
      <?php 
      $userquery=mysqli_query($mysqli,"SELECT curp, nombre, apellidos from solicitantes where curp='$solicitante'");
      while($userarray=mysqli_fetch_array($userquery)){
      ?>
      <option value="<?php echo($userarray['curp']) ?>"><?php echo($userarray['curp']." (".$userarray['nombre']." ".$userarray['apellidos'].")") ?></option>
      <?php 
      }
      $userquery=mysqli_query($mysqli,"SELECT curp, nombre, apellidos from solicitantes where curp!='$solicitante' order by fecha_registrado DESC");
      while($userarray=mysqli_fetch_array($userquery)){
      ?>
      <option value="<?php echo($userarray['curp']) ?>"><?php echo($userarray['curp']." (".$userarray['nombre']." ".$userarray['apellidos'].")") ?></option>
      <?php 
      }
      ?>
    </select>

    <label for="fecha_registro" class="form-label">Fecha de registro (dd/mm/aaaa)</label>
    <input max="2023-06-16" min="2005-06-15" type="date" name="fecha_registro" class="form-control" id="fecha_registro" value='<?php echo($ogarray['fecha_registro']) ?>' aria-describedby="fecha_registro_help" required>
    <div id="fecha_registro_help" class="form-text">Coloca tu fecha de registro</div>

    <label for="destino" class="form-label">Destino</label>
    <select id="destino" class="form-select" name="destino" required>
    <option value="Tarjeta">Tarjeta de credito</option>
    <option value="Prestamo">Prestamo</option>
    <option value="Auto">Auto</option>
    <option value="Casa">Casa</option>
    </select>

    <label for="monto" class="form-label">Monto Solicitado</label>
    <input step="100" value='<?php echo($ogarray['monto']) ?>' type="number" name="monto" min="20000" max="200000" class="form-control" minlenght="5" maxlength="6" id="monto" aria-describedby="monto_help" required>
    <div id="monto_help" class="form-text">Coloca el Monto solicitado</div>

    <label for="plazo" class="form-label">Plazo de pago (Años)</label>
    <input type="number" value='<?php echo($ogarray['plazo']) ?>' name="plazo" min="1" max="10" class="form-control" id="plazo" aria-describedby="plazo_help" required>
    <div id="plazo_help" class="form-text">Coloca el Plazo en años</div>

  </div>
  <button class="btn btn-primary" type="submit">Enviar datos</button>
  </form>
<?php
}

function mostrarSolicitudes($mysqli){

?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Folio</th>
      <th scope="col">Nombre Completo</th>
      <th scope="col">Destino</th>
      <th scope="col">Fecha Registro</th>
    <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $showquery=mysqli_query($mysqli,"SELECT pedidos.id,solicitantes.nombre,solicitantes.apellidos,pedidos.destino,pedidos.fecha_registro from pedidos inner join solicitantes on solicitantes.curp=pedidos.solicitante order by pedidos.fecha_registro desc");
    while($showarray=mysqli_fetch_array($showquery)){
    ?>
    <tr>
      <th scope="row"><?php echo($showarray['id']); ?></th>
      <td><?php echo($showarray['nombre']." ".$showarray['apellidos']); ?></td>
      <td><?php echo($showarray['destino']); ?></td>
      <td><?php echo($showarray['fecha_registro']); ?></td>
    <td><a href="index.php?action=modify&target=<?php echo($showarray['id']); ?>" class="btn btn-success">Editar</a></td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
  </table>
<?php
}
?>  