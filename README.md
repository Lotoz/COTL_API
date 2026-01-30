# 🐑 Cult of the Lamb API

> ⚠️ Esta API está basada en el videojuego **Cult of the Lamb** y es un proyecto educativo para practicar **Laravel** y **Docker**.

## Readme EN

This is the Spanish version of the README. For the English version, see the file [README.en.md](README.en.md).

## 📚 Descripción

API RESTful completa con autenticación segura mediante **Laravel Sanctum** y gestión integral de usuarios y seguidores.
Construida con **Laravel** y **Docker** para facilitar el desarrollo, prueba y despliegue en cualquier entorno.

## 🚀 Características Principales

- ✅ **Autenticación segura** con Laravel Sanctum
- ✅ **Gestión de usuarios** (registro, login, perfil)
- ✅ **Gestión de seguidores** (crear, listar, actualizar, eliminar)
- ✅ **Validación de datos** en todos los endpoints
- ✅ **Documentación completa** con ejemplos de uso
- ✅ **Containerización con Docker** para fácil despliegue
- ✅ **Base de datos MySQL** con migraciones y seeders

## 🛠️ Stack Tecnológico

| Tecnología | Versión | Descripción |
|-----------|---------|------------- |
| **Laravel** | 11.x | Framework backend |
| **PHP** | 8.3+ | Lenguaje de programación |
| **MySQL** | 8.0 | Base de datos |
| **Docker** | Latest | Contenedorización |
| **Composer** | Latest | Gestor de dependencias PHP |
| **Laravel Sanctum** | - | Autenticación API |

## 📦 Requisitos Previos

- **Docker** - [Descargar](https://www.docker.com/get-started)
- **Docker Compose** - [Instrucciones de instalación](https://docs.docker.com/compose/install/)
- **Git** (opcional pero recomendado)

## 🚀 Instalación Rápida

### Opción 1: Con script automático (Recomendado)

```bash
# Clonar repositorio
git clone <repository-url>
cd COTL_CRUD/cotl_api

# Ejecutar script de setup
chmod +x setup.sh
./setup.sh
```

### Opción 2: Instalación manual

```bash
# Navegar al directorio
cd COTL_CRUD/cotl_api

# Configurar archivo .env
cp .env.example .env

# Construir y levantar contenedores
docker-compose up -d --build

# Instalar dependencias
docker exec -it cotl_api_web composer install

# Generar clave de aplicación
docker exec -it cotl_api_web php artisan key:generate

# Ejecutar migraciones y seeders
docker exec -it cotl_api_web php artisan migrate --seed

# Permisos en Linux (si es necesario)
sudo chown -R $USER:$USER .
```

✅ La aplicación estará disponible en `http://localhost:8000`

## 🔐 Credenciales de Prueba

Después de ejecutar el setup, puedes usar estas credenciales para probar la API:

| Email         | Contraseña  |
|---------------|-------------|
|<lamb@cult.com>| password123 |
|<goat@cult.com>| password123 |

> **Nota:** Puedes crear nuevos usuarios usando el endpoint de registro.

## 📡 Endpoints de la API

### Autenticación

- `POST /api/register` - Registrar nuevo usuario
- `POST /api/login` - Iniciar sesión
- `POST /api/logout` - Cerrar sesión (requiere autenticación)

### Usuarios

- `GET /api/user` - Obtener perfil del usuario autenticado
- `PUT /api/user` - Actualizar perfil (requiere autenticación)

### Seguidores

- `GET /api/followers` - Listar todos los seguidores
- `POST /api/followers` - Crear nuevo seguidor (requiere autenticación)
- `GET /api/followers/{id}` - Obtener un seguidor específico
- `PUT /api/followers/{id}` - Actualizar seguidor (requiere autenticación)
- `DELETE /api/followers/{id}` - Eliminar seguidor (requiere autenticación)

## 🧪 Probando la API

### Herramientas Recomendadas

- [Postman](https://www.postman.com/) - Cliente REST completo
- [Thunder Client](https://www.thunderclient.com/) - Extensión VS Code
- [curl](https://curl.se/) - Línea de comandos

### Usando Thunder Client

Thunder Client es una extensión VS Code que facilita las pruebas de la API. Aquí está el flujo básico:

#### 1. Registrar usuario

- Método: `POST`
- URL: `http://localhost:8000/api/register`
- Headers:

  ```txt
  Content-Type: application/json
  Accept: application/json
  ```

- Body (JSON):

  ```json
   {
      "name": "Lotoz",
      "email": "lotoz@cult.com",
      "password": "password123z",
      "password_confirmation": "password123z"
  }
  ```

#### 2. Iniciar sesión

- Método: `POST`
- URL: `http://localhost:8000/api/login`
- Headers:

  ```
  Content-Type: application/json
  Accept: application/json
  ```

- Body (JSON):

  ```json
  {
    "email": "lamb@cult.com",
    "password": "password123"
  }
  ```

- Respuesta: Recibirás un token de autenticación que debes usar en las siguientes peticiones

#### 3. Usar el token en solicitudes autenticadas

- Headers adicionales en peticiones protegidas:

  ```txt
  Authorization: Bearer {tu_token_aqui}
  ```

Consulta la carpeta `pictures/` para ver capturas de pantalla de Thunder Client con ejemplos reales.

### Importancia del Header Accept

⚠️ **Recuerda incluir siempre el header en tus peticiones:**

```txt
Accept: application/json
```

## 📸 Referencias Visuales

En la carpeta `pictures/` encontrarás ejemplos visuales de las peticiones usando Thunder Client:

- `register.png` - Registro de usuario
- `login.png` - Inicio de sesión
- `create_follower.png` - Crear seguidor
- `ist_followers.png` - Listar seguidores
- `update_follower.png` - Actualizar seguidor
- `delete_follower.png` - Eliminar seguidor

## 📁 Estructura del Proyecto

```txt
cotl_api/
├── app/
│   ├── Http/Controllers/     # Controladores de la API
│   ├── Models/               # Modelos de datos
│   └── Providers/            # Proveedores de aplicación
├── database/
│   ├── migrations/           # Migraciones de base de datos
│   ├── factories/            # Factories para pruebas
│   └── seeders/              # Seeders de datos
├── routes/
│   └── api.php               # Rutas de API
├── config/                   # Archivos de configuración
└── storage/                  # Almacenamiento de aplicación
```

## 🐳 Comandos Docker Útiles

```txt
# Ver logs de contenedores
docker-compose logs -f

# Ejecutar comandos artisan
docker exec -it cotl_api_web php artisan <command>

# Acceder a la shell del contenedor
docker exec -it cotl_api_web bash

# Detener contenedores
docker-compose down

# Reiniciar contenedores
docker-compose restart
```

## 📄 Licencia

Este proyecto está bajo la **Licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más detalles.

---

<div align="center">
  <sub>Desarrollado con ❤️ por <a href="https://github.com/Lotoz">Lotoz</a></sub>
  <br>
  <sub>Basado en el videojuego Cult of the Lamb - Proyecto Educativo</sub>
</div>
