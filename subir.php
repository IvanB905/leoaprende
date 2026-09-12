<?php
$pageTitle = "Subir Nuevo Recurso de Lectoescritura";
require_once __DIR__ . '/includes/data.php';

$mensajeExito = '';
$mensajeError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $categoria = trim($_POST['categoria'] ?? 'Método Silábico');
    $tipo = trim($_POST['tipo'] ?? 'Guía Imprimible (PDF)');
    $nivel = trim($_POST['nivel'] ?? '1° Primaria');
    $habilidad = trim($_POST['habilidad'] ?? 'Conciencia Fonológica');
    $autor = trim($_POST['autor'] ?? 'Docente de Aula');
    $institucion = trim($_POST['institucion'] ?? 'Institución Educativa');
    $letrasInput = trim($_POST['letras'] ?? 'M, P');
    $edad = trim($_POST['edad'] ?? '5 a 7 años');
    $licencia = trim($_POST['licencia'] ?? 'Creative Commons Atribución-NoComercial-CompartirIgual (CC BY-NC-SA 4.0)');
    $consejo = trim($_POST['consejo_aula'] ?? 'Aplicar en sesiones cortas de refuerzo grupal.');
    $enlace = trim($_POST['enlace'] ?? 'recursos_archivos/cartilla_silabas_m_p_s_l.html');

    if (!empty($titulo) && !empty($descripcion)) {
        $letrasArray = array_map('trim', explode(',', $letrasInput));
        $nuevoId = 'rec-' . str_pad(count(obtenerRecursos()) + 1, 3, '0', STR_PAD_LEFT);
        
        $nuevoRecurso = [
            "id" => $nuevoId,
            "titulo" => $titulo,
            "slug" => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $titulo))),
            "descripcion" => $descripcion,
            "tipo" => $tipo,
            "formato" => strpos($tipo, 'Juego') !== false ? 'text/html' : 'application/pdf',
            "icono" => strpos($tipo, 'Juego') !== false ? 'bi-controller' : 'bi-file-earmark-pdf',
            "color" => "primary",
            "categoria" => $categoria,
            "habilidad" => $habilidad,
            "letras" => $letrasArray,
            "nivel" => $nivel,
            "edad_recomendada" => $edad,
            "tiempo_estimado" => "20 minutos",
            "tipo_interactividad" => "Expositiva e interactiva guiada",
            "autor" => $autor,
            "institucion" => $institucion,
            "fecha_publicacion" => date('Y-m-d'),
            "idioma" => "es-CO (Español)",
            "licencia" => $licencia,
            "tamano" => "2.0 MB",
            "paginas" => 8,
            "descargas" => 0,
            "valoracion" => 5.0,
            "total_votos" => 1,
            "estado" => "En Revisión", // Flujo de curaduría
            "destacado" => false,
            "enlace_recurso" => $enlace,
            "imagen_portada" => "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&auto=format&fit=crop&q=80",
            "consejo_aula" => $consejo,
            "metadatos_dublin_core" => [
                "title" => $titulo,
                "creator" => $autor,
                "subject" => "Lectoescritura, $categoria, $habilidad, sílabas",
                "description" => $descripcion,
                "publisher" => "LeoAprende",
                "contributor" => $institucion,
                "date" => date('Y-m-d'),
                "type" => "EducationalResource",
                "format" => "application/pdf",
                "identifier" => "URN:NBN:ES:LEO-" . date('Y') . "-$nuevoId",
                "source" => "Proyecto de Aula de Lectura",
                "language" => "es",
                "relation" => "Colección Recursos Didácticos de Aula",
                "coverage" => "Básica Primaria",
                "rights" => $licencia
            ],
            "metadatos_ieee_lom" => [
                "general" => [
                    "identificador" => "LOM-LEO-$nuevoId",
                    "idioma" => "Español",
                    "palabras_clave" => $letrasArray
                ],
                "ciclo_vida" => [
                    "version" => "1.0",
                    "estado" => "En Revisión",
                    "contribuyente" => $autor
                ],
                "educativo" => [
                    "tipo_interactividad" => "Mixta",
                    "tipo_recurso_educativo" => $tipo,
                    "nivel_interactividad" => "Medio",
                    "densidad_semantica" => "Baja",
                    "rol_usuario_final" => "Docente / Estudiante",
                    "contexto" => $nivel,
                    "rango_edad_tipico" => $edad,
                    "dificultad" => "Fácil",
                    "tiempo_aprendizaje" => "00:20:00"
                ],
                "derechos" => [
                    "costo" => "No",
                    "derechos_autor" => "Sí ($licencia)"
                ]
            ]
        ];

        if (agregarRecurso($nuevoRecurso)) {
            $mensajeExito = "¡Excelente! El recurso <strong>'$titulo'</strong> ha sido cargado con éxito. En cumplimiento del flujo de trabajo, se encuentra en estado <strong>'En Revisión'</strong> para curaduría pedagógica con la rúbrica LORI.";
        } else {
            $mensajeError = "Ocurrió un error al intentar guardar el recurso. Por favor intenta de nuevo.";
        }
    } else {
        $mensajeError = "Por favor completa los campos obligatorios (Título y Descripción).";
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subir Recurso Didáctico</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="bg-primary-custom text-white p-4">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill mb-2">
                        <i class="bi bi-cloud-arrow-up-fill"></i> Flujo de Publicación Docente
                    </span>
                    <h2 class="fw-bold mb-1">Aportar un Recurso al Repositorio</h2>
                    <p class="mb-0 text-light opacity-90">
                        Comparte tus guías de trabajo, lecturas infantiles o juegos para fortalecer la enseñanza de la lectura en otras aulas.
                    </p>
                </div>

                <div class="card-body p-4">
                    <?php if (!empty($mensajeExito)): ?>
                    <div class="alert alert-success alert-dismissible fade show rounded-3 p-3 mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                        <?= $mensajeExito ?>
                        <div class="mt-3">
                            <a href="evaluacion.php" class="btn btn-sm btn-outline-success fw-bold">
                                <i class="bi bi-clipboard-check"></i> Ir al Panel de Evaluación para Aprobarlo
                            </a>
                            <a href="index.php" class="btn btn-sm btn-success fw-bold ms-2">
                                <i class="bi bi-arrow-left"></i> Volver al Catálogo
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($mensajeError)): ?>
                    <div class="alert alert-danger rounded-3 p-3 mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= $mensajeError ?>
                    </div>
                    <?php endif; ?>

                    <form method="POST" action="subir.php" class="needs-validation">
                        <!-- Paso 1: Información Básica del Recurso -->
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                1. Datos Generales del Recurso Didáctico
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-bold small">Título del Recurso *</label>
                                    <input type="text" name="titulo" class="form-control rounded-3" placeholder="Ej: Fichas de Lectura de Sílabas con la Letra D y T" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Tipo de Material *</label>
                                    <select name="tipo" class="form-select rounded-3">
                                        <option value="Guía Imprimible (PDF)">Guía Imprimible (PDF)</option>
                                        <option value="Juego Interactivo Web">Juego Interactivo Web</option>
                                        <option value="Lecturas Guiadas (PDF)">Lecturas con Pictogramas</option>
                                        <option value="Fichas de Grafomotricidad (PDF)">Fichas de Grafomotricidad</option>
                                        <option value="Material Lúdico Manipulativo (PDF)">Material Lúdico Manipulativo</option>
                                        <option value="Evaluación Diagnóstica Docente">Evaluación Diagnóstica</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small">Descripción Pedagógica *</label>
                                    <textarea name="descripcion" class="form-control rounded-3" rows="3" placeholder="Explica de forma clara el propósito de la actividad, la metodología sugerida y qué aprenderá el niño..." required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Paso 2: Metadatos Curriculares y Pedagógicos (IEEE LOM) -->
                        <div class="mb-4">
                            <h5 class="fw-bold text-success border-bottom pb-2 mb-3">
                                2. Metadatos Curriculares y de Aprendizaje (Perfil IEEE LOM)
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Categoría Metodológica</label>
                                    <select name="categoria" class="form-select rounded-3">
                                        <option value="Método Silábico">Método Silábico</option>
                                        <option value="Juegos Interactivos">Juegos Interactivos</option>
                                        <option value="Comprensión Lectora">Comprensión Lectora</option>
                                        <option value="Grafomotricidad y Trazos">Grafomotricidad y Trazos</option>
                                        <option value="Diagnóstico y Evaluación">Diagnóstico y Evaluación</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Habilidad que Desarrolla</label>
                                    <input type="text" name="habilidad" class="form-control rounded-3" placeholder="Ej: Conciencia Fonológica, Decodificación, Fluidez" value="Conciencia Fonológica">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Grado / Población Objetivo</label>
                                    <select name="nivel" class="form-select rounded-3">
                                        <option value="Preescolar y Transición">Preescolar / Transición (4-5 años)</option>
                                        <option value="1° Primaria" selected>1.° Primaria (6-7 años)</option>
                                        <option value="2° Primaria">2.° Primaria (7-8 años)</option>
                                        <option value="Refuerzo y Nivelación">Refuerzo escolar / Rezago lector</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Fonemas / Sílabas trabajadas</label>
                                    <input type="text" name="letras" class="form-control rounded-3" placeholder="Ej: D, T, N, B (separadas por coma)" value="M, P, S">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Edad Recomendada</label>
                                    <input type="text" name="edad" class="form-control rounded-3" placeholder="Ej: 5 a 7 años" value="5 a 7 años">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Tiempo Estimado de Sesión</label>
                                    <input type="text" name="tiempo" class="form-control rounded-3" value="20 minutos">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small">Consejo u Orientación para la Maestra en el Aula</label>
                                    <input type="text" name="consejo_aula" class="form-control rounded-3" placeholder="Ej: Realizar primero el modelado en la pizarra y pedir a los niños que sigan la lectura con el dedo...">
                                </div>
                            </div>
                        </div>

                        <!-- Paso 3: Autoría y Derechos de Autor (Ley 23 de 1982 / Dublin Core) -->
                        <div class="mb-4">
                            <h5 class="fw-bold text-danger border-bottom pb-2 mb-3">
                                3. Autoría, Integridad y Licencia Abierta (Dublin Core & Ley 23)
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Nombre de la Maestra / Autor(a) *</label>
                                    <input type="text" name="autor" class="form-control rounded-3" placeholder="Lic. Tu Nombre y Apellido" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Institución Educativa o Escuela</label>
                                    <input type="text" name="institucion" class="form-control rounded-3" placeholder="Ej: Escuela Normal / Colegio Integrado">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small">Licencia de Publicación Abierta (Creative Commons)</label>
                                    <select name="licencia" class="form-select rounded-3">
                                        <option value="Creative Commons Atribución-NoComercial-CompartirIgual (CC BY-NC-SA 4.0)">CC BY-NC-SA 4.0 (Permite copiar y adaptar para el aula sin fines comerciales)</option>
                                        <option value="Creative Commons Atribución (CC BY 4.0)">CC BY 4.0 (Máxima reutilización con reconocimiento de autor)</option>
                                        <option value="Creative Commons Atribución-NoComercial (CC BY-NC 4.0)">CC BY-NC 4.0 (Libre uso escolar no comercial)</option>
                                    </select>
                                    <small class="text-muted d-block mt-1">
                                        <i class="bi bi-shield-check"></i> Garantiza la protección intelectual del autor conforme a la <strong>Ley 23 de 1982</strong> de Derechos de Autor y promueve el uso libre en aulas escolares.
                                    </small>
                                </div>

                                <div class="col-12">
                                    <div class="form-check p-3 bg-light rounded-3 border">
                                        <input class="form-check-input" type="checkbox" id="checkEtica" required checked>
                                        <label class="form-check-label small" for="checkEtica">
                                            Declaro que este material es de autoría propia o cuenta con las debidas autorizaciones y citas bajo norma APA 7.ª edición, y que su uso de herramientas digitales/IA respeta los principios éticos y de integridad académica.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end pt-3 border-top">
                            <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4 me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary-custom rounded-pill px-5 fw-bold shadow">
                                <i class="bi bi-cloud-arrow-up-fill me-1"></i> Depositar Recurso en el Repositorio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
