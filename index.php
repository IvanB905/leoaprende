<?php
$pageTitle = "Catálogo de Recursos Didácticos de Lectoescritura";
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/header.php';

$recursos = obtenerRecursos();
$stats = obtenerEstadisticas();

// Filtro por categoría desde URL si existe
$categoriaSeleccionada = $_GET['cat'] ?? '';
?>

<!-- Hero Banner Principal -->
<section class="hero-section">
    <div class="container text-center position-relative" style="z-index: 2;">
        <span class="hero-tag">
            <i class="bi bi-stars text-warning me-1"></i> Recursos Educativos Abiertos para el Aula Infantil
        </span>
        <h1 class="display-4 fw-bold mb-3">Aprender a Leer es una Aventura Mágica 📚✨</h1>
        <p class="lead max-w-700 mx-auto text-light opacity-95 mb-4">
            Repositorio digital de guías imprimibles, juegos interactivos de sílabas y lecturas con pictogramas creadas por y para maestras, enfocado en superar el rezago lector en primera infancia y primer grado.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#catalogo" class="btn btn-warning-custom btn-lg rounded-pill px-4 fw-bold shadow">
                <i class="bi bi-compass-fill me-1"></i> Explorar Recursos
            </a>
            <a href="juegos/ruleta.php" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-bold">
                <i class="bi bi-controller text-warning me-1"></i> Jugar a la Ruleta de Sílabas
            </a>
        </div>
    </div>
</section>

<!-- Caja de Búsqueda y Filtros Facetados -->
<div class="container search-container-box" id="buscador">
    <div class="search-card-main">
        <div class="row g-3 align-items-center">
            <div class="col-lg-5">
                <label class="form-label small fw-bold text-muted mb-1"><i class="bi bi-search"></i> Búsqueda por palabra, fonema o tema:</label>
                <div class="input-group">
                    <input type="text" id="inputBusqueda" class="form-control search-input-lg" 
                           placeholder="Ej: sílabas con M, ruleta, pictogramas, trazos..."
                           value="<?= htmlspecialchars($categoriaSeleccionada) ?>">
                    <button class="btn btn-primary-custom px-4" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <div class="col-sm-6 col-lg-2">
                <label class="form-label small fw-bold text-muted mb-1"><i class="bi bi-mortarboard"></i> Grado / Nivel:</label>
                <select id="selectNivel" class="form-select search-input-lg py-2">
                    <option value="">Todos los niveles</option>
                    <option value="Preescolar">Preescolar / Transición</option>
                    <option value="1° Primaria">1.° Primaria</option>
                    <option value="2° Primaria">2.° Primaria</option>
                    <option value="Refuerzo">Refuerzo y Nivelación</option>
                </select>
            </div>

            <div class="col-sm-6 col-lg-3">
                <label class="form-label small fw-bold text-muted mb-1"><i class="bi bi-file-earmark"></i> Formato del Recurso:</label>
                <select id="selectTipo" class="form-select search-input-lg py-2">
                    <option value="">Todos los formatos</option>
                    <option value="Guía Imprimible">Guía Imprimible (PDF)</option>
                    <option value="Juego Interactivo">Juego Interactivo Web</option>
                    <option value="Lecturas Guiadas">Lecturas con Pictogramas</option>
                    <option value="Grafomotricidad">Fichas de Grafomotricidad</option>
                    <option value="Evaluación">Evaluación Diagnóstica</option>
                </select>
            </div>

            <div class="col-lg-2">
                <label class="form-label small fw-bold text-muted mb-1"><i class="bi bi-alphabet"></i> Letra / Fonema:</label>
                <select id="selectLetra" class="form-select search-input-lg py-2">
                    <option value="">Todas</option>
                    <option value="M">Letra M</option>
                    <option value="P">Letra P</option>
                    <option value="S">Letra S</option>
                    <option value="L">Letra L</option>
                    <option value="T">Letra T</option>
                    <option value="Vocales">Vocales (A, E, I, O, U)</option>
                </select>
            </div>
        </div>

        <!-- Filtros Rápidos / Pills de Categorías -->
        <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top align-items-center">
            <span class="small fw-bold text-muted me-2">Categorías didácticas:</span>
            <a href="#" class="category-pill <?= empty($categoriaSeleccionada) ? 'active' : '' ?>" data-categoria="">
                <i class="bi bi-grid-fill"></i> Todos (<?= $stats['total'] ?>)
            </a>
            <a href="#" class="category-pill <?= $categoriaSeleccionada === 'Método Silábico' ? 'active' : '' ?>" data-categoria="Método Silábico">
                <i class="bi bi-card-text"></i> Método Silábico
            </a>
            <a href="#" class="category-pill <?= $categoriaSeleccionada === 'Juegos Interactivos' ? 'active' : '' ?>" data-categoria="Juegos Interactivos">
                <i class="bi bi-controller"></i> Juegos Interactivos
            </a>
            <a href="#" class="category-pill <?= $categoriaSeleccionada === 'Comprensión Lectora' ? 'active' : '' ?>" data-categoria="Comprensión Lectora">
                <i class="bi bi-book-half"></i> Lecturas con Pictogramas
            </a>
            <a href="#" class="category-pill <?= $categoriaSeleccionada === 'Grafomotricidad y Trazos' ? 'active' : '' ?>" data-categoria="Grafomotricidad y Trazos">
                <i class="bi bi-pencil-fill"></i> Grafomotricidad
            </a>
            <a href="#" class="category-pill <?= $categoriaSeleccionada === 'Diagnóstico y Evaluación' ? 'active' : '' ?>" data-categoria="Diagnóstico y Evaluación">
                <i class="bi bi-clipboard-check"></i> Diagnóstico de Aula
            </a>
        </div>
    </div>
