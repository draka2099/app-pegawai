
import './bootstrap';

import Alpine from 'alpinejs';
import anchor from '@alpinejs/anchor'; // <-- Impor plugin

Alpine.plugin(anchor); // <-- Daftarkan plugin

window.Alpine = Alpine;

Alpine.start();