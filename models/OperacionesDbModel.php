<?php
require_once "../models/database.php";
require_once "../controllers/OperacionesDbController.php";

class OperacionesDbModel
{
    public $conn = null;

    public function __construct() {
        $database = new DataBase();
        $this->conn = $database->conexion();
    }

    public function buscarUsuarios() {
        $qUsuarios = $this->conn->query("SELECT * FROM usuarios");
        return mysqli_fetch_assoc($qUsuarios);
    }

    public function buscarRevistas() {
        $qNuevaRev = $this->conn->query("SELECT doc_revista, nombre FROM revistas");
        
        $datos = array();
        while($row = mysqli_fetch_assoc($qNuevaRev)){
         array_push($datos, $row);
        }
        return $datos;
    }

    public function buscarArticulos($idRevista) {
        $qArticulos = $this->conn->query("SELECT * FROM articulos WHERE doc_revista = $idRevista ");
        
        $datos = array();
        while($row = mysqli_fetch_assoc($qArticulos)){
         array_push($datos, $row);
        }
        return $datos;
    }


    public function crearNuevaRevista($nombre) {

        $qInsert = "INSERT INTO revistas(nombre) ";
        $qInsert .= "VALUES ( '$nombre' ) ";

        if($this->conn->query($qInsert)){
            return $this->conn->insert_id;
        }else{
            return "error al crear nueva revista";
        }
    }

    public function crearNuevoArticulo($nomArt, $contenidoArt, $periosidadArt, $categoriaArt, $idRevista) {

        $fecha = date('Y-m-d');

        $qInsert = "INSERT INTO articulos (nombre, contenido, periosidad, categoria, fecha, doc_revista) ";
        $qInsert .= "VALUES ( '$nomArt', '$contenidoArt', '$periosidadArt', '$categoriaArt', '$fecha' , $idRevista ) ";

        if ($this->conn->query($qInsert)) {

            $idArt = $this->conn->insert_id;

            return ['estado' => true, 'idArt' => $idArt];

        } else {
            return "error al crear articulo";
        }

    }


}