</div>

<!-- Catálogo de Tarjetas de Recursos -->
<main class="container my-5" id="catalogo">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Colección de Materiales Didácticos</h2>
            <p class="text-muted small mb-0" id="contadorResultados">Mostrando <?= count($recursos) ?> recursos pedagógicos disponibles</p>
        </div>
        <div class="d-none d-md-flex align-items-center gap-2 small text-muted">
            <span class="badge bg-light text-dark border"><i class="bi bi-check-circle-fill text-success"></i> Curados con estándar LOM</span>
            <span class="badge bg-light text-dark border"><i class="bi bi-shield-check text-primary"></i> Dublin Core Metadata</span>
        </div>
    </div>

    <!-- Rejilla de Recursos -->
    <div class="row g-4" id="contenedorTarjetas">
        <?php foreach ($recursos as $r): 
            $letrasStr = implode(', ', $r['letras'] ?? []);
        ?>
        <div class="col-md-6 col-lg-4 tarjeta-recurso-item"
             data-titulo="<?= strtolower(htmlspecialchars($r['titulo'])) ?>"
             data-desc="<?= strtolower(htmlspecialchars($r['descripcion'])) ?>"
             data-cat="<?= htmlspecialchars($r['categoria']) ?>"
             data-nivel="<?= htmlspecialchars($r['nivel']) ?>"
             data-tipo="<?= htmlspecialchars($r['tipo']) ?>"
             data-letras="<?= htmlspecialchars($letrasStr) ?>">
            
            <div class="resource-card">
                <div class="card-img-wrapper">
                    <img src="<?= htmlspecialchars($r['imagen_portada']) ?>" class="card-img-top" alt="<?= htmlspecialchars($r['titulo']) ?>">
                    <span class="card-badge-type bg-<?= $r['color'] ?? 'primary' ?> text-white">
                        <i class="bi <?= $r['icono'] ?? 'bi-file-earmark' ?>"></i> <?= htmlspecialchars($r['tipo']) ?>
                    </span>
                    <span class="card-badge-grade">
                        <i class="bi bi-mortarboard-fill"></i> <?= htmlspecialchars($r['nivel']) ?>
                    </span>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="tag-skill"><?= htmlspecialchars($r['habilidad']) ?></span>
                        <span class="small text-warning fw-bold">
                            <i class="bi bi-star-fill"></i> <?= number_format($r['valoracion'], 1) ?> (<?= $r['total_votos'] ?>)
                        </span>
                    </div>

                    <h5 class="card-title">
                        <a href="recurso.php?id=<?= urlencode($r['id']) ?>">
                            <?= htmlspecialchars($r['titulo']) ?>
                        </a>
                    </h5>

                    <p class="resource-desc">
                        <?= htmlspecialchars($r['descripcion']) ?>
                    </p>

                    <!-- Letras / Fonemas cubiertos -->
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1 fw-bold">Fonemas / Sílabas trabajadas:</small>
                        <?php foreach (($r['letras'] ?? []) as $letra): ?>
                            <span class="pill-letter"><?= htmlspecialchars($letra) ?></span>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                        <span class="small text-muted">
                            <i class="bi bi-download text-secondary"></i> <span id="contador-descargas-<?= $r['id'] ?>"><?= $r['descargas'] ?></span> descargas
                        </span>

                        <div class="d-flex gap-1">
                            <a href="recurso.php?id=<?= urlencode($r['id']) ?>" class="btn btn-sm btn-outline-primary fw-bold rounded-pill px-3" title="Ver Ficha y Metadatos Dublin Core">
                                Ficha Técnica
                            </a>
                            <?php if (strpos($r['tipo'], 'Juego') !== false): ?>
                            <a href="juegos/ruleta.php" class="btn btn-sm btn-success fw-bold rounded-pill px-3">
                                <i class="bi bi-play-fill"></i> Jugar
                            </a>
                            <?php else: ?>
                            <a href="<?= htmlspecialchars($r['enlace_recurso']) ?>" target="_blank" 
                               onclick="registrarDescarga('<?= $r['id'] ?>')" 
                               class="btn btn-sm btn-warning-custom fw-bold rounded-pill px-3 text-dark">
                                <i class="bi bi-cloud-arrow-down-fill"></i> Descargar
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Mensaje si no hay resultados -->
    <div id="mensajeSinResultados" class="text-center py-5" style="display: none;">
        <div class="display-1 text-muted mb-3"><i class="bi bi-search"></i></div>
        <h4 class="fw-bold text-dark">No se encontraron recursos con esos filtros</h4>
        <p class="text-muted">Prueba buscando otra consonante (ej: M, P, S), cambiando de grado o limpiando el buscador.</p>
        <button class="btn btn-outline-primary rounded-pill px-4" onclick="document.getElementById('inputBusqueda').value=''; document.getElementById('selectNivel').value=''; document.getElementById('selectTipo').value=''; document.getElementById('selectLetra').value=''; document.getElementById('inputBusqueda').dispatchEvent(new Event('input'));">
            Ver todos los recursos
        </button>
    </div>
