import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'; // Thêm để cấu hình Alias

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js'
            ],
            refresh: true, // Tự động reload trình duyệt khi sửa file
        }),
    ],
    resolve: {
        alias: {
            // Cho phép dùng '@' để trỏ nhanh vào thư mục resources/js
            '@': path.resolve(__dirname, './resources/js'),
            // Alias cho các file CSS/SCSS nếu cần
            '~': path.resolve(__dirname, './resources'),
        },
    },
    build: {
        // Tối ưu hóa việc gom nhóm file (Chunking) để trang web tải nhanh hơn
        chunkSizeWarningLimit: 1600,
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString();
                    }
                },
            },
        },
    },
});