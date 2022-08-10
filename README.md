## Antes de descargar

Se recomienda utilizar nodejs versión 16.16.0 y php 8.0.2 para evitar problemas al instalar el proyecto.

## Instrucciones

1. Bajar el proyecto mediante git o descargando el zip
2. Ejecutar ``composer install`` para instalar el vendor
3. Ejecutar ``npm install`` para instalar el node_modules
4. Configurar el .env
5. Ejecutar ``php artisan migrate`` y ``php artisan db:seed`` para ejecutar migraciones y seembrados
6. Iniciar el proyecto con ``php artisan serve`` y en otra terminal correr el siguiente comando ``npm run dev``
7. Por defecto se visualizará en localhost:8000

![image](https://user-images.githubusercontent.com/77127962/184013716-f0a599e6-853f-4962-b1fd-75619bebed92.png)
