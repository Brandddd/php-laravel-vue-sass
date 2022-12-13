<x-app>
    <div class="card mx-5 my-5">
        <div class="card-header d-flex justify-content-between">
            <h2><strong>Usuarios</strong></h2>
			<a href="{{route('user.create')}}" class="btn btn-primary">Crear usuario</a>
        </div>
        <div class="card-body">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->number_id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>