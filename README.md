# 🛒 Ecommerce Laravel Shop System

Sistema de ecommerce completo desarrollado con **Laravel 12**, que incluye panel administrativo con **AdminLTE 4**, carrito de compras, gestión de usuarios con roles y permisos, y funcionalidades típicas de tiendas online modernas.

## 📋 Tabla de Contenido

- [Características](#-características)
- [Tecnologías](#-tecnologías)
- [Requisitos](#-requisitos)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
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
- ✅ Sistema de login/registro con autenticación web tradicional
- ✅ Sesiones clásicas de Laravel (`Auth::attempt`, cookies, middleware `auth`)
- ✅ Recuperación de contraseñas por email
- ✅ Gestión de perfiles de usuario
- ✅ Roles y permisos configurables con **Laravel Permission** usando RBAC (Role-Based Access Control)
- ✅ Middleware personalizado para protección de rutas

### 🎛️ **Panel Administrativo**
- ✅ Dashboard de bienvenida, con mensajes de errores de acceso, en caso de no tener los permisos necesarios
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
- ✅ Validación de formularios con FormRequest personalizadas
- ✅ Blade templates con herencia y componentes
- ✅ Configuración de base de datos con charset utf8mb4 y collation utf8mb4_spanish_ci
- ✅ Gestión de archivos con nombres únicos y organización por carpetas

## 🚀 Tecnologías

- **Backend**: Laravel 12, PHP 8.2+
- **Base de Datos**: MySQL 8.0+
- **Frontend**: Bootstrap 5, AdminLTE 4
- **Autenticación**: Sesiones clásicas de Laravel (Auth::attempt, cookies, middleware auth)
- **Permisos**: spatie/laravel-permission (RBAC)
- **Despliegue**: Compatible con cPanel y hosting compartido

## 📋 Requisitos

- **PHP** >= 8.2
- **Composer** >= 2.0
- **MySQL** >= 8.0 o **PostgreSQL** >= 12
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
DB_DATABASE=dbsistema
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

**Configuración de Base de Datos**: El proyecto usa `utf8mb4` y `utf8mb4_spanish_ci` en `config/database.php` para soporte completo de caracteres Unicode (emojis, acentos españoles, caracteres especiales asiáticos, etc.)

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

## ⚙️ Configuración

### Usuarios por Defecto
*Los usuarios y roles se configurarán durante el desarrollo del curso*

**Usuarios de prueba disponibles después de ejecutar seeders:**
- **Admin**: admin@prueba.com | Contraseña: admin123456
- **Cliente**: cliente@prueba.com | Contraseña: cliente123456

### Configuración de Email (Gmail SMTP)
Para funcionalidades de recuperación de contraseñas y notificaciones, configura Gmail SMTP en `.env`:
```env
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_correo@gmail.com
MAIL_PASSWORD=tu_contraseña_de_aplicacion
MAIL_FROM_ADDRESS="tu_correo@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Importante**: Para usar Gmail SMTP necesitas generar una "Contraseña de aplicación" siguiendo esta [guía oficial de Google](https://support.google.com/mail/answer/185833?hl=es-419&authuser=4).

### Validación de Formularios
El sistema utiliza **FormRequest personalizadas** para validación robusta:

**ProductoRequest**: Validación de productos con reglas específicas
- Código único por producto (permite edición del mismo)
- Validación de imágenes (jpg, jpeg, png, máximo 2MB)
- Imagen obligatoria al crear, opcional al editar
- Mensajes de error personalizados en español

**UserRequest**: Validación de usuarios con lógica condicional
- Email único ignorando usuario actual al editar
- Contraseña obligatoria solo al crear usuarios
- Validación dinámica según método HTTP (POST/PUT/PATCH)

### Gestión de Archivos
Los productos incluyen manejo inteligente de imágenes:
- **Nombres únicos**: Prefijo aleatorio + nombre original para evitar duplicados
- **Organización**: Imágenes guardadas en `public/uploads/productos/`
- **Optimización**: Eliminación automática de imágenes anteriores al actualizar
- **Validación**: Solo archivos jpg, jpeg, png hasta 2MB

## 🎯 Uso

### Sistema de Roles y Permisos (RBAC)
El sistema implementa un modelo de control de acceso basado en roles con dos roles principales:

**👨‍💼 Administrador (admin@prueba.com)**
- Gestión completa de usuarios (crear, editar, eliminar, activar/desactivar)
- Administración de roles y permisos
- CRUD completo de productos
- Gestión de pedidos (listar, anular)

**🛒 Cliente (cliente@prueba.com)**
- Ver y cancelar sus propios pedidos
- Gestionar perfil personal
- Realizar compras en la tienda

### Funcionalidades Principales
- **Ruta principal (/)**: Catálogo de la tienda online
- **Autenticación**: Login/registro con recuperación de contraseña por email
- **Carrito de compras**: Agregar, modificar cantidades, eliminar productos
- **Panel de usuario**: Gestión de pedidos y perfil personal
- **Panel administrativo**: Control total del sistema (solo admin)

### Comandos de optimización
```env
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

### Estándares de Código
- Seguir las convenciones de Laravel
- Documentar cambios importantes
- Usar commits descriptivos

## 📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

## 📞 Soporte

- **Documentación**: [Wiki del proyecto](../../wiki)
- **Issues**: [Reportar problemas](../../issues)
- **Discussions**: [Foro de la comunidad](../../discussions)

---

⭐ **¿Te ha gustado el proyecto? ¡Dale una estrella!** ⭐

Desarrollado con ❤️ usando Laravel 12
