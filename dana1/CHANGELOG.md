# Changelog

## [1.0.1] - 22-04-2025
### Cambios en contacto.php
Cambios realizados:
- Se sanitizaron los datos de entrada del formulario utilizando `filter_input` para validar y limpiar los datos ingresados.
- Se implementó el uso de `htmlspecialchars` para escapar los datos antes de usarlos en el cuerpo del correo, protegiendo contra ataques XSS.
- Se añadió validación en el cliente con JavaScript para mejorar la experiencia del usuario y prevenir el envío de formularios incompletos.
- Se mejoró la validación en el servidor para asegurar que todos los campos requeridos estén presentes y sean válidos antes de procesar el formulario.
- Se añadió manejo de errores HTTP con códigos de respuesta (`http_response_code`) para indicar errores en el procesamiento.

### Explicación adicional:
- **Sanitización de datos**: Se utilizó `filter_input` para limpiar y validar los datos ingresados, como el nombre, correo electrónico, asunto y mensaje.
- **Protección contra XSS**: `htmlspecialchars` se usó para escapar los datos antes de incluirlos en el cuerpo del correo, evitando la inyección de scripts maliciosos.
- **Validación en el cliente**: Se agregó un script de JavaScript para validar los campos del formulario antes de enviarlo, mejorando la experiencia del usuario.
- **Validación en el servidor**: Se asegura que todos los campos estén completos y sean válidos antes de enviar el correo.
- **Manejo de errores HTTP**: Se implementaron códigos de respuesta HTTP (`400` y `500`) para indicar errores en la validación o en el envío del correo.

## [1.0.2] - 22-04-2025
### Cambios en index.php
Cambios realizados:
- Se implementó el uso de `htmlspecialchars` para escapar cualquier texto dinámico en el HTML, protegiendo contra ataques XSS.
- Se revisaron los atributos `alt` de las imágenes y el texto visible para asegurarse de que estén correctamente escapados.
- Se añadieron medidas preventivas para manejar datos dinámicos en el futuro de forma segura.
- Se reforzaron las buenas prácticas de seguridad en el código, aunque el archivo no interactúa directamente con datos de entrada del usuario ni con la base de datos.

### Explicación adicional:
- **Protección contra XSS**: Se usó `htmlspecialchars` para escapar cualquier texto dinámico que pudiera ser introducido en el futuro, previniendo inyecciones de scripts maliciosos.
- **Buenas prácticas**: Aunque este archivo no interactúa con datos de entrada ni realiza consultas SQL, se preparó para manejar datos dinámicos de forma segura en el futuro.
- **Validación de formularios**: Se dejó preparado para agregar validaciones en el cliente y servidor si se incluyen formularios en el futuro.
- **Seguridad en la base de datos**: Aunque este archivo no interactúa con la base de datos, se recomienda usar usuarios con privilegios limitados en otros archivos que sí lo hagan.

---

## [1.0.3] - 22-04-2025
### Cambios en login.php
Cambios realizados:
- Se implementó el uso de consultas preparadas (`prepare` y `bind_param`) para evitar inyecciones SQL.
- Se sanitizaron los datos de entrada del formulario utilizando `filter_input` para validar y limpiar los datos ingresados.
- Se añadió la verificación de contraseñas utilizando `password_verify` para garantizar la seguridad de las credenciales.
- Se escaparon los datos dinámicos almacenados en la sesión con `htmlspecialchars` para prevenir ataques XSS.
- Se mejoró la validación de los campos del formulario para asegurar que todos los datos requeridos estén presentes y sean válidos antes de procesar la solicitud.

### Explicación adicional:
- **Protección contra Inyección SQL**: Se usaron consultas preparadas para evitar que datos maliciosos se mezclen con las consultas SQL.
- **Sanitización de Entradas**: Se utilizó `filter_input` para validar y limpiar los datos ingresados por el usuario.
- **Contraseñas Hasheadas**: Se utilizó `password_verify` para comparar la contraseña ingresada con el hash almacenado en la base de datos.
- **Protección contra XSS**: Se escaparon los datos dinámicos antes de almacenarlos en la sesión para evitar inyecciones de scripts maliciosos.
- **Validación de Formularios**: Se validaron los campos del formulario para evitar datos incompletos o maliciosos.

