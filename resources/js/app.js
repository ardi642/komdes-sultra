import AOS from 'aos';
import 'aos/dist/aos.css';

// Alpine and Livewire are loaded by Laravel

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        AOS.init({
            duration: 600,
            once: true,
            offset: 50,
        });
    }, 100);
});

document.addEventListener('livewire:init', () => {
    // Interceptor untuk Penanganan Error Global
    Livewire.hook('request', ({ fail }) => {
        fail(({ status, preventDefault }) => {
            let message = '';
            
            if (status === 0) {
                message = 'Koneksi ke server terputus. Silakan periksa jaringan Anda.';
            } else if (status === 419 || status === 401) {
                message = 'Sesi Anda telah berakhir. Halaman akan dimuat ulang...';
                setTimeout(() => window.location.reload(), 2000);
            } else if (status === 413) {
                message = 'File yang Anda unggah terlalu besar.';
            } else if (status === 403) {
                message = 'Akses ditolak: Anda tidak memiliki izin untuk melakukan tindakan ini.';
            } else if (status === 404) {
                message = 'Data atau halaman tidak ditemukan.';
            } else {
                message = 'Terjadi kesalahan pada sistem atau database. Silakan coba lagi.';
            }

            // Dispatch global toast event
            window.dispatchEvent(new CustomEvent('window-toast', {
                detail: { type: 'error', message: message }
            }));

            // Prevent default Livewire error modal
            preventDefault();
        });
    });
});
