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
			<h1>Agregar Medicamento</h1>
		</section>

		<div class="formulario">
			<form name="frm_usuario" method="POST" autocomplete="off" />
				<div class="formulario_id">
					<p>Id</p>
					<input type="number" name="id_tipousu" id="idmedic" value=""/>
				</div>
				<div class="formulario_info">
					<p>Nombre Medicamento</p>
					<input type="text" name="medicamento" id="medicamento" value=""/>	
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
	$medic = $_POST['medicamento'];
	$sql_medic = "SELECT * FROM `medicamentos` WHERE `medicamento` = '$medic' ";
	$medic_query = mysqli_query($mysqli, $sql_medic);
	$row_medic = mysqli_fetch_assoc($medic_query);

	if ($row_medic) {
		echo '<script>alert("El medicamento ya existe");</script>';
		echo '<script>window.location="registro_medicamento.php"</script>';
	}

	elseif ($_POST['medicamento'] == "") {
		echo '<script>alert("Campos vacíos");</script>';
		echo '<script>window.location="registro_medicamento.php"</script>';
	}

	else {
		$medicamento = $_POST['medicamento'];
		$sql_medicamento = "INSERT INTO `medicamentos`(`medicamento`) VALUES ('$medicamento')";
		$medicamento = mysqli_query($mysqli, $sql_medicamento);
		echo '<script>alert("Registro Exitoso");</script>';
		echo '<script>window.location="registro_medicamento.php"</script>';
	}
}else if (isset($_POST["btn-buscar"]))
{
	$id_medic = $_POST['medicamento'];
	$sql_idmedic = "SELECT * FROM `medicamentos` WHERE `medicamento` = '$id_medic';";
	$id = mysqli_query($mysqli, $sql_idmedic);
	$row_idmedic = mysqli_fetch_assoc($id);

	if ($row_idmedic) {
		echo "<script> let id = '" . $row_idmedic['id_medicamentos']  . "'</script>";
		echo "<script> let name = '" . $id_medic  . "'</script>";
		echo "<script> document.getElementById('medicamento').value = name; </script>";
		echo "<script> document.getElementById('idmedic').value = id; </script>";
	}

	elseif ($_POST['medicamento'] == "") {
		echo '<script>alert("Campos vacíosss");</script>';
		echo '<script>window.location="registro_medicamento.php";</script>';
	}
}