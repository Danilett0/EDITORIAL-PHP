<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";
$operacionesRevista = new OperacionesDbController();

if (isset($_POST['nomRev'])) {
    $idRevista = $operacionesRevista->crearNuevaRevista($_POST['nomRev']);

    if ($idRevista) {
        $nomArt = $_POST['nomArt'];
        $contenidoArt = $_POST['contenidoArt'];
        $periosidadArt = $_POST['periosidadArt'];
        $categoriaArt = $_POST['categoriaArt'];

        $datosArt = $operacionesRevista->crearNuevoArticulo(
            $nomArt,
            $contenidoArt,
            $periosidadArt,
            $categoriaArt,
            $idRevista
        );

        if ($datosArt) {
            header('Location: home.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Revista</title>
    <link rel="stylesheet" href="../css/main.css">
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

            </div>
        </div>
    </header>

    <main>
        <form action="nuevaRevista.php" method="post" class="NuevaRevista">

            <h2 class="BigTitle" >Crear nueva revista</h1>

            <div class="revista">
                <input name="nomRev" type="text" placeholder="Nombre Revista" required>
            </div>
            
            <br>
            <i>Nota: la revista debe contener al menos un articulo para ser creada</i>

            <div class="articulo">

                <p>Nombre del articulo</p>
                <input name="nomArt" type="text" required>

                <p>Contenido del articulo</p>
                <textarea name="contenidoArt" rows="15"  required></textarea>

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
        </form>
    </main>



</body>

</html>