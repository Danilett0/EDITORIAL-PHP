<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";

$idArt = $_GET['idArt'];

$controller = new OperacionesDbController();
$consultaArticulo = $controller->buscarArticuloId($idArt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Articulo</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>

    <header>
        <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/views/encabezadoDatosUser.php";
        ?>

        <div class="MenuNavegacion">
            <div class="BoxLeft">
                <a class="OptionMenu" href="verRevista.php?idRev=<?= $_GET['idRev'] ?>">
                    <img class="icon" src="../images/icons/previous.png" alt="regresar">
                </a>
            </div>

            <div class="BoxRight">
                <a class="OptionMenu" href="editarArticulo.php?idArt=<?= $idArt ?>">
                    <img class="icon" src="../images/icons/edit.png" alt="editar">
                    <p>Editar Articulo</p>
                </a>
                <a class="OptionMenu" href="descargarPDF.php?idArt=<?= $idArt ?>">
                    <img class="icon" src="../images/icons/download.png" alt="Descagar">
                    <p>Descagar Articulo</p>
                </a>
            </div>
        </div>
    </header>

    <main>
        <?php
        if ($consultaArticulo) { ?>
            <div class="BodyArticle">
                <h2 class=""><?= $consultaArticulo['nombre'] ?></h2>
                <p class="ContentArticle"><?= $consultaArticulo['contenido'] ?></p>
                <div class="InfoArticle">
                    <p><span> Categoria </span><?= $consultaArticulo['categoria'] ?></p>
                    <p><span> Periosidad Publicacion </span><?= $consultaArticulo['periosidad'] ?> dias</p>
                    <p><span> Fecha Publicacion </span><?= $consultaArticulo['fecha'] ?></p>
                </div>
            </div>
            <?php
        } else {
            echo "<h5> No se encontro el articulo buscado! </h5>";
        } ?>


    </main>



    </div>
</body>

</html>