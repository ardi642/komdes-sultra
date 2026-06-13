import AOS from 'aos';
import 'aos/dist/aos.css';

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        AOS.init({
            duration: 600,
            once: true,
            offset: 50,
        });
    }, 100);
});
