<?php
require_once("../db/connection.php");
session_start();
if($_POST["inicio"]){
	// inicia sesion para los usuarios
	$usuario = $_POST["email"];
	$clave = $_POST["clave"];
	
	
	/// consultamos el usuario segun el usuario y la clave
	$con="select * from usuarios where email = '$usuario' and password = '$clave'"; 	
	$query=mysqli_query($mysqli, $con);
	$fila=mysqli_fetch_assoc($query);
	
	if($fila){		
		/// si el usuario y la clave son correctas, creamos las sesiones 
			
		$_SESSION['id_usuario'] = $fila['id_usuario']; 
		$_SESSION['nombres'] = $fila['nombre']; 
		$_SESSION['tipo'] = $fila['tipo_usuario'];
		$_SESSION['email'] = $fila['email'];
		
				/// dependiendo del tipo de usuario lo redireccinamos a una pagina
		/// si es un client
		if($_SESSION['tipo'] == 1){
			header("Location: ../model/admin/index1.php"); 
			exit();
		}
		/// si es un vendedor
		elseif($_SESSION['tipo'] == 2){
			header("Location: ../model/usuario/index1.php"); 
			exit();		
		}
		
		
	}else{
		/// si el usuario y la clave son incorrectas lo lleva a la pagina de inio y se muestra un mensaje
		header("Location: ../errorlog.html"); 
		exit();
	}
	
}	
?>