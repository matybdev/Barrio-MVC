# Barrio‑MVC

**Plataforma web “Barrio MVC + API”** — Sistema para gestión de barrio (vecinos, accesos, reclamos), construida con arquitectura MVC + API REST + frontend PHP + backend Java.

## 📄 Descripción

Barrio‑MVC es una aplicación web full‑stack que combina backend en Java (Spring Boot) con frontend en PHP MVC, junto a una base de datos MySQL, para ofrecer una plataforma de administración integral de un barrio o comunidad.

Este proyecto nace como ejercicio personal para consolidar conocimientos en:

- Arquitectura MVC  
- Desarrollo backend con Java + Spring Boot + API REST  
- Desarrollo frontend con PHP + MVC + templates  
- Persistencia con MySQL  
- Organización modular del código  
- Buenas prácticas de código y estructura escalable  

---

## 📦 Características

- API REST construida en Java / Spring Boot  
- Frontend en PHP MVC que consume la API  
- Gestión de vecinos, accesos y reclamos  
- Base de datos relacional MySQL  
- Separación clara entre backend / frontend / base de datos  
- Código organizado y mantenible  

---

## 🛠️ Tecnologías utilizadas

| Capa / Herramienta | Tecnología |
|------------------|-----------|
| Backend API      | Java + Spring Boot |
| Frontend         | PHP (MVC) |
| Base de datos    | MySQL |
| Estilos / Assets | SCSS, CSS |
| Automatización   | Gulp, npm |
| Control de versiones | Git / GitHub |

---

## 🚀 Cómo correr el proyecto localmente

### Requisitos previos
- Java 17+  
- PHP 7.4+  
- MySQL  
- Git  
- Node.js + npm  

### Pasos

1. Cloná el repositorio  
   ```bash
   git clone https://github.com/Maty1337/Barrio-MVC.git
   ```
2. Creá la base de datos `barrio_db` y cargá los scripts SQL.
3. Backend (Spring Boot):  
   ```bash
   cd backend-folder
   mvn clean install
   mvn spring-boot:run
   ```
4. Frontend (PHP): configurar servidor local apuntando a `public/`.
5. Instalá dependencias del frontend:  
   ```bash
   npm install
   gulp build
   ```
6. Abrí en navegador: `http://localhost/`.

---

## 📁 Estructura del proyecto

```
Barrio‑MVC/
├── app/
├── models/
├── public/
├── backend/
├── gulpfile.js
├── package.json
├── composer.json
└── README.md
```

---

## ✨ Posibles mejoras

- Autenticación y roles  
- Panel administrativo completo  
- Documentación de API (Swagger)  
- Tests automatizados  
- Mejora del diseño UI/UX  

---

## 👤 Autor

**Matías** — Full Stack Developer Jr  
GitHub: https://github.com/Maty1337  
Portfolio: https://maty1337.github.io  

---

