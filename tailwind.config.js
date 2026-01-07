import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                // Font tiêu đề sang trọng
                heading: ['Playfair Display', 'serif'], 
            },
            colors: {
                // Sử dụng Zinc làm tone màu Gray mặc định (sang hơn)
                gray: colors.zinc,
                
                // Màu vàng Gold Luxury
                yellow: {
                    50: '#fffbeb', 100: '#fef3c7', 200: '#fde68a', 300: '#fcd34d',
                    400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309',
                    800: '#92400e', 900: '#78350f', 950: '#451a03',
                },
                
                // Dark mode đặc thù (Matte Black)
                dark: {
                    800: '#1a1a1a',
                    900: '#121212', 
                    950: '#050505',
                }
            },
            // --- NÂNG CẤP THÊM ---
            animation: {
                'shimmer': 'shimmer 2s linear infinite',
                'float': 'float 6s ease-in-out infinite',
                'marquee': 'marquee 25s linear infinite',
            },
            keyframes: {
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
                marquee: {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-50%)' },
                }
            },
            backgroundImage: {
                // Hiệu ứng ánh kim cho text hoặc card
                'gradient-gold': 'linear-gradient(to right, #f59e0b, #fde68a, #f59e0b)',
            }
        },
    },

    plugins: [
        forms,
        // Plugin hỗ trợ viết các tiện ích 3D đơn giản
        function({ addUtilities }) {
            addUtilities({
                '.preserve-3d': {
                    'transform-style': 'preserve-3d',
                },
                '.perspective-1000': {
                    'perspective': '1000px',
                },
                '.backface-hidden': {
                    'backface-visibility': 'hidden',
                },
            })
        }
    ],
};