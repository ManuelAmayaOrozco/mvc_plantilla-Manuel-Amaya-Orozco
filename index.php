<?php

    /*
    El archivo más importante en un proyecto MVC es el index.php. Todas las peticiones URL que realice el usuario pasarán por este fichero. 
    Toda acción que se ejecute en nuestra aplicación tendrá que llamar al index y este tendrá que cargar el controlador asociado a dicha acción, 
    el modelo y la vista si procede.

    Responsabilidad principal: Es el punto de entrada de la aplicación.
    Detalles:
    - Se encarga de inicializar el entorno de la aplicación, como configurar constantes, cargar librerías e incluir el archivo de 
    autoloading si se utiliza (por ejemplo, con Composer).
    - Maneja la lógica de enrutar las solicitudes al controlador correspondiente.
    - Es minimalista y delega todas las responsabilidades importantes a las capas lógicas del patrón MVC.
    */

    // NECESITAMOS CAPTURAR LA PETICIÓN
    /*
    localhost/mvc_plantilla/landing
    localhost/mvc_plantilla/login
    localhost/mvc_plantilla/register
    localhost/mvc_plantilla/loquesea
    */

    $requestUri = $_SERVER["REQUEST_URI"] ?? "";
    $parseUri = parse_url($requestUri);

    // Como ya sabemos a qué URI quiere acceder el cliente, podemos cargar el Controller asociado
    switch ($parseUri["path"]) {
        case "/mvc_plantilla-Manuel-Amaya-Orozco/usuarios/get":
            require_once "./models/usuariosModel.php";
            $usuariosModel = new UsuariosModel();
            //$usuariosModel->getUsuario(1);
            //$usuariosModel->getUsuario(2);
            //$usuariosModel->getUsuario(3);
            break;
        case "/mvc_plantilla-Manuel-Amaya-Orozco/login":
            require_once "./controllers/loginController.php";
            $loginController = new LoginController();

            $requestMethod = $_SERVER["REQUEST_METHOD"]; // Va a ser GET o POST

            if($requestMethod == "GET") {

                $loginController->showLogin();

            } elseif ($requestMethod == "POST") {

                $datos = $_POST ?? [];

                $loginController->login($datos);

            }

            break;
        case "/mvc_plantilla-Manuel-Amaya-Orozco/landing":
            // Cargamos LandingController
            require_once "./controllers/landingController.php";
            $landingController = new LandingController();
            // LLAMAR AL MÉTODO DE LANDING CONTROLLER RESPONSABLE DE CARGAR LA PÁGINA
            $landingController->cargarVistaLanding();
            break;
        case "/mvc_plantilla-Manuel-Amaya-Orozco/citas/allCitas":
            // Cargamos LandingController
            require_once "./controllers/citaController.php";
            $citaController = new CitaController();
            // LLAMAR AL MÉTODO DE LANDING CONTROLLER RESPONSABLE DE CARGAR LA PÁGINA
            $citaController->cargarListAllCitas();
            break;
        case "/mvc_plantilla-Manuel-Amaya-Orozco/citas":
            $nombre = $_GET["nombre"];
            // Cargamos LandingController
            require_once "./controllers/citaController.php";
            $citaController = new CitaController();
            // LLAMAR AL MÉTODO DE LANDING CONTROLLER RESPONSABLE DE CARGAR LA PÁGINA
            $citaController->cargarListCitasTatuador($nombre);
            break;
        case "/mvc_plantilla-Manuel-Amaya-Orozco/citas/alta":
            // Cargamos LandingController
            require_once "./controllers/citaController.php";
            $citaController = new CitaController();
            // LLAMAR AL MÉTODO DE LANDING CONTROLLER RESPONSABLE DE CARGAR LA PÁGINA

            $requestMethod = $_SERVER["REQUEST_METHOD"] ?? ""; // REQUEST_METHOD nos da GET, POST o... la que venga

            if($requestMethod == "POST") {

                // GUARDAR LA CITA
                $citaController->guardarCita($_POST);

            } elseif ($requestMethod == "GET") {

                // MOSTRAR EL FORM
                $citaController->cargarAltaCitaView();

            } else {

                // MOSTRAR UNA PÁGINA 405 Method Not Allowed (o en este caso 404 por ahora)
                require_once "./controllers/notFoundController.php";
                $notFoundController = new NotFoundController();
                $notFoundController->cargarVista404();
                break;

            }

            break;
        default:
            // CARGAR EL CONTROLLER ASOCIADO A MOSTRAR LA PÁGINA 404
            require_once "./controllers/notFoundController.php";
            $notFoundController = new NotFoundController();
            $notFoundController->cargarVista404();
            break;
    }

?>