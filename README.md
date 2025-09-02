# AM ToDo — API (Laravel)

API REST para gestionar tareas de un ToDo simple. Forma parte de un stack desacoplado **Laravel (API) + React (SPA)**.

> 🔗 Frontend (SPA): https://github.com/AtilioModenutti/am-todo-web

---

## ✨ Características
- Endpoints CRUD de tareas (`/api/tasks`)
- Filtro opcional por `user_id` (`GET /api/tasks?user_id=1`)
- Seeds con datos de ejemplo
- CORS configurado para desarrollo con Vite
- Estructura simple para extender (auth con Sanctum, roles, tests, etc.)

## 🧱 Stack
- PHP 8.2+ · Laravel 11
- MySQL/MariaDB
- Composer

## 🧩 Arquitectura (alto nivel)
```
React (Vite)  ⇄  Axios  ⇄  Laravel API  ⇄  MySQL
```

---

## 🚀 Quick start

```bash
# 1) Clonar e instalar
git clone https://github.com/AtilioModenutti/am-todo-api.git
cd am-todo-api
cp .env.example .env
composer install
php artisan key:generate

# 2) Configurar base de datos en .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 3) Migrar + seed
php artisan migrate --seed

# 4) Levantar
php artisan serve
# -> http://127.0.0.1:8000
```

> ✅ Verificá el endpoint en el navegador: `http://127.0.0.1:8000/api/tasks`

---

## 🔌 Endpoints

| Método | Ruta                    | Descripción                         |
|------:|--------------------------|-------------------------------------|
|   GET | `/api/tasks`             | Lista todas las tareas              |
|   GET | `/api/tasks?user_id=1`   | Lista filtrando por `user_id`       |
|  POST | `/api/tasks`             | Crea una tarea                      |
| PATCH | `/api/tasks/{id}`        | Actualiza título / estado `done`    |
| DELETE| `/api/tasks/{id}`        | Elimina una tarea                   |

**Ejemplo (crear):**
```json
POST /api/tasks
{
  "user_id": 1,
  "title": "Conectar front y back",
  "done": false
}
```

**Ejemplo (actualizar):**
```json
PATCH /api/tasks/3
{
  "done": true
}
```

---

## 🗄️ Esquema de datos
**Tabla `tasks`**
- `id` (PK)
- `user_id` (int) — opcionalmente FK si existe tabla `users`
- `title` (string, 255)
- `done` (boolean, default: false)
- `created_at`, `updated_at`

> **Seed de ejemplo:** 3 tareas iniciales con `user_id = 1`.

---

## 🗂️ Archivos relevantes
```
app/Models/Task.php
app/Http/Controllers/TaskController.php
database/migrations/*_create_tasks_table.php
database/seeders/TaskSeeder.php
routes/api.php
config/cors.php
bootstrap/app.php
```

**`bootstrap/app.php`** (Laravel 11) — asegurate de registrar las rutas:
```php
->withRouting(
  web: __DIR__.'/../routes/web.php',
  api: __DIR__.'/../routes/api.php',
  commands: __DIR__.'/../routes/console.php',
  health: '/up',
)
```

---

## 🌐 CORS (dev con Vite)

`config/cors.php`:
```php
'paths' => ['api/*'],
'allowed_methods' => ['*'],
'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173'],
'allowed_headers' => ['*'],
'supports_credentials' => false,
```
Refrescar config:
```bash
php artisan config:clear
```

---

## 🧪 Comandos útiles
```bash
php artisan route:list --path=api
php artisan migrate:fresh --seed
php artisan optimize:clear
```

---

## 🧭 Roadmap (próximos pasos)
- [ ] Autenticación con Laravel Sanctum
- [ ] Policies por usuario (cada uno ve solo sus tareas)
- [ ] Pruebas Feature de CRUD + auth
- [ ] Paginación y ordenamiento en `/api/tasks`

## 📜 Licencia
MIT
