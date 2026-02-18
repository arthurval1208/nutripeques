@extends('layouts.app')

@section('content')
<style>
    /* Estilos para las tarjetas de mensajes */
    .message-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: transform 0.2s;
        border: 1px solid #eee;
    }
    .message-card:hover {
        transform: translateY(-3px);
    }
    .text-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #7276d1;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    /* Estilo para mensajes ya procesados */
    .message-read {
        opacity: 0.7;
        background: #fdfdfd;
        border-left: 5px solid #ccc;
    }
    /* Botones de acción circulares */
    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
        border: none;
    }
    .btn-done { background: #e8f5e9; color: #2e7d32; }
    .btn-done:hover { background: #2e7d32; color: white; }
    .btn-delete { background: #ffebee; color: #c62828; }
    .btn-delete:hover { background: #c62828; color: white; }

    .badge-prioridad {
        font-size: 0.8rem;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-chat-left-dots me-2"></i> Mensajes Recibidos</h2>
        <span class="badge bg-white text-dark border px-3 py-2 rounded-pill shadow-sm">
            Total: {{ count($mensajes) }}
        </span>
    </div>

    <div class="row d-none d-md-flex mb-2 px-4">
        <div class="col-2 text-label">Nombre</div>
        <div class="col-2 text-label">Correo</div>
        <div class="col-1 text-label text-center">Prioridad</div>
        <div class="col-2 text-label text-center">Asunto</div>
        <div class="col-3 text-label">Mensaje</div>
        <div class="col-2 text-label text-center">Acciones</div>
    </div>

    @forelse($mensajes as $mensaje)
    <div class="message-card {{ $mensaje->Prioridad == 'baja' ? 'message-read' : '' }}">
        <div class="row align-items-center">
            <div class="col-md-2 fw-bold text-truncate">{{ $mensaje->nombre }}</div>
            
            <div class="col-md-2 text-muted small">
                <i class="bi bi-envelope me-1"></i> {{ $mensaje->correo }}
            </div>
            
            <div class="col-md-1 text-center">
                <span class="badge-prioridad {{ $mensaje->Prioridad == 'alta' ? 'bg-danger text-white' : ($mensaje->Prioridad == 'media' ? 'bg-warning text-dark' : 'bg-light text-muted') }}">
                    {{ ucfirst($mensaje->Prioridad) }}
                </span>
            </div>

            <div class="col-md-2 text-center fw-bold small text-primary">{{ $mensaje->asunto }}</div>
            
            <div class="col-md-3 text-muted text-truncate" title="{{ $mensaje->mensaje }}">
                {{ $mensaje->mensaje }}
            </div>
            
            <div class="col-md-2">
                <div class="d-flex justify-content-center gap-2">
                    
                    @if($mensaje->Prioridad != 'baja')
                    <form action="{{ route('mensajes.read', $mensaje->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-action btn-done" title="Marcar como atendido">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    </form>
                    @else
                    <div class="btn-action bg-light text-muted" title="Ya procesado">
                        <i class="bi bi-check-all"></i>
                    </div>
                    @endif

                    <form action="{{ route('mensajes.destroy', $mensaje->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este mensaje definitivamente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" title="Eliminar">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
        <i class="bi bi-inbox text-muted mb-3" style="font-size: 3rem;"></i>
        <p class="text-muted fw-bold">No hay mensajes en la bandeja de entrada.</p>
    </div>
    @endforelse
</div>
@endsection