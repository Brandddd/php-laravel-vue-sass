<x-app>
    <section class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2><strong>Usuarios (Vistas hechas con Blade)</strong></h2>
                <a href="{{ route('user.create') }}" class="btn btn-primary">Crear usuario</a>
            </div>
            <div class="card-body">
                <section class="table-responsive">
                    <table class="table my-4 mx-3 justify-content-center">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <h4><strong>Identificación</strong></h4>
                                </th>
                                <th scope="col">
                                    <h4><strong>Nombre</strong></h4>
                                </th>
                                <th scope="col">
                                    <h4><strong>Apellido</strong></h4>
                                </th>
                                <th scope="col">
                                    <h4><strong>Correo Electrónico</strong></h4>
                                </th>
                                <th scope="col">
                                    <h4><strong>Acciones</strong></h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th>{{ $user->number_id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                                            class="btn btn-warning btn-sm me-1">Editar</a>

                                        <form action="{{ route('user.delete', ['user' => $user->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </section>
</x-app>
