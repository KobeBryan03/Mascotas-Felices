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
        <link rel="stylesheet" href="estilos.css">
        <title>Panel</title>
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
            <h1>Panel <?php echo $usua['tipo_usuario'] ?></h1>
        </section>

        <nav class="navegacion">
            <ul class="menu wrapper">
                <li>
                    <a href="#">
                        <span class="text-item">Consultar Mascota</span>
                        <span class="down-item"></span>
                    </a>
                </li>
            </ul>
        </nav>
    </body>
</html>