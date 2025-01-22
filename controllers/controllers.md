## Capa Controlador

- **Responsabilidad principal:** Actuar como intermediario entre la Vista y el Modelo.
- **Detalles:**
  - Recibe las solicitudes del usuario (a través de `index.php` o de las rutas).
  - Procesa las solicitudes invocando métodos del Modelo para obtener o modificar datos.
  - Prepara los datos que se enviarán a la Vista.
  - Decide qué Vista se renderizará para responder a la solicitud del usuario.