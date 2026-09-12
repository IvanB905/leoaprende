<?php
header('Content-Type: application/json');
require_once __DIR__ . '/includes/data.php';

$id = $_GET['id'] ?? '';
if (!empty($id)) {
    incrementarDescargas($id);
    $rec = obtenerRecursoPorId($id);
    echo json_encode([
        'exito' => true,
        'descargas' => $rec['descargas'] ?? 0
    ]);
} else {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'ID no proporcionado'
    ]);
}
