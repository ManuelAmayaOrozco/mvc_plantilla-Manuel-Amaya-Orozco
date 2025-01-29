<?php

require_once './database/DBHandler.php';

class UsuariosModel {

    private $dbHandler;

    private $conexion;

    private $tabla = "usuarios";

    public function __construct() {
    
        $this->dbHandler = new DBHandler("localhost", "root", "", "tattoos_bd", "3306");

    }

    public function getUsuario($idUsuario) {

        $this->conexion = $this->dbHandler->conectar();

        $sql = "SELECT * FROM $this->tabla WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("i", $idUsuario);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {

            $usuarios[] = $fila;

        }

        print_r($usuarios);

    }

    public function login($email, $password) {

        $this->conexion = $this->dbHandler->conectar();

        $sql = "SELECT email, password FROM $this->tabla WHERE email = ? AND password = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("ss", $email, $password);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {

            $usuarios[] = $fila;

        }

        if (!empty($usuarios)) {
            return true;
        } else {
            return false;
        }

    }

    public function insertUsuario($email, $password) {

        $this->conexion = $this->dbHandler->conectar();

        $sql = "INSERT INTO $this->tabla (email, password) VALUES (?,?)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("ss", $email, $password);

        $stmt->execute();
        
    }

}

?>