<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/models/OperacionesDbModel.php";

class OperacionesDbController
{
    private $operacionesModel = null;

    public function __construct() {
        $this->operacionesModel = new OperacionesDbModel();
    }

    public function buscarUsuarios() {
        return $this->operacionesModel->buscarUsuarios();
    }

    public function buscarRevistas() {
        return $this->operacionesModel->buscarRevistas();
    }

    public function buscarRevistaId($idRev) {
        return $this->operacionesModel->buscarRevistaId($idRev);
    }

    public function buscarArticulos($idRevista) {
        return $this->operacionesModel->buscarArticulos($idRevista);
    }

    public function buscarArticuloId($idArt) {
        return $this->operacionesModel->buscarArticuloId($idArt);
    }

    public function actualizarArticulo($idArt, $nomArt, $contArt, $periArt, $catArt) {
        return $this->operacionesModel->actualizarArticulo($idArt, $nomArt, $contArt, $periArt, $catArt);
    }

    public function crearNuevaRevista($nombre) {

        return $this->operacionesModel->crearNuevaRevista($nombre);
    }

    public function crearNuevoArticulo($nomArt, $contenidoArt, $periosidadArt, $categoriaArt, $idRevista) {

        return $this->operacionesModel->crearNuevoArticulo(
            $nomArt,
            $contenidoArt,
            $periosidadArt,
            $categoriaArt,
            $idRevista
        );
    }

    public function inactivarArticulo($idArt) {
        return $this->operacionesModel->inactivarArticulo($idArt);
    }

    public function inactivarRevista($idRev) {
        return $this->operacionesModel->inactivarRevista($idRev);
    }

}