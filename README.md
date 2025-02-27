# Propósito

Este repositorio es una prueba técnica, se hace uso de modelado de dominio, diseño limpio, persistencia de datos con Doctrine y pruebas automatizadas con PHPUnit.

# Requerimientos

* Git instalado
* Docker instalado
* Docker-compose instalado

# Setup manual

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

Asignar valor a las variables:

Variable | Descripción
---------|------------
MYSQL_HOST| Dirección del servidor de base de datos, este valor se asigna con el nombre del servicio en Docker
MYSQL_DATABASE | Nombre de la base de datos
MYSQL_USER | Usuario de la base de datos
MYSQL_PASSWORD | Password de la base de datos
MYSQL_RANDOM_ROOT_PASSWORD | Asigna una contraseña aleatoria al usuario root del servidor MySQL

* Crear contenedores usando docker-compose

```
docker compose up -d
```
ó
```
docker-compose up -d
```