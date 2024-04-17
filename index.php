<?php
$errorLogin = null;

if (isset($_POST['usuario']) && isset($_POST['pass'])) {
    require_once './controllers/loginController.php';

    $validarLogin = new ValidarLoginController();
    $result = $validarLogin->validarInicioSession($_POST['usuario'], $_POST['pass']);

    $result ? header('Location: ./views/home.php') : $errorLogin = "Datos Incorrectos";
}

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

    <form action="index.php" method="post" class="FormLogin">
        <h2>Iniciar Sesion</h2>
        <div>
            <p>Usuario</p>
            <input type="text" name="usuario" required>
        </div>
        <div>
            <p>Contraseña</p>
            <input type="password" name="pass" required>
        </div>

        <button type="submit">INGRESAR</button>
        <br>
        <p class="error"> <?= $errorLogin ?></p>
    </form>
</body>

</html>