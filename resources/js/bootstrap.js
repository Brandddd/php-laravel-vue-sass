import _ from 'lodash'
import axios from 'axios'
import * as bootstrap from 'bootstrap'
import swal from 'sweetalert2'

// Con el window, las importaciones quedan globales para todo el aplicativo
// Procesamiento de array y objetos ver documentacion de lodash, solo con llamar _ en cualquier parte se trae lodash
window._ = _
// Solo con llamar swal en cualquier parte se trae todo lo de sweetalert.
window.swal = swal
// Solo con llamar axios en cualquier parte se trae todo lo de axios.
window.axios = axios
// Peticiones con ajax, cada peticion con axios, se manda con esta cabecera.
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
// Trayendolo para todo el proyecto.
window.bootstrap = bootstrap
