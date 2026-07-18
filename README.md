# PayPhone CI/CD - TechStore

Proyecto academico de tienda web que integra un boton de pago con PayPhone en modo de pruebas. La practica fue adaptada para evidenciar un flujo DevOps con repositorio Git, pipeline automatico y empaquetado del proyecto para despliegue.

## Tecnologias usadas

- HTML, CSS y JavaScript para la interfaz de tienda.
- PHP para el proxy backend que se comunica con la API de PayPhone.
- GitHub como repositorio de codigo fuente.
- GitHub Actions para integracion continua y despliegue empaquetado.

## Estructura del proyecto

```text
.
├── .github/workflows/ci-cd.yml
├── scripts/validate.php
├── .env.example
├── config.php
├── index.html
├── payphone-proxy.php
└── response.php
```

## Configuracion local

1. Copiar `.env.example` como `.env`.
2. Colocar las credenciales de prueba de PayPhone:

```env
PAYPHONE_TOKEN=token_de_pruebas
PAYPHONE_STORE_ID=store_id_de_pruebas
PAYPHONE_BASE_URL=http://localhost:8080
```

3. Ejecutar el proyecto con PHP:

```bash
php -S localhost:8080
```

4. Abrir en el navegador:

```text
http://localhost:8080
```

## Pipeline CI/CD

El pipeline se encuentra en `.github/workflows/ci-cd.yml` y se ejecuta automaticamente cuando se realiza un push en la rama `main` o `master`.

Etapas implementadas:

- **Checkout:** descarga el codigo del repositorio.
- **Setup PHP:** prepara PHP 8.2 con las extensiones necesarias.
- **Test:** revisa la sintaxis de los archivos PHP y ejecuta una validacion funcional basica.
- **Build:** crea la carpeta `deploy` con los archivos necesarios para publicar el proyecto.
- **Deploy:** sube la carpeta `deploy` como artefacto de GitHub Actions.

## Evidencias para la actividad

- Enlace del repositorio en GitHub.
- Captura del archivo `.github/workflows/ci-cd.yml`.
- Captura de una ejecucion exitosa en la pestana **Actions**.
- Captura del artefacto `techstore-payphone-deploy` generado por el pipeline.
- Capturas del proyecto funcionando localmente con el boton de PayPhone en modo prueba.
- Historial de commits realizados en el repositorio.

## Explicacion tecnica

El proyecto simula una tienda llamada TechStore. El usuario agrega productos al carrito y presiona el boton de PayPhone. El frontend envia la informacion del pedido a `payphone-proxy.php`, que prepara la transaccion usando la API de PayPhone y devuelve la URL oficial de pago. Luego, `response.php` recibe los datos de retorno y confirma el estado de la transaccion con PayPhone.

Para mejorar la practica, las credenciales ya no se escriben directamente en el codigo. Ahora se leen desde variables de entorno mediante `.env`, lo que permite mantener el repositorio limpio y evitar exponer datos sensibles. El pipeline de GitHub Actions valida el codigo y genera un paquete listo para despliegue cada vez que se suben cambios a la rama principal.
