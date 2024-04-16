<?php

include_once "./controllers/consultasDB.php";

$controller = new MainController();

$errorLogin = null;

if(isset($_GET['val'])){
    $errorLogin = "Datos Incorrectos";
}

// $consultaUsuarios = $controller->buscarUsuarios();

// while($resultado = mysqli_fetch_assoc($consultaUsuarios)){
//     echo $resultado['num_documento'];
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>

    <form action="./controllers/validarLogin.php" method="post" class="FormLogin">
        <h4>Iniciar Sesion</h4>
        <div>
            <p>Usuario</p>
            <input type="text"  name="usuario" required>
        </div>
        <div>
            <p>Contraseña</p>
            <input type="password"  name="pass" required >
        </div>

        <button type="submit">INGRESAR</button>
        <br>
       <p class="error"> <?= $errorLogin ?></p>
    </form>
</body>
</html>