---

## [1.0.4] - 22-04-2025
### Cambios en registro.php
Cambios realizados:
- Se simplificó el código para registrar únicamente `nombre`, `email` y `password` en la tabla `usuarios`.
- Se configuraron valores predeterminados en la base de datos para las columnas adicionales (`rol`, `tonkens`, `insignias`, `perfil_publico`, `valoracion`), permitiendo que se ignoren en la consulta SQL.
- Se utilizó `password_hash` para almacenar las contraseñas de forma segura.
- Se implementaron consultas preparadas (`prepare` y `bind_param`) para evitar inyecciones SQL.
- Se añadieron mensajes claros para informar al usuario sobre el éxito o fallo del registro.

### Explicación adicional:
- **Simplicidad**: El código ahora solo registra los campos esenciales (`nombre`, `email`, `password`), dejando que las columnas adicionales usen valores predeterminados configurados en la base de datos.
- **Protección contra Inyección SQL**: Se usaron consultas preparadas para evitar que datos maliciosos se mezclen con las consultas SQL.
- **Contraseñas Hasheadas**: Se utilizó `password_hash` para almacenar las contraseñas de forma segura, protegiendo los datos de los usuarios en caso de una brecha de seguridad.
- **Manejo de Errores**: Se añadieron mensajes claros para informar al usuario si ocurre un error durante el proceso de registro.
- **Seguridad Mejorada**: Se validaron y sanitizaron los datos de entrada utilizando `filter_input` para evitar datos maliciosos.

---

## [1.0.5] - 22-04-2025
### Cambios en quienes_somos.php
Cambios realizados:
- Se implementó el uso de `htmlspecialchars` para escapar cualquier texto dinámico en el HTML, protegiendo contra ataques XSS.
- Se revisaron los textos estáticos para asegurarse de que estén correctamente escapados y preparados para futuras modificaciones.
- Se mantuvo el código limpio y preparado para manejar datos dinámicos en el futuro.

### Explicación adicional:
- **Protección contra XSS**: Se usó `htmlspecialchars` para escapar cualquier texto dinámico que pudiera ser introducido en el futuro, previniendo inyecciones de scripts maliciosos.
- **Preparación para Datos Dinámicos**: Aunque actualmente el contenido es estático, el uso de `htmlspecialchars` asegura que el archivo esté protegido si en el futuro se cargan datos desde la base de datos o se reciben entradas del usuario.
- **Buenas Prácticas**: Se mantuvo el código limpio y seguro, siguiendo las mejores prácticas de desarrollo.

---

## [1.0.6] - 22-04-2025
### Cambios en dashboard.php
Cambios realizados:
- Se añadió un panel de administración con estadísticas clave:
  - Total de usuarios.
  - Total de productos.
  - Total de pedidos.
  - Tonkens totales distribuidos.
- Se mejoró el diseño del panel utilizando clases de Bootstrap para un estilo más profesional y responsivo.
- Se corrigieron las rutas de inclusión para garantizar que los archivos CSS y JS se carguen correctamente desde cualquier subdirectorio.
- Se implementaron rutas absolutas para los enlaces de navegación.

### Explicación adicional:
- **Estadísticas clave**: Se implementaron consultas SQL para obtener datos importantes como el total de usuarios, productos, pedidos y tonkens distribuidos.
- **Diseño**: Se utilizó Bootstrap para crear un diseño limpio y responsivo, asegurando que el panel sea fácil de usar en dispositivos móviles y de escritorio.
- **Compatibilidad**: Se corrigieron las rutas para que funcionen correctamente desde cualquier subdirectorio.

---

