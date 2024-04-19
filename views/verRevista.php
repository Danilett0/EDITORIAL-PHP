<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";
$idRev = $_GET['idRev'];

session_start();
$resultadoRev = null;

if (!$_SESSION['login']) {
    header('Location: ../index.php');
    exit();
}

$controller = new OperacionesDbController();
$consultaArticulos = $controller->buscarArticulos($idRev);
$consultaRevista = $controller->buscarRevistaId($idRev);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="MensajeBienbenida">
        <p>Hola! <?= $_SESSION['userName'] ?></p>
        <p><?= $_SESSION['userCargo'] ?></p>
    </div>

    <div class="Menu">
    <a class="CreaRevista" href="nuevoArticulo.php?idRev=<?= $idRev ?>">
            <img src="../images/icons/add.png" alt="crear revista">
            <p>Nuevo Articulo</p>
        </a>
        <a href="home.php">
            <img class="Previous" src="../images/icons/previous.png" alt="previous">
        </a>
    </div>

    <div class="listadoArticulos">
        <?php
        if ($consultaArticulos) {
            echo "<b>" . strtoupper($consultaRevista['nombre']) . "</b>, Articulos Relacionados";
            for ($i = 0; $i < count($consultaArticulos); $i++) { ?>

                <div class="ContainerArt Round" data-id="<?= $consultaArticulos[$i]['doc_articulo'] ?>">

                    <a class="BoxArt"
                        href="verArticulo.php?idArt=<?= $consultaArticulos[$i]['doc_articulo'] . "&idRev=" . $_GET['idRev'] ?>">
                        <div>
                            <p><span>Articulo </span><?= $consultaArticulos[$i]['nombre'] ?></p>
                            <p>, Publicado el <?= $consultaArticulos[$i]['fecha'] ?></p>
                        </div>
                    </a>

                    <div>
                        <div class="eliminar" data-id="<?= $consultaArticulos[$i]['doc_articulo'] ?>">
                            <img src="../images/icons/delete.png" alt="delete">
                        </div>
                    </div>

                </div>

            <?php }
        } else {
            echo "<h5> No se encontraron articulos! </h5>";
        } ?>
    </div>

    <script>
        $(document).ready(function () {
            $('.eliminar').click(function () {

                $confirmar = confirm('Esta seguro de eliminar este registro?')

                if ($confirmar) {
                    var idArticulo = $(this).data('id');

                    $.ajax({
                        url: '../controllers/ajax/ajaxHandler.php',
                        type: 'POST',
                        data: {
                            'idArt': idArticulo,
                            'action': 'delete'
                        },
                        success: function (response) {
                            console.log(response);
                            if (response.success) {
                                $('div[data-id="' + idArticulo + '"]').remove();
                            } else {
                                alert('Hubo un error al eliminar el artículo');
                            }
                        }
                    });
                }
            });
        });

    </script>

</body>

</html>