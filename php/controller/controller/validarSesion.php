<?php
//Archivo que permite validar la sesi�n

if(!isset($_SESSION['email']) || !isset($_SESSION['tipo']))
{
	header("Location: ../../index.html");
	exit;
}
?>