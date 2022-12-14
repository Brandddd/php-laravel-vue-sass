<template>
	<div class="card mx-5 my-5">
		<div class="card-header d-flex justify-content-between">
			<h2><strong>Libros</strong></h2>
			<a class="btn btn-primary">Crear libro</a>
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
	</div>
</template>

<script>
import axios from 'axios'
import TableComponent from './Table.vue'

export default {
	props: [],
	components: {
		TableComponent
	},
	data() {
		return {
			books: [],
			load: false
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
				// Consumiento la api desde la api.php con axios para obtener el objeto books y mandandola como data
				const { data } = await axios.get('/api/Books/GetAllBooks')
				this.books = data.books
				this.load = true
				// console.log(books)
			} catch (error) {
				console.error(error)
			}
		}
	}
}
</script>

