# ACTIVIDAD 2: DISEÑO Y PROTOTIPO DE UN REPOSITORIO DE RECURSOS EDUCATIVOS DIGITALES

**Título del Proyecto:** *LeoAprende*: Diseño y Prototipo de un Repositorio Didáctico de Recursos Educativos Digitales Abiertos (REDA) para el Fortalecimiento de la Lectoescritura Inicial en Proyectos de Aula de Básica Primaria

---

## HOJA DE PRESENTACIÓN / PORTADA (NORMA APA 7.ª EDICIÓN)

**Título del Trabajo:**  
Diseño y Prototipo de un Repositorio Digital de Recursos Educativos Abiertos para la Iniciación a la Lectoescritura en Educación Infantil y Primer Grado (*LeoAprende*)

**Nombre de los Autores (Estudiantes):**  
[Nombre y Apellidos del Estudiante 1]  
[Nombre y Apellidos del Estudiante 2]  
[Nombre y Apellidos del Estudiante 3]  
[Nombre y Apellidos del Estudiante 4]  

**Asignatura / Curso:**  
Recursos Educativos Digitales y Gestión del Conocimiento  

**Programa Académico:**  
Licenciatura en Educación / Maestría en Tecnologías Digitales Aplicadas a la Educación  

**Nombre del Docente / Asesor:**  
[Nombre del Docente de la Asignatura]  

**Institución Universitaria:**  
[Nombre de la Universidad / Facultad de Educación]  

**Fecha de Entrega:**  
Marzo de 2026  

---

## 1. INTRODUCCIÓN

El acceso a la cultura escrita constituye uno de los hitos fundacionales del desarrollo integral, cognitivo y social del ser humano. En los primeros años de escolaridad formal (transición, primero y segundo grado de básica primaria), aprender a leer y escribir no se reduce a una mera técnica de decodificación mecánica, sino que representa la puerta de entrada a la construcción autónoma de significados y a la participación ciudadana (Ferreiro & Teberosky, 1979). No obstante, diversos diagnósticos educativos a nivel regional han evidenciado una problemática recurrente: un porcentaje significativo de niños ingresa a la educación básica primaria experimentando dificultades severas en la adquisición de la lectura, fenómeno agravado por rezagos en la conciencia fonológica y la falta de materiales didácticos pertinentes y adaptados a sus necesidades específicas (UNESCO, 2021).

En la práctica pedagógica cotidiana, los docentes se enfrentan a una notable dispersión de recursos en internet. Aunque existen portales y blogs educativos, estos carecen en su gran mayoría de una catalogación estandarizada, no explicitan sus licencias de autor, presentan barreras de accesibilidad o no ofrecen una articulación secuencial entre el método silábico, la estimulación fonológica y el juego interactivo.

Ante este desafío, el presente proyecto formula el diseño y desarrollo del prototipo interactivo de **LeoAprende**, un Repositorio de Recursos Educativos Digitales Abiertos (REDA) centrado de manera monográfica y especializada en la iniciación a la lectoescritura infantil. Este informe detalla el contexto educativo, la justificación psicopedagógica, el modelo arquitectónico del repositorio, la estandarización de metadatos bajo las normas internacionales **Dublin Core** e **IEEE LOM**, los roles y flujos de trabajo de publicación y curaduría (basados en la métrica de calidad LORI), el manual operativo del prototipo web funcional y la correspondiente declaración de uso ético de tecnologías e Inteligencia Artificial Generativa (IAG), en concordancia con la Ley 23 de 1982 de Derechos de Autor y las Normas APA 7.ª edición.

---

## 2. CONTEXTO EDUCATIVO Y JUSTIFICACIÓN PEDAGÓGICA

### 2.1. Definición del Contexto Específico
El contexto seleccionado corresponde al **Área Temática de Iniciación a la Lectoescritura y Atención al Rezago Lector en Aulas de Educación Inicial y Básica Primaria (Grados Transición, 1.° y 2.°)**, concebido como soporte directo para **Proyectos de Aula** dirigidos a niños que no han logrado consolidar el principio alfabético o que presentan barreras de aprendizaje en la decodificación.

* **Población Objetivo:** Niños entre 4 y 8 años de edad, docentes de primera infancia y básica primaria, y familias/cuidadores que apoyan el proceso de alfabetización en el hogar.
* **Escenario de Aplicación:** Aulas de clase convencionales, aulas de apoyo pedagógico, centros de tutoría escolar y entornos comunitarios con conectividad básica o requerimientos de material impreso.

