/**
 * LeoAprende - Lógica JavaScript para el Repositorio de Lectoescritura
 */

document.addEventListener('DOMContentLoaded', () => {
    inicializarBuscador();
    inicializarFiltrosRapidos();
    inicializarSintesisVoz();
});

/**
 * Filtro y búsqueda en tiempo real sobre las tarjetas del catálogo
 */
function inicializarBuscador() {
    const inputBuscar = document.getElementById('inputBusqueda');
    const selectNivel = document.getElementById('selectNivel');
    const selectTipo = document.getElementById('selectTipo');
    const selectLetra = document.getElementById('selectLetra');
    const contadorResultados = document.getElementById('contadorResultados');
    const tarjetas = document.querySelectorAll('.tarjeta-recurso-item');

    if (!inputBuscar && !selectNivel && !selectTipo && !selectLetra) return;

    function filtrarTarjetas() {
        const query = (inputBuscar ? inputBuscar.value : '').toLowerCase().trim();
        const nivel = selectNivel ? selectNivel.value.toLowerCase() : '';
        const tipo = selectTipo ? selectTipo.value.toLowerCase() : '';
        const letra = selectLetra ? selectLetra.value.toUpperCase() : '';

        let visibles = 0;

        tarjetas.forEach(tarjeta => {
            const titulo = tarjeta.getAttribute('data-titulo') || '';
            const desc = tarjeta.getAttribute('data-desc') || '';
            const cat = tarjeta.getAttribute('data-cat') || '';
            const cardNivel = tarjeta.getAttribute('data-nivel') || '';
            const cardTipo = tarjeta.getAttribute('data-tipo') || '';
            const cardLetras = tarjeta.getAttribute('data-letras') || '';

            const coincideTexto = !query || 
                titulo.includes(query) || 
                desc.includes(query) || 
                cat.includes(query) ||
                cardLetras.toLowerCase().includes(query);

            const coincideNivel = !nivel || cardNivel.includes(nivel);
            const coincideTipo = !tipo || cardTipo.includes(tipo);
            const coincideLetra = !letra || cardLetras.includes(letra);

            if (coincideTexto && coincideNivel && coincideTipo && coincideLetra) {
                tarjeta.style.display = 'block';
                visibles++;
            } else {
                tarjeta.style.display = 'none';
            }
        });

        if (contadorResultados) {
            contadorResultados.textContent = `${visibles} recurso(s) encontrado(s)`;
        }

        const sinResultados = document.getElementById('mensajeSinResultados');
        if (sinResultados) {
            sinResultados.style.display = visibles === 0 ? 'block' : 'none';
        }
    }

    if (inputBuscar) inputBuscar.addEventListener('input', filtrarTarjetas);
    if (selectNivel) selectNivel.addEventListener('change', filtrarTarjetas);
    if (selectTipo) selectTipo.addEventListener('change', filtrarTarjetas);
    if (selectLetra) selectLetra.addEventListener('change', filtrarTarjetas);
}

/**
 * Pastillas de categoría superior
 */
function inicializarFiltrosRapidos() {
    const pills = document.querySelectorAll('.category-pill');
    const inputBuscar = document.getElementById('inputBusqueda');

    pills.forEach(pill => {
        pill.addEventListener('click', (e) => {
            // Si es enlace normal déjalo navegar o filtrar
            const categoria = pill.getAttribute('data-categoria');
            if (categoria && inputBuscar) {
                e.preventDefault();
                pills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');
                inputBuscar.value = categoria;
                inputBuscar.dispatchEvent(new Event('input'));
            }
        });
    });
}

/**
 * Registro de descargas sin recargar página
 */
function registrarDescarga(idRecurso) {
    fetch(`api_descargas.php?id=${encodeURIComponent(idRecurso)}`)
        .then(response => response.json())
        .then(data => {
            if (data.exito) {
                const el = document.getElementById(`contador-descargas-${idRecurso}`);
                if (el) {
                    el.textContent = data.descargas;
                }
            }
        })
        .catch(err => console.log('Descarga iniciada directamente', err));
}

/**
 * Soporte de Voz (Web Speech API) para pronunciar sílabas y letras
 */
function inicializarSintesisVoz() {
    window.pronunciarTexto = function(texto) {
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance(texto);
            utterance.lang = 'es-ES';
            utterance.rate = 0.85; // Un poco más despacio para comprensión infantil
            utterance.pitch = 1.1;
            window.speechSynthesis.speak(utterance);
        } else {
            console.log('Síntesis de voz no disponible');
        }
    };
}
