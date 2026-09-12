<?php
$pageTitle = "Comité Evaluador | Curaduría Pedagógica LORI";
require_once __DIR__ . '/includes/data.php';

$mensajeAccion = '';

// Procesar acción del evaluador
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recursoId = $_POST['recurso_id'] ?? '';
    $nuevoEstado = $_POST['nuevo_estado'] ?? '';
    $observacion = trim($_POST['observacion'] ?? '');

    if (!empty($recursoId) && !empty($nuevoEstado)) {
        if (actualizarEstadoRecurso($recursoId, $nuevoEstado, $observacion)) {
            $mensajeAccion = "El recurso <strong>$recursoId</strong> ha sido actualizado al estado: <span class='badge bg-primary'>$nuevoEstado</span>.";
        }
    }
}

$recursos = obtenerRecursos();
require_once __DIR__ . '/includes/header.php';
?>

<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Panel de Curaduría y Evaluación</li>
        </ol>
    </nav>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill mb-1">
                <i class="bi bi-shield-check"></i> Rol: Comité Curador / Evaluador Pedagógico
            </span>
            <h2 class="fw-bold text-dark mb-0">Revisión de Calidad de Recursos (Modelo LORI)</h2>
            <p class="text-muted small mb-0">Garantiza la pertinencia didáctica, accesibilidad y rigor tipográfico antes de publicar en el catálogo.</p>
        </div>
        <div>
            <a href="index.php" class="btn btn-sm btn-outline-secondary rounded-pill">
                <i class="bi bi-arrow-left"></i> Volver al Catálogo
            </a>
        </div>
    </div>

    <?php if (!empty($mensajeAccion)): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-3 p-3 mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?= $mensajeAccion ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Cuadro Informativo de la Rúbrica LORI para Lectoescritura -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="fw-bold text-dark mb-2">
                    <i class="bi bi-card-checklist text-primary"></i> Criterios de Evaluación Pedagógica (LORI Adaptado a Lectura Infantil)
                </h5>
                <p class="small text-muted mb-0">
                    Cada recurso propuesto por los docentes es examinado en 5 dimensiones clave:
                    <strong>1. Calidad del Contenido</strong> (fonemas correctos, ausencia de erratas),
                    <strong>2. Legibilidad Tipográfica</strong> (fuente clara para niños de 5-7 años, buen espaciado),
                    <strong>3. Motivación Lúdica</strong> (ilustraciones atractivas, gamificación),
                    <strong>4. Adecuación a la Edad</strong> (longitud de oraciones controlada) y
                    <strong>5. Derechos de Autor</strong> (Licencias Creative Commons conformes a Ley 23 de 1982).
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <span class="badge bg-primary-subtle text-primary border border-primary px-3 py-2 rounded-pill fw-bold">
                    <i class="bi bi-patch-check-fill"></i> Estándar de Curaduría Activo
                </span>
            </div>
        </div>
    </div>

    <!-- Lista de Recursos en Revisión y Publicados -->
    <div class="row g-4">
        <?php foreach ($recursos as $r): 
            $esPendiente = ($r['estado'] ?? '') === 'En Revisión';
        ?>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden <?= $esPendiente ? 'border border-2 border-warning' : '' ?>">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-<?= $esPendiente ? 'warning text-dark' : 'success' ?> fw-bold">
                            <?= $esPendiente ? '⏳ Pendiente de Evaluación' : '✅ Publicado y Aprobado' ?>
                        </span>
                        <code class="small"><?= htmlspecialchars($r['id']) ?></code>
                    </div>
                    <span class="small text-muted"><?= htmlspecialchars($r['fecha_publicacion']) ?></span>
                </div>

                <div class="card-body p-4">
                    <div class="d-flex gap-3 mb-3">
                        <img src="<?= htmlspecialchars($r['imagen_portada']) ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 12px;" alt="Miniatura">
                        <div>
                            <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($r['titulo']) ?></h5>
                            <p class="small text-muted mb-0"><strong>Autor:</strong> <?= htmlspecialchars($r['autor']) ?> (<?= htmlspecialchars($r['institucion']) ?>)</p>
                            <span class="badge bg-light text-dark border small mt-1"><?= htmlspecialchars($r['categoria']) ?></span>
                            <span class="badge bg-light text-dark border small mt-1"><?= htmlspecialchars($r['nivel']) ?></span>
                        </div>
                    </div>

                    <p class="small text-secondary mb-3">
                        <?= htmlspecialchars($r['descripcion']) ?>
                    </p>

                    <!-- Simulación de Calificación LORI -->
                    <div class="p-3 bg-light rounded-3 border mb-3 small">
                        <div class="d-flex justify-content-between mb-1">
                            <span>1. Rigor Fonológico y Contenido:</span>
                            <strong class="text-success">5 / 5 ⭐</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>2. Legibilidad Tipográfica Infantil:</span>
                            <strong class="text-success">5 / 5 ⭐</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>3. Adecuación al Proyecto de Aula:</span>
                            <strong class="text-success">4.8 / 5 ⭐</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>4. Licencia y Metadatos Dublin Core:</span>
                            <strong class="text-success">Completo 100%</strong>
                        </div>
                    </div>

                    <?php if (!empty($r['observacion_evaluador'])): ?>
                    <div class="alert alert-info py-2 small mb-3">
                        <strong>Dictamen previo:</strong> <?= htmlspecialchars($r['observacion_evaluador']) ?>
                    </div>
                    <?php endif; ?>

                    <!-- Formulario de Dictamen Curatorial -->
                    <form method="POST" action="evaluacion.php" class="border-top pt-3">
                        <input type="hidden" name="recurso_id" value="<?= htmlspecialchars($r['id']) ?>">
                        
                        <label class="form-label small fw-bold text-dark">Retroalimentación / Dictamen del Comité:</label>
                        <input type="text" name="observacion" class="form-control form-control-sm rounded-3 mb-2" 
                               placeholder="Ej: Aprobado. Las fuentes son claras y las sílabas coinciden con el plan curricular."
                               value="Cumple satisfactoriamente con la escala de pertinencia didáctica LORI.">

                        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mt-2">
                            <a href="<?= htmlspecialchars($r['enlace_recurso']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill">
                                <i class="bi bi-eye"></i> Inspeccionar Material
                            </a>

                            <div class="d-flex gap-2">
                                <button type="submit" name="nuevo_estado" value="En Corrección" class="btn btn-sm btn-outline-warning rounded-pill">
                                    Observar
                                </button>
                                <button type="submit" name="nuevo_estado" value="Aprobado" class="btn btn-sm btn-success rounded-pill fw-bold">
                                    <i class="bi bi-check-lg"></i> Aprobar Recurso
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
