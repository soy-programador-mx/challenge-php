#!/bin/bash

# Definir colores para mensajes
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # Sin color

# Función para verificar si un comando está disponible
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Validar que los comandos necesarios estén instalados
echo -e "${GREEN}Verificando dependencias...${NC}"

if ! command_exists git; then
    echo -e "${RED}Error: git no está instalado. Instálalo antes de continuar.${NC}"
    exit 1
fi

if ! command_exists docker; then
    echo -e "${RED}Error: docker no está instalado. Instálalo antes de continuar.${NC}"
    exit 1
fi

if ! command_exists docker-compose && ! docker compose version >/dev/null 2>&1; then
    echo -e "${RED}Error: docker-compose no está instalado. Instálalo antes de continuar.${NC}"
    exit 1
fi

echo -e "${GREEN}Todas las dependencias están instaladas. Continuando...${NC}"

# Clonar el repositorio
echo -e "${GREEN}Clonando el repositorio...${NC}"
git clone https://github.com/soy-programador-mx/challenge-php.git
cd challenge-php || { echo -e "${RED}Error: No se pudo acceder al directorio challenge-php${NC}"; exit 1; }

echo -e "${GREEN}Generando archivo .env...${NC}"
cp .env.template .env

# Solicitar variables al usuario
echo -e "${GREEN}Configurando variables de entorno...${NC}"
read -p "Ingrese la dirección del servidor MySQL (ej. mysql_service): " MYSQL_HOST
read -p "Ingrese el nombre de la base de datos: " MYSQL_DATABASE
read -p "Ingrese el usuario de la base de datos: " MYSQL_USER
read -sp "Ingrese la contraseña de la base de datos: " MYSQL_PASSWORD
echo
read -p "¿Desea asignar una contraseña aleatoria al usuario root? (yes/no): " RANDOM_ROOT
read -p "Modo de ejecución (dev/production): " MODE

# Configurar el archivo .env con los valores proporcionados
sed -i "s/^MYSQL_HOST=.*/MYSQL_HOST=$MYSQL_HOST/" .env
sed -i "s/^MYSQL_DATABASE=.*/MYSQL_DATABASE=$MYSQL_DATABASE/" .env
sed -i "s/^MYSQL_USER=.*/MYSQL_USER=$MYSQL_USER/" .env
sed -i "s/^MYSQL_PASSWORD=.*/MYSQL_PASSWORD=$MYSQL_PASSWORD/" .env
sed -i "s/^MYSQL_RANDOM_ROOT_PASSWORD=.*/MYSQL_RANDOM_ROOT_PASSWORD=$RANDOM_ROOT/" .env
sed -i "s/^MODE=.*/MODE=$MODE/" .env

echo -e "${GREEN}Iniciando contenedores con Docker...${NC}"
docker compose up -d

# Esperar unos segundos para asegurar que los servicios estén listos
echo -e "${GREEN}Esperando a que los contenedores se inicien...${NC}"
sleep 5

# Ejecutar pruebas unitarias
echo -e "${GREEN}Ejecutando pruebas unitarias...${NC}"
docker compose exec app ./vendor/bin/phpunit tests

echo -e "${GREEN}¡Proceso completado exitosamente!${NC}"
