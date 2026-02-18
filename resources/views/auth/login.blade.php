@extends('layouts.app')
@section('title', 'Iniciar sesión - UNITED')
@push('styles')
<style>
:root{
  --primary:#4e54c8;      /* morado */
  --primary-2:#6b73ff;    /* degradado */
  --accent:#f5c542;       /* dorado */
  --rose:#b04a63;         /* rosa */
  --bg:#f3f3f8;
  --card:#ffffff;
  --text:#2a2a2a;
  --border:#e6e7f2;
  --nav-h:64px;           /* alto aprox navbar */
}
html,body{height:100%;}
body{
  background: var(--bg);
  font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
}

/* Quitar padding del main para centrar de verdad */
main.py-4{ padding-top:0 !important; padding-bottom:0 !important; }

/* Contenedor centrado */
.auth-wrap{
  min-height: calc(100vh - var(--nav-h));
  display:flex;
  align-items:center;      /* vertical */
  justify-content:center;  /* horizontal */
}

/* Tarjeta */
.auth-card{
  border:0;
  border-radius:18px;
  overflow:hidden;
  box-shadow: 0 12px 30px rgba(0,0,0,.12);
  background: var(--card);
  width: 100%;
  max-width: 820px;
}

/* Header */
.auth-header{
  background: linear-gradient(135deg, var(--primary), var(--primary-2));
  color:#fff;
  font-weight:700;
  letter-spacing:.5px;
  padding: 18px 22px;
  display:flex; align-items:center; gap:10px;
}

/* Cuerpo */
.auth-body{ padding: 28px 26px 26px; }
.lead-text{ color:#555; margin: 2px 0 18px; font-size:.95rem; }

/* Inputs */
.form-label{ font-weight:600; color:#333;}
.form-control{
  border-radius:10px;
  border:1px solid #d9dbe9;
  padding: .65rem .9rem;
  transition: box-shadow .2s, border-color .2s;
}
.form-control:focus{
  border-color: var(--primary);
  box-shadow: 0 0 0 .2rem rgba(78,84,200,.15);
}
.is-invalid{ border-color:#dc3545 !important; }
.invalid-feedback strong{ font-weight:600; }

/* Checkbox */
.form-check-input:checked{
  background-color: var(--primary);
  border-color: var(--primary);
}

/* Botones */
.btn{ border-radius:10px; font-weight:700; letter-spacing:.3px; }
.btn-primary{
  background: var(--primary);
  border-color: var(--primary);
  padding: .65rem 1.25rem;
}
.btn-primary:hover{ filter: brightness(1.05); }
.btn-accent{
  background: var(--accent);
  color:#333;
  border:0;
}
.btn-accent:hover{ filter:brightness(1.07); }
.btn-link{
  color: var(--primary);
  text-decoration:none;
  font-weight:600;
  padding-left:0;
}
.btn-link:hover{ color:var(--primary-2); text-decoration: underline; }

/* Separador */
.divider{
  display:flex; align-items:center; gap:10px; margin: 16px 0;
  color:#777; font-size:.9rem;
}
.divider::before,.divider::after{
  content:""; flex:1; height:1px; background: var(--border);
}

/* Footer tarjeta */
.auth-footer{
  border-top:1px solid #eef0f6;
  background:#fafbff;
  padding: 16px 22px;
  font-size:.9rem;
  color:#555;
}
.link-accent{ color: var(--rose); font-weight:700; }
.link-accent:hover{ color:#923c54; }

/* CTA centrado y bonito */
.cta-register{
  display:inline-block;
  border-radius: 999px;
  font-weight: 700;
  text-align:center;
  min-width: 280px;
}

/* Móvil: etiquetas encima del input */
@media (max-width: 575.98px){
  :root{ --nav-h:56px; }
  .col-form-label.text-md-end{ text-align:left !important; margin-bottom:.25rem; }
}
</style>
@endpush

@section('content')
<div class="container auth-wrap">
  <div class="card auth-card">

    {{-- Header --}}
    <div class="auth-header">
      <span>{{ __('Iniciar sesión') }}</span>
    </div>

    {{-- Cuerpo --}}
    <div class="auth-body">
      <p class="lead-text">Bienvenido(a). Ingresa tus credenciales para continuar.</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-3 row align-items-center">
          <label for="email" class="col-md-4 col-form-label text-md-end form-label">
            {{ __('Correo electrónico') }}
          </label>
          <div class="col-md-7">
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                   placeholder="tucorreo@ejemplo.com">
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        {{-- Password --}}
        <div class="mb-3 row align-items-center">
          <label for="password" class="col-md-4 col-form-label text-md-end form-label">
            {{ __('Contraseña') }}
          </label>
          <div class="col-md-7">
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password"
                   placeholder="••••••••">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        {{-- Remember --}}
        <div class="mb-3 row">
          <div class="col-md-7 offset-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember"
                     {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                {{ __('Recuérdame') }}
              </label>
            </div>
          </div>
        </div>

        {{-- Acciones --}}
        <div class="row align-items-center">
          <div class="col-md-7 offset-md-4 d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primary">
              {{ __('Entrar') }}
            </button>

            @if (Route::has('password.request'))
              <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
              </a>
            @endif
          </div>
        </div>

        <div class="divider"><span>o</span></div>

        {{-- CTA registro centrado --}}
        @if (Route::has('register'))
          <div class="row">
            <div class="col-12 d-flex justify-content-center">
              <a href="{{ route('register') }}" class="btn btn-accent btn-lg px-4 cta-register">
                Crear cuenta nueva
              </a>
            </div>
          </div>
        @endif
      </form>
    </div>

    {{-- Footer de tarjeta --}}
    <div class="auth-footer d-flex justify-content-between align-items-center">
      <span>© {{ now()->year }} UNITED</span>
      <span>¿Sin cuenta? <a class="link-accent" href="{{ route('register') }}">Regístrate</a></span>
    </div>

  </div>
</div>
@endsection
