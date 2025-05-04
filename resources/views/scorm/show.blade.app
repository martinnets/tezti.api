@extends('layouts.app')

@section('styles')
<style>
    .scorm-container {
        width: 100%;
        height: calc(100vh - 200px);
        min-height: 600px;
    }
    
    .scorm-frame {
        width: 100%;
        height: 100%;
        border: 1px solid #ccc;
    }
    
    .navigation-buttons {
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>{{ $package->title }}</div>
                        <a href="{{ route('scorm.index') }}" class="btn btn-sm btn-secondary">Volver a la lista</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="scorm-container">
                        <iframe id="scorm-frame" class="scorm-frame" src="{{ $package->getEntryUrl() }}" allowfullscreen></iframe>
                    </div>
                    
                    <div class="navigation-buttons">
                        <div>
                            <!-- Placeholder para botones adicionales si es necesario -->
                        </div>
                        <div>
                            @if ($nextPackage)
                                <a href="{{ route('scorm.load_next', $package->id) }}" class="btn btn-primary">Continuar al siguiente módulo</a>
                            @else
                                <a href="{{ route('scorm.index') }}" class="btn btn-success">Finalizar curso</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Variables para almacenar información del SCORM API
    let scormAPI = null;
    let packageId = {{ $package->id }};
    let intervalId = null;
    
    // Función para inicializar la interfaz API del SCORM
    function initScormAPI() {
        // Crear el objeto API que interactuará con el contenido SCORM
        scormAPI = {
            // Variables de estado SCORM
            cmi: {
                core: {
                    student_id: "{{ Auth::id() }}",
                    student_name: "{{ Auth::user()->name }}",
                    lesson_location: "{{ $progress->location ?? '' }}",
                    lesson_status: "{{ $progress->completion_status ?? 'not attempted' }}",
                    score: {
                        raw: "{{ $progress->score ?? '' }}"
                    },
                    suspend_data: "{{ $progress->suspend_data ?? '' }}",
                    total_time: "00:00:00"
                }
            },
            
            // Métodos del API SCORM
            LMSInitialize: function() {
                console.log("LMSInitialize called");
                return "true";
            },
            
            LMSSetValue: function(element, value) {
                console.log("LMSSetValue", element, value);
                
                // Mapeo de campos SCORM a nuestras propiedades
                const pathParts = element.split('.');
                
                // Procesar los valores según el elemento
                if (element === "cmi.core.lesson_location") {
                    this.cmi.core.lesson_location = value;
                } else if (element === "cmi.core.lesson_status") {
                    this.cmi.core.lesson_status = value;
                } else if (element === "cmi.core.score.raw") {
                    this.cmi.core.score.raw = value;
                } else if (element === "cmi.suspend_data") {
                    this.cmi.core.suspend_data = value;
                }
                
                // Autoguardar cada vez que se modifica un valor importante
                this.saveProgress();
                
                return "true";
            },
            
            LMSGetValue: function(element) {
                console.log("LMSGetValue", element);
                
                // Mapeo de campos SCORM a nuestras propiedades
                if (element === "cmi.core.lesson_location") {
                    return this.cmi.core.lesson_location;
                } else if (element === "cmi.core.lesson_status") {
                    return this.cmi.core.lesson_status;
                } else if (element === "cmi.core.score.raw") {
                    return this.cmi.core.score.raw;
                } else if (element === "cmi.suspend_data") {
                    return this.cmi.core.suspend_data;
                } else if (element === "cmi.core.student_id") {
                    return this.cmi.core.student_id;
                } else if (element === "cmi.core.student_name") {
                    return this.cmi.core.student_name;
                }
                
                return "";
            },
            
            LMSCommit: function() {
                console.log("LMSCommit called");
                this.saveProgress();
                return "true";
            },
            
            LMSFinish: function() {
                console.log("LMSFinish called");
                this.saveProgress();
                
                // Si está completado, permitir avanzar automáticamente
                if (this.cmi.core.lesson_status === "completed" || 
                    this.cmi.core.lesson_status === "passed") {
                    setTimeout(() => {
                        // Opcional: redirigir automáticamente al siguiente paquete
                        @if ($nextPackage)
                        //window.location.href = "{{ route('scorm.load_next', $package->id) }}";
                        @endif
                    }, 1000);
                }
                
                return "true";
            },
            
            LMSGetLastError: function() {
                return "0"; // 0 significa sin error
            },
            
            LMSGetErrorString: function(errorCode) {
                return "No error";
            },
            
            LMSGetDiagnostic: function(errorCode) {
                return "No diagnostic information available";
            },
            
            // Método para guardar el progreso en el servidor
            saveProgress: function() {
                fetch('{{ route("scorm.save_progress", $package->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        location: this.cmi.core.lesson_location,
                        completion_status: this.cmi.core.lesson_status,
                        score: this.cmi.core.score.raw,
                        suspend_data: this.cmi.core.suspend_data
                    })
                })
                .then(response => response.json())
                .then(data => console.log('Progress saved:', data))
                .catch(error => console.error('Error saving progress:', error));
            }
        };
        
        // Inyectar el API en el iframe
        const iframe = document.getElementById('scorm-frame');
        iframe.onload = function() {
            try {
                // Intentar inyectar el API en el iframe
                iframe.contentWindow.API = scormAPI;
                
                // Configurar el guardado automático periódico
                intervalId = setInterval(() => {
                    scormAPI.saveProgress();
                }, 30000); // Guardar cada 30 segundos
                
                console.log("SCORM API successfully injected");
            } catch (error) {
                console.error("Error injecting SCORM API:", error);
            }
        };
    }
    
    // Inicializar cuando el documento esté listo
    document.addEventListener('DOMContentLoaded', function() {
        initScormAPI();
        
        // Limpiar el intervalo cuando se abandona la página
        window.addEventListener('beforeunload', function() {
            if (intervalId) {
                clearInterval(intervalId);
                
                // Intentar guardar el progreso antes de salir
                if (scormAPI) {
                    scormAPI.saveProgress();
                }
            }
        });
    });
</script>
@endsection