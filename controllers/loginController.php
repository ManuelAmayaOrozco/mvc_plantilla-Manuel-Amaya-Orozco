<?php

    require_once "./models/usuariosModel.php";

    class LoginController {

        private $usuariosModel;

        public function __construct() {
            $this->usuariosModel = new UsuariosModel();
        }

        public function showLogin($errores = []) {
            require_once "./views/loginView.php";

        }

        public function login($datos = []) {

            $input_email = $datos["input_email"] ?? "";
            $input_password = $datos["input_password"] ?? "";

            $errores = [];

            if($input_email == "") {
                $errores["error_email"] = "El campo email es obligatorio";
            }
            
            if($input_password == "") {
                $errores["error_password"] = "El campo password es obligatorio";
            }

            if (!empty($errores)) {

                $this->showLogin($errores);

            } else {

                // REGISTRAMOS LA CITA
                // PARA REGISTRAR LA CITA NECESITAMOS ACCEDER A LA BASE DE DATOS -> NECESITAMOS LLAMAR A UN MÉTODO QUE ACCEDA A LA BASE DE DATOS
                // ¿A QUÉ CLAE LLAMAMOS? -> CitaModel.php
                // ¿A QUÉ MÉTODO DE LA CLASE LLAMAMOS? -> insertCita($datosDeLaCita)
                $operacionExitosa = $this->usuariosModel->login($input_email, $input_password);

                if ($operacionExitosa) {

                    require_once "./views/landingView.php";

                } else {

                    $this->showLogin([$errores]);

                }

            }

        }


    }


?>