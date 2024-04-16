<?php

class DataBase
{

    private $dbServer = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbDatabase = "editorial";

    public $conn;

    public function conexion() {
        $this->conn = null;

        try {
            $this->conn = mysqli_connect($this->dbServer, $this->dbUser, $this->dbPass, $this->dbDatabase);

            if ($this->conn->connect_error) {
                die("Problemas en la conexion" . $this->conn->error);
            } else {
                echo "";
            }
        } catch (Exception $exception) {
            echo "Error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
