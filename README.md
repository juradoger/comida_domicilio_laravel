
# 🍔 Sistema de Comida Rápida a Domicilio - Laravel 12

Este proyecto es una aplicación web desarrollada con Laravel 12, orientada a brindar un servicio moderno y eficiente de comida rápida a domicilio, permitiendo a los clientes ver el menú, realizar pedidos en línea y gestionar la entrega de forma organizada.

---

## 📌 Descripción del Caso de Estudio

El objetivo principal es construir una plataforma digital de comida rápida, con funcionalidades que permitan:

- Ver el menú por categorías (hamburguesas, pizzas, snacks, bebidas, etc.).
- Realizar pedidos en línea seleccionando productos, cantidades y dirección de entrega.
- Asignar repartidores a los pedidos.
- Administrar productos, clientes, empleados y pedidos desde un panel de gestión.

Este sistema está enfocado en ofrecer rapidez, simplicidad y escalabilidad para negocios pequeños o medianos de comida rápida.

---

## 🚀 Tecnologías 

| Herramienta        | Descripción                                       |
|--------------------|---------------------------------------------------|
|   Laravel 12       | Framework PHP para desarrollo web moderno         |
|   PHP 8.2          | Lenguaje backend principal                        |
|   MySQL / MariaDB  | Base de datos relacional                          |
|   Composer         | Gestor de dependencias para PHP                   |
|   Blade            | Motor de plantillas de Laravel                    |

---

## ⚙️ Pasos para Ejecutar el Proyecto

1. Clona el repositorio
   ```bash
   git clone https://github.com/usuario/proyecto-comida-domicilio.git
   cd proyecto-comida-domicilio
   ```

2. Instala las dependencias
   ```bash
   composer install
   ```

3. Copia y configura el archivo `.env`(opcional)
   ```bash
   cp .env.example .env
   ```

4. Genera la clave de la aplicación (opcional)
   ```bash
   php artisan key:generate
   ```

5. Configura tu base de datos en el archivo `.env`
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=comida_domicilio
   DB_USERNAME=root
   DB_PASSWORD=tu_contraseña
   ```

6. Ejecuta las migraciones y los seeders
   ```bash
   php artisan migrate --seed
   ```

7. Levanta el servidor local
   ```bash
   php artisan serve
   ```

8. Abre la aplicación en tu navegador
   ```
   http://localhost:8000
   ```

---

## 📁 Estructura del Proyecto (Resumen)

```
├── app/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── views/        ← Vistas Blade
│   └── css/js/       ← Recursos front-end
├── routes/
│   └── web.php       ← Rutas del sistema
├── .env
├── artisan
├── composer.json
└── README.md
```

---

## 👤 Autores

- Nayeli Zharit Ordoñez Choque
- Wattfi Vargas Castro

---

## ✅ Recomendaciones

- Verifica que el servidor MySQL esté corriendo antes de ejecutar las migraciones.
- Para el entorno de desarrollo, puedes usar [Laragon](https://laragon.org), [XAMPP](https://www.apachefriends.org), o [Docker](https://www.docker.com).

---

## 📌 Estado del proyecto

> ✅ En desarrollo funcional  

---