### 2.2. Justificación y Fundamentación Teórica
La justificación de este repositorio se cimenta en tres pilares fundamentales:

1. **La Perspectiva Psicogenética y Constructivista (Ferreiro & Teberosky):** La adquisición de la lengua escrita atraviesa hipótesis evolutivas (presilábica, silábica, silábico-alfabética y alfabética). Los materiales del repositorio están graduados para intervenir en cada una de estas etapas, permitiendo que el docente seleccione fichas con pictogramas o juegos que correspondan exactamente a la hipótesis cognitiva en la que se encuentra el estudiante.
2. **La Centralidad de la Conciencia Fonológica:** Como afirman Defior y Serrano (2011), la habilidad para identificar, segmentar y manipular los sonidos del habla (fonemas y sílabas) es el predictor más confiable del éxito lector posterior. Por ello, el repositorio prioriza materiales centrados en fonemas directos (M, P, S, L, T), discriminación auditiva y síntesis silábica.
3. **El Aprendizaje Lúdico y Gamificado:** En la infancia temprana, el juego mediado por recursos tecnológicos interactivos disminuye el estrés asociado a la frustración por el error de lectura, transformando la práctica repetitiva en una experiencia motivadora y placentera (Gee, 2007).

---

## 3. ARQUITECTURA DE INFORMACIÓN Y TIPOS DE RECURSOS DIGITALES

### 3.1. Taxonomía de Recursos Incluidos
Para responder a la diversidad de estilos de aprendizaje y a la realidad de conectividad de las instituciones educativas, el repositorio clasifica sus recursos en cinco tipologías:

1. **Guías y Cuadernillos Imprimibles (PDF):** Fichas didácticas de trazo, combinación silábica y lectura graduada con fuentes escolares adaptadas (líneas de pauta, espacio interletra ampliado).
2. **Juegos Interactivos Web (HTML5/Canvas):** Objetos de aprendizaje gamificados ejecutables en navegador (ruletas silábicas, emparejamiento fonema-imagen, trenes de vocales) con retroalimentación sonora inmediata mediante síntesis de voz (Web Speech API).
3. **Lecturas Cortas con Pictogramas:** Textos breves de 3 a 5 líneas acompañados de iconos semánticos que facilitan la comprensión lectora inferencial y literal en niños no decodificadores fluidos.
4. **Fichas de Grafomotricidad:** Ejercicios de direccionalidad, control postural del trazo y discriminación visoespacial.
5. **Instrumentos de Evaluación Diagnóstica Docente:** Listas de cotejo, protocolos rápidos de fluidez fonológica y rúbricas formativas para el seguimiento en el proyecto de aula.

---

## 4. ESTÁNDARES DE METADATOS SELECCIONADOS Y JUSTIFICACIÓN

Para asegurar la interoperabilidad, visibilidad, indexación y recuperación precisa de los recursos, se adoptó un modelo híbrido basado en **Dublin Core Metadata Element Set (ISO 15836)** para la descripción bibliográfica nuclear, complementado con el estándar **IEEE LOM (Learning Object Metadata - IEEE 1484.12.1)** para la caracterización pedagógica.

### Tabla 1.
*Esquema de Metadatos Dublin Core aplicado a los Recursos de LeoAprende*

| Elemento Dublin Core | Definición en el Contexto de LeoAprende | Ejemplo de Aplicación en el Recurso rec-001 |
| :--- | :--- | :--- |
| **Title** | Denominación formal del recurso didáctico. | *Cartilla de Sílabas Directas: Fonemas M, P, S, L* |
| **Creator** | Nombre de la docente o pedagogo autor. | Gómez, María Elena |
| **Subject** | Palabras clave, fonemas y habilidades desarrolladas. | Lectura inicial, método silábico, fonemas M-P-S-L |
| **Description** | Resumen didáctico y propósito metodológico. | Cuadernillo de 16 páginas para decodificación silábica. |
| **Publisher** | Entidad u organización editora. | Repositorio Abierto LeoAprende |
| **Contributor** | Colaboradores, ilustradores o comités de apoyo. | Comité de Docentes de Primera Infancia |
| **Date** | Fecha de creación o depósito formal (AAAA-MM-DD). | 2026-02-15 |
| **Type** | Género de contenido según DCMI Type Vocabulary. | `Text` / `InteractiveResource` |
| **Format** | Tipo MIME del medio digital o software. | `application/pdf` / `text/html` |
| **Identifier** | Identificador persistente o local único. | `URN:NBN:ES:LEO-2026-001` |
| **Source** | Procedencia u origen del material pedagógico. | Proyecto de Aula de Lectoescritura Inicial |
| **Language** | Código ISO 639-1 del idioma principal. | `es` (Español) |
| **Relation** | Vínculo con colecciones o materiales previos. | Pertenece a: *Colección Aprendiendo a Leer Paso a Paso* |
| **Coverage** | Ámbito espacial o nivel del sistema educativo. | Educación Básica Primaria (Grados K-2) |
| **Rights** | Términos legales de uso y licencia otorgada. | Creative Commons CC BY-NC-SA 4.0 |

