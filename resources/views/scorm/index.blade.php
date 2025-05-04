@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Paquetes SCORM disponibles</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="list-group">
                        @forelse ($packages as $package)
                            <a href="{{ route('scorm.show', $package->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $package->title }}</h5>
                                    
                                    @php
                                        $progress = $package->getUserProgress(Auth::id());
                                    @endphp
                                    
                                    @if ($progress && $progress->isCompleted())
                                        <span class="badge bg-success">Completado</span>
                                    @elseif ($progress)
                                        <span class="badge bg-warning">En progreso</span>
                                    @else
                                        <span class="badge bg-secondary">No iniciado</span>
                                    @endif
                                </div>
                                <p class="mb-1">{{ $package->description }}</p>
                                <small>Versión: {{ $package->version ?? 'N/A' }}</small>
                            </a>
                        @empty
                            <div class="alert alert-info">
                                No hay paquetes SCORM disponibles en este momento.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection