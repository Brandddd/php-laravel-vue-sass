<x-app>
    <section class="container my-5">
		<div class="card">
			<div class=card-header>
				<h2>
					Crear usuario
				</h2>
			</div>
			<div class="card-body">
				{{-- Desde web.php se crea la ruta, se le asigna el nombre y se pone dentro de route --}}
				<form action="{{route("user.create.post")}}" method="POST">
					@csrf
					<x-user.form-user/>
				</form>
			</div>
		</div>
    </section>
</x-app>
