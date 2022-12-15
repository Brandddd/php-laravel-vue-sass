<template>
	<!-- Modal -->
	<div class="modal fade" id="book_modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						<!-- Si es creacion coloca crear, si es actualizar, coloca actualizar -->
						<strong>{{ `${is_create ? 'Crear' : 'Actualizar'} libro` }}</strong>
					</h5>
					<button
						type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close"
					></button>
				</div>
				<div class="modal-body">
					<!-- Formulario para crear libro dentro del modal -->
					<!-- Se debe llamar la funcion como submit.prevent de storeBook desde el form -->
					<form @submit.prevent="storeBook" enctype="multipart/form-data">
						<!-- Encriptacion para el formulario enctype -->
						<div class="mb-3">
							<label for="images" class="form-label">Portada</label>
							<input
								type="file"
								class="form-control"
								id="file"
								accept="image/*"
								@change="loadImage"
							/>
						</div>
						<div class="mb-3">
							<label for="title" class="form-label">Titulo</label>
							<input
								type="text"
								class="form-control"
								id="title"
								v-model="book.title"
							/>
						</div>
						<div class="mb-3">
							<label for="stock" class="form-label">Stock</label>
							<input
								type="number"
								class="form-control"
								id="stock"
								v-model="book.stock"
							/>
						</div>
						<div class="mb-3">
							<label for="description" class="form-label">Descripción</label>
							<textarea
								class="form-control"
								id="description"
								rows="3"
								v-model="book.description"
							></textarea>
						</div>

						<!-- Vue - select libreria -->

						<div class="mb-3">
							<label for="category" class="form-label">Categoría</label>
							<v-select
								id="category"
								:options="categories"
								v-model="book.category_id"
								:reduce="category => category.id"
								label="name"
								:clearable="false"
							></v-select>
						</div>

						<div class="mb-3">
							<label for="author" class="form-label">Autor</label>
							<v-select
								id="author"
								:options="authors"
								v-model="book.author_id"
								:reduce="author => author.id"
								label="name"
								:clearable="false"
							></v-select>
						</div>
						<!-- Para hacer una linea -->
						<hr />
						<section class="d-flex justify-content-center">
							<button
								type="button"
								class="btn btn-secondary mx-1"
								data-bs-dismiss="modal"
							>
								Cerrar
							</button>
							<button type="submit" class="btn btn-primary mx-1">
								<strong>{{ `${is_create ? 'Crear' : 'Actualizar'}` }}</strong>
							</button>
						</section>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ['book_data'],
	data() {
		return {
			is_create: true,
			categories: [],
			authors: [],
			book: {},
			file: null
		}
	},
	created() {
		// Cuando se crea va al index
		this.index()
	},
	methods: {
		index() {
			this.getCategories()
			this.getAuthors()
			this.setBook()
		},
		setBook() {
			if (!this.book_data) return
			this.book = { ...this.book_data }
			// Como estamos creando un libro, ponemos el is_Create en false, y asi se activa la condicion de actualizar o crear
			this.is_create = false
		},
		loadImage(event) {
			// Obtiene el target html y el file que esta dentro de ese HTML, 0 es donde viene el binario
			this.file = event.target.files[0]
		},
		// Carga de la data del formulario con la imagen:
		loadFormData() {
			// El FormData es el tipo de formulario que sube archivos binarios al backend
			const form_data = new FormData()
			// Subir la imagen
			// Si existe el archivo, manda la imagen al form_data
			if (this.file) form_data.append('image', this.file, this.file.name)

			// Para agregarle los campos al formData se usa append
			form_data.append('title', this.book.title)
			form_data.append('stock', this.book.stock)
			form_data.append('description', this.book.description)
			form_data.append('category_id', this.book.category_id)
			form_data.append('author_id', this.book.author_id)
			// Se retorna el form data
			return form_data
		},
		async getCategories() {
			// Con rutas API se hace de esta forma:
			// const { data } = await axios.get('/api/Categories/GetAllCategories')
			// Con rutas WEB se hace de esta forma: (Previamente añadiendo el token crsf en bootstrap.js)
			const { data } = await axios.get('Categories/GetAllCategories')
			this.categories = data.categories
		},
		async getAuthors() {
			// Rutas API:
			// const { data } = await axios.get('/api/Authors/GetAllAuthors')
			// Uso de rutas WEB:
			const { data } = await axios.get('Authors/GetAllAuthors')
			this.authors = data.authors
		},
		async storeBook() {
			try {
				// Acá se crea el book que se manda al backend
				const book = this.loadFormData()
				// Si es crear, me manda a crear, si no, me manda a update
				if (this.is_create) {
					// API
					// Para guardar el libro, le pasamos la dirección api, y el objeto que le vamos a mandar, en este caso this.book
					// await axios.post('api/Books/CreateBook', this.book)
					// WEB
					await axios.post('Books/CreateBook', book)
				} else {
					// API
					// await axios.put(`api/Books/UpdateBook/${this.book.id}`, this.book)
					// WEB:
					await axios.post(`Books/UpdateBookFormData/${this.book.id}`, book)
				}
				// Mensajes de error o success
				swal.fire({
					icon: 'success',
					title: 'Felicidades!',
					text: 'Libro almacenado.'
				})
				// Llamamos a la funcion desde el index, con el parent, como padre desde el hijo, con parent tambien podemos llamar a variables y otras cosas
				this.$parent.closeModal()
			} catch (error) {
				console.error(error)
				swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Algo salió mal!'
				})
			}
		}
	}
}
</script>

