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
			<h1>Agregar tipo usuario</h1>
		</section>

		<div class="formulario">
			<form name="frm_usuario" method="POST" autocomplete="off" />
				<div class="formulario_id">
					<p>Id</p>
					<input type="number" name="id_tipousu" id="idusu" value=""/>
				</div>
				<div class="formulario_info">
					<p>Tipo Usuario</p>
					<input type="text" name="tipo_usu" id="tipousu" value=""/>	
				</div>
				<div class="formulario_button">
					<!-- Save button -->
					<input type="submit" value="Guardar" name="btn-guardar" />
					<!-- search button -->
					<input type="submit" value="Buscar" name="btn-buscar" />
					<!-- Edit button -->
					<input type="submit" value="Editar" name="btn-editar" />
					<!-- Delete button -->
					<input type="submit" value="Eliminar" name="btn-eliminar" />
				</div>
			</form>
		</div>
	</body>
</html>

<?php 
if (isset($_POST["btn-guardar"]))
{
	$tip_us = $_POST['tipo_usu'];
	$sql_usu = "SELECT * FROM tipo_usuario WHERE tipo_usuario = '$tip_us'";
	$tip = mysqli_query($mysqli, $sql_usu);
	$row = mysqli_fetch_assoc($tip);

	if ($row) {
		echo '<script>alert("El tipo de usuario ya existe");</script>';
		echo '<script>window.location="registro.php"</script>';
	}

	elseif ($_POST['tipo_usu'] == "") {
		echo '<script>alert("Campos vacíos");</script>';
		echo '<script>window.location="registro.php"</script>';
	}

	else {
		$tipo = $_POST['tipo_usu'];
		$sql_usu = "INSERT INTO tipo_usuario (tipo_usuario) values('$tipo')";
		$tip = mysqli_query($mysqli, $sql_usu);
		echo '<script>alert("Registro Exitoso");</script>';
		echo '<script>window.location="registro.php"</script>';
	}
}else if (isset($_POST["btn-buscar"]))
{
	$id_us = $_POST['id_tipousu'];
	$sql_idusu = "SELECT * FROM `tipo_usuario` WHERE `id_tipo_usuario` = '$id_us';";
	$id = mysqli_query($mysqli, $sql_idusu);
	$row_id = mysqli_fetch_assoc($id);

	if ($row_id) {
		echo "<script> let usr = '" . $row_id['tipo_usuario']  . "'</script>";
		echo "<script> let id = '" . $id_us  . "'</script>";
		echo "<script> document.getElementById('tipousu').value = usr; </script>";
		echo "<script> document.getElementById('idusu').value = id; </script>";
	}

	elseif ($_POST['id_tipousu'] == "") {
		echo '<script>alert("Campos vacíosss");</script>';
		echo '<script>window.location="registro.php";</script>';
	}
}else if (isset($_POST["btn-editar"]))
{
	$var1 = $_POST['tipo_usu'];
	$var2 = $_POST['id_tipousu'];
	$sql_edit = "UPDATE `tipo_usuario` SET `tipo_usuario`='$var1' WHERE `id_tipo_usuario` = '$var2'";
	$edit = mysqli_query($mysqli, $sql_edit);
	echo '<script>alert("Los cambios fueron realizados Exitosamente");</script>';
	echo '<script>window.location="registro.php"</script>';
}else if (isset($_POST["btn-eliminar"]))
{
	$var1 = $_POST['id_tipousu'];
	$sql_delete = "DELETE FROM `tipo_usuario` WHERE `id_tipo_usuario` = '$var1'";
	$delete = mysqli_query($mysqli, $sql_delete);
	echo '<script>alert("Se ha eliminado correctamente");</script>';
	echo '<script>window.location="registro.php"</script>';
}
?>