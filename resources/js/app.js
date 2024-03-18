import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// window.ApexCharts = ApexCharts;

Alpine.start();

import '../css/nucleo-icons.css';
import '../css/nucleo-svg.css';
import '../css/argon-dashboard-tailwind.css';
import '../css/tooltips.css';
import '../css/perfect-scrollbar.css';
import 'sweetalert2/dist/sweetalert2.min.css';


import './chartjs.min';
import './perfect-scrollbar.min';
//import './carousel';
import './dropdown';
import './dark-mode';
import './navbar-sticky';
//import './sidenav';
import './sidenav-burger';

import './tooltips';
import './nav-pills';
import './charts';
import './argon-dashboard-tailwind';
//import './navbar-collapse';

/*import.meta.global([
    '../img/!**',
    '../fonts/!**',
]);*/

import $ from 'jquery';
window.$ = window.jQuery = $;

import { createPopper } from "@popperjs/core";
window.createPopper = createPopper;

window.addEventListener('selected', function(e) {
    console.log(e.detail.value); // Select option value(s)
    console.log(e.detail.name); // The select element name
    console.log(e.detail.id); // The select element ID
    console.log(e );

    Livewire.emit('changeSelect', [e.detail.name, e.detail.value, e.detail.id]);
});
