# Propósito

Este repositorio es una prueba técnica, se hace uso de modelado de dominio, diseño limpio, persistencia de datos con Doctrine y pruebas automatizadas con PHPUnit.

# Requerimientos

* Git instalado
* Docker instalado
* Docker-compose instalado

# Setup

## setup.sh

Puede levantar el proyecto haciendo uso del script ```bin/setup.sh```

* Usadno wget
```
wget https://raw.githubusercontent.com/soy-programador-mx/challenge-php/main/bin/setup.sh -O setup.sh
```

* Usando curl
```
curl -o setup.sh https://raw.githubusercontent.com/soy-programador-mx/challenge-php/main/bin/setup.sh
```

* Dar permisos de ejecución y ejecutar el script

```
chmod +x setup.sh
./setup.sh
```

## Manualmente

Pasos para iniciar el proyecto correctamente:

* Clonar el repositorio:

```
git clone https://github.com/soy-programador-mx/challenge-php.git
```

* Acceder a la carpeta del repositorio

```
cd challenge-php
```

* Generar archivo .env en base al archivo template ```.env.template```.

```
cp .env.template .env
```

* Asignar valor a las variables:

```
vim .env
```

Variable | Descripción
---------|------------
MYSQL_HOST| Dirección del servidor de base de datos, este valor se asigna con el nombre del servicio MySQL del archivo docker-compose.yml
MYSQL_DATABASE | Nombre de la base de datos
MYSQL_USER | Usuario de la base de datos
MYSQL_PASSWORD | Password de la base de datos
MYSQL_RANDOM_ROOT_PASSWORD | Asigna una contraseña aleatoria al usuario root del servidor MySQL
MODE | Valores posibles ```dev``` ó ```production```. En el modo "dev", ejecuta doctrine para crear las tablas automáticamente al generar el contenedor ```app``` mediante el archivo ```docker-entrypoint.sh```

* Crear contenedores usando docker-compose

```
docker compose up -d
```
ó
```
docker-compose up -d
```

# Uso

## Ejecutar  pruebas unitarias

```
docker compose exec app ./vendor/bin/phpunit tests
```

## Creación de usuarios:

```
curl --location 'http://localhost:8089/' \
--form 'name="Jorge123"' \
--form 'email="jorge1@dev.local"' \
--form 'password="Mexico123\!"'
```

## Realizar modificaciones

Si desea realizar modificaciones en vivo, debe descomentar las siguientes líneas del archivo ```docker-compose.yml``` y regenerar el contenedor ```app``` con ```docker compose up -d```

```
    # volumes:
    #   - ./:/var/www/html
```