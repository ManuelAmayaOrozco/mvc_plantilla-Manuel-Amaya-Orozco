<?php

    require_once "./models/tatuadorModel.php";
    require_once "./models/citaModel.php";
    require_once "./models/cita.php";

    class CitaController {

        // NECESITAMOS LOS MODELOS QUE SE USEN
        private $citaModel;
        private $tatuadorModel;

        public function __construct() {
            $this->citaModel = new CitaModel("./database/citas.json");
            $this->tatuadorModel = new TatuadorModel("./database/tatuadores.json");
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

        public function cargarAltaCitaView($error = false) {

            $tatuadores = $this->tatuadorModel->leerTatuadores();

            require_once "./views/AltaCitaView.php";

        }

        public function guardarCita($post_data = null) {

            if (isset($post_data) 
                && $post_data["input_id"] 
                && $post_data["input_descripcion"] 
                && $post_data["input_fecha_cita"] 
                && $post_data["input_cliente"] 
                && $post_data["input_tatuador"]) {

                    // 1º OBTENER TODAS LAS CITAS
                    $citasPresentes = $this->citaModel->leerCitas();

                    // 2º EXTRAER EN VARIABLES
                    $id = $post_data["input_id"];
                    $descripcion = $post_data["input_descripcion"];
                    $fecha_cita = $post_data["input_fecha_cita"];
                    $cliente = $post_data["input_cliente"];
                    $tatuador = $post_data["input_tatuador"];

                    // 3º INSERTAR UNA NUEVA CITA SI ESTÁ LIBRE
                    $citaDisponible = true;
                    foreach ($citasPresentes as $cita) {

                        if ($cita["fecha_cita"] == $fecha_cita && $cita["tatuador"] == $tatuador) {

                            $citaDisponible = false;

                        }

                    }

                    if ($citaDisponible) {

                        $citaNueva = new Cita($id, $descripcion, $fecha_cita, $cliente, $tatuador);
                        $citasPresentes[] = $citaNueva;

                        // 4º INSERTO EN FICHERO
                        $this->citaModel->guardarCitas($citasPresentes);

                        require_once "./views/AltaCitaCorrectaView.php";

                    } else {

                        // ERROR
                        $error = true;
                        $this->cargarAltaCitaView($error);

                    }

            

            }

        }

    }

?>