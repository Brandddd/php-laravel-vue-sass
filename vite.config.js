import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
	// tipo de servidor:
	server: {
		hmr: {
			host: 'localhost'
		}
	},
	plugins: [
		laravel({
			input: ['resources/sass/app.scss', 'resources/js/app.js'],
			refresh: true
		}),
		vue()
	],
	resolve: {
		alias: {
			vue: 'vue/dist/vue.esm-bundler.js', // Alliases: Cualquier archivo que se use con vite, se hace para asignarle un alias a las rutas
			'@': path.resolve(__dirname, 'resources/js'), // Hace referenca a los resorces con el @
			'~': path.resolve(__dirname, 'node_modules') // Hace referencia a los modulos de node
		}
	}
})
