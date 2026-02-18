@extends('layouts.app')

@section('title', 'Gestión de Usuarios - Nutripeques')

@section('content')
<style>
    /* ====== VARIABLES NUTRI ====== */
    :root {
        --purple-gradient: linear-gradient(135deg, #7276d1 0%, #5a5eb1 100%);
        --soft-blue: #e3f2fd;
        --card-bg: rgba(255, 255, 255, 0.7);
    }

    body {
        background-color: var(--soft-blue);
        background-image: radial-gradient(circle at 10% 20%, rgba(216, 241, 230, 0.46) 0.1%, rgba(233, 226, 226, 0.28) 90.1%);
        font-family: 'Quicksand', sans-serif;
    }

    /* ====== CONTENEDOR TIPO CRISTAL ====== */
    .user-container {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 2px solid white;
        border-radius: 40px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        margin-top: 20px;
    }

    .header-section {
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-section h2 {
        font-weight: 800;
        color: #333;
        margin: 0;
    }

    /* ====== ESTILO DE TABLA ====== */
    .table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table thead th {
        border: none;
        color: #7276d1;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        padding: 15px;
    }

    .table tbody tr {
        background: white;
        transition: transform 0.2s;
        box-shadow: 0 5px 10px rgba(0,0,0,0.02);
    }

    .table tbody tr:hover {
        transform: scale(1.01);
        box-shadow: 0 8px 15px rgba(114, 118, 209, 0.1);
    }

    .table tbody td {
        border: none;
        padding: 18px 15px;
        vertical-align: middle;
        color: #555;
    }

    /* Bordes redondeados para las filas */
    .table tbody tr td:first-child { border-radius: 15px 0 0 15px; font-weight: 700; color: #7276d1; }
    .table tbody tr td:last-child { border-radius: 0 15px 15px 0; }

    /* Avatar Círculo */
    .user-avatar {
        width: 35px;
        height: 35px;
        background: var(--purple-gradient);
        color: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 10px;
        font-size: 0.8rem;
    }

    .badge-date {
        background: #f0f2f5;
        color: #666;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
    }
</style>

<div class="container py-5">
    <div class="user-container">
        <div class="header-section">
            <h2><i class="bi bi-people-fill me-2" style="color: #7276d1;"></i> Usuarios Registrados</h2>
            <span class="badge rounded-pill bg-white text-dark shadow-sm px-3 py-2 border">
                Total: {{ count($usuarios) }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td>
                            <div class="user-avatar">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            {{ $user->name }}
                        </td>
                        <td>
                            <i class="bi bi-envelope me-2 opacity-50"></i>
                            {{ $user->email }}
                        </td>
                        <td>
                            <span class="badge-date">
                                <i class="bi bi-calendar3 me-2"></i>
                                {{ $user->created_at->format('d/m/Y') }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(count($usuarios) == 0)
            <div class="text-center py-5">
                <i class="bi bi-person-exclamation opacity-25" style="font-size: 4rem;"></i>
                <p class="mt-3 text-muted">No hay usuarios registrados en la base de datos.</p>
            </div>
        @endif
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection