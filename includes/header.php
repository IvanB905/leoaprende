<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Rol por defecto: docente (se puede cambiar con ?rol=estudiante|docente|evaluador|admin)
if (isset($_GET['rol'])) {
    $_SESSION['rol_activo'] = $_GET['rol'];
}
$rolActivo = $_SESSION['rol_activo'] ?? 'docente';

$rolesInfo = [
    'estudiante' => ['nombre' => 'Niño / Familia', 'badge' => 'bg-info text-dark', 'icono' => 'bi-emoji-smile', 'desc' => 'Modo Lúdico para aprender jugando'],
    'docente' => ['nombre' => 'Docente de Aula', 'badge' => 'bg-success', 'icono' => 'bi-person-badge', 'desc' => 'Descarga directa y aporte de recursos'],
    'evaluador' => ['nombre' => 'Comité Evaluador', 'badge' => 'bg-warning text-dark', 'icono' => 'bi-clipboard-check', 'desc' => 'Curaduría pedagógica y calidad'],
    'admin' => ['nombre' => 'Administrador', 'badge' => 'bg-danger', 'icono' => 'bi-shield-lock', 'desc' => 'Gestión general y métricas']
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' : '' ?>LeoAprende | Repositorio de Recursos para la Lectoescritura</title>
    <!-- Fuentes Google amigables para educación -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS y Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<!-- Barra Superior de Simulación de Roles -->
<div class="role-bar py-1 px-3 border-bottom text-white">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2 small">
            <span class="badge bg-white text-dark fw-bold"><i class="bi bi-person-gear"></i> Rol Simulado:</span>
            <span class="badge <?= $rolesInfo[$rolActivo]['badge'] ?> px-2 py-1">
                <i class="<?= $rolesInfo[$rolActivo]['icono'] ?>"></i> <?= $rolesInfo[$rolActivo]['nombre'] ?>
            </span>
            <span class="d-none d-md-inline text-light opacity-75">| <?= $rolesInfo[$rolActivo]['desc'] ?></span>
        </div>
        <div class="d-flex align-items-center gap-1 mt-1 mt-md-0">
            <span class="small text-white-50 me-1 d-none d-sm-inline">Cambiar rol:</span>
            <a href="?rol=estudiante" class="btn btn-xs btn-outline-light <?= $rolActivo === 'estudiante' ? 'active fw-bold' : '' ?>" title="Modo Niño / Familia">
                <i class="bi bi-emoji-smile"></i> Familia
            </a>
            <a href="?rol=docente" class="btn btn-xs btn-outline-light <?= $rolActivo === 'docente' ? 'active fw-bold' : '' ?>" title="Modo Maestra / Docente">
                <i class="bi bi-person-badge"></i> Maestra
            </a>
            <a href="?rol=evaluador" class="btn btn-xs btn-outline-light <?= $rolActivo === 'evaluador' ? 'active fw-bold' : '' ?>" title="Modo Evaluador Curador">
                <i class="bi bi-clipboard-check"></i> Evaluador
            </a>
            <a href="?rol=admin" class="btn btn-xs btn-outline-light <?= $rolActivo === 'admin' ? 'active fw-bold' : '' ?>" title="Modo Administrador">
                <i class="bi bi-shield-lock"></i> Admin
            </a>
        </div>
    </div>
</div>

<!-- Header Principal / Navbar -->
<nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm py-2">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <div class="brand-logo-icon">
                <i class="bi bi-book-half"></i>
            </div>
            <div>
                <span class="brand-title">Leo<span class="text-warning-custom">Aprende</span></span>
                <span class="d-block brand-subtitle">Repositorio de Lectoescritura Inicial</span>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active fw-bold text-primary' : '' ?>" href="index.php">
                        <i class="bi bi-grid-fill me-1"></i> Catálogo de Recursos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="juegos/ruleta.php">
                        <i class="bi bi-controller text-success me-1"></i> Ruleta de Sílabas
                    </a>
                </li>
                <?php if (in_array($rolActivo, ['docente', 'evaluador', 'admin'])): ?>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'subir.php' ? 'active fw-bold text-primary' : '' ?>" href="subir.php">
                        <i class="bi bi-cloud-arrow-up-fill text-primary me-1"></i> Subir Recurso
                    </a>
                </li>
                <?php endif; ?>
                <?php if (in_array($rolActivo, ['evaluador', 'admin'])): ?>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'evaluacion.php' ? 'active fw-bold text-primary' : '' ?>" href="evaluacion.php">
                        <i class="bi bi-clipboard-check-fill text-warning me-1"></i> Curaduría LORI
                    </a>
                </li>
                <?php endif; ?>
                <?php if ($rolActivo === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active fw-bold text-primary' : '' ?>" href="admin.php">
                        <i class="bi bi-speedometer2 text-danger me-1"></i> Panel Admin
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="documento_entrega_apa7.html" target="_blank">
                        <i class="bi bi-file-earmark-text-fill text-info me-1"></i> Documento APA 7
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <a href="index.php#buscador" class="btn btn-warning-custom rounded-pill px-3 py-1 fw-bold text-dark shadow-sm">
                    <i class="bi bi-search me-1"></i> Buscar Fichas
                </a>
                <?php if ($rolActivo === 'docente' || $rolActivo === 'admin'): ?>
                <a href="subir.php" class="btn btn-primary-custom rounded-pill px-3 py-1 fw-bold text-white shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> Nueva Ficha
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