*Nota.* Adaptado de Dublin Core Metadata Initiative (DCMI, 2020).

---

### Tabla 2.
*Esquema de Metadatos Educativos IEEE LOM (Perfil de Aplicación)*

| Categoría LOM | Campo / Atributo | Justificación Pedagógica y Valor en LeoAprende |
| :--- | :--- | :--- |
| **General** | *Keywords (Palabras clave)* | Permite filtrar específicamente por consonante o fonema de interés (ej. "M", "P", "Sílabas directas"). |
| **Ciclo de Vida** | *Estado de Publicación* | Registra si el material está "En Revisión" o "Aprobado", garantizando trazabilidad curatorial. |
| **Educativo** | *Tipo de Interactividad* | Clasifica el recurso en Expositivo (lectura), Activo (trazos) o Mixto/Gamificado (juegos web). |
| **Educativo** | *Nivel de Interactividad* | Determina el grado de respuesta que el recurso exige al niño (Bajo, Medio, Muy Alto). |
| **Educativo** | *Rol del Usuario Final* | Diferencia entre materiales de uso autónomo del niño, materiales de mediación docente y guías para padres. |
| **Educativo** | *Rango de Edad Típico* | Calibra la idoneidad psicomotriz y lectora (ej. 4-5 años para trazos; 6-7 años para oraciones). |
| **Educativo** | *Dificultad Didáctica* | Escala de Muy Fácil a Media para estructurar rutas de aprendizaje progresivas. |
| **Educativo** | *Tiempo de Aprendizaje* | Estimado entre 10 y 25 minutos para respetar la curva de atención en primera infancia. |
| **Derechos** | *Costo y Licenciamiento* | Acceso libre y gratuito bajo marco Creative Commons y Ley 23 de 1982. |

*Nota.* Adaptado de IEEE Learning Technology Standards Committee (IEEE LTSC, 2002).

---

## 5. MODELO DE ROLES Y MATRIZ DE PERMISOS

Para garantizar la integridad y sostenibilidad del repositorio, se definieron cuatro roles funcionales:

1. **Estudiante / Familia (Modo Lúdico):**
   * Perfil sin barreras de autenticación forzada para garantizar máxima accesibilidad.
   * Funcionalidades: Búsqueda mediante iconos amigables, ejecución de juegos interactivos con voz, previsualización de cuentos con pictogramas y descarga directa de fichas para el hogar.
2. **Docente de Aula (Creador y Consumidor):**
   * Funcionalidades: Descarga libre de cuadernillos imprimibles y guías metodológicas, registro y depósito de nuevos recursos a través de un formulario con mapeo guiado de metadatos, y valoración cualitativa de materiales utilizados en clase.
3. **Comité Curador / Evaluador Pedagógico:**
   * Funcionalidades: Acceso a la bandeja de recursos pendientes de publicación, evaluación formal a través de la rúbrica LORI adaptada, formulación de observaciones pedagógicas y dictamen de aprobación o solicitud de ajustes.
4. **Administrador del Sistema:**
   * Funcionalidades: Supervisión global del catálogo, gestión de taxonomías, visualización de analíticas de descargas e impacto, exportación de bases de datos de metadatos (JSON/CSV) y auditoría de licencias.

---

## 6. FLUJOS DE TRABAJO DEL REPOSITORIO

### 6.1. Flujo de Carga y Publicación de Recursos
1. **Creación del Recurso:** La docente diseña la ficha o juego basándose en su experiencia en el proyecto de aula.
2. **Depósito y Auto-catalogación:** Mediante el módulo `subir.php`, la docente ingresa los datos esenciales; el sistema auto-completa los metadatos Dublin Core y LOM correspondientes.
3. **Declaración de Autoría y Licencia:** Se suscribe la cesión no exclusiva bajo Creative Commons y se declara el cumplimiento ético de derechos de autor (Ley 23 de 1982).
4. **Asignación de Estado "En Revisión":** El recurso se inhabilita provisionalmente para el catálogo general y se notifica al comité evaluador.