### Cambios en pedidos.php, productos.php y usuarios.php
Cambios realizados:
- Se añadieron funcionalidades completas para:
  - Crear, editar y eliminar registros.
  - Validar los datos de entrada en el servidor utilizando `filter_input` y consultas preparadas (`prepare` y `bind_param`) para evitar inyecciones SQL.
  - Mostrar mensajes claros de éxito o error al realizar operaciones.
- Se mejoró la visualización de los datos en tablas utilizando Bootstrap para un diseño limpio.
- Se implementaron rutas absolutas para garantizar que los enlaces y recursos se carguen correctamente desde cualquier ubicación.

### Explicación adicional:
- **CRUD completo**: Se añadieron funcionalidades para gestionar registros en las tablas correspondientes.
- **Validación de datos**: Se validaron y sanitizaron los datos de entrada para evitar inyecciones SQL y proteger la base de datos.
- **Mensajes claros**: Se añadieron mensajes de éxito o error para informar al usuario sobre el resultado de las operaciones.
- **Diseño mejorado**: Se utilizó Bootstrap para mejorar la apariencia de las tablas y formularios.

---

### Cambios en header.php
Cambios realizados:
- Se corrigieron las rutas de los archivos CSS y JS para que sean absolutas, asegurando que funcionen correctamente desde cualquier subdirectorio.
- Se añadió soporte para rutas absolutas dinámicas utilizando una variable `$base_url`.
- Se mejoró la estructura del encabezado con clases de Bootstrap para un diseño más responsivo y moderno.
- Se añadieron enlaces adicionales como "Registro" y "Login".

### Explicación adicional:
- **Rutas absolutas**: Se corrigieron las rutas de los archivos CSS, JS y enlaces de navegación para que funcionen correctamente desde cualquier subdirectorio.
- **Diseño mejorado**: Se utilizó Bootstrap para mejorar la apariencia del encabezado y hacerlo más responsivo.
- **Portabilidad**: Las rutas absolutas aseguran que el proyecto funcione correctamente sin importar desde dónde se incluyan los archivos.

---

### Cambios en login.php
Cambios realizados:
- Se implementó la validación de credenciales utilizando `password_verify` para comparar contraseñas hasheadas.
- Se añadieron mensajes claros para informar al usuario si las credenciales son incorrectas.
- Se escaparon los datos dinámicos almacenados en la sesión con `htmlspecialchars` para prevenir ataques XSS.
- Se mejoró la validación de los campos del formulario para asegurar que todos los datos requeridos estén presentes y sean válidos antes de procesar la solicitud.

### Explicación adicional:
- **Seguridad mejorada**: Se implementó `password_verify` para comparar contraseñas hasheadas, asegurando que las credenciales sean seguras.
- **Protección contra XSS**: Se escaparon los datos dinámicos almacenados en la sesión para prevenir inyecciones de scripts maliciosos.
- **Validación robusta**: Se validaron los campos del formulario para evitar datos incompletos o maliciosos.

---

### Cambios en style.css
Cambios realizados:
- Se añadió un diseño para las tablas, formularios y botones en las páginas de administración.
- Se mejoró la visualización del encabezado y la navegación con estilos personalizados.
- Se añadieron estilos para mensajes de éxito y error, mejorando la experiencia del usuario.

### Explicación adicional:
- **Estilo profesional**: Se añadieron estilos personalizados para tablas, formularios y botones, mejorando la experiencia visual en las páginas de administración.
- **Mensajes de usuario**: Se añadieron estilos para mensajes de éxito y error, haciendo que sean más visibles y claros.
- **Diseño responsivo**: Se utilizó Bootstrap junto con estilos personalizados para garantizar que las páginas sean fáciles de usar en dispositivos móviles y de escritorio.

---

## [1.0.7] - 23-04-2025
### Cambios en dashboard.php
Cambios realizados:
- **Se añadieron gráficos interactivos (charts)** para visualizar las estadísticas:
  - Gráfico de barras para mostrar el número de pedidos por categoría.
  - Gráfico de dona para mostrar el total de tonkens distribuidos.
