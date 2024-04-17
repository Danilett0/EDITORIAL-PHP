<?php
include_once "../models/OperacionesDbModel.php";

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

    public function buscarArticulos($idRevista) {
        return $this->operacionesModel->buscarArticulos($idRevista);
    }

    public function crearNuevaRevista($nombre) {

        return $this->operacionesModel->crearNuevaRevista($nombre);
    }

    public function crearNuevoArticulo($nomArt, $contenidoArt, $periosidadArt, $categoriaArt, $idRevista) {

        return $this->operacionesModel->crearNuevoArticulo(
            $nomArt, $contenidoArt, $periosidadArt, $categoriaArt, $idRevista
        );
    }

}