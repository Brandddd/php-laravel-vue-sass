import './bootstrap'
import { createApp } from 'vue'

// -------------------------- Componentes -------------------------
import ExampleComponent from './components/ExampleComponent.vue' // Forma de importar componentes

const app = createApp({
	components: {
		ExampleComponent
	}
})

// Para usar los componentes con un div, deben tener el id='app'
app.mount('#app') // Se monta la aplicacion en un id que se llama app, se llama en layouts/app.blade.php

// app.component('example-component', ExampleComponent) // Se le da el nombre al componente para registrarlo. PARA COMPONENTES GLOBALES
