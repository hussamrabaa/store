import Alpine from 'alpinejs';
import './cart';

window.Alpine = Alpine;

Alpine.start();

const boot = () => {
    if (!document.getElementById('bg-scene')) return;

    import('./scene').then(({ initBackgroundScene }) => initBackgroundScene());
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}
