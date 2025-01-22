<?php

    class HandleJson {
        private $jsonRoute;

        public function __construct($jsonRoute) {
            $this->jsonRoute = $jsonRoute;
        }

        public function loadFromJson()
        {
            if (file_exists($this->jsonRoute)) {
                $content = file_get_contents($this->jsonRoute);
                return json_decode($content, true) ?? []; // Decodificar JSON o devolver un array vacío
            }
            return []; // Si el archivo no existe, devolver un array vacío
        }

        public function saveToJson($data)
        {
            // Nombre del archivo JSON
            file_put_contents($this->jsonRoute, json_encode($data, JSON_PRETTY_PRINT));
        }


    }


?>