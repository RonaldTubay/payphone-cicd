# Guia rapida para subir este proyecto a GitHub

Abre una terminal dentro de esta carpeta:

```text
C:\Users\ASUS A15\RAPITAXI_TESIS\Integracion-de-plataformas\techstore
```

Ejecuta estos comandos:

```bash
git init
git branch -M main
git remote remove origin
git remote add origin https://github.com/RonaldTubay/payphone-cicd.git
git add .
git commit -m "Implementa proyecto PayPhone con pipeline CI/CD"
git push -u origin main --force-with-lease
```

Si `git remote remove origin` muestra un error porque no existe un remoto anterior, continua con el siguiente comando.

Se usa `--force-with-lease` porque el repositorio remoto ya tiene un primer commit con README. En este caso reemplaza ese contenido inicial por el proyecto completo sin mezclar historiales.

## Despues de subir

1. Entra al repositorio en GitHub.
2. Abre la pestana **Actions**.
3. Verifica que se ejecute el workflow **CI/CD PayPhone TechStore**.
4. Cuando termine en verde, abre la ejecucion y revisa el artefacto **techstore-payphone-deploy**.
5. Toma capturas del repositorio, workflow, ejecucion exitosa y artefacto.

## Para ejecutar localmente

Crea un archivo `.env` copiando `.env.example` y coloca las credenciales de prueba de PayPhone.

Luego ejecuta:

```bash
php -S localhost:8080
```

Abre:

```text
http://localhost:8080
```
