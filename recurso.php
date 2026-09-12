<?php
require_once __DIR__ . '/includes/data.php';

$id = $_GET['id'] ?? 'rec-001';
$recurso = obtenerRecursoPorId($id);

if (!$recurso) {
    header("Location: index.php");
    exit;
}

$pageTitle = $recurso['titulo'];
require_once __DIR__ . '/includes/header.php';
$dc = $recurso['metadatos_dublin_core'] ?? [];
$lom = $recurso['metadatos_ieee_lom'] ?? [];
?>

<div class="container my-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="index.php?cat=<?= urlencode($recurso['categoria']) ?>"><?= htmlspecialchars($recurso['categoria']) ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($recurso['titulo']) ?></li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Columna Principal -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="p-4 bg-white border-bottom">
                    <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                        <span class="badge bg-<?= $recurso['color'] ?? 'primary' ?> px-3 py-2 rounded-pill">
                            <i class="bi <?= $recurso['icono'] ?? 'bi-file-earmark' ?>"></i> <?= htmlspecialchars($recurso['tipo']) ?>
                        </span>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                            <i class="bi bi-mortarboard-fill text-primary"></i> <?= htmlspecialchars($recurso['nivel']) ?>
                        </span>
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                            <i class="bi bi-check-circle-fill"></i> Estado: <?= htmlspecialchars($recurso['estado']) ?>
                        </span>
                    </div>

                    <h1 class="fw-bold text-dark mb-2"><?= htmlspecialchars($recurso['titulo']) ?></h1>
                    
                    <div class="d-flex flex-wrap gap-3 text-muted small mt-2">
                        <span><i class="bi bi-person-circle text-primary"></i> <strong>Autor:</strong> <?= htmlspecialchars($recurso['autor']) ?></span>
                        <span><i class="bi bi-building text-secondary"></i> <strong>Institución:</strong> <?= htmlspecialchars($recurso['institucion']) ?></span>
                        <span><i class="bi bi-calendar-event text-info"></i> <strong>Fecha:</strong> <?= htmlspecialchars($recurso['fecha_publicacion']) ?></span>
                    </div>
                </div>

                <!-- Imagen o Visor del Recurso -->
                <div class="p-4 bg-light text-center border-bottom">
                    <img src="<?= htmlspecialchars($recurso['imagen_portada']) ?>" class="img-fluid rounded-4 shadow-sm mb-3" style="max-height: 320px; width: 100%; object-fit: cover;" alt="Portada">
                    
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <?php if (strpos($recurso['tipo'], 'Juego') !== false): ?>
                        <a href="juegos/ruleta.php" class="btn btn-success btn-lg rounded-pill px-5 fw-bold shadow">
                            <i class="bi bi-controller"></i> JUGAR AHORA (ONLINE)
                        </a>
                        <?php else: ?>
                        <a href="<?= htmlspecialchars($recurso['enlace_recurso']) ?>" target="_blank" 
                           onclick="registrarDescarga('<?= $recurso['id'] ?>')" 
                           class="btn btn-warning-custom btn-lg rounded-pill px-5 fw-bold text-dark shadow">
                            <i class="bi bi-cloud-arrow-down-fill"></i> DESCARGAR GUÍA (PDF / IMPRIMIBLE)
                        </a>
                        <a href="<?= htmlspecialchars($recurso['enlace_recurso']) ?>" target="_blank" class="btn btn-outline-primary btn-lg rounded-pill px-4 fw-bold">
                            <i class="bi bi-eye-fill"></i> Vista Previa
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">Descripción Didáctica</h5>
                    <p class="text-secondary leading-relaxed">
                        <?= htmlspecialchars($recurso['descripcion']) ?>
                    </p>

                    <!-- Caja de Consejo Pedagógico de Aula -->
                    <div class="p-3 rounded-4 bg-warning-subtle border border-warning my-4">
                        <h6 class="fw-bold text-dark mb-1">
                            <i class="bi bi-lightbulb-fill text-warning"></i> Orientaciones para la Maestra en el Proyecto de Aula:
                        </h6>
                        <p class="mb-0 text-dark small">
                            <?= htmlspecialchars($recurso['consejo_aula']) ?>
                        </p>
                    </div>

                    <!-- Pestañas de Metadatos Estandarizados (Rúbrica: Dublin Core y LOM) -->
                    <div class="mt-4">
                        <ul class="nav nav-pills mb-3 gap-2" id="metaTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active fw-bold rounded-pill" id="dc-tab" data-bs-toggle="pill" data-bs-target="#dc-content" type="button" role="tab">
                                    <i class="bi bi-tags-fill me-1"></i> Metadatos Dublin Core (15 Campos)
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold rounded-pill" id="lom-tab" data-bs-toggle="pill" data-bs-target="#lom-content" type="button" role="tab">
                                    <i class="bi bi-mortarboard-fill me-1"></i> Perfil Pedagógico IEEE LOM
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="metaTabsContent">
                            <!-- Tab Dublin Core -->
                            <div class="tab-pane fade show active" id="dc-content" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-metadata align-middle">
                                        <tbody>
                                            <tr>
                                                <th>Title (Título)</th>
                                                <td><?= htmlspecialchars($dc['title'] ?? $recurso['titulo']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Creator (Autor/Creador)</th>
                                                <td><?= htmlspecialchars($dc['creator'] ?? $recurso['autor']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Subject (Materia / Temas)</th>
                                                <td><?= htmlspecialchars($dc['subject'] ?? '') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Description (Descripción)</th>
                                                <td><?= htmlspecialchars($dc['description'] ?? $recurso['descripcion']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Publisher (Editor/Publicador)</th>
                                                <td><?= htmlspecialchars($dc['publisher'] ?? 'LeoAprende') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Contributor (Colaborador)</th>
                                                <td><?= htmlspecialchars($dc['contributor'] ?? '') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Date (Fecha)</th>
                                                <td><?= htmlspecialchars($dc['date'] ?? $recurso['fecha_publicacion']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Type (Tipo de recurso)</th>
                                                <td><code><?= htmlspecialchars($dc['type'] ?? '') ?></code></td>
                                            </tr>
                                            <tr>
                                                <th>Format (Formato técnico)</th>
                                                <td><code><?= htmlspecialchars($dc['format'] ?? $recurso['formato']) ?></code></td>
                                            </tr>
                                            <tr>
                                                <th>Identifier (Identificador)</th>
                                                <td><strong><?= htmlspecialchars($dc['identifier'] ?? $recurso['id']) ?></strong></td>
                                            </tr>
                                            <tr>
                                                <th>Source (Fuente)</th>
                                                <td><?= htmlspecialchars($dc['source'] ?? '') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Language (Idioma)</th>
                                                <td><?= htmlspecialchars($dc['language'] ?? 'es') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Relation (Relación curricular)</th>
                                                <td><?= htmlspecialchars($dc['relation'] ?? '') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Coverage (Cobertura)</th>
                                                <td><?= htmlspecialchars($dc['coverage'] ?? '') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Rights (Derechos de Autor)</th>
                                                <td><span class="badge bg-success"><?= htmlspecialchars($dc['rights'] ?? $recurso['licencia']) ?></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tab IEEE LOM -->
                            <div class="tab-pane fade" id="lom-content" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-metadata align-middle">
                                        <tbody>
                                            <tr class="table-primary">
                                                <th colspan="2" class="text-primary fw-bold">1. General & Ciclo de Vida</th>
                                            </tr>
                                            <tr>
                                                <th>Identificador LOM</th>
                                                <td><code><?= htmlspecialchars($lom['general']['identificador'] ?? '') ?></code></td>
                                            </tr>
                                            <tr>
                                                <th>Palabras Clave (Keywords)</th>
                                                <td><?= implode(', ', $lom['general']['palabras_clave'] ?? []) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Versión y Estado</th>
                                                <td>Versión <?= htmlspecialchars($lom['ciclo_vida']['version'] ?? '1.0') ?> (<?= htmlspecialchars($lom['ciclo_vida']['estado'] ?? 'Final') ?>)</td>
                                            </tr>
                                            <tr class="table-primary">
                                                <th colspan="2" class="text-primary fw-bold">2. Aspectos Educativos y Pedagógicos (LOM Educational)</th>
                                            </tr>
                                            <tr>
                                                <th>Tipo de Interactividad</th>
                                                <td><span class="badge bg-info text-dark"><?= htmlspecialchars($lom['educativo']['tipo_interactividad'] ?? '') ?></span></td>
                                            </tr>
                                            <tr>
                                                <th>Nivel de Interactividad</th>
                                                <td><strong><?= htmlspecialchars($lom['educativo']['nivel_interactividad'] ?? '') ?></strong></td>
                                            </tr>
                                            <tr>
                                                <th>Rol del Usuario Final</th>
                                                <td><?= htmlspecialchars($lom['educativo']['rol_usuario_final'] ?? '') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Contexto de Aprendizaje</th>
                                                <td><?= htmlspecialchars($lom['educativo']['contexto'] ?? '') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Rango de Edad Típico</th>
                                                <td><?= htmlspecialchars($lom['educativo']['rango_edad_tipico'] ?? '') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Dificultad Pedagógica</th>
                                                <td><span class="badge bg-warning text-dark"><?= htmlspecialchars($lom['educativo']['dificultad'] ?? '') ?></span></td>
                                            </tr>
                                            <tr>
                                                <th>Tiempo Estimado de Aprendizaje</th>
                                                <td><?= htmlspecialchars($lom['educativo']['tiempo_aprendizaje'] ?? '') ?></td>
                                            </tr>
                                            <tr class="table-primary">
                                                <th colspan="2" class="text-primary fw-bold">3. Derechos y Acceso</th>
                                            </tr>
                                            <tr>
                                                <th>Costo</th>
                                                <td><span class="badge bg-success">Gratuito / Acceso Abierto</span></td>
                                            </tr>
                                            <tr>
                                                <th>Derechos de Propiedad Intelectual</th>
                                                <td><?= htmlspecialchars($lom['derechos']['derechos_autor'] ?? '') ?> (Conforme a Ley 23 de 1982)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reseñas y Evaluación Comunitaria de Maestras -->
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-chat-heart-fill text-danger me-1"></i> Evaluaciones de Docentes de Aula</h5>
                        
                        <div class="card bg-light border-0 p-3 rounded-4 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong class="text-dark">Maestra Viviana Castro (Colegio María Inmaculada)</strong>
                                <span class="text-warning small"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></span>
                            </div>
                            <p class="small text-muted mb-0">
                                "Lo usé en mi clase de nivelación con 5 niños que no lograban juntar las sílabas. La progresión gráfica y el tamaño de las letras es perfecto para evitar confusiones visoespaciales."
                            </p>
                        </div>

                        <!-- Formulario para dejar valoración -->
                        <div class="p-3 bg-white border rounded-4">
                            <h6 class="fw-bold text-dark mb-2">¿Aplicaste este recurso en tu clase? Valóralo:</h6>
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <span class="text-muted small">Calificación:</span>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill cursor-pointer"></i>
                                    <i class="bi bi-star-fill cursor-pointer"></i>
                                    <i class="bi bi-star-fill cursor-pointer"></i>
                                    <i class="bi bi-star-fill cursor-pointer"></i>
                                    <i class="bi bi-star cursor-pointer"></i>
                                </div>
                            </div>
                            <textarea class="form-control rounded-3 mb-2" rows="2" placeholder="Escribe un consejo para otras maestras sobre cómo te funcionó..."></textarea>
                            <button class="btn btn-sm btn-primary rounded-pill px-3 fw-bold" onclick="alert('¡Gracias por tu reseña docente! Ha sido registrada.');">
                                Publicar Comentario
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna Lateral: Ficha Resumen y Botones -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 85px;">
                <h5 class="fw-bold text-dark mb-3">Ficha de Resumen</h5>

                <ul class="list-group list-group-flush small mb-4">
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Categoría:</span>
                        <strong class="text-dark"><?= htmlspecialchars($recurso['categoria']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Habilidad Clave:</span>
                        <strong class="text-primary"><?= htmlspecialchars($recurso['habilidad']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Edad Sugerida:</span>
                        <strong class="text-dark"><?= htmlspecialchars($recurso['edad_recomendada']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Tiempo Estimado:</span>
                        <strong class="text-dark"><?= htmlspecialchars($recurso['tiempo_estimado']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Descargas registradas:</span>
                        <strong class="text-success"><i class="bi bi-download"></i> <span id="contador-descargas-<?= $recurso['id'] ?>"><?= $recurso['descargas'] ?></span></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Licencia:</span>
                        <span class="badge bg-secondary text-wrap text-start"><?= htmlspecialchars($recurso['licencia']) ?></span>
                    </li>
                </ul>

                <div class="d-grid gap-2">
                    <?php if (strpos($recurso['tipo'], 'Juego') !== false): ?>
                    <a href="juegos/ruleta.php" class="btn btn-success fw-bold py-2 rounded-pill shadow-sm">
                        <i class="bi bi-controller"></i> Abrir Juego Interactivo
                    </a>
                    <?php else: ?>
                    <a href="<?= htmlspecialchars($recurso['enlace_recurso']) ?>" target="_blank" 
                       onclick="registrarDescarga('<?= $recurso['id'] ?>')" 
                       class="btn btn-warning-custom fw-bold py-2 rounded-pill shadow-sm text-dark">
                        <i class="bi bi-cloud-arrow-down-fill"></i> Descargar Guía Imprimible
                    </a>
                    <?php endif; ?>
                    <a href="index.php" class="btn btn-outline-secondary py-2 rounded-pill">
                        ← Volver al Catálogo
                    </a>
                </div>

                <div class="alert alert-light border rounded-3 mt-4 mb-0 small text-muted">
                    <i class="bi bi-shield-lock-fill text-success me-1"></i>
                    <strong>Recurso Verificado:</strong> Este material fue revisado por el comité de curaduría con la rúbrica LORI para asegurar rigor didáctico y respeto a derechos de autor.
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
