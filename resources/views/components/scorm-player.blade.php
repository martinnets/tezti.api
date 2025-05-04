<div>
    @if ($currentScorm)
        <h2>Reproduciendo: {{ $currentScorm }}</h2>
        <iframe
            id="scorm-iframe"
            src="{{ asset('storage/scorm_extracted/' . $currentScorm . '/index.html') }}"
            width="100%"
            height="600px"
            frameborder="0"
        ></iframe>

        @if ($nextScorm)
            <button onclick="window.location.href='{{ route('play.scorm', ['scormIdentifier' => $nextScorm]) }}'">
                Continuar al Siguiente SCORM: {{ $nextScorm }}
            </button>
        @else
            <p>Has completado todos los SCORM.</p>
        @endif
    @else
        <p>No hay SCORM para reproducir.</p>
    @endif

    <script>
        // Aquí iría la lógica JavaScript para interactuar con el contenido SCORM
        // (por ejemplo, para detectar la finalización y notificar al servidor).

        // Ejemplo básico para detectar la carga del iframe (esto no indica finalización del SCORM)
        document.getElementById('scorm-iframe').onload = function() {
            console.log('El SCORM actual se ha cargado.');
            // Aquí podrías iniciar alguna lógica de seguimiento si es necesario.
        };
    </script>
</div>