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
			<h1>Recetar Medicamentos</h1>
		</section>

		<div class="formulario">
			<form name="frm_usuario" method="POST" autocomplete="off" />
				<div class="formulario_id">
					<p>Id Recibo</p>
					<input type="number" name="id_recibo" id="idrecibo" value=""/>
				</div>
				<div class="formulario_info">
					<p>Id Visita</p>
					<input type="text" name="id_visita" id="idvisita" value=""/>	
				</div>
				<div class="formulario_id">
					<p>Id Medicina</p>
					<input type="number" name="id_medicina" id="idmedic" value=""/>
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
	$idvis = $_POST['id_visita'];
	$idmedic = $_POST['id_medicina'];
	$sql_medic = "SELECT * FROM `visitas_medicinas` WHERE `id_visita` = '$idvis' AND `id_medicina` =  '$idmedic'";
	$medic_query = mysqli_query($mysqli, $sql_medic);
	$row_medic = mysqli_fetch_assoc($medic_query);

	if ($row_medic) {
		echo '<script>alert("El medicamento ya se recetó");</script>';
		echo '<script>window.location="recetar_medicamento.php"</script>';
	}

	elseif ($_POST['id_medicina'] == "" or $_POST['id_visita'] == "") {
		echo '<script>alert("Campos vacíos");</script>';
		echo '<script>window.location="recetar_medicamento.php"</script>';
	}

	else {
		$var1 = $_POST['id_visita'];
		$var2 = $_POST['id_medicina'];
		$sql_medicamento = "INSERT INTO `visitas_medicinas`(`id_visita`, `id_medicina`) VALUES ('$var1','$var2')";
		$medicamento = mysqli_query($mysqli, $sql_medicamento);
		echo '<script>alert("Registro Exitoso");</script>';
		echo '<script>window.location="recetar_medicamento.php"</script>';
	}
}else if (isset($_POST["btn-buscar"]))
{
	$id_medic = $_POST['id_recibo'];
	$sql_idmedic = "SELECT * FROM `visitas_medicinas` WHERE `id_recibo` = '$id_medic';";
	$id = mysqli_query($mysqli, $sql_idmedic);
	$row_idmedic = mysqli_fetch_assoc($id);

	if ($row_idmedic) {
		echo "<script> let idmedic = '" . $row_idmedic['id_medicina']  . "'</script>";
		echo "<script> let idvisita = '" . $row_idmedic['id_visita']  . "'</script>";
		echo "<script> let id = '" . $id_medic  . "'</script>";
		echo "<script> document.getElementById('idrecibo').value = id; </script>";
		echo "<script> document.getElementById('idvisita').value = idvisita; </script>";
		echo "<script> document.getElementById('idmedic').value = idmedic; </script>";
	}

	elseif ($_POST['id_recibo'] == "") {
		echo '<script>alert("Campos vacíosss");</script>';
		echo '<script>window.location="recetar_medicamento.php";</script>';
	}
}