### 6.2. Flujo de Curaduría y Evaluación Pedagógica
1. **Inspección Técnica y Didáctica:** El evaluador examina el recurso en `evaluacion.php`, valorando calidad gráfica, legibilidad de fuentes escolares y rigor fonológico.
2. **Aplicación de Escala LORI:** Se asigna puntaje en las 5 dimensiones clave.
3. **Dictamen Curatorial:**
   * *Aprobado:* El recurso pasa automáticamente al estado visible en el catálogo con insignia de verificación.
   * *En Corrección:* Se remite retroalimentación al docente con sugerencias de ajuste (ej. aumentar tamaño de tipografía o corregir distractor fonético).

### 6.3. Flujo de Búsqueda y Descarga
1. **Consulta Facetada:** El usuario filtra simultáneamente por grado, tipo de recurso (juego vs. PDF) y consonante específica (M, P, S, L).
2. **Exploración de la Ficha Técnica:** Se accede a `recurso.php`, donde se consultan los 15 campos Dublin Core, el perfil LOM y las orientaciones didácticas de aula.
3. **Descarga y Trazabilidad:** Al hacer clic en descargar, se incrementa el contador de impacto pedagógico y se abre la ficha imprimible en alta definición.

---

## 7. MECANISMO DE EVALUACIÓN DE CALIDAD: MODELO LORI ADAPTADO

Para la evaluación y curaduría de los recursos educativos digitales se adoptó y adaptó el instrumento **LORI (Learning Object Review Instrument)** de Nesbit et al. (2002), configurando cinco dimensiones pertinentes a la lectoescritura infantil:

1. **Calidad de Contenidos Fonológicos:** Ausencia de ambigüedades fonéticas, correspondencia unívoca grafema-fonema y pertinencia léxica (palabras comprensibles para niños de 5 a 7 años).
2. **Adecuación de la Tipografía y Ergonomía Visual:** Empleo de fuentes recomendadas para iniciación lectora (tipografía script o redonda con buena diferenciación entre letras especulares como *b/d* o *p/q*), espaciado interlineal amplio e ilustraciones infantiles atractivas sin sobrecarga cognitiva.
3. **Interactividad y Motivación Lúdica:** Capacidad del recurso para enganchar el interés del niño mediante el juego, la retroalimentación positiva y el reto progresivo.
4. **Utilidad para el Proyecto de Aula:** Claridad en las orientaciones docentes, inclusión de sugerencias metodológicas de aplicación grupal o individual.
5. **Cumplimiento Legal y Accesibilidad:** Declaración formal de licencias libres y formato abierto para impresión o navegación sin restricciones comerciales.

---

## 8. ESPECIFICACIÓN Y MANUAL DEL PROTOTIPO WEB FUNCIONAL

### 8.1. Arquitectura Técnica
* **Entorno de Despliegue:** Servidor Apache local (XAMPP).
* **Ruta de Instalación:** `c:\xampp\htdocs\repositorio\`
* **Enlace Web en Línea (GitHub Pages):** [https://ivanb905.github.io/leoaprende/](https://ivanb905.github.io/leoaprende/)
* **Enlace Local de Acceso (XAMPP):** `http://localhost/repositorio/`
* **Tecnologías Implementadas:** PHP 8.x para lógica de negocio y procesamiento de estados, JavaScript ES6 con API Canvas y Web Speech para juegos interactivos, CSS3 moderno con sistema de diseño educativo responsivo y almacenamiento en base de datos ligera estructurada en JSON (`data/recursos.json`).

### 8.2. Módulos y Pantallas del Prototipo
* **Catálogo Principal (`index.php`):** Presenta banner inspirador, barra de búsqueda en tiempo real, selector facetado por grado y consonante, botones de filtro por categoría y cuadrícula de tarjetas con badges dinámicos.
* **Ficha de Detalle y Metadatos (`recurso.php`):** Despliega el visor del recurso, pestañas alternables de los 15 campos Dublin Core y el perfil IEEE LOM, caja de consejos pedagógicos de aula y sistema de reseñas docentes.
* **Juego Interactivo de Sílabas (`juegos/ruleta.php`):** Ruleta en Canvas con síntesis de voz en español que pronuncia los fonemas, formula retos visuales al niño y lleva conteo de puntos.
* **Módulo de Carga Docente (`subir.php`):** Formulario escalonado para auto-catalogar recursos con metadatos curriculares y cláusula de autoría.
* **Panel de Curaduría Pedagógica (`evaluacion.php`):** Vista especializada para el rol evaluador con botones de dictamen y rúbrica LORI.
* **Panel de Administración (`admin.php`):** Métricas consolidadas de descargas en aula, distribución porcentual de categorías y matriz de permisos.
* **Hojas de Trabajo Imprimibles (`recursos_archivos/*.html`):** Fichas reales en alta calidad listas para impresión docente o guardado en PDF.

