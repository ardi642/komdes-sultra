import AOS from 'aos';
import 'aos/dist/aos.css';

import TomSelect from 'tom-select';
window.TomSelect = TomSelect;

import Sortable from 'sortablejs';
window.Sortable = Sortable;

import Chart from 'chart.js/auto';
window.Chart = Chart;

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        AOS.init({
            duration: 600,
            once: true,
            offset: 50,
        });
    }, 100);
});