- Se corrigieron las rutas de inclusión para garantizar que los archivos CSS y JS se carguen correctamente desde cualquier subdirectorio.
- Se implementaron rutas absolutas para los enlaces de navegación.

### Explicación adicional:
- **Gráficos interactivos**: Se implementaron gráficos utilizando la librería Chart.js para visualizar las estadísticas de manera más clara y atractiva.
  - **Gráfico de barras**: Muestra el número de pedidos por categoría.
  - **Gráfico de dona**: Representa el total de tonkens distribuidos.
- **Compatibilidad**: Se corrigieron las rutas para que funcionen correctamente desde cualquier subdirectorio.

---

### Cambios en header.php
Cambios realizados:
- Se añadieron enlaces adicionales como "Perfil" y "Cerrar Sesión" para usuarios logueados.
- Se añadió lógica para mostrar "Login" y "Registro" cuando no hay una sesión activa.

---

### Cambios en login.php
Cambios realizados:
- Se añadió lógica para redirigir a diferentes páginas según el rol del usuario:
  - Administrador: `admin/dashboard.php`.
  - Voluntario: `productos/index.php`.
  - Cliente: `index.php`.

### Explicación adicional:
- **Redirección por rol**: Se añadió lógica para redirigir a diferentes áreas según el rol del usuario.

---

### Cambios en editar.php
Cambios realizados:
- Se añadió la funcionalidad para que los usuarios puedan editar su nombre, correo electrónico y teléfono.
- Se añadió un campo opcional para cambiar la contraseña.
- Se implementó la validación y sanitización de los datos enviados por el usuario.
- Se añadió un mensaje de éxito o error después de guardar los cambios.
- Se actualizó la sesión del usuario con los nuevos datos después de realizar cambios.

### Explicación adicional:
- **Gestión de datos personales**: Los usuarios ahora pueden editar su información personal, incluyendo la contraseña.
- **Validación y sanitización**: Se validaron y limpiaron los datos enviados por el usuario para evitar datos maliciosos.
- **Mensajes claros**: Se añadieron mensajes de éxito o error para informar al usuario sobre el resultado de la operación.

---

### Cambios en perfil.php
Cambios realizados:
- Se añadió la funcionalidad para mostrar las opciones del perfil según el rol del usuario:
  - Administrador: Acceso al panel de administración.
  - Voluntario: Gestión de productos.
  - Cliente: Acceso al carrito y pedidos.
- Se añadió un botón para editar el perfil.
- Se añadió un formulario para solicitar la cancelación de la cuenta.
- Se corrigió la ruta del carrito para que apunte a `carrito/index.php`.

### Explicación adicional:
- **Opciones por rol**: Se añadieron opciones específicas para cada rol de usuario, mejorando la experiencia del usuario.
- **Gestión del perfil**: Los usuarios pueden editar su perfil o solicitar la cancelación de su cuenta.
- **Corrección de rutas**: Se corrigió la ruta del carrito para que funcione correctamente.

---

### Cambios en logout.php
Cambios realizados:
- Se implementó la funcionalidad para destruir la sesión del usuario y redirigirlo a la página principal (`index.php`).

### Explicación adicional:
- **Cierre de sesión seguro**: Se destruyó la sesión del usuario para garantizar que no pueda acceder a áreas restringidas después de cerrar sesión.
- **Redirección**: Se redirigió al usuario a la página principal después de cerrar sesión.

---

## [1.0.8] - 23-04-2025
### Cambios en dashboard.php
Cambios realizados:
- Se implementó la sanitización de datos dinámicos utilizados en los gráficos para proteger contra ataques XSS.
- Se añadieron validaciones de sesión para garantizar que solo los administradores puedan acceder al panel.
- Se mejoró la estructura del código para garantizar consultas SQL seguras utilizando consultas preparadas.

### Explicación adicional:
- **Protección contra XSS**: Se sanitizaron los datos dinámicos utilizados en los gráficos para evitar inyecciones de scripts maliciosos.
- **Validación de sesión**: Se añadió una verificación para garantizar que solo los administradores puedan acceder al panel.
- **Consultas seguras**: Se usaron consultas preparadas para evitar inyecciones SQL.

