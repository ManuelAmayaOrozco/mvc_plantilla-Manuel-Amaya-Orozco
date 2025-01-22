## PLANTILLA PARA MVC

Fork a este repositorio y después lo clonáis.

## EXPLICACIONES RESUMIDAS


# Responsabilidades de Cada Capa en el Patrón MVC

## 1. `index.php`

- **Responsabilidad principal:** Es el punto de entrada de la aplicación.
- **Detalles:**
  - Se encarga de inicializar el entorno de la aplicación, como configurar constantes, cargar librerías e incluir el archivo de autoloading si se utiliza (por ejemplo, con Composer).
  - Maneja la lógica de enrutar las solicitudes al controlador correspondiente.
  - Es minimalista y delega todas las responsabilidades importantes a las capas lógicas del patrón MVC.

```php
// Ejemplo básico de un index.php:
require_once 'autoload.php'; // Carga automática de clases
require_once 'routes.php';   // Define rutas y controladores

// Ruta solicitada
$requestUri = $_SERVER['REQUEST_URI'];
$controller = getControllerFromRoute($requestUri); // función para mapear rutas

// Invoca el controlador
$controller->handleRequest();
```

---

## 2. Capa Modelo

- **Responsabilidad principal:** Gestionar la lógica de negocio y el acceso a los datos.
- **Detalles:**
  - Define la estructura y las reglas de los datos.
  - Se comunica con la base de datos u otras fuentes de datos para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar).
  - Es completamente independiente de las capas de Vista y Controlador.
  - Proporciona datos limpios y preparados para que el Controlador los utilice.

```php
// Ejemplo básico de un Modelo:
class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
```

---

## 3. Capa Vista

- **Responsabilidad principal:** Presentar los datos al usuario.
- **Detalles:**
  - Es responsable de generar la interfaz de usuario (HTML, CSS, JavaScript) utilizando los datos proporcionados por el Controlador.
  - Debe ser lo más simple posible, sin incluir lógica de negocio o acceso a datos.
  - Puede utilizar plantillas para estructurar mejor la presentación de la interfaz.

```php
// Ejemplo básico de una Vista:
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perfil de Usuario</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($user['name']); ?></h1>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
</body>
</html>
```

---

## 4. Capa Controlador

- **Responsabilidad principal:** Actuar como intermediario entre la Vista y el Modelo.
- **Detalles:**
  - Recibe las solicitudes del usuario (a través de `index.php` o de las rutas).
  - Procesa las solicitudes invocando métodos del Modelo para obtener o modificar datos.
  - Prepara los datos que se enviarán a la Vista.
  - Decide qué Vista se renderizará para responder a la solicitud del usuario.

```php
// Ejemplo básico de un Controlador:
class UserController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function showProfile($userId) {
        $user = $this->model->getUserById($userId);
        if ($user) {
            require 'views/user_profile.php';
        } else {
            echo "Usuario no encontrado.";
        }
    }
}
```

---

## Resumen de responsabilidades

| Componente   | Responsabilidad                                                              |
|--------------|------------------------------------------------------------------------------|
| `index.php`  | Punto de entrada, inicializa la aplicación, enruta las solicitudes.          |
| Modelo       | Gestiona la lógica de negocio y el acceso a los datos.                      |
| Vista        | Genera la interfaz de usuario basada en los datos del Controlador.          |
| Controlador  | Conecta la Vista y el Modelo, gestiona la solicitud y prepara los datos.     |

---

Este esquema modular y bien definido permite un código más mantenible y facilita la escalabilidad de la aplicación.
