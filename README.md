# 🛒 Ecommerce Laravel Shop System

Sistema de ecommerce completo desarrollado con **Laravel 12**, que incluye panel administrativo con **AdminLTE 4**, carrito de compras, gestión de usuarios con roles y permisos, y funcionalidades avanzadas para tiendas online modernas.

## 📋 Tabla de Contenido

- [Características](#-características)
- [Tecnologías](#-tecnologías)
- [Requisitos](#-requisitos)
- [Instalación](#-instalación)
- [Uso](#-uso)

- [Despliegue](#-despliegue)
- [Contribución](#-contribución)
- [Licencia](#-licencia)

## ⭐ Características

### 🏪 **Frontend de Tienda**
- ✅ Catálogo de productos con búsqueda y filtros avanzados
- ✅ Carrito de compras con persistencia de sesión
- ✅ Sistema de pedidos con seguimiento de estado
- ✅ Interfaz responsive y moderna
- ✅ Paginación optimizada para grandes volúmenes de datos

### 🔐 **Autenticación y Autorización**
- ✅ Sistema de login/registro de usuarios
- ✅ Recuperación de contraseñas por email
- ✅ Gestión de perfiles de usuario
- ✅ Roles y permisos configurables con **Laravel Permission**
- ✅ Middleware personalizado para protección de rutas

### 🎛️ **Panel Administrativo**
- ✅ Dashboard con métricas y estadísticas
- ✅ CRUD completo de productos, usuarios y pedidos
- ✅ Gestión de roles y permisos
- ✅ Interfaz AdminLTE 4 responsive
- ✅ Activación/desactivación de registros
- ✅ Búsqueda y filtrado en tiempo real

### 🛠️ **Desarrollo y Arquitectura**
- ✅ Arquitectura MVC limpia y escalable
- ✅ Migraciones y seeders para base de datos
- ✅ Model Factories para testing
- ✅ Eloquent ORM con relaciones optimizadas
- ✅ Query Builder para consultas complejas
- ✅ Validación de formularios con FormRequest
- ✅ Blade templates con herencia y componentes

## 🚀 Tecnologías

- **Backend**: Laravel 12, PHP 8.1+
- **Base de Datos**: MySQL 8.0+
- **Frontend**: Bootstrap 5, AdminLTE 4
- **Autenticación**: Laravel Sanctum
- **Permisos**: spatie/laravel-permission
- **Despliegue**: Compatible con cPanel y hosting compartido

## 📋 Requisitos

- **PHP** >= 8.2
- **Composer** >= 2.0
- **MySQL** >= 8.0
- **Node.js** >= 16 (para assets)
- **Git**

## 💻 Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/ecommerce-laravel-shop-system.git
cd ecommerce-laravel-shop-system
```

### 2. Instalar dependencias
```bash
composer install
npm install
```

### 3. Configurar entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar base de datos
Edita el archivo `.env` con tus credenciales de base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_laravel
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
```

### 6. Compilar assets (cuando esté implementado)
```bash
npm run build
```

### 7. Iniciar servidor de desarrollo
```bash
php artisan serve
```

🎉 **¡Listo!** Tu aplicación estará disponible en `http://localhost:8000`

## 🎯 Uso

*Las funcionalidades se desarrollarán progresivamente durante el curso siguiendo las mejores prácticas de Laravel*

## 🚀 Despliegue

### Hosting Compartido con cPanel
1. **Subir archivos**: Sube todos los archivos excepto la carpeta `public` a tu directorio raíz
2. **Configurar public**: Mueve el contenido de `public/` a `public_html/`
3. **Actualizar paths**: Modifica `public_html/index.php` para apuntar a las rutas correctas
4. **Configurar .env**: Ajusta las variables de entorno para producción
5. **Optimizar**: Ejecuta comandos de optimización

```bash
# Comandos de optimización para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

### Variables de Entorno para Producción
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com

# Configuración de base de datos de producción
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=tu_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=contraseña_segura
```

## 🤝 Contribución

¡Las contribuciones son bienvenidas! Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -m 'Add: nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

⭐ **¿Te ha gustado el proyecto? ¡Dale una estrella!** ⭐

Desarrollado con ❤️ usando Laravel 12 por Hector Gonzalez 
