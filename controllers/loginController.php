<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/editorial/models/loginModel.php";


class ValidarLoginController
{
    private $sessionModel;

    public function __construct() {
        $this->sessionModel = new ValidarSessionModel();
    }
    public function validarInicioSession($username, $password) {

        return $this->sessionModel->validarLogin($username, $password);
    }

}
