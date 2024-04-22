<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";
$errorDatos = null;

if (isset($_GET['idArt'])) {
    $idArt = $_GET['idArt'];

    $controller = new OperacionesDbController();
    $consultaArticulo = $controller->buscarArticuloId($idArt);
    $cAr = $consultaArticulo['categoria'];
} else {
    $errorDatos = true;
}

if (isset($_POST['nomArt'])) {
    $controller = new OperacionesDbController();

    $idArt = $_POST['idArt'];
    $nomArt = $_POST['nomArt'];
    $contArt = $_POST['contenidoArt'];
    $periArt = $_POST['periosidadArt'];
    $catArt = $_POST['categoriaArt'];

    $consultaArticulo = $controller->actualizarArticulo($idArt,$nomArt,$contArt,$periArt,$catArt);

    if($consultaArticulo){
        $consultaArticulo = $controller->buscarArticuloId($idArt);
        $idRev = $consultaArticulo['doc_revista'];
        header("location: verArticulo.php?idArt=".trim($idArt)."&idRev=".trim($idRev));
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Articulo</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>

    <main>
        <?php
        if ($errorDatos) {
            echo "Ops! Ocurrio un error al consultar los datos del articulo!, idArt undefined ";
        } else { ?>
            <form action="editarArticulo.php" method="post" class="NuevaRevista">

                <div class="articulo">
                    <p>Nombre del articulo</p>
                    <input name="nomArt" type="text" value="<?= $consultaArticulo['nombre'] ?>" required>

                    <p>Contenido del articulo</p>
                    <textarea name="contenidoArt" rows="15" required><?= $consultaArticulo['contenido'] ?></textarea>

                    <p>adjunte una imagen al articulo</p>
                    <input name="imagenArt" type="file">

                    <div class="colx2">
                        <div>
                            <p>Periosidad</p>
                            <input name="periosidadArt" type="number" value="<?= $consultaArticulo['periosidad'] ?>"
                                required>
                        </div>

                        <div>
                            <p>Categoria del articulo</p>
                            <select name="categoriaArt">
                                <option value="ciencia" <?= ($cAr == 'ciencia') ? 'selected' : '' ?>>ciencia</option>
                                <option value="farandula" <?= ($cAr == 'farandula') ? 'selected' : '' ?>>farandula</option>
                                <option value="tecnologia" <?= ($cAr == 'tecnologia') ? 'selected' : '' ?>>tecnologia</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit">Finalizar</button>
                </div>
                <input type="hidden" name="idArt" value="<?= $_GET['idArt'] ?> ">
            </form>
        <?php }
        ?>

    </main>

</body>

</html>