---

### Cambios en editar.php
Cambios realizados:
- Se implementó la validación de sesión para garantizar que solo los usuarios autenticados puedan acceder a la página.
- Se añadieron validaciones y sanitización de los datos enviados por el formulario.
- Se mejoró el manejo de errores para mostrar mensajes claros al usuario.
- Se protegieron los datos dinámicos mostrados en el formulario contra ataques XSS.
- Se añadió la funcionalidad para actualizar el nombre y correo electrónico del usuario de forma segura.

### Explicación adicional:
- **Validación de sesión**: Solo los usuarios autenticados pueden acceder a la página.
- **Sanitización de datos**: Se validaron y limpiaron los datos enviados por el usuario para evitar datos maliciosos.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en el formulario para evitar inyecciones de scripts maliciosos.
- **Manejo de errores**: Se añadieron mensajes claros para informar al usuario sobre el resultado de la operación.

---

### Cambios en perfil.php
Cambios realizados:
- Se implementó la validación de sesión para garantizar que solo los usuarios autenticados puedan acceder a la página.
- Se añadieron opciones específicas según el rol del usuario:
  - Administrador: Acceso al panel de administración.
  - Voluntario: Gestión de productos.
  - Cliente: Acceso al carrito y pedidos.
- Se protegieron los datos dinámicos mostrados en la página contra ataques XSS.
- Se añadió un formulario para solicitar la cancelación de la cuenta con confirmación.

### Explicación adicional:
- **Validación de sesión**: Solo los usuarios autenticados pueden acceder a la página.
- **Opciones por rol**: Se añadieron opciones específicas para cada rol de usuario, mejorando la experiencia del usuario.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en la página para evitar inyecciones de scripts maliciosos.
- **Gestión del perfil**: Los usuarios pueden editar su perfil o solicitar la cancelación de su cuenta.

---

### Cambios en logout.php
Cambios realizados:
- Se implementó la funcionalidad para destruir la sesión del usuario y redirigirlo a la página principal (`index.php`).
- Se mejoró la seguridad del cierre de sesión para garantizar que no se pueda acceder a áreas restringidas después de cerrar sesión.

### Explicación adicional:
- **Cierre de sesión seguro**: Se destruyó la sesión del usuario para garantizar que no pueda acceder a áreas restringidas después de cerrar sesión.
- **Redirección**: Se redirigió al usuario a la página principal después de cerrar sesión.

---

### Cambios generales
Cambios realizados:
- Se mejoró la seguridad general del proyecto mediante la implementación de consultas preparadas en todas las interacciones con la base de datos.
- Se añadieron validaciones de sesión en todas las páginas restringidas para garantizar que solo los usuarios autorizados puedan acceder.
- Se implementó la sanitización de todos los datos dinámicos mostrados en las páginas para proteger contra ataques XSS.
- Se mejoró el manejo de errores para mostrar mensajes claros y útiles al usuario.

### Explicación adicional:
- **Consultas preparadas**: Se usaron consultas preparadas en todas las interacciones con la base de datos para evitar inyecciones SQL.
- **Validación de sesión**: Se añadió una verificación de sesión en todas las páginas restringidas para garantizar la seguridad del sistema.
- **Protección contra XSS**: Se escaparon todos los datos dinámicos mostrados en las páginas para evitar inyecciones de scripts maliciosos.
- **Manejo de errores**: Se añadieron mensajes claros para informar al usuario sobre el resultado de las operaciones.

---

## [1.0.9] - 25-04-2025
### Cambios en productos/index.php
Cambios realizados:
- Se añadió un botón "Ver Detalle" en la tabla de productos para acceder a la página de detalles de cada producto.
- Se incluyeron las columnas `categoría` y `stock` en la tabla de productos para mostrar información adicional.
- Se sanitizaron los datos dinámicos mostrados en la tabla para proteger contra ataques XSS.
- Se implementaron consultas preparadas para obtener los datos de los productos de forma segura.

