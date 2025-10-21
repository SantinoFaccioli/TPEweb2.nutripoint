## Integrantes del grupo

- Merlina López — merlilopez72@gmail.com
- Santino Faccioli Vanini — santino.faccioli@gmail.com
##descripción del trabajo:
El sitio web *NutriPoint* permite a los usuarios visualizar los productos de la dietética de manera pública.  
Los visitantes pueden explorar los productos organizados por categorías (Sin TACC, Veganos, Harinas, Lácteos, Frutos secos, etc.), ver precios, stock y descripción de cada producto.

El acceso administrativo está reservado a los usuarios con rol de administrador, quienes pueden crear, modificar o eliminar tanto categorías como productos.  

## Modelo de datos
A continuación se muestra el Diagrama Entidad-Relación (DER) de nuestra base de datos:

![DER de NutriPoint](DER_nutripoint.png)

## El script SQL que genera la base de datos se encuentra en el archivo `db_nutripoint.sql`.

El modelo de datos se compone de dos entidades principales:

**Categoría**  
- Representa los distintos grupos de productos de la dietética (ej: Sin TACC, Veganos, Harinas, Lácteos, Frutos secos).  
- Clave primaria: `id_categoria` (PK).

**Producto**  
- Almacena la información de cada producto: nombre, precio, stock y descripción.  
- Clave primaria: `id_producto` (PK).  
- Clave foránea: `id_categoria` (FK), que lo vincula con una categoría.

**Relación**  
- Una Categoría puede contener muchos Productos (1 → N).  
- Un Producto pertenece únicamente a una Categoría.

Este diseño asegura que cada producto esté correctamente organizado dentro de una categoría, garantizando consistencia y facilidad en las consultas.
 ## Despliegue e Instalación (TPE 2)

Para desplegar el sitio en un servidor local (como XAMPP con Apache y MySQL), seguí estos pasos:

1.  **Clonar o descargar** este repositorio en la carpeta `htdocs` de tu instalación de XAMPP.
2.  **Iniciar los servicios** de Apache y MySQL.
3.  **Abrir phpMyAdmin**
4.  **Crear una nueva base de datos.** El nombre debe coincidir con el definido en el archivo `config.php` (por defecto: `db_nutripoint`).
5.  **Importar** el script `db_nutripoint.sql` (incluido en este repositorio) dentro de la base de datos que acabás de crear. Esto generará las tablas y relaciones.
6.  **Verificar el archivo `config.php`:** Asegurate de que `DB_USER` y `DB_PASS` coincidan con tu configuración local de MySQL.
7.  **Acceder al sitio** desde tu navegador, por ejemplo: `http://localhost/NUTRIPOINT/`.

---

## Acceso de Administrador

El sitio cuenta con un panel de administración protegido para gestionar el ABM de productos y categorías.

-   **URL de Login:** `http://localhost/NUTRIPOINT/login`
-   **Usuario:** `webadmin`
-   **Contraseña:** `admin`

---