{{-- Alerta de sesion, que en la sesion tenga el titulo sucess en todas las sesiones si esta 'viva' --}}
{{-- Se verifica si la petición al backend fue elaborada exitosamente --}}
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Alerta para los errores, si hay un error se imprime, estos errores se mandan por backend --}}
{{-- Si hay un error con la peticion al backend, y este no pudo cargar la solicitud por algun error, retorna este cuadro de error --}}
@if (Session::has('error'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- En caso de que no devuelvar error por backend, se hace este foreach --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
