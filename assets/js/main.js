import '../scss/main.scss';

// Make every file in assets/images part of the build (hashed + listed in the manifest)
import.meta.glob('../images/**/*.{png,jpg,jpeg,gif,svg,webp,avif}', { eager: true });

// ---- Theme JS ----
document.documentElement.classList.add('js');