</main>

<!-- Sección Pedagógica: Pertinencia del Proyecto de Aula -->
<section class="bg-white py-5 border-top">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill mb-2">
                    <i class="bi bi-lightbulb-fill"></i> Justificación Pedagógica del Proyecto
                </span>
                <h2 class="fw-bold text-dark mb-3">¿Por qué este Repositorio de Lectoescritura?</h2>
                <p class="text-muted">
                    La transición entre preescolar y primer grado representa un momento crítico en el desarrollo cognitivo infantil. Muchos niños enfrentan dificultades de decodificación y discriminación fonológica que, si no se atienden oportunamente, devienen en rezago escolar crónico.
                </p>
                <div class="row g-3 mt-2">
                    <div class="col-sm-6">
                        <div class="d-flex gap-3">
                            <div class="fs-2 text-warning"><i class="bi bi-puzzle-fill"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Método Silábico y Fonético</h6>
                                <p class="small text-muted">Avanza desde el sonido de las letras hasta la formación de palabras y oraciones con significado.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex gap-3">
                            <div class="fs-2 text-success"><i class="bi bi-controller"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Aprendizaje Lúdico</h6>
                                <p class="small text-muted">Juegos interactivos que motivan al estudiante y reducen la ansiedad frente al error lector.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex gap-3">
                            <div class="fs-2 text-info"><i class="bi bi-eye-fill"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Apoyo con Pictogramas</h6>
                                <p class="small text-muted">Facilita la comprensión lectora temprana mediante andamiajes visuales y contextuales.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex gap-3">
                            <div class="fs-2 text-danger"><i class="bi bi-file-earmark-check-fill"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Diagnóstico Oportuno</h6>
                                <p class="small text-muted">Instrumentos rápidos para que la maestra identifique rezagos y adapte su proyecto de aula.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow rounded-4 p-4 bg-light">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-diagram-3-fill text-primary"></i> Arquitectura del Repositorio</h5>
                    <div class="p-3 bg-white rounded-3 border mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong class="text-primary"><i class="bi bi-tags-fill"></i> Estándar de Metadatos</strong>
                            <span class="badge bg-success">Completado</span>
                        </div>
                        <small class="text-muted">Implementación de los 15 campos Dublin Core + Perfil de categorización pedagógica IEEE LOM.</small>
                    </div>
                    <div class="p-3 bg-white rounded-3 border mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong class="text-warning text-dark"><i class="bi bi-people-fill"></i> Roles de Usuario Articulados</strong>
                            <span class="badge bg-info text-dark">4 Roles</span>
                        </div>
                        <small class="text-muted">Estudiante/Familia (Modo Lúdico), Docente (Subida/Descarga), Evaluador (Rúbrica LORI) y Administrador.</small>
                    </div>
                    <div class="p-3 bg-white rounded-3 border">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong class="text-danger"><i class="bi bi-journal-check"></i> Documento Escrito Formal</strong>
                            <span class="badge bg-secondary">Normas APA 7</span>
                        </div>
                        <small class="text-muted">Monografía académica con justificación, marcos conceptuales, tablas de metadatos y declaración de uso ético de IAG.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
