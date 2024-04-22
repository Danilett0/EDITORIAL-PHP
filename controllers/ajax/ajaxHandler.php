<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/controllers/OperacionesDbController.php";

$OperacionesDbController = new OperacionesDbController();

if (isset($_POST['idArt'])) {
  $idArt = $_POST['idArt'];

  if ($_POST['action'] == 'delete') {
    $result = $OperacionesDbController->inactivarArticulo($idArt);

    header('Content-Type: application/json');
    echo json_encode(array('success' => $result));
  }
}

if (isset($_POST['idRev'])) {
  $idRev = $_POST['idRev'];

  if ($_POST['action'] == 'delete') {
    $result = $OperacionesDbController->inactivarRevista($idRev);

    header('Content-Type: application/json');
    echo json_encode(array('result' => $result));
  }
}
