<?php
// Configuración y gestor de datos para LeoAprende
define('DATA_FILE', __DIR__ . '/../data/recursos.json');

function obtenerRecursos() {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $contenido = file_get_contents(DATA_FILE);
    $datos = json_decode($contenido, true);
    return is_array($datos) ? $datos : [];
}

function guardarRecursos($recursos) {
    return file_put_contents(DATA_FILE, json_encode($recursos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function obtenerRecursoPorId($id) {
    $recursos = obtenerRecursos();
    foreach ($recursos as $r) {
        if ($r['id'] === $id) {
            return $r;
        }
    }
    return null;
}

function agregarRecurso($nuevoRecurso) {
    $recursos = obtenerRecursos();
    $recursos[] = $nuevoRecurso;
    return guardarRecursos($recursos);
}

function actualizarEstadoRecurso($id, $nuevoEstado, $observacion = '') {
    $recursos = obtenerRecursos();
    $modificado = false;
    foreach ($recursos as &$r) {
        if ($r['id'] === $id) {
            $r['estado'] = $nuevoEstado;
            if (!empty($observacion)) {
                $r['observacion_evaluador'] = $observacion;
            }
            $modificado = true;
            break;
        }
    }
    if ($modificado) {
        guardarRecursos($recursos);
    }
    return $modificado;
}

function incrementarDescargas($id) {
    $recursos = obtenerRecursos();
    $modificado = false;
    foreach ($recursos as &$r) {
        if ($r['id'] === $id) {
            $r['descargas'] = ($r['descargas'] ?? 0) + 1;
            $modificado = true;
            break;
        }
    }
    if ($modificado) {
        guardarRecursos($recursos);
    }
    return $modificado;
}

function obtenerEstadisticas() {
    $recursos = obtenerRecursos();
    $total = count($recursos);
    $aprobados = 0;
    $pendientes = 0;
    $totalDescargas = 0;
    $categorias = [];

    foreach ($recursos as $r) {
        if (($r['estado'] ?? '') === 'Aprobado') {
            $aprobados++;
        } else {
            $pendientes++;
        }
        $totalDescargas += (int)($r['descargas'] ?? 0);
        $cat = $r['categoria'] ?? 'General';
        $categorias[$cat] = ($categorias[$cat] ?? 0) + 1;
    }

    return [
        'total' => $total,
        'aprobados' => $aprobados,
        'pendientes' => $pendientes,
        'totalDescargas' => $totalDescargas,
        'categorias' => $categorias
    ];
}
