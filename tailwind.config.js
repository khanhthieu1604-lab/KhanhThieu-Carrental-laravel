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
            // --- PHASE 4: TYPOGRAPHY & ANIMATION ENHANCEMENTS ---
            fontSize: {
                'xs': ['0.75rem', { lineHeight: '1.5' }],      // 12px
                'sm': ['0.875rem', { lineHeight: '1.5' }],     // 14px
                'base': ['1rem', { lineHeight: '1.6' }],       // 16px
                'lg': ['1.125rem', { lineHeight: '1.6' }],     // 18px
                'xl': ['1.333rem', { lineHeight: '1.5' }],     // ~21px
                '2xl': ['1.777rem', { lineHeight: '1.4' }],    // ~28px
                '3xl': ['2.369rem', { lineHeight: '1.3' }],    // ~38px
                '4xl': ['3.157rem', { lineHeight: '1.2' }],    // ~50px
                '5xl': ['4.209rem', { lineHeight: '1.1' }],    // ~67px
                '6xl': ['5.61rem', { lineHeight: '1' }],       // ~90px
            },
            letterSpacing: {
                'tightest': '-0.05em',
                'tighter': '-0.025em',
                'tight': '-0.0125em',
                'normal': '0',
                'wide': '0.025em',
                'wider': '0.05em',
                'widest': '0.1em',
                'ultra-wide': '0.2em',
            },
            animation: {
                'shimmer': 'shimmer 2s linear infinite',
                'float': 'float 6s ease-in-out infinite',
                'float-delay-1': 'float 6s ease-in-out 1s infinite',
                'float-delay-2': 'float 6s ease-in-out 2s infinite',
                'marquee': 'marquee 25s linear infinite',
                'fade-in': 'fade-in 0.6s ease-out forwards',
                'slide-in-left': 'slide-in-left 0.6s ease-out forwards',
                'slide-in-right': 'slide-in-right 0.6s ease-out forwards',
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
                },
                'fade-in': {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                'slide-in-left': {
                    '0%': { transform: 'translateX(-100%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                },
                'slide-in-right': {
                    '0%': { transform: 'translateX(100%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
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
        function ({ addUtilities }) {
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