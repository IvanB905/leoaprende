<?php
$pageTitle = "La Ruleta Mágica de las Sílabas | Juego Interactivo";
require_once __DIR__ . '/../includes/data.php';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="../index.php?cat=Juegos+Interactivos">Juegos Interactivos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ruleta de Sílabas</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="bg-primary-custom text-white p-4 text-center position-relative">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill mb-2">
                        <i class="bi bi-controller"></i> Recurso Lúdico Digital
                    </span>
                    <h2 class="fw-bold mb-1">🎡 La Ruleta Mágica de las Sílabas</h2>
                    <p class="mb-0 opacity-90">Gira la ruleta, escucha el sonido y descubre palabras divertidas</p>
                </div>

                <div class="card-body p-4 text-center">
                    <!-- Marcador para el niño -->
                    <div class="d-flex justify-content-center gap-4 mb-4">
                        <div class="bg-light px-4 py-2 rounded-3 border">
                            <span class="d-block text-muted small fw-bold">PUNTOS</span>
                            <span class="fs-3 fw-bold text-success" id="contadorPuntos">⭐ 0</span>
                        </div>
                        <div class="bg-light px-4 py-2 rounded-3 border">
                            <span class="d-block text-muted small fw-bold">GIROS</span>
                            <span class="fs-3 fw-bold text-primary" id="contadorGiros">🎯 0</span>
                        </div>
                    </div>

                    <!-- Puntero y Disco de la Ruleta -->
                    <div class="position-relative d-inline-block my-3">
                        <div class="wheel-pointer"></div>
                        <canvas id="ruletaCanvas" width="340" height="340" style="border-radius: 50%; box-shadow: 0 10px 30px rgba(0,0,0,0.15);"></canvas>
                    </div>

                    <div class="mt-4">
                        <button id="btnGirar" class="btn btn-warning-custom btn-lg rounded-pill px-5 py-3 fw-bold fs-4 shadow">
                            <i class="bi bi-arrow-repeat"></i> ¡GIRAR RULETA!
                        </button>
                    </div>

                    <!-- Panel de Resultado Dinámico -->
                    <div id="panelResultado" class="mt-4 p-4 rounded-4 bg-light border border-2 border-primary d-none">
                        <span class="badge bg-primary fs-6 px-3 py-1 mb-2">¡Sílaba seleccionada!</span>
                        <div class="display-3 fw-bold text-primary mb-2" id="textoSilaba">MA</div>
                        <button class="btn btn-sm btn-outline-primary rounded-pill mb-3" onclick="reproducirSilabaActual()">
                            <i class="bi bi-volume-up-fill"></i> Escuchar de nuevo
                        </button>

                        <h5 class="fw-bold text-dark mt-2 mb-3">¿Cuál de estos dibujos empieza con esta sílaba?</h5>
                        <div class="row g-3 justify-content-center" id="opcionesDibujos">
                            <!-- Opciones inyectadas por JS -->
                        </div>

                        <div id="mensajeFeedback" class="mt-3 fs-5 fw-bold"></div>
                    </div>

                    <!-- Enlace a la cartilla descargable complementaria -->
                    <div class="mt-5 p-3 rounded-3 bg-white border d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                        <div class="text-sm-start">
                            <span class="badge bg-danger mb-1"><i class="bi bi-file-earmark-pdf"></i> Material Complementario</span>
                            <h6 class="fw-bold mb-0">Cartilla de Sílabas Directas (M, P, S, L)</h6>
                            <small class="text-muted">Imprime las fichas de trabajo para afianzar este juego en papel.</small>
                        </div>
                        <a href="../recurso.php?id=rec-001" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3">
                            Ver Guía Imprimible
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna Lateral: Ficha Curricular LOM y Dublin Core del Juego -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle-fill text-primary"></i> Ficha Pedagógica</h5>
                
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Estándar Metadatos:</span>
                        <span class="badge bg-secondary">IEEE LOM & Dublin Core</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Nivel Educativo:</span>
                        <span class="fw-bold">Preescolar y 1° Primaria</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Edad Recomendada:</span>
                        <span class="fw-bold">4 a 6 años</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Interactividad:</span>
                        <span class="badge bg-success">Muy Alta (Gamificada)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Habilidad Clave:</span>
                        <span class="fw-bold">Conciencia Fonológica</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Licencia:</span>
                        <span class="fw-bold">CC BY-SA 4.0</span>
                    </li>
                </ul>

                <div class="alert alert-info border-0 rounded-3 mt-3 mb-0 small">
                    <i class="bi bi-lightbulb-fill text-warning me-1"></i>
                    <strong>Consejo para la Maestra:</strong> Usa este juego para abrir la clase como actividad motivacional ("Warm-up"). Permite que los niños repitan el sonido en coro haciendo palmas por cada sílaba.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Lógica de la Ruleta en Canvas
