<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuario WHERE email = '" . $_SESSION['email'] . "' AND usuarios.tipo_usuario = tipo_usuario.id_tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<?php 
	// Realizamos la consulta para la tabla estados
	$sql_estados = "SELECT mascotas_clientes.id_mascota, usuarios.nombre, tipo_mascota.tipo_masc, mascotas_clientes.nombre_mascota, mascotas_clientes.color, estados.estado
	FROM mascotas_clientes
	INNER JOIN usuarios ON mascotas_clientes.id_propietario = usuarios.id_usuario
	INNER JOIN tipo_mascota ON mascotas_clientes.tipo_mascota = tipo_mascota.id_tipo_masc
	INNER JOIN estados ON mascotas_clientes.estado = estados.id_estado
    WHERE usuarios.id_usuario = '" . $_SESSION['id_usuario'] . "';";
	$query_estado = mysqli_query($mysqli, $sql_estados);
	$row_estado = mysqli_fetch_assoc($query_estado);
?>

<?php

if (isset($_POST['btncerrar'])) {
	session_destroy();
	header('location: ../../index.html');
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="estilos2.css">
		<title>Registro Usuario</title>
	</head>
	<body>
		<div class="session_container">
			<form method="POST">
				<div class="session_buttons">
					<img src="./img/icons8-user-48.png" alt="">
					<p><?php echo $usua['nombre'] ?></p>
					<input type="submit" value="Cerrar sesión" name="btncerrar" />
					<input type="submit" formaction="./index.php" value="Regresar" />
				</div>
			</form>
		</div>

		<section class="title">
			<h1>Listado Mascotas</h1>
		</section>

		<div class="formulario">
			<div class="formulario_info">
				<table class="tabla">
					<tr>
						<th>Id</th>
						<th>Propietario</th>
						<th>Especie</th>
						<th>Nombre</th>
						<th>Color</th>
						<th>Estado</th>
					</tr>
					<?php 
						do {
					?>
					<tr>
						<th><?php echo($row_estado['id_mascota'])?></th>
						<th><?php echo($row_estado['nombre'])?></th>
						<th><?php echo($row_estado['tipo_masc'])?></th>
						<th><?php echo($row_estado['nombre_mascota'])?></th>
						<th><?php echo($row_estado['color'])?></th>
						<th><?php echo($row_estado['estado'])?></th>
					</tr>
					<?php	
						}while($row_estado = mysqli_fetch_assoc($query_estado));
					?>
				</table>
			</div>
		</div>
	</body>
</html>