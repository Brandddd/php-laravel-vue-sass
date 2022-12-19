<template>
	<!-- Se le da id a la tabla para asignar el datatable -->
	<table class="table" id="bookTable">
		<thead>
			<tr>
				<th>Titulo</th>
				<th>Autor</th>
				<th>Stock</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(book, index) in books" :key="index">
				<th>{{ book.title }}</th>
				<td>{{ book.author.name }}</td>
				<td>{{ book.stock }}</td>
				<td>
					<button class="btn btn-warning me-2" @click="getBook(book.id)">Editar</button>
					<button class="btn btn-danger" @click="deleteBook(book)">Eliminar</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
export default {
	props: ['books_data'],
	data() {
		return {
			books: []
		}
	},
	created() {
		this.index()
	},
	// Cuando ya este montado el componente lo cargue con jquery y datatables
	mounted() {
		//
		$('#bookTable').DataTable()
	},
	methods: {
		index() {
			// copia identica en memoria ram del label que se esté editando
			this.books = { ...this.books_data }
		},
		async getBook(book_id) {
			try {
				const { data } = await axios.get(`Books/GetABook/${book_id}`)
				// Se lo pasamos al la funcion padre el libro para que lo rellene
				this.$parent.editBook(data.book)
			} catch (error) {
				console.error(error)
			}
		},
		async deleteBook(book) {
			try {
				// Alerta aviso
				const result = await swal.fire({
					icon: 'info',
					title: '¿Seguro deseas borrar el libro?',
					showCancelButton: true,
					confirmButtonText: 'Eliminar'
				})

				if (!result.isConfirmed) return

				// Direccion web
				await axios.delete(`Books/DeleteBook/${book.id}`)
				// Recargar pagina mostrando nuevamente todos los libros en la vista de vue.
				this.$parent.getBooks()
				swal.fire({
					icon: 'success',
					title: 'Felicidades!',
					text: 'Libro eliminado exitosamente.'
				})
			} catch (error) {
				console.error(error)
			}
		}
	}
}
</script>