### Explicación adicional:
- **Botón "Ver Detalle"**: Permite acceder a la página de detalles de un producto específico.
- **Columnas adicionales**: Se añadieron las columnas `categoría` y `stock` para mostrar más información sobre los productos.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en la tabla para evitar inyecciones de scripts maliciosos.
- **Consultas seguras**: Se usaron consultas preparadas para evitar inyecciones SQL.

---

### Cambios en productos/editar.php
Cambios realizados:
- Se implementó la funcionalidad para editar los datos de un producto, incluyendo `nombre`, `descripción`, `precio_tonkens`, `categoría` y `stock`.
- Se validaron y sanitizaron los datos enviados por el formulario para evitar datos maliciosos.
- Se protegieron los datos dinámicos mostrados en el formulario contra ataques XSS.
- Se añadieron mensajes claros para informar al usuario sobre el éxito o fallo de la operación.
- Se implementaron consultas preparadas para actualizar los datos del producto de forma segura.

### Explicación adicional:
- **Edición de productos**: Los usuarios pueden editar todos los campos del producto de forma segura.
- **Validación y sanitización**: Se validaron y limpiaron los datos enviados por el usuario para evitar datos maliciosos.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en el formulario para evitar inyecciones de scripts maliciosos.
- **Mensajes claros**: Se añadieron mensajes para informar al usuario sobre el resultado de la operación.
- **Consultas seguras**: Se usaron consultas preparadas para proteger la base de datos contra inyecciones SQL.

---

### Cambios en productos/detalle.php
Cambios realizados:
- Se implementó la funcionalidad para mostrar los detalles de un producto específico, incluyendo `nombre`, `descripción`, `precio_tonkens`, `categoría` y `stock`.
- Se validó el ID del producto recibido en la URL para garantizar que sea un número entero válido.
- Se protegieron los datos dinámicos mostrados en la página contra ataques XSS.
- Se implementaron consultas preparadas para obtener los datos del producto de forma segura.

### Explicación adicional:
- **Visualización de detalles**: Los usuarios pueden ver todos los detalles de un producto específico.
- **Validación del ID**: Se validó el ID recibido en la URL para evitar accesos no autorizados o datos maliciosos.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en la página para evitar inyecciones de scripts maliciosos.
- **Consultas seguras**: Se usaron consultas preparadas para proteger la base de datos contra inyecciones SQL.

---

### Cambios en productos/agregar.php
Cambios realizados:
- Se implementó la funcionalidad para agregar nuevos productos, incluyendo `nombre`, `descripción`, `precio_tonkens`, `categoría` y `stock`.
- Se validaron y sanitizaron los datos enviados por el formulario para evitar datos maliciosos.
- Se protegieron los datos dinámicos mostrados en los mensajes de éxito o error contra ataques XSS.
- Se añadieron mensajes claros para informar al usuario sobre el éxito o fallo de la operación.
- Se implementaron consultas preparadas para insertar los datos del producto de forma segura.

### Explicación adicional:
- **Agregar productos**: Los usuarios pueden agregar nuevos productos con todos los campos requeridos.
- **Validación y sanitización**: Se validaron y limpiaron los datos enviados por el usuario para evitar datos maliciosos.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en los mensajes para evitar inyecciones de scripts maliciosos.
- **Mensajes claros**: Se añadieron mensajes para informar al usuario sobre el resultado de la operación.
- **Consultas seguras**: Se usaron consultas preparadas para proteger la base de datos contra inyecciones SQL.

---

## [1.1.0] - 25-04-2025

### Cambios en productos/index.php
Cambios realizados:
- Se añadió un botón "Añadir al Carrito" que abre un modal para seleccionar la cantidad antes de añadir el producto al carrito.
- Se implementó la validación en el cliente para garantizar que la cantidad seleccionada no supere el stock disponible.
- Se sanitizaron los datos dinámicos mostrados en la tabla para proteger contra ataques XSS.
- Se implementaron consultas preparadas para obtener los datos de los productos de forma segura.

