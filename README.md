# TechStore - Pago con PayPhone

TechStore es una tienda web sencilla que permite simular compras con integracion de PayPhone en modo de pruebas. El usuario puede agregar productos al carrito, revisar el total y continuar al flujo de pago mediante el boton de PayPhone.

## Tecnologias

- HTML, CSS y JavaScript para la interfaz de la tienda.
- PHP para el proxy backend que se comunica con la API de PayPhone.
- GitHub Actions para validar y empaquetar el proyecto automaticamente.

## Archivos principales

```text
.github/workflows/ci-cd.yml
scripts/validate.php
.env.example
config.php
index.html
payphone-proxy.php
response.php
```

## Configuracion

Copia el archivo `.env.example` y renombra la copia como `.env`.

```env
PAYPHONE_TOKEN=token_de_pruebas
PAYPHONE_STORE_ID=store_id_de_pruebas
PAYPHONE_BASE_URL=http://localhost:8080
```

El archivo `.env` contiene credenciales locales y no debe subirse al repositorio.

## Ejecucion local

Desde la carpeta del proyecto ejecuta:

```bash
php -S localhost:8080
```

Luego abre en el navegador:

```text
http://localhost:8080
```

## Flujo de pago

1. El usuario selecciona productos en `index.html`.
2. El carrito calcula subtotal, IVA y total.
3. Al presionar el boton de PayPhone, el frontend envia la compra a `payphone-proxy.php`.
4. El proxy prepara la transaccion usando la API de PayPhone.
5. PayPhone redirige al usuario a `response.php`.
6. `response.php` confirma el estado de la transaccion y muestra el resultado.

## CI/CD

El pipeline se encuentra en `.github/workflows/ci-cd.yml`. Se ejecuta automaticamente cuando se suben cambios a la rama `main` o `master`.

El flujo realiza:

- Revision de sintaxis PHP.
- Validacion basica del proyecto con `scripts/validate.php`.
- Creacion de una carpeta `deploy`.
- Publicacion del paquete como artefacto de GitHub Actions.

El artefacto generado se llama:

```text
techstore-payphone-deploy
```
