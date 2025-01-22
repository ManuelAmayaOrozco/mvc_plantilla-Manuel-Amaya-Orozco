<?php

    require_once "./models/citaModel.php";

    class CitaController {

        // NECESITAMOS LOS MODELOS QUE SE USEN
        private $citaModel;

        public function __construct() {
            $this->citaModel = new CitaModel("./database/citas.json");
        }

        public function cargarListAllCitas() {

            // 1º OBTENER TODAS LAS CITAS
            // PARA OBTENER TODAS LAS CITAS, USO CITAMODEL->EL MÉTODO leerCitas()
            $citas = $this->citaModel->leerCitas();

            // 2º CARGAMOS LA VISTA
            require_once "./views/listaCitasView.php";

        }

        public function cargarListCitasTatuador($nombre) {

            // 1º OBTENER TODAS LAS CITAS DEL TATUADOR
            // PARA OBTENER TODAS LAS CITAS DEL TATUADOR, USO CITAMODEL->EL MÉTODO leerCitas()
            $citas = $this->citaModel->leerCitas();

            // DESPUÉS SOLO COGEMOS LAS CITAS DEL TATUADOR ESPECÍFICO
            $citastat = [];

            foreach ($citas as $cita) {

                if ($cita["tatuador"] == $nombre) {

                    $citastat[] = $cita;

                }

            }

            // 2º CARGAMOS LA VISTA
            require_once "./views/listaCitasTatuadorView.php";

        }

    }

?>