const silabas = [
    { silaba: "MA", palabra: "Mano", emoji: "✋", distractores: [{palabra:"Pelota", emoji:"⚽"}, {palabra:"Sol", emoji:"☀️"}] },
    { silaba: "PA", palabra: "Pato", emoji: "🦆", distractores: [{palabra:"Luna", emoji:"🌙"}, {palabra:"Mesa", emoji:"🪑"}] },
    { silaba: "SO", palabra: "Sol", emoji: "☀️", distractores: [{palabra:"Gato", emoji:"🐱"}, {palabra:"Pera", emoji:"🍐"}] },
    { silaba: "LU", palabra: "Luna", emoji: "🌙", distractores: [{palabra:"Taza", emoji:"☕"}, {palabra:"Dado", emoji:"🎲"}] },
    { silaba: "ME", palabra: "Mesa", emoji: "🪑", distractores: [{palabra:"Sapo", emoji:"🐸"}, {palabra:"León", emoji:"🦁"}] },
    { silaba: "PI", palabra: "Piña", emoji: "🍍", distractores: [{palabra:"Mariposa", emoji:"🦋"}, {palabra:"Tortuga", emoji:"🐢"}] },
    { silaba: "SA", palabra: "Sapo", emoji: "🐸", distractores: [{palabra:"Pato", emoji:"🦆"}, {palabra:"Lápiz", emoji:"✏️"}] },
    { silaba: "LE", palabra: "León", emoji: "🦁", distractores: [{palabra:"Moneda", emoji:"🪙"}, {palabra:"Pez", emoji:"🐟"}] }
];

const colores = ["#ef4444", "#f59e0b", "#10b981", "#06b6d4", "#3b82f6", "#8b5cf6", "#ec4899", "#14b8a6"];
const canvas = document.getElementById('ruletaCanvas');
const ctx = canvas.getContext('2d');
const numSegmentos = silabas.length;
const radio = canvas.width / 2;
let anguloActual = 0;
let girando = false;
let puntos = 0;
let giros = 0;
let silabaSeleccionada = null;

function dibujarRuleta() {
    const anguloPorSegmento = (2 * Math.PI) / numSegmentos;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    for (let i = 0; i < numSegmentos; i++) {
        const anguloInicio = anguloActual + i * anguloPorSegmento;
        const anguloFin = anguloInicio + anguloPorSegmento;

        ctx.beginPath();
        ctx.moveTo(radio, radio);
        ctx.arc(radio, radio, radio - 5, anguloInicio, anguloFin);
        ctx.fillStyle = colores[i];
        ctx.fill();
        ctx.lineWidth = 3;
        ctx.strokeStyle = '#ffffff';
        ctx.stroke();

        // Texto de la sílaba
        ctx.save();
        ctx.translate(radio, radio);
        ctx.rotate(anguloInicio + anguloPorSegmento / 2);
        ctx.textAlign = 'right';
        ctx.fillStyle = '#ffffff';
        ctx.font = 'bold 24px Quicksand, Nunito, sans-serif';
        ctx.fillText(silabas[i].silaba, radio - 35, 8);
        ctx.restore();
    }

    // Centro decorativo
    ctx.beginPath();
    ctx.arc(radio, radio, 32, 0, 2 * Math.PI);
    ctx.fillStyle = '#1e1b4b';
    ctx.fill();
    ctx.lineWidth = 4;
    ctx.strokeStyle = '#fbbf24';
    ctx.stroke();

    ctx.fillStyle = '#ffffff';
    ctx.font = 'bold 16px Nunito';
    ctx.textAlign = 'center';
    ctx.fillText('LEO', radio, radio + 5);
}

dibujarRuleta();

document.getElementById('btnGirar').addEventListener('click', () => {
    if (girando) return;
    girando = true;
    giros++;
    document.getElementById('contadorGiros').textContent = `🎯 ${giros}`;
    document.getElementById('panelResultado').classList.add('d-none');
    document.getElementById('mensajeFeedback').textContent = '';

    const girosCompletos = Math.floor(Math.random() * 5 + 5); // 5 a 10 vueltas
    const anguloExtra = Math.random() * 2 * Math.PI;
    const anguloFinal = anguloActual + (girosCompletos * 2 * Math.PI) + anguloExtra;
    const duracion = 3500;
    const inicioTiempo = performance.now();
    const anguloInicial = anguloActual;

    function animar(tiempo) {
        const progreso = Math.min((tiempo - inicioTiempo) / duracion, 1);
        // Easing out cubic
        const factor = 1 - Math.pow(1 - progreso, 3);
        anguloActual = anguloInicial + (anguloFinal - anguloInicial) * factor;
        dibujarRuleta();

        if (progreso < 1) {
            requestAnimationFrame(animar);
        } else {
            girando = false;
            determinarGanador();
        }
    }

    requestAnimationFrame(animar);
});

function determinarGanador() {
    // El puntero está arriba (a las 12 en punto = 3*PI/2 o -PI/2)
    const anguloPorSegmento = (2 * Math.PI) / numSegmentos;
    // Normalizar ángulo actual
    let anguloNormal = (anguloActual % (2 * Math.PI) + 2 * Math.PI) % (2 * Math.PI);
    // Puntero arriba: ángulo de referencia 1.5 * PI
    let anguloPuntero = (1.5 * Math.PI - anguloNormal + 2 * Math.PI) % (2 * Math.PI);
    let indice = Math.floor(anguloPuntero / anguloPorSegmento) % numSegmentos;

    silabaSeleccionada = silabas[indice];
    mostrarResultado(silabaSeleccionada);
}

function mostrarResultado(item) {
    const panel = document.getElementById('panelResultado');
    document.getElementById('textoSilaba').textContent = item.silaba;
    panel.classList.remove('d-none');

    // Pronunciar automáticamente con Web Speech API
    reproducirSilabaActual();

    // Generar opciones lúdicas
    const opcionesContainer = document.getElementById('opcionesDibujos');
    opcionesContainer.innerHTML = '';

    const opciones = [
        { palabra: item.palabra, emoji: item.emoji, esCorrecta: true },
        ...item.distractores.map(d => ({ palabra: d.palabra, emoji: d.emoji, esCorrecta: false }))
    ];

    // Desordenar opciones
    opciones.sort(() => Math.random() - 0.5);

    opciones.forEach(op => {
        const col = document.createElement('div');
        col.className = 'col-sm-4';
        col.innerHTML = `
            <button class="btn btn-outline-secondary w-100 p-3 rounded-4 bg-white shadow-sm opcion-btn" onclick="verificarRespuesta(${op.esCorrecta}, this)">
                <div class="display-4">${op.emoji}</div>
                <div class="fw-bold fs-5 mt-2">${op.palabra}</div>
            </button>
        `;
        opcionesContainer.appendChild(col);
    });
}

function reproducirSilabaActual() {
    if (silabaSeleccionada && window.pronunciarTexto) {
        window.pronunciarTexto(`¡La sílaba es: ${silabaSeleccionada.silaba}!`);
    }
}

function verificarRespuesta(esCorrecta, boton) {
    const feedback = document.getElementById('mensajeFeedback');
    const todosBotones = document.querySelectorAll('.opcion-btn');
    todosBotones.forEach(b => b.disabled = true);

    if (esCorrecta) {
        boton.classList.remove('btn-outline-secondary', 'bg-white');
        boton.classList.add('btn-success', 'text-white');
        feedback.className = 'mt-3 fs-4 fw-bold text-success';
        feedback.innerHTML = '🎉 ¡EXCELENTE! ¡Respuesta correcta!';
        puntos += 10;
        document.getElementById('contadorPuntos').textContent = `⭐ ${puntos}`;
        if (window.pronunciarTexto) {
            window.pronunciarTexto(`¡Muy bien! ${silabaSeleccionada.palabra} empieza por ${silabaSeleccionada.silaba}`);
        }
    } else {
        boton.classList.remove('btn-outline-secondary', 'bg-white');
        boton.classList.add('btn-danger', 'text-white');
        feedback.className = 'mt-3 fs-5 fw-bold text-danger';
        feedback.innerHTML = 'Inténtalo de nuevo en el siguiente giro 😊';
    }
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
