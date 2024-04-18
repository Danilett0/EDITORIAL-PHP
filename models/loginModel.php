<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/models/database.php";
class ValidarSessionModel
{
    private $conn;

    private $userName;
    private $userPassw;


    public function __construct() {
        $database = new DataBase();
        $this->conn = $database->conexion();
    }

    public function validarLogin($username, $password) {
        $this->userName = $username;
        $this->userPassw = $password;
        $result = null;

        $qConsultaUser = "SELECT nombre, num_documento, password FROM usuarios WHERE num_documento = ? ";

        $buscarDoc = $this->conn->prepare($qConsultaUser);
        $buscarDoc->bind_param("s", $this->userName);
        $buscarDoc->execute();

        $resDoc = $buscarDoc->get_result();

        if (mysqli_num_rows($resDoc) > 0) {
            $row = mysqli_fetch_assoc($resDoc);

            $docUser = $row["num_documento"];
            $passUser = $row["password"];

            if ($docUser == $this->userName && $passUser == $this->userPassw) {

                $qCargo = "SELECT cargos.nombre  FROM usuarios ";
                $qCargo .= "INNER JOIN cargos ON usuarios.doc_cargo = cargos.doc_cargo ";
                $qCargo .= "WHERE num_documento = ? ";

                $buscarCargo = $this->conn->prepare($qCargo);
                $buscarCargo->bind_param('s', $docUser);
                $buscarCargo->execute();

                $resCargo = $buscarCargo->get_result();

                $cargoUser = mysqli_fetch_assoc($resCargo);

                $result = true;
                $_SESSION['login'] = $result;
                $_SESSION['userName'] = $row['nombre'];
                $_SESSION['userCargo'] = $cargoUser['nombre'];
            } else {
                $result = false;
            }

        } else {
            $result = false;
        }

        return $result;

    }

}
