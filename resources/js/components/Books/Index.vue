<template>
	<div class="card mx-5 my-5">
		<div class="card-header d-flex justify-content-between">
			<h2><strong>Libros (Vistas hechas con Vue)</strong></h2>
			<button @click="openModal" class="btn btn-primary">Crear libro</button>
		</div>

		<div class="card-body">
			<section class="table-responsive" v-if="load">
				<!-- Se le envían los datos de books por props a la tabla -->
				<table-component :books_data="books" />
			</section>
			<!-- load -->
			<section class="d-flex justify-content-center my-3" v-else>
				<div class="spinner-border text-primary" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</section>
		</div>
		<section v-if="load_modal">
			<!-- Se lo enviamos al modal con un props de modal-->
			<modal :book_data="book" />
		</section>
	</div>
</template>

<script>
import axios from 'axios'
import TableComponent from './Table.vue'
import Modal from './Modal.vue'

export default {
	props: [],
	components: {
		TableComponent,
		Modal
	},
	data() {
		return {
			books: [],
			load: false,
			load_modal: false,
			modal: null,
			book: null
		}
	},
	created() {
		this.index()
	},
	mounted() {},

	methods: {
		async index() {
			// Obtencion del objeto books desde getBooks()
			await this.getBooks()
		},
		async getBooks() {
			try {
				this.load = false
				// Consumiento la api desde la api.php con axios para obtener el objeto books y mandandola como data
				const { data } = await axios.get('Books/GetAllBooks')
				this.books = data.books
				this.load = true
				// console.log(books)
			} catch (error) {
				console.error(error)
			}
		},
		openModal() {
			/* Montando modal */
			this.load_modal = true
			// Se debe esperar un poco ya que Vue pasa por su ciclo de vida, para que pueda atrapar la variable blook_modal
			setTimeout(() => {
				/* Capturando modal por el ID desde Modal.vue */
				this.modal = new bootstrap.Modal(document.getElementById('book_modal'), {
					keyboard: false // No cerrarlo con la tecla escape.
				})
				// Abrimos el modal
				this.modal.show()

				// Se debe traer el id del modal para saber a qué se hace la referencia
				const modal = document.getElementById('book_modal')
				// Evento de escucha que cuando se cierre ejecuta un callback, funcion que se ejecuta cuando se cierra un evento
				modal.addEventListener('hidden.bs.modal', () => {
					this.load_modal = false
					// Se pone en null para que las variables se reinicien
					this.book = null
				})
			}, 200)
		},
		// Creamos a close modal para recargar los libros al momento de actualizar o crear un libro
		closeModal() {
			// Cerrar el modal
			this.modal.hide()
			this.getBooks()
			// Llamamos esta función en Modal.vue
		},
		editBook(book){
			this.book = book
			this.openModal()
		}
	}
}
</script>

