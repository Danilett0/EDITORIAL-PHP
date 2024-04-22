<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/models/database.php";

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
        $qNuevaRev = $this->conn->query("SELECT doc_revista, nombre FROM revistas WHERE estado != 'INACTIVO' ");

        $datos = array();
        while ($row = mysqli_fetch_assoc($qNuevaRev)) {
            array_push($datos, $row);
        }
        return $datos;
    }

    public function buscarRevistaId($idRev) {
        $qNuevaRev = $this->conn->query("SELECT * FROM revistas where doc_revista = $idRev ");

        return mysqli_fetch_assoc($qNuevaRev);
    }

    public function buscarArticulos($idRevista) {
        $qArticulos = $this->conn->query("SELECT * FROM articulos WHERE doc_revista = $idRevista AND estado != 'INACTIVO' ");

        $datos = array();
        while ($row = mysqli_fetch_assoc($qArticulos)) {
            array_push($datos, $row);
        }
        return $datos;
    }

    public function buscarArticuloId($idArt) {
        $qArticulos = $this->conn->query("SELECT * FROM articulos WHERE doc_articulo = $idArt AND estado != 'INACTIVO' ");

        return mysqli_fetch_assoc($qArticulos);
    }

    public function actualizarArticulo($idArt, $nomArt, $contArt, $periArt, $catArt) {
        $qUpdate  = "UPDATE articulos ";
        $qUpdate .= "SET nombre='$nomArt', contenido='$contArt', periosidad='$periArt', categoria='$catArt' ";
        $qUpdate .= "WHERE doc_articulo = $idArt";

        return  $this->conn->query($qUpdate);
    }

    public function crearNuevaRevista($nombre) {

        $qInsert = "INSERT INTO revistas(nombre) ";
        $qInsert .= "VALUES ( '$nombre' ) ";

        if ($this->conn->query($qInsert)) {
            return $this->conn->insert_id;
        } else {
            return "error al crear nueva revista";
        }
    }

    public function crearNuevoArticulo($nomArt, $contenidoArt, $periosidadArt, $categoriaArt, $idRevista) {

        $fecha = date('Y-m-d');

        $qInsert = "INSERT INTO articulos (nombre, contenido, periosidad, categoria, fecha, doc_revista, estado) ";
        $qInsert .= "VALUES ( '$nomArt', '$contenidoArt', '$periosidadArt', '$categoriaArt', '$fecha' , $idRevista, 'ACTIVO' ) ";

        if ($this->conn->query($qInsert)) {

            $idArt = $this->conn->insert_id;

            return ['estado' => true, 'idArt' => $idArt];

        } else {
            return "error al crear articulo";
        }
    }

    public function inactivarArticulo($idArt) {

        $qUpdate = "UPDATE articulos SET estado ='INACTIVO' WHERE doc_articulo = $idArt ";

        if ($this->conn->query($qUpdate)) {
            return true;
        } else {
            return "error al inactivar articulo Id. " . $idArt;
        }
    }

    public function inactivarRevista($idRev) {
        $qInactivaRev = "UPDATE revistas SET estado ='INACTIVO' WHERE doc_revista = $idRev ";

        if ($this->conn->query($qInactivaRev)) {
            $qArticulosRel = "SELECT doc_articulo FROM articulos WHERE doc_revista = $idRev ";

            $result = $this->conn->query($qArticulosRel);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $idArt = $row['doc_articulo'];
                    $qDeleteArt = "UPDATE articulos SET estado ='INACTIVO' WHERE  doc_articulo = $idArt ";
                    $this->conn->query($qDeleteArt);
                }
                return true;
            } else {
                return ['success' => true, 'message' => 'no se econtraron articulos relacionados'];
            }
        } else {
            return ['success' => false, 'message' => 'error al inactivar registro'];
        }
    }
}
