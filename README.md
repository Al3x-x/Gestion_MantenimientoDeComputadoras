### Primer paso instalar los requerimientos de moonshine >
    composer require moonshine/moonshine

/// Segundo paso configurar el .env con las credenciales de la base de datos y el email

### Tercer paso migrar las tablas a la base de datos
    php artisan migrate

### Cuarto paso crear un Super Admin
    php artisan moonshine-rbac:user
