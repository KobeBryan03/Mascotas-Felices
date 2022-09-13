<?php
  $hostname = "localhost:3360";
  $username = "root";
  $password = "";
  $database = "mascotas_felices";
  
  $mysqli = new mysqli ($hostname, $username, $password, $database);

  if ($mysqli -> connect_errno)
  {
     die("fallo la conexion" . mysqli_connect_errno());
  }
  
?>