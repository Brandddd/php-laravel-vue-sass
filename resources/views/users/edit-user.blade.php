<x-app>
    <section class="container my-5">
        <div class="card">
            <div class=card-header>
                <h2>
                    Editar Usuario
                </h2>
            </div>
            <div class="card-body">
                {{-- Desde web.php se crea la ruta, se le asigna el nombre y se pone dentro de route --}}
                <form action="{{ route('user.edit.put', ['user' => $user->id]) }}" method="POST">
					@csrf
                    @method('PUT')
                    <x-user.form-user :user="$user" />
                </form>
            </div>
        </div>
    </section>
</x-app>
