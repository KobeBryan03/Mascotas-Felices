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
			<h1>Registro Visita</h1>
		</section>

		<div class="formulario">
			<form name="frm_usuario" method="POST" autocomplete="off" />
				<div class="formulario_id">
					<p>Id Visita</p>
					<input type="number" name="id_visita" id="idvisita" value=""/>
				</div>
				<div class="formulario_info">
					<p>Id Mascota</p>
					<input type="text" name="id_mascota" id="idmascota" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Id Veterinario</p>
					<input type="text" name="id_propietario" id="idpropietario" value=""/>	
				</div>	
				<div class="formulario_info">
					<p>Fecha Visita</p>
					<input type="date" name="fecha" id="fecha" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Temperatura</p>
					<input type="number" name="temperatura" id="temperatura" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Frecuencia Cardiaca</p>
					<input type="number" name="frecuencia" id="frecuencia" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Recomendaciones</p>
					<input type="text" name="recomendaciones" id="recomendaciones" value=""/>	
				</div>
				<div class="formulario_info">
					<p>Costo Visita</p>
					<input type="text" name="costo" id="costo" value=""/>	
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
	$id_masc = $_POST['id_mascota'];
	$fechavis = $_POST['fecha'];
	$sql_masc = "SELECT * FROM `visitas` WHERE  `fecha_visita` = '$fechavis' AND `id_mascota` = '$id_masc'";
	$masc_query = mysqli_query($mysqli, $sql_masc);
	$row_masc = mysqli_fetch_assoc($masc_query);

	if ($row_masc) {
		echo '<script>alert("Ya se realizó esta visita hoy");</script>';
		echo '<script>window.location="registro_visita.php"</script>';
	}

	elseif ($_POST['fecha'] == "") {
		echo '<script>alert("Campos vacíos");</script>';
		echo '<script>window.location="registro_visita.php"</script>';
	}

	else {
		$id_masc = $_POST['id_mascota'];
		$id_prop = $_POST['id_propietario'];
		$fecha = $_POST['fecha'];
		$temp = $_POST['temperatura'];
		$frec = $_POST['frecuencia'];
		$rec = $_POST['recomendaciones'];
		$cost = $_POST['costo'];
		$estado = $_POST['estado_masc'];
		$sql_visita = "INSERT INTO `visitas`(`fecha_visita`, `id_veterinario`, `id_mascota`, `estado`, `temperatura`, `frecuencia_car`, `recomendaciones`, `costo_visita`) VALUES ('$fecha','$id_prop','$id_masc','$estado','$temp','$frec','$rec','$cost')";
		$save_visita = mysqli_query($mysqli, $sql_visita);
		echo '<script>alert("Visita Exitosa");</script>';
		echo '<script>window.location="registro_visita.php"</script>';
	}
}else if (isset($_POST["btn-buscar"]))
{
	$id_visita = $_POST['id_visita'];
	$sql_idafiliacion = "SELECT * FROM `visitas` WHERE `id_visitas` = '$id_visita';";
	$id = mysqli_query($mysqli, $sql_idafiliacion);
	$row_idafiliacion = mysqli_fetch_assoc($id);

	if ($row_idafiliacion) {
		echo "<script> let frecuencia = '" . $row_idafiliacion['frecuencia_car']  . "'</script>";
		echo "<script> let fechav = '" . $row_idafiliacion['fecha_visita']  . "'</script>";
		echo "<script> let idprop = '" . $row_idafiliacion['id_veterinario']  . "'</script>";
		echo "<script> let idmasc = '" . $row_idafiliacion['id_mascota']  . "'</script>";
		echo "<script> let estado = '" . $row_idafiliacion['estado']  . "'</script>";
		echo "<script> let temp = '" . $row_idafiliacion['temperatura']  . "'</script>";
		echo "<script> let id = '" . $id_visita  . "'</script>";
		echo "<script> let recom = '" . $row_idafiliacion['recomendaciones']  . "'</script>";
		echo "<script> let costo = '" . $row_idafiliacion['costo_visita']  . "'</script>";
		echo "<script> document.getElementById('idvisita').value = id; </script>";
		echo "<script> document.getElementById('idmascota').value = idmasc; </script>";
		echo "<script> document.getElementById('idpropietario').value = idprop; </script>";
		echo "<script> document.getElementById('fecha').value = fechav; </script>";
		echo "<script> document.getElementById('temperatura').value = temp; </script>";
		echo "<script> document.getElementById('frecuencia').value = frecuencia; </script>";
		echo "<script> document.getElementById('recomendaciones').value = recom; </script>";
		echo "<script> document.getElementById('costo').value = costo; </script>";
		echo "<script> document.getElementById('estado_masc').value = estado; </script>";
	}

	elseif ($_POST['id_visita'] == "") {
		echo '<script>alert("Campos vacíosss");</script>';
		echo '<script>window.location="registro_visita.php";</script>';
	}
}