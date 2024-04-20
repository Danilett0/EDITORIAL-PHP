<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";

if (isset($_POST['nomArt'])) {
    $OperacionesDbController = new OperacionesDbController();
    $nomArt = $_POST['nomArt'];
    $contenidoArt = $_POST['contenidoArt'];
    $periosidadArt = $_POST['periosidadArt'];
    $categoriaArt = $_POST['categoriaArt'];
    $idRev = $_POST['idRev'];

    $datosArt = $OperacionesDbController->crearNuevoArticulo(
        $nomArt,
        $contenidoArt,
        $periosidadArt,
        $categoriaArt,
        $idRev
    );

    if ($datosArt) {
        header("Location: verRevista.php?idRev=$idRev");
    }
}
?>

<!DOCTYPE html>
<html lang="es">

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
                <a href="verRevista.php?idRev=<?= $_GET['idRev'] ?> ">
                    <img class="icon" src="../images/icons/previous.png" alt="previous">
                </a>
            </div>

            <div class="BoxRight">
            </div>
        </div>
    </header>

    <main>
        <form action="nuevoArticulo.php" method="post" class="NuevaRevista">
            <h1>Crear nuevo Articulo</h1>

            <div class="articulo">
                <p>Nombre del articulo</p>
                <input name="nomArt" type="text" required>

                <p>Contenido del articulo</p>
                <textarea name="contenidoArt" required></textarea>

                <p>adjunte una imagen al articulo</p>
                <input name="imagenArt" type="file">

                <div class="colx2">
                    <div>
                        <p>Periosidad</p>
                        <input name="periosidadArt" type="number" required>
                    </div>

                    <div>
                        <p>Categoria del articulo</p>
                        <select name="categoriaArt">
                            <option value="ciencia">ciencia</option>
                            <option value="farandula">farandula</option>
                            <option value="tecnologia">tecnologia</option>
                        </select>
                    </div>
                </div>
                <button type="submit">Finalizar</button>
            </div>
            <input type="hidden" name="idRev" value="<?= $_GET['idRev'] ?> ">
        </form>
    </main>

</body>

</html>