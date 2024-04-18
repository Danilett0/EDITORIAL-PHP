<?php
include_once "../controllers/OperacionesDbController.php";
$idArt = $_GET['idArt'];

session_start();
$resultadoRev = null;

if (!$_SESSION['login']) {
    header('Location: ../index.php');
    exit();
}

$controller = new OperacionesDbController();
$consultaArticulo = $controller->buscarArticuloId($idArt);

print_r($consultaArticulo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <div class="MensajeBienbenida">
        <p>Hola! <?= $_SESSION['userName'] ?></p>
        <p><?= $_SESSION['userCargo'] ?></p>
    </div>
    <div class="Menu">

        <div class="listadoRevistas">
            <?php
            if ($consultaArticulo) {

                ?>
                <div class="CardRevista Round">
                    <h4><?= $consultaArticulo['nombre'] ?></h4>
                    <p><?= $consultaArticulo['contenido'] ?></p>
                    <p><?= $consultaArticulo['periosidad'] ?></p>
                    <p><?= $consultaArticulo['categoria'] ?></p>
                    <p><?= $consultaArticulo['fecha'] ?></p>
                </div>

            <?php } else {
                echo "<h5> No se encontro el articulo buscado! </h5>";
            } ?>
        </div>

    </div>
</body>

</html>