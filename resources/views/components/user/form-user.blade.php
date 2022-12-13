 {{-- Name --}}
 <div class="mb-3">
     <label for="name" class="form-label">Nombre</label>
     <input type="text" name="name" class="form-control
		@error('name') is-invalid @enderror" {{-- Para evitar que me borre los campos si hay un error: Si existe 'name' entonces deja 'name' sino lo deja vacio '' --}}
         value="{{ old('name') ? old('name') : '' }}">
     {{-- Funcion de blade que lee los errores que le pertenecen al name --}}
     @error('name')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
     @enderror
 </div>
 {{-- Lastname --}}
 <div class="mb-3">
     <label for="name" class="form-label">Apellido</label>
     <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
         value="{{ old('last_name') ? old('last_name') : '' }}">
     {{-- Funcion de blade que lee los errores que le pertenecen al name --}}
     @error('last_name')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
     @enderror
 </div>
 {{-- Identificación --}}
 <div class="mb-3">
     <label for="name" class="form-label">Cedula</label>
     <input type="number" name="number_id" class="form-control @error('number_id') is-invalid @enderror"
	 value="{{ old('number_id') ? old('number_id') : '' }}">
     {{-- Funcion de blade que lee los errores que le pertenecen al name --}}
     @error('number_id')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
     @enderror
 </div>
 {{-- Correo --}}
 <div class="mb-3">
     <label for="name" class="form-label">Correo</label>
     <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
	 value="{{ old('email') ? old('email') : '' }}">
     {{-- Funcion de blade que lee los errores que le pertenecen al name --}}
     @error('email')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
     @enderror
 </div>
 {{-- Contraseña --}}
 <div class="mb-3">
     <label for="name" class="form-label">Contraseña</label>
     <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
     {{-- Funcion de blade que lee los errores que le pertenecen al name --}}
     @error('password')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
     @enderror
 </div>
 {{-- Confirmar contraseña --}}
 <div class="mb-3">
     <label for="name" class="form-label">Confirmar contraseña</label>
     <input type="password" name="password_confirmation"
         class="form-control @error('password_confirmation') is-invalid @enderror">
     {{-- Funcion de blade que lee los errores que le pertenecen al name --}}
     @error('password_confirmation')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
     @enderror
 </div>

 {{-- Botones --}}
 <a href="/Users" class="btn btn-danger me-4">Volver</a>
 <button type="submit" class="btn btn-primary">Enviar</button>