---

## 9. DECLARACIÓN ÉTICA DE AUTORÍA Y USO DE INTELIGENCIA ARTIFICIAL GENERATIVA (IAG)

En estricto cumplimiento de la legislación colombiana sobre derechos morales y patrimoniales de autor (**Ley 23 de 1982** y Decisiones Andinas concordantes), así como de las directrices institucionales de integridad académica:

1. **Autoría Académica:** Los autores del presente proyecto certifican que las concepciones pedagógicas, la formulación del problema de aula en lectoescritura, la estructuración de la matriz de roles y la justificación de metadatos representan una producción intelectual original y de pensamiento propio.
2. **Uso de Herramientas de Inteligencia Artificial:** Se emplearon asistentes de Inteligencia Artificial Generativa como herramienta instrumental de apoyo técnico en:
   * Asistencia en la generación de código base HTML/CSS/PHP para agilizar el prototipado rápido de la interfaz.
   * Revisión de estilo y coherencia de redacción bajo normas APA 7.ª edición.
   * Consulta de esquemas técnicos de metadatos estandarizados (DCMI e IEEE LOM).
3. **Verificación y Curaduría Humana:** Todos los contenidos pedagógicos, las tablas de metadatos y las directrices metodológicas fueron revisados, validados y ajustados críticamente por el equipo de estudiantes, asumiendo la total responsabilidad académica del producto entregado.

---

## 10. CONCLUSIONES

1. El diseño de un repositorio especializado en lectoescritura infantil resuelve de manera directa la fragmentación y falta de rigor de los recursos abiertos existentes en la web, proveyendo a las maestras de aula un entorno seguro, estructurado y metodológicamente coherente.
2. La implementación complementaria de los estándares **Dublin Core** e **IEEE LOM** demuestra que la estandarización no es un formalismo burocrático, sino una condición indispensable para que los recursos didácticos sean fácilmente localizables por habilidades específicas (conciencia fonológica, método silábico, grafomotricidad).
3. El prototipo desarrollado en `c:\xampp\htdocs\repositorio` evidencia que es factible articular herramientas interactivas lúdicas (gamificación con síntesis de voz) y materiales tradicionales imprimibles en una sola plataforma armónica, satisfaciendo simultáneamente las necesidades de estudiantes, docentes y comités de calidad.

---

## 11. REFERENCIAS BIBLIOGRÁFICAS (NORMAS APA 7.ª EDICIÓN)

* Defior, S., & Serrano, F. (2011). La conciencia fonémica, aliada de la adquisición del código alfabético. *Revista de Logopedia, Foniatría y Audiología*, 31(4), 202–212. https://doi.org/10.1016/S0214-4603(11)70188-6
* Dublin Core Metadata Initiative. (2020). *DCMI Metadata Terms*. https://www.dublincore.org/specifications/dublin-core/dcmi-terms/
* Ferreiro, E., & Teberosky, A. (1979). *Los sistemas de escritura en el desarrollo del niño*. Siglo XXI Editores.
* Gee, J. P. (2007). *Good video games and good learning: Collected essays on culture and learning in video games*. Peter Lang Publishing.
* IEEE Learning Technology Standards Committee. (2002). *Draft Standard for Learning Object Metadata (IEEE 1484.12.1-2002)*. Institute of Electrical and Electronics Engineers. https://standards.ieee.org/
* Ley 23 de 1982. *Sobre derechos de autor*. Congreso de la República de Colombia. Diario Oficial No. 35.952.
* Ministerio de Educación Nacional de Colombia. (2016). *Derechos Básicos de Aprendizaje: Lenguaje (Grados Transición a 5°)*. MEN.
* Nesbit, J., Belfer, K., & Leacock, T. (2002). Learning object review instrument (LORI). *E-Learning*, 1(2), 1–12.
* UNESCO. (2021). *Los aprendizajes fundamentales en América Latina y el Caribe: Evaluación de logros y desafíos post-pandemia*. Oficina Regional de Educación para América Latina y el Caribe (OREALC/UNESCO Santiago).
* Vygotsky, L. S. (1978). *Mind in society: The development of higher psychological processes*. Harvard University Press.
