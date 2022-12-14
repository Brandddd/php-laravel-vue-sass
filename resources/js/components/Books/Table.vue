<template>
	<table class="table">
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
					<button class="btn btn-warning me-2">Editar</button>
					<button class="btn btn-danger">Eliminar</button>
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
	methods: {
		index() {
			this.books = {...this.books_data}
		}
	}
}
</script>
