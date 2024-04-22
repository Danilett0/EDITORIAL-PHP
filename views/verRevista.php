<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";
$idRev = $_GET['idRev'];

$resultadoRev = null;

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

  <header>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/views/encabezadoDatosUser.php";
    ?>

    <div class="MenuNavegacion">
      <div class="BoxLeft">
        <a class="OptionMenu" href="home.php">
          <img class="icon" src="../images/icons/previous.png" alt="regresar">
        </a>
      </div>

      <div class="BoxRight">
        <a class="OptionMenu" href="nuevoArticulo.php?idRev=<?= $idRev ?>">
          <img class="icon" src="../images/icons/add.png" alt="nuevo">
          <p>Nuevo Articulo</p>
        </a>
        <a class="OptionMenu eliminarRevista" href="" data-id="<?= $idRev ?>">
          <img class="icon" src="../images/icons/delete.png" alt="eliminar">
          <p>Eliminar Revista</p>
        </a>
      </div>
    </div>
  </header>

  <main>
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
              <div class="eliminarArticulo" data-id="<?= $consultaArticulos[$i]['doc_articulo'] ?>">
                <img src="../images/icons/delete.png" alt="delete">
              </div>
            </div>

          </div>
        <?php }
      } else {
        echo "<h5> No se encontraron articulos! </h5>";
      } ?>
    </div>
  </main>

  <script>
    $(document).ready(function () {

      $('.eliminarArticulo').click(function () {
        $confirmar = confirm('Esta seguro de eliminar este registro?');
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

      $('.eliminarRevista').click(function (e) {
        e.preventDefault();

        $confirmar = confirm('Esta seguro de eliminar este registro?');
        if ($confirmar) {
          var idRev = $(this).data('id');

          $.ajax({
            url: '../controllers/ajax/ajaxHandler.php',
            type: 'POST',
            data: {
              'idRev': idRev,
              'action': 'delete'
            },
            success: function (response) {
              console.log(response);
              if (response.result) {
                window.location.replace('home.php')
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