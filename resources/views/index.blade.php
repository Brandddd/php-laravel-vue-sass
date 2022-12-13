{{-- @extends('layouts.app') --}} {{-- - Se extiende para que coja lo de layout - --}}

{{-- @section('content') --}} {{-- - Una section va buscar siempre en el layout un yield con el titulo content - --}}
{{-- <div class="container">
	<h1>
		Hola mundo
	</h1>
</div>
@endsection --}}

{{-- Asi se trabaja en la empresa --}}
<x-app title="Biblioteca Central">

    {{-- A Book --}}
    {{-- Ver BookController.php para ver variables. Se itera cada libro en un libro de la siguiente forma: --}}
    <section class="d-flex justify-content-center flex-wrap">
        @foreach ($books as $book)
            <div class="card my-2 mx-3" style="width: 18rem;">
                <img src="https://api.lorem.space/image/game?w=150&h=220" class="card-img-top" alt="Libro">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">{{ $book->description }}</p>
                    <a href="#" class="btn btn-primary">Prestar</a>
                </div>
            </div>
        @endforeach
    </section>
</x-app>
