export default {
    plugins: {
        // Xử lý import các file CSS nhỏ vào file chính
        'postcss-import': {},
        
        // Tailwind CSS xử lý các class tiện ích
        tailwindcss: {},
        
        // Tự động thêm tiền tố (prefix) cho các trình duyệt cũ (VD: -webkit-, -moz-)
        // Giúp các hiệu ứng Glassmorphism và Backdrop-blur chạy ổn định trên Safari
        autoprefixer: {},
        
        // Tối ưu hóa và nén CSS khi chạy lệnh 'npm run build'
        ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {}),
    },
};