<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuarios, tipo_usuario WHERE email = '" . $_SESSION['email'] . "' AND usuarios.tipo_usuario = tipo_usuario.id_tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<?php 
	// Realizamos la consulta para la tabla tipos de usuarios
	$sql_tipo_masc = "SELECT * FROM `tipo_mascota`;";
	$query_tipo_masc = mysqli_query($mysqli, $sql_tipo_masc);
	$row_tipo_masc = mysqli_fetch_assoc($query_tipo_masc);

	// Realizamos la consulta para la tabla estados
	$sql_estados = "SELECT * FROM `estados` WHERE id_estado > 2;";
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
		<title>Registro Mascotas</title>
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
			<h1>Registrar Mascota</h1>
		</section>

		<div class="formulario">
			<form name="frm_usuario" method="POST" autocomplete="off" />
				<div class="formulario_id">
					<p>Id Mascota</p>
					<input type="text" name="id_usu" id="idusu" value="" />
				</div>
				<div class="formulario_info">
					<p>Id Propietario</p>
					<input type="number" name="uiduser" id="uiduser" value="" />	
				</div>
				<div class="formulario_info">
					<p>Nombre Mascota</p>
					<input type="text" name="mname" id="mname" value="" />	
				</div>
				<div class="formulario_info">
					<p>Color</p>
					<input type="text" name="mcolor" id="mcolor" value=""/>	
				</div>
				<div class="formulario_info">
					<select name="tipo_masc" id="tipo_masc">
						<option value="">Seleccione Tipo de Mascota...</option>
							<?php 
								do {
							?>
							<option value="<?php echo($row_tipo_masc['id_tipo_masc'])?>"><?php echo($row_tipo_masc['tipo_masc'])?></option>
							<?php	}while($row_tipo_masc = mysqli_fetch_assoc($query_tipo_masc));
							?>
					</select>	
				</div>
				<div class="formulario_info">
					<select name="estado_masc" id="estado_masc">
						<option value="">Seleccione Estado de la Mascota...</option>
						<?php 
								do {
							?>
							<option value="<?php echo($row_estado['id_estado'])?>"><?php echo($row_estado['estado'])?></option>
							<?php	}while($row_estado = mysqli_fetch_assoc($query_estado));
							?>
					</select>
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
	if ($_POST['uiduser'] == "" || $_POST['mname'] == "" || $_POST['mcolor'] == "" || $_POST['tipo_masc'] == "" || $_POST['estado_masc'] == "") {
		echo '<script>alert("Campos vacíos");</script>';
		echo '<script>window.location="registro_animal.php"</script>';
	}

	else {
		$var1 = $_POST['uiduser'];
		$var2 = $_POST['mname'];
		$var3 = $_POST['mcolor'];
		$var4 = $_POST['tipo_masc'];
		$var5 = $_POST['estado_masc'];
		$sql_masc = "INSERT INTO `mascotas_clientes`(`id_propietario`, `tipo_mascota`, `nombre_mascota`, `color`, `estado`) VALUES ('$var1', '$var4', '$var2', '$var3', '$var5')";
		$reg_masc = mysqli_query($mysqli, $sql_masc);
		echo '<script>alert("Registro Exitoso");</script>';
		echo '<script>window.location="registro_animal.php"</script>';
	}
}else if (isset($_POST["btn-buscar"]))
{
	$id_us = $_POST['uiduser'];
	$id_masc = $_POST['id_usu'];
	$sql_idusu = "SELECT * FROM `mascotas_clientes` WHERE `id_propietario` = '$id_us' OR `id_mascota` = '$id_masc';";
	$id = mysqli_query($mysqli, $sql_idusu);
	$row_id = mysqli_fetch_assoc($id);

	if ($row_id) {
		echo "<script> let id_prop = '" . $row_id['id_propietario']  . "'</script>";
		echo "<script> let id_masc= '" . $row_id['id_mascota']  . "'</script>";
		echo "<script> let mname = '" . $row_id['nombre_mascota']  . "'</script>";
		echo "<script> let mcolor = '" . $row_id['color']  . "'</script>";
		echo "<script> let type = '" . $row_id['tipo_mascota']  . "'</script>";
		echo "<script> let status = '" . $row_id['estado']  . "'</script>";
		echo "<script> document.getElementById('idusu').value = id_masc; </script>";
		echo "<script> document.getElementById('uiduser').value = id_prop; </script>";
		echo "<script> document.getElementById('mname').value = mname; </script>";
		echo "<script> document.getElementById('mcolor').value = mcolor; </script>";
		echo "<script> document.getElementById('tipo_masc').value = type; </script>";
		echo "<script> document.getElementById('estado_masc').value = status; </script>";
	}

	elseif ($_POST['uiduser'] == "") {
		echo '<script>alert("Campos vacíos o id no exíste");</script>';
		echo '<script>window.location="registro_animal.php";</script>';
	}
}
?>