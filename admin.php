<?php
$pageTitle = "Panel de Administración | Métricas del Repositorio";
require_once __DIR__ . '/includes/data.php';

$stats = obtenerEstadisticas();
$recursos = obtenerRecursos();
require_once __DIR__ . '/includes/header.php';
?>

<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Panel de Administración</li>
        </ol>
    </nav>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <span class="badge bg-danger fw-bold px-3 py-1 rounded-pill mb-1">
                <i class="bi bi-shield-lock-fill"></i> Módulo de Gestión y Gobernanza
            </span>
            <h2 class="fw-bold text-dark mb-0">Panel de Control y Estadísticas</h2>
            <p class="text-muted small mb-0">Monitoreo del impacto de los recursos en las aulas escolares y estado de la colección.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="data/recursos.json" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                <i class="bi bi-filetype-json"></i> Exportar Datos (JSON)
            </a>
            <a href="index.php" class="btn btn-sm btn-outline-secondary rounded-pill">
                <i class="bi bi-arrow-left"></i> Catálogo Público
            </a>
        </div>
    </div>

    <!-- Tarjetas de Métricas Principales -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold d-block">TOTAL RECURSOS</span>
                        <span class="fs-2 fw-bold text-primary"><?= $stats['total'] ?></span>
                    </div>
                    <div class="p-3 bg-primary-subtle text-primary rounded-3 fs-3">
                        <i class="bi bi-folder2-open"></i>
                    </div>
                </div>
                <small class="text-success mt-2 d-block"><i class="bi bi-arrow-up-short"></i> 100% catalogados con Dublin Core</small>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold d-block">RECURSOS APROBADOS</span>
                        <span class="fs-2 fw-bold text-success"><?= $stats['aprobados'] ?></span>
                    </div>
                    <div class="p-3 bg-success-subtle text-success rounded-3 fs-3">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                </div>
                <small class="text-muted mt-2 d-block">Disponibles para libre descarga</small>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold d-block">EN REVISIÓN / AJUSTES</span>
                        <span class="fs-2 fw-bold text-warning"><?= $stats['pendientes'] ?></span>
                    </div>
                    <div class="p-3 bg-warning-subtle text-warning rounded-3 fs-3">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                <small class="text-warning mt-2 d-block"><a href="evaluacion.php" class="text-decoration-none text-warning fw-bold">Ver pendientes →</a></small>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold d-block">DESCARGAS EN AULA</span>
                        <span class="fs-2 fw-bold text-danger"><?= number_format($stats['totalDescargas']) ?></span>
                    </div>
                    <div class="p-3 bg-danger-subtle text-danger rounded-3 fs-3">
                        <i class="bi bi-cloud-arrow-down"></i>
                    </div>
                </div>
                <small class="text-success mt-2 d-block"><i class="bi bi-graph-up-arrow"></i> Alto impacto docente</small>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Distribución por Categoría Didáctica -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-pie-chart-fill text-primary"></i> Recursos por Categoría Pedagógica</h5>
                
                <div class="d-flex flex-column gap-3">
                    <?php 
                    $colores = ['bg-primary', 'bg-success', 'bg-warning', 'bg-info', 'bg-danger'];
                    $i = 0;
                    foreach ($stats['categorias'] as $cat => $cant): 
                        $porcentaje = round(($cant / max(1, $stats['total'])) * 100);
                        $color = $colores[$i % count($colores)];
                        $i++;
                    ?>
                    <div>
                        <div class="d-flex justify-content-between small fw-bold mb-1">
                            <span><?= htmlspecialchars($cat) ?></span>
                            <span><?= $cant ?> material(es) (<?= $porcentaje ?>%)</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 10px;">
                            <div class="progress-bar <?= $color ?>" role="progressbar" style="width: <?= $porcentaje ?>%"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="alert alert-light border rounded-3 mt-4 mb-0 small text-muted">
                    <i class="bi bi-info-circle-fill text-info me-1"></i>
                    El <strong>Método Silábico</strong> y los <strong>Juegos Interactivos</strong> concentran el mayor número de consultas por parte de las maestras de primer grado.
                </div>
            </div>
        </div>

        <!-- Matriz de Roles y Permisos -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-people-fill text-warning"></i> Matriz de Roles del Repositorio</h5>
                
                <div class="table-responsive">
                    <table class="table table-sm table-bordered align-middle small">
                        <thead class="table-light">
                            <tr>
                                <th>Rol de Usuario</th>
                                <th>Buscar y Descargar</th>
                                <th>Cargar Recursos</th>
                                <th>Curaduría LORI</th>
                                <th>Gestión Global</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Estudiante / Familia</strong></td>
                                <td class="text-center text-success">✓</td>
                                <td class="text-center text-muted">✗</td>
                                <td class="text-center text-muted">✗</td>
                                <td class="text-center text-muted">✗</td>
                            </tr>
                            <tr>
                                <td><strong>Docente de Aula</strong></td>
                                <td class="text-center text-success">✓</td>
                                <td class="text-center text-success">✓</td>
                                <td class="text-center text-muted">✗</td>
                                <td class="text-center text-muted">✗</td>
                            </tr>
                            <tr>
                                <td><strong>Comité Evaluador</strong></td>
                                <td class="text-center text-success">✓</td>
                                <td class="text-center text-success">✓</td>
                                <td class="text-center text-success">✓</td>
                                <td class="text-center text-muted">✗</td>
                            </tr>
                            <tr class="table-primary">
                                <td><strong>Administrador</strong></td>
                                <td class="text-center text-success">✓</td>
                                <td class="text-center text-success">✓</td>
                                <td class="text-center text-success">✓</td>
                                <td class="text-center text-success">✓</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-3 bg-light rounded-3 border mt-3 small">
                    <strong>Gobernanza Institucional:</strong> Garantiza la calidad de los recursos educativos abiertos antes de su incorporación al catálogo escolar.
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla Detallada de Recursos -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Inventario General de Materiales</h5>
            <span class="badge bg-secondary"><?= count($recursos) ?> registrados</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Título del Recurso</th>
                        <th>Tipo</th>
                        <th>Nivel</th>
                        <th>Autor(a)</th>
                        <th>Descargas</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recursos as $r): ?>
                    <tr>
                        <td><code><?= htmlspecialchars($r['id']) ?></code></td>
                        <td>
                            <strong><?= htmlspecialchars($r['titulo']) ?></strong>
                            <span class="d-block text-muted" style="font-size: 0.75rem;">
                                Fonemas: <?= implode(', ', $r['letras'] ?? []) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($r['tipo']) ?></td>
                        <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($r['nivel']) ?></span></td>
                        <td><?= htmlspecialchars($r['autor']) ?></td>
                        <td><i class="bi bi-download text-muted"></i> <?= number_format($r['descargas']) ?></td>
                        <td>
                            <?php if (($r['estado'] ?? '') === 'Aprobado'): ?>
                                <span class="badge bg-success">Aprobado</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">En Revisión</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="recurso.php?id=<?= urlencode($r['id']) ?>" class="btn btn-xs btn-outline-primary">
                                Ver Ficha
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
