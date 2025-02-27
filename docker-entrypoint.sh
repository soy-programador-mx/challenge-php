#!/bin/bash

# Hacer que el script falle en caso de error
set -e

# Verificar si la variable MODE está definida y si su valor es 'dev'
if [ "$MODE" = "dev" ]; then

    echo "Development mode detected. Generating database..."
    doctrine orm:schema-tool:create --force

    echo "Development mode detected. Generating database tables..."
    doctrine orm:schema-tool:update --force
fi

# Ejecutar el comando que se pasó al contenedor
exec "$@"
