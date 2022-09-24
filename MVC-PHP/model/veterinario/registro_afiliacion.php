<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuario WHERE email = '" . $_SESSION['email'] . "' AND usuarios.tipo_usuario = tipo_usuario.id_tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
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
		<title>taller</title>
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
			<h1>Registro Afiliación</h1>
		</section>

		<div class="formulario">
			<form name="frm_usuario" method="POST" autocomplete="off" />
				<div class="formulario_id">
					<p>Id Afiliación</p>
					<input type="number" name="id_afiliacion" id="idafilacion" value=""/>
				</div>
				<div class="formulario_info">
					<p>Id Mascota</p>
					<input type="text" name="id_mascota" id="idmascota" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Fecha de Afiliación</p>
					<input type="date" name="fecha_afiliacion" id="fecha" value=""/>	
				</div>
				
				<div class="formulario_button">
					<!-- Save button -->
					<input type="submit" value="Guardar" name="btn-guardar" />
					<!-- search button -->
					<input type="submit" value="Buscar" name="btn-buscar" />
				</div>
			</form>
		</div>
	</body>
</html>

<?php 
if (isset($_POST["btn-guardar"]))
{
	$masc = $_POST['id_mascota'];
	$sql_masc = "SELECT * FROM `afiliacion` WHERE `id_mascota` = '$masc' ";
	$masc_query = mysqli_query($mysqli, $sql_masc);
	$row_masc = mysqli_fetch_assoc($masc_query);

	if ($row_masc) {
		echo '<script>alert("La afiliación ya existe");</script>';
		echo '<script>window.location="registro_afiliacion.php"</script>';
	}

	elseif ($_POST['id_mascota'] == "") {
		echo '<script>alert("Campos vacíos");</script>';
		echo '<script>window.location="registro_afiliacion.php"</script>';
	}

	else {
		$id_masc = $_POST['id_mascota'];
		$fecha_afiliacion = $_POST['fecha_afiliacion'];
		$sql_afiliacion = "INSERT INTO `afiliacion`(`fecha_afiliacion`, `id_mascota`) VALUES ('$fecha_afiliacion','$id_masc')";
		$afiliacion = mysqli_query($mysqli, $sql_afiliacion);
		echo '<script>alert("Afiliación Exitosa");</script>';
		echo '<script>window.location="registro_afiliacion.php"</script>';
	}
}else if (isset($_POST["btn-buscar"]))
{
	$id_masc = $_POST['id_mascota'];
	$sql_idafiliacion = "SELECT * FROM `afiliacion` WHERE `id_mascota` = '$id_masc';";
	$id = mysqli_query($mysqli, $sql_idafiliacion);
	$row_idafiliacion = mysqli_fetch_assoc($id);

	if ($row_idafiliacion) {
		echo "<script> let id = '" . $row_idafiliacion['id_afiliacion']  . "'</script>";
		echo "<script> let idmascota = '" . $id_masc  . "'</script>";
		echo "<script> let fechaa = '" . $row_idafiliacion['fecha_afiliacion']  . "'</script>";
		echo "<script> document.getElementById('idafilacion').value = id; </script>";
		echo "<script> document.getElementById('idmascota').value = idmascota; </script>";
		echo "<script> document.getElementById('fecha').value = fechaa; </script>";
	}

	elseif ($_POST['id_mascota'] == "") {
		echo '<script>alert("Campos vacíosss");</script>';
		echo '<script>window.location="registro_afiliacion.php";</script>';
	}
}