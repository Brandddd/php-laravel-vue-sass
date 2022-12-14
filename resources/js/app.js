import './bootstrap'
import { createApp } from 'vue'

import vSelect from 'vue-select'

// -------------------------- Componentes -------------------------
import ExampleComponent from './components/ExampleComponent.vue' // Forma de importar componentes
import BooksList from './components/Books/Index.vue'

const app = createApp({
	components: {
		ExampleComponent,
		BooksList
	}
})

app.component('v-select', vSelect)

// Para usar los componentes con un div, deben tener el id='app'
app.mount('#app') // Se monta la aplicacion en un id que se llama app, se llama en layouts/app.blade.php

// app.component('example-component', ExampleComponent) // Se le da el nombre al componente para registrarlo. PARA COMPONENTES GLOBALES
