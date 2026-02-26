import './bootstrap';
import { animate, createTimeline } from 'animejs';
import Alpine from 'alpinejs';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

// Swiper
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

// Flatpickr for date picking 
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

// Adapter for Anime.js v4 to maintain v3 compatibility
const anime = (params) => animate(params);
anime.timeline = (params) => createTimeline(params);

window.Alpine = Alpine;
window.anime = anime;
window.Swiper = Swiper;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.Lenis = Lenis;
window.flatpickr = flatpickr;

Alpine.start();

// ========================================
// PHASE 4: SCROLL REVEAL SYSTEM
// ========================================

document.addEventListener('DOMContentLoaded', () => {
    // Intersection Observer for scroll reveals
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                // Optionally unobserve after reveal
                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observe all scroll-reveal elements
    document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right').forEach(el => {
        revealObserver.observe(el);
    });

    // Smooth scroll with Lenis (optional but premium)
    if (typeof Lenis !== 'undefined') {
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            orientation: 'vertical',
            smoothWheel: true,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }

        requestAnimationFrame(raf);
    }
});