# Laravel Dockerizado

Este proyecto proporciona una estructura básica para iniciar un proyecto de Laravel utilizando contenedores Docker. Incluye servicios preconfigurados para PHP, Composer, NGINX y MySQL.

## Estructura del proyecto

```
.
├── docker-compose.yaml          # Define los servicios y sus relaciones
├── dockerfiles/                 # Contiene Dockerfiles personalizados
│   ├── composer.dockerfile     # Imagen de Composer
│   └── php.dockerfile          # Imagen de PHP con extensiones necesarias
├── env/
│   └── mysql.env               # Variables de entorno para MySQL
├── nginx/
│   └── nginx.conf              # Configuración del servidor NGINX
└── README.md                   # Este archivo
```

## Objetivo

Permitir una forma sencilla y reproducible de levantar entornos de desarrollo para Laravel sin necesidad de instalar dependencias globalmente en tu máquina.

## Uso

1. **Ajusta los Dockerfiles según tus necesidades**
   Puedes modificar los archivos en `dockerfiles/` para cambiar versiones de PHP, agregar extensiones, o personalizar la imagen de Composer.

2. **Construye y levanta los servicios**

   ```bash
   docker compose up -d --build
   ```

3. **Crea un nuevo proyecto de Laravel**
   Una vez levantado el entorno, ejecuta el siguiente comando para generar el esqueleto del proyecto Laravel en el contenedor de Composer:

   ```bash
   docker compose run --rm composer create-project --prefer-dist laravel/laravel .
   ```

4. **Accede a la aplicación**
   Luego de crear el proyecto, Laravel estará disponible en `http://localhost` (o el puerto definido en `docker-compose.yaml`).

## Configuración de MySQL

Para configurar la conexión a la base de datos MySQL, edita el archivo `mysql.env` dentro del directorio `src`. Modifica las siguientes variables:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=secret
```

Asegúrate de que los valores de `DB_USERNAME` y `DB_PASSWORD` coincidan con los definidos en el archivo `env/mysql.env`.

## Comandos de Artisan

Para ejecutar comandos de Artisan, utiliza el siguiente comando:

```bash
docker compose run --rm artisan [comando]
```

Reemplaza `[comando]` con el comando de Artisan que deseas ejecutar (ej. `migrate`, `make:controller`, etc.).

## Comandos de npm

Para ejecutar comandos de npm, primero debes acceder al contenedor `php` o `app` (si tienes uno definido) y luego ejecutar los comandos de npm. Por ejemplo:

```bash
docker compose run --rm npm install
```

## Notas

* Asegúrate de tener Docker y Docker Compose instalados.
* Este proyecto está pensado para desarrollo local. No se recomienda usarlo tal cual en producción sin ajustes de seguridad.
