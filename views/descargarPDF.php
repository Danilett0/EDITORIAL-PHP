<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/librerias/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$idArt = $_GET['idArt'];

$controller = new OperacionesDbController();
$consultaArticulo = $controller->buscarArticuloId($idArt);

if ($consultaArticulo) {
    ob_start();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <main>
            <div class="BodyArticle" style="width: 95%;margin:auto;background:#fafafa;padding:20px">
                <h2 style="text-transform: uppercase;  "><?= $consultaArticulo['nombre'] ?></h2>
                <p class="ContentArticle"><?= $consultaArticulo['contenido'] ?></p>
                <div style="display: flex; flex-direction: row; ">
                    <p>
                        <span style="font-weight: bold;color:#057269"> Categoria </span>
                        <?= $consultaArticulo['categoria'] ?>
                        <span style="font-weight: bold;color:#057269">Periosidad Publicacion </span>
                        <?= $consultaArticulo['periosidad'] ?> dias
                        <span style="font-weight: bold;color:#057269">Fecha Publicacion </span>
                        <?= $consultaArticulo['fecha'] ?>
                    </p>

                </div>
            </div>
        </main>

    </body>

    </html>

    <?php

    $html = ob_get_clean();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();

    $dompdf->stream("articulo.pdf", array("Attachment" => true));
}
?>