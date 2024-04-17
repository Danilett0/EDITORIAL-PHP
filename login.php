<?php
$errorLogin = null;

if (isset($_POST['usuario']) && isset($_POST['pass'])) {
    require_once './controllers/loginController.php';

    $validarLogin = new ValidarLoginController();
    $result = $validarLogin->validarInicioSession($_POST['usuario'], $_POST['pass']);

    $result ? header('Location: ./views/home.php') : $errorLogin = "Datos Incorrectos";
}

?>

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
