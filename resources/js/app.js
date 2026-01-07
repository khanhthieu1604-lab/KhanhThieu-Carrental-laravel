import './bootstrap';

// Sử dụng import trực tiếp từ package name để Vite tự động phân giải đường dẫn chuẩn
import anime from 'animejs'; 
import Alpine from 'alpinejs';

window.Alpine = Alpine;
// Gán anime vào đối tượng window để có thể gọi từ các file Blade (như file welcome.blade.php bạn vừa sửa)
window.anime = anime;

Alpine.start();