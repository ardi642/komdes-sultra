import TomSelect from 'tom-select';
window.TomSelect = TomSelect;

import Sortable from 'sortablejs';
window.Sortable = Sortable;

window.loadChartJs = async () => {
    const module = await import('chart.js/auto');
    return module.default;
};

window.loadTinyMCE = async () => {
    const module = await import('./tinymce-loader.js');
    return module.default;
};

