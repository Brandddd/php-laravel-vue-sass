<div class="card">
	<div class=card-header>
		<h2>
			{{$type}} Usuario
		</h2>
	</div>
	<div class="card-body">
		<form>
			<div class="mb-3">
				<label for="Nombre" class="form-label">Nombre</label>
				<input type="text" class="form-control" id="exampleInputEmail1">
				{{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
			</div>
			<div class="mb-3">
				<label for="Apellido" class="form-label">Apellido</label>
				<input type="text" class="form-control" id="exampleInputEmail1">
				{{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
			</div>
			<div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">identificacion</label>
				<input type="number" class="form-control" id="exampleInputEmail1">
				{{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
			</div>
			<div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Correo</label>
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
				{{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Contraseña</label>
				<input type="password" class="form-control" id="exampleInputPassword1">
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Confirmar Contraseña</label>
				<input type="password" class="form-control" id="exampleInputPassword1">
			</div>
			<button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	</div>
</div>
