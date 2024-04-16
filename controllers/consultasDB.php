<?php

error_reporting(0);
include_once "../models/database.php";
include_once "./models/database.php";

class MainController
{
    private $conn;

    private $userName;
    private $userPassw;

    // constructor para realizar la conexion con la base de datos
    public function __construct() {
        $database = new DataBase();
        $db = $database->conexion();

        $this->conn = $db;
    }

    public function buscarUsuarios() {
        return $this->conn->query("SELECT * FROM usuarios");
    }


    public function validarLogin($user = '', $pass = '') {
        session_start();
        $this->userName = $user;
        $this->userPassw = $pass;
        $result = null;

        $buscarDoc = $this->conn->query("SELECT *  FROM usuarios WHERE num_documento = '$user' ");

        if (mysqli_num_rows($buscarDoc) > 0) {

            $row = mysqli_fetch_assoc($buscarDoc);

            $docUser = $row["num_documento"];
            $passUser = $row["password"];

            if ($docUser == $this->userName && $passUser == $this->userPassw) {
                $result = true;
                $_SESSION['login'] = $result;
            } else {
                $result = false;
            }

        }

        return $result;

    }

}