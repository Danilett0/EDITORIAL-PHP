<?php
require_once "../controllers/consultasDB.php";
$controller = new MainController();

if (isset($_POST['usuario']) && isset($_POST['pass'])) {

    $validarLogin = $controller->validarLogin($_POST['usuario'], $_POST['pass']);

    if ($validarLogin){
        header('Location: ../views/home.php' );
    }else{
        header('Location: ../index.php?val=0' );
    }
}






