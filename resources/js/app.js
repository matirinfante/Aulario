require('./bootstrap');

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import 'datatables.net-bs5';
import $ from 'jquery';

window.$ = window.jQuery = $;
window.Alpine = Alpine;

Alpine.start();


window.Swal = require('sweetalert2');
