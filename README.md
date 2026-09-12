# 📚 LeoAprende - Repositorio Digital de Recursos para la Lectoescritura Inicial

> **Actividad 2:** Diseño y Prototipo de un Repositorio de Recursos Educativos Digitales  
> **Área Temática:** Iniciación a la lectura y escritura para proyectos de aula infantil (Transición, 1.° y 2.° de primaria).  
> **Estándares:** Dublin Core (15 elementos) & Perfil Pedagógico IEEE LOM.  
> **Rúbrica de Calidad:** Modelo LORI adaptado a lectoescritura.  
> **Licenciamiento:** Creative Commons (CC BY-NC-SA 4.0) & Ley 23 de 1982 de Derechos de Autor.  

---

## 🌐 Demostración en Vivo (GitHub Pages)
Puedes visualizar y probar el repositorio interactivo directamente desde tu navegador:
👉 **[Ver Prototipo LeoAprende en GitHub Pages](https://ivanb905.github.io/leoaprende/)**

---

## 🎯 Propósito Pedagógico
Centralizar, categorizar y compartir recursos educativos abiertos (guías imprimibles, lecturas con pictogramas, pruebas diagnósticas y juegos interactivos) orientados a superar el rezago lector y consolidar la conciencia fonológica en la primera infancia.

---

## 🚀 Funcionalidades Principales
1. **Catálogo Facetado:** Filtros por grado (Preescolar, 1.°, 2.°, Refuerzo), formato (PDF, Juego, Pictogramas) y fonemas específicos (M, P, S, L, T).
2. **Selector de 4 Roles:**
   - 🧒 *Familia / Niño:* Modo lúdico y acceso directo a juegos.
   - 👩‍🏫 *Docente de Aula:* Descarga de guías y módulo de depósito de nuevas fichas.
   - 📋 *Comité Evaluador:* Curaduría de recursos bajo escala LORI.
   - 🔒 *Administrador:* Métricas de descargas y matriz de roles y permisos.
3. **Fichas Técnicas Estandarizadas:**
   - Despliegue de los **15 campos Dublin Core** (ISO 15836).
   - Dimensiones pedagógicas del perfil **IEEE LOM** (interactividad, dificultad, rango de edad).
4. **Juego Interactivo "La Ruleta de las Sílabas":**
   - Desarrollado en Canvas con **síntesis de voz en español** (Web Speech API) que pronuncia los fonemas en voz alta.

---

## 📂 Estructura del Repositorio
* `index.html` / `repositorio_completo.html`: Aplicación web interactiva completa lista para GitHub Pages.
* `index.php`, `recurso.php`, `subir.php`, `evaluacion.php`, `admin.php`: Versión modular para servidores PHP / XAMPP.
* `juegos/ruleta.php`: Juego interactivo de sílabas con audio.
* `recursos_archivos/`: Materiales imprimibles reales de alta resolución (PDF/HTML).
