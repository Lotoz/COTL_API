#!/bin/bash

# Colores para la terminal
GREEN='\033[0;32m'
NC='\033[0m' # No Color

echo -e "${GREEN} Iniciando la configuración del Culto (COTL API)...${NC}"

# Preparar el entorno
if [ ! -f .env ]; then
    cp .env.example .env
    echo "${GREEN} Archivo .env creado desde el ejemplo."
fi

# Levantar Docker
docker compose up -d
echo "${GREEN} Contenedores levantados en segundo plano."

# Comandos internos de Laravel
echo "Instalando dependencias y generando claves..."
docker exec -it cotl_api_web composer install
docker exec -it cotl_api_web php artisan key:generate
docker exec -it cotl_api_web php artisan migrate --seed

# Ajuste de permisos (Solo para Linux)
if [[ "$OSTYPE" == "linux-gnu"* ]]; then
    echo "Detectado Linux: Ajustando permisos de archivos..."
    sudo chown -R $USER:$USER .
fi

echo -e "${GREEN} ¡Listo! Accede a: http://localhost:8000${NC}"
echo "Recuerda usar: Accept: application/json en tus peticiones."