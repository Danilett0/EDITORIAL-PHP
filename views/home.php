<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";

$controller = new OperacionesDbController();
$consultaRevistas = $controller->buscarRevistas();
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

    <header>
        <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/views/encabezadoDatosUser.php";
        ?>

        <div class="MenuNavegacion">
            <div class="BoxLeft">
             
            </div>

            <div class="BoxRight">
                <a class="OptionMenu" href="nuevaRevista.php">
                    <img class="icon" src="../images/icons/add.png" alt="nuevo">
                    <p>Crear Revista</p>
                </a>
            </div>
        </div>
    </header>

    <main>
        <h2 class="BigTitle" >REVISTAS CREADAS</h2>

        <div class="listadoRevistas">
            <?php

            if ($consultaRevistas) {
                for ($i = 0; $i < count($consultaRevistas); $i++) {

                    $articulosEnc = $controller->buscarArticulos($consultaRevistas[$i]['doc_revista']);
                    $nArt = count($articulosEnc) ?>

                    <a class="BoxRevistas" href="verRevista.php?idRev=<?= $consultaRevistas[$i]['doc_revista'] ?>">
                        <div class="CardRevista Round">
                            <h4><?= $consultaRevistas[$i]['nombre'] ?></h4>
                            <p><?= $nArt > 1 ? $nArt . " Articulos" : $nArt . " Articulo" ?> </p>
                        </div>
                    </a>

                <?php }
            } else {
                echo "<h5> No se encontraron revistas creadas </h5>";
            } ?>
        </div>
    </main>

</body>

</html>