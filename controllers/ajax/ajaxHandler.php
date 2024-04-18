<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";

$OperacionesDbController = new OperacionesDbController();

if (isset($_POST['action'])) {
    $idArt = $_POST['idArt'];
    $result = $OperacionesDbController->inactivarArticulo($idArt);

    header('Content-Type: application/json');
    echo json_encode(array('success' => $result));
}
