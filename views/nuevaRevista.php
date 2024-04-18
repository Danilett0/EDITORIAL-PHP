<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";

if (!$_SESSION['login']) {
    header('Location: ../index.php');
    exit();
}

$operacionesRevista = new OperacionesDbController();

if(isset($_POST['nomRev'])){

    $idRevista = $operacionesRevista->crearNuevaRevista($_POST['nomRev']);

    if ($idRevista){
        $nomArt = $_POST['nomArt'];
        $contenidoArt = $_POST['contenidoArt'];
        $periosidadArt = $_POST['periosidadArt'];
        $categoriaArt = $_POST['categoriaArt'];

        $datosArt = $operacionesRevista->crearNuevoArticulo(
            $nomArt, $contenidoArt, $periosidadArt, $categoriaArt, $idRevista
        );

        if($datosArt){
            header('Location: home.php');
        }
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Revista</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>

    <h1>Crear nueva revista</h1>

    <form action="nuevaRevista.php" method="post" class="NuevaRevista">

        <div class="revista">
            <h5>Ingrese el nombre de la revista</h5>
            <input name="nomRev" type="text" required>
        </div>
        <br>
        <i>Nota: la revista debe contener al menos un articulo para ser creada</i>
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


    </form>

</body>

</html>