### Explicación adicional:
- **Botón "Añadir al Carrito"**: Mejora la experiencia del usuario al permitir seleccionar la cantidad directamente desde un modal.
- **Validación de stock**: Garantiza que no se puedan añadir cantidades mayores al stock disponible.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en la tabla para evitar inyecciones de scripts maliciosos.
- **Consultas seguras**: Se usaron consultas preparadas para proteger la base de datos contra inyecciones SQL.

---

### Cambios en header.php
Cambios realizados:
- Se añadieron enlaces dinámicos según el rol del usuario:
  - Administrador: Acceso al panel de administración.
  - Voluntario: Acceso directo a productos.
  - Cliente: Acceso al carrito y productos.
- Se añadió un enlace para cerrar sesión de forma segura.
- Se sanitizaron los datos dinámicos mostrados en el encabezado para proteger contra ataques XSS.

### Explicación adicional:
- **Enlaces dinámicos**: Mejora la experiencia del usuario al mostrar opciones relevantes según su rol.
- **Cierre de sesión seguro**: Garantiza que el usuario no pueda acceder a áreas restringidas después de cerrar sesión.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en el encabezado para evitar inyecciones de scripts maliciosos.

---

### Cambios en carrito/index.php
Cambios realizados:
- Se validaron los datos del carrito para garantizar que los IDs de los productos y las cantidades sean válidos.
- Se sanitizaron los datos dinámicos mostrados en la tabla para proteger contra ataques XSS.
- Se añadieron mensajes claros para informar al usuario si el carrito está vacío o si ocurre un problema.
- Se implementaron consultas preparadas para obtener los datos de los productos de forma segura.

### Explicación adicional:
- **Validación de datos**: Garantiza que los datos del carrito sean válidos antes de procesarlos.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en la tabla para evitar inyecciones de scripts maliciosos.
- **Mensajes claros**: Se añadieron mensajes para informar al usuario sobre el estado del carrito.
- **Consultas seguras**: Se usaron consultas preparadas para proteger la base de datos contra inyecciones SQL.

---

### Cambios en carrito/checkout.php
Cambios realizados:
- Se añadió validación para garantizar que el usuario tenga suficientes "tonkens" y que haya suficiente stock para cada producto antes de procesar la compra.
- Se implementaron transacciones SQL para garantizar que todas las operaciones (registro del pedido, actualización del stock, etc.) se realicen de manera atómica.
- Se sanitizaron los datos dinámicos mostrados en los mensajes para proteger contra ataques XSS.
- Se añadieron mensajes claros para informar al usuario si ocurre un problema durante el proceso de compra.

### Explicación adicional:
- **Validación de tonkens y stock**: Garantiza que el usuario no pueda realizar una compra si no tiene suficientes "tonkens" o si no hay suficiente stock.
- **Transacciones SQL**: Asegura que todas las operaciones relacionadas con la compra se realicen de manera segura y consistente.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en los mensajes para evitar inyecciones de scripts maliciosos.
- **Mensajes claros**: Se añadieron mensajes para informar al usuario sobre el estado de la compra.

---

### Cambios en carrito/eliminar.php
Cambios realizados:
- Se validó que el ID del producto recibido sea un número entero válido antes de procesarlo.
- Se sanitizaron los datos dinámicos mostrados en los mensajes para proteger contra ataques XSS.
- Se añadieron mensajes claros para informar al usuario si el producto fue eliminado o si no estaba en el carrito.
- Se registraron intentos de acceso no autorizado y errores en el log del servidor.

### Explicación adicional:
- **Validación del ID del producto**: Garantiza que solo se procesen IDs válidos.
- **Protección contra XSS**: Se escaparon los datos dinámicos mostrados en los mensajes para evitar inyecciones de scripts maliciosos.
- **Mensajes claros**: Se añadieron mensajes para informar al usuario sobre el estado de la operación.
- **Registro de errores**: Facilita la depuración al registrar intentos de acceso no autorizado y errores en el log del servidor.

---
