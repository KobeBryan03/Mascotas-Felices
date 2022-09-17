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
	$sql_tipo_usu = "SELECT * FROM `tipo_usuario` WHERE id_tipo_usuario;";
	$query_tipo_usu = mysqli_query($mysqli, $sql_tipo_usu);
	$row_tipo_usu = mysqli_fetch_assoc($query_tipo_usu);

	// Realizamos la consulta para la tabla estados
	$sql_estados = "SELECT * FROM `estados` WHERE id_estado < 3;";
	$query_estado = mysqli_query($mysqli, $sql_estados);
	$row_estado = mysqli_fetch_assoc($query_estado);
?>

<?php

if (isset($_POST['btncerrar'])) {
	session_destroy();
	header('location: ../../index.html');
}

?>

</div>

</div>

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
			<h1>Registrar Usuario</h1>
		</section>

		<div class="formulario">
			<form name="frm_usuario" method="POST" autocomplete="off" />
				<div class="formulario_id">
					<p>Id</p>
					<input type="number" name="id_usu" id="idusu" value="" />
				</div>
				<div class="formulario_info">
					<p>Numero Documento</p>
					<input type="number" name="udocument" id="udocument" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Nombre</p>
					<input type="text" name="uname" id="uname" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Apellido</p>
					<input type="text" name="ulast_name" id="ulast_name" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Direccion</p>
					<input type="text" name="uaddress" id="uaddress" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Email</p>
					<input type="email" name="uemail" id="uemail" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Numero Teléfono</p>
					<input type="number" name="uphone" id="uphone" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Contraseña</p>
					<input type="password" name="upassword" id="upassword" value=""/>	
				</div>
				<div class="formulario_info">
					<select name="tipo_usu" id="tipo_usu">
						<option value="">Seleccione Tipo de Usuario...</option>
							<?php 
								do {
							?>
							<option value="<?php echo($row_tipo_usu['id_tipo_usuario'])?>"><?php echo($row_tipo_usu['tipo_usuario'])?></option>
							<?php	}while($row_tipo_usu = mysqli_fetch_assoc($query_tipo_usu));
							?>
					</select>	
				</div>
				<div class="formulario_info">
					<select name="estado_usu" id="estado_usu">
						<option value="">Seleccione Estado del Usuario...</option>
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
	$tip_us = $_POST['tipo_usu'];
	$docu_user = $_POST['udocument'];
	$sql_val = "SELECT * FROM `usuarios` WHERE `tipo_usuario` = '$tip_us' AND `numero_tar`= '$docu_user';";
	$val = mysqli_query($mysqli, $sql_val);
	$row_val = mysqli_fetch_assoc($val);

	if ($row_val) {
		echo '<script>alert("Este usuario ya se encuentra registrado");</script>';
		echo '<script>window.location="registro_user.php"</script>';
	}

	elseif ($_POST['udocument'] == "" || $_POST['uname'] == "" || $_POST['ulast_name'] == "" || $_POST['uaddress'] == "" || $_POST['uemail'] == "" || $_POST['uphone'] == "" || $_POST['upassword'] == "" || $_POST['tipo_usu'] == "" || $_POST['estado_usu'] == "") {
		echo '<script>alert("Campos vacíos");</script>';
		echo '<script>window.location="registro_user.php"</script>';
	}

	else {
		$var1 = $_POST['udocument'];
		$var2 = $_POST['uname'];
		$var3 = $_POST['ulast_name'];
		$var4 = $_POST['uaddress'];
		$var5 = $_POST['uemail'];
		$var6 = $_POST['uphone'];
		$var7 = $_POST['upassword'];
		$var8 = $_POST['tipo_usu'];
		$var9 = $_POST['estado_usu'];
		$sql_usu = "INSERT INTO `usuarios`(`nombre`, `apellido`, `direccion`, `email`, `tipo_usuario`, `numero_tar`, `estado`, `password`, `telefono`) VALUES ('$var2', '$var3', '$var4', '$var5', '$var8', '$var1', '$var9', '$var7', '$var6')";
		$reg_user = mysqli_query($mysqli, $sql_usu);
		echo '<script>alert("Registro Exitoso");</script>';
		echo '<script>window.location="registro_user.php"</script>';
	}
}else if (isset($_POST["btn-buscar"]))
{
	$id_us = $_POST['id_usu'];
	$sql_idusu = "SELECT * FROM `usuarios` WHERE `id_usuario` = '$id_us';";
	$id = mysqli_query($mysqli, $sql_idusu);
	$row_id = mysqli_fetch_assoc($id);

	if ($row_id) {
		echo "<script> let id = '" . $id_us  . "'</script>";
		echo "<script> let card = '" . $row_id['numero_tar']  . "'</script>";
		echo "<script> let name = '" . $row_id['nombre']  . "'</script>";
		echo "<script> let lastname = '" . $row_id['apellido']  . "'</script>";
		echo "<script> let address = '" . $row_id['direccion']  . "'</script>";
		echo "<script> let email = '" . $row_id['email']  . "'</script>";
		echo "<script> let phone = '" . $row_id['telefono']  . "'</script>";
		echo "<script> let password = '" . $row_id['password']  . "'</script>";
		echo "<script> let type = '" . $row_id['tipo_usuario']  . "'</script>";
		echo "<script> let status = '" . $row_id['estado']  . "'</script>";
		echo "<script> document.getElementById('idusu').value = id; </script>";
		echo "<script> document.getElementById('udocument').value = card; </script>";
		echo "<script> document.getElementById('uname').value = name; </script>";
		echo "<script> document.getElementById('ulast_name').value = lastname; </script>";
		echo "<script> document.getElementById('uaddress').value = address; </script>";
		echo "<script> document.getElementById('uemail').value = email; </script>";
		echo "<script> document.getElementById('uphone').value = phone; </script>";
		echo "<script> document.getElementById('upassword').value = password; </script>";
		echo "<script> document.getElementById('tipo_usu').value = type; </script>";
		echo "<script> document.getElementById('estado_usu').value = status; </script>";
	}

	elseif ($_POST['id_tipousu'] == "") {
		echo '<script>alert("Campos vacíos o id no exíste");</script>';
		echo '<script>window.location="registro_user.php";</script>';
	}
}
?>