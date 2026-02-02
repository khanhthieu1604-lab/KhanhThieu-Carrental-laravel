# 🚗 Thiuu Rental Elite

Hệ thống quản lý cho thuê xe cao cấp được xây dựng bằng Laravel 12, cung cấp giải pháp toàn diện cho doanh nghiệp cho thuê xe với giao diện hiện đại và tính năng đầy đủ.

## ✨ Tính năng chính

- 🚙 **Quản lý xe**: Thêm, sửa, xóa và theo dõi danh mục xe đa dạng
- 📅 **Đặt xe trực tuyến**: Hệ thống đặt xe thông minh với kiểm tra tình trạng sẵn sàng
- 💳 **Thanh toán VNPay**: Tích hợp cổng thanh toán VNPay an toàn
- 👤 **Quản lý người dùng**: Hệ thống xác thực và phân quyền với Backpack
- 📊 **Dashboard Admin**: Thống kê, báo cáo chi tiết về doanh thu và hoạt động
- 📧 **Thông báo Email**: Gửi xác nhận đặt xe và email thông báo
- 🔍 **Tìm kiếm nâng cao**: TNTSearch cho tìm kiếm nhanh chóng
- 🌐 **Đa ngôn ngữ**: Hỗ trợ Tiếng Việt và Tiếng Anh
- 📱 **Responsive**: Giao diện tối ưu cho mọi thiết bị

## 🛠️ Công nghệ sử dụng

- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: Blade Templates, TailwindCSS, Alpine.js
- **Database**: MySQL 8.0
- **Cache & Queue**: Redis 7
- **Search**: Laravel Scout + TNTSearch
- **Admin Panel**: Laravel Backpack
- **Payment**: VNPay Gateway
- **PDF**: DomPDF

## 🐳 Docker Setup (Khuyến nghị)

### Yêu cầu hệ thống

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) 20.10+
- [Docker Compose](https://docs.docker.com/compose/install/) 2.0+
- 4GB RAM trở lên
- 10GB dung lượng ổ đĩa trống

### Khởi động nhanh

```bash
# Clone repository
git clone <repository-url>
cd Thiuu

# Build Docker images
docker-compose build --no-cache

# Khởi động containers
docker-compose up -d

# Xem logs
docker-compose logs -f
```

**Lưu ý:** Khi khởi động lần đầu, containers sẽ tự động:
- Chạy database migrations
- Generate APP_KEY (nếu chưa có)
- Build frontend assets
- Cấu hình permissions

Quá trình này có thể mất 1-2 phút.

### Kiến trúc Docker

Dự án sử dụng 7 containers:

| Service | Mô tả | Port |
|---------|-------|------|
| **thiuu_app** | PHP 8.2-FPM + Laravel | - |
| **thiuu_nginx** | Web server Nginx | 8080 |
| **thiuu_mysql** | MySQL 8.0 Database | 3307 |
| **thiuu_redis** | Redis Cache & Queue | 6379 |
| **thiuu_queue** | Laravel Queue Worker | - |
| **thiuu_phpmyadmin** | Database Management UI | 8089 |
| **thiuu_mailhog** | Email Testing Tool | 1025, 8025 |

### Truy cập ứng dụng

Sau khi containers khởi động thành công:

- **🌐 Web Application**: http://localhost:8080
- **🗄️ phpMyAdmin**: http://localhost:8089
  - Server: `mysql`
  - Username: `root`
  - Password: `password`
- **📧 Mailhog (Email Testing)**: http://localhost:8025
- **💾 MySQL Database**: `localhost:3307`
  - Database: `laravel`
  - Username: `laravel`
  - Password: `password`
- **🔴 Redis**: `localhost:6379`

### Quản lý Docker containers

```powershell
# Xem trạng thái containers
docker-compose ps

# Xem logs
docker-compose logs -f

# Xem logs của service cụ thể
docker-compose logs -f app
docker-compose logs -f nginx

# Dừng tất cả services
docker-compose down

# Dừng và xóa volumes (reset hoàn toàn)
docker-compose down -v

# Khởi động lại service cụ thể
docker-compose restart app

# Rebuild containers sau khi thay đổi code
docker-compose build app
docker-compose up -d
```

### Chạy lệnh Laravel trong container

```powershell
# Artisan commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan tinker

# Composer
docker-compose exec app composer install
docker-compose exec app composer update

# NPM (nếu cần rebuild assets)
docker-compose exec app npm install
docker-compose exec app npm run build

# Truy cập bash shell
docker-compose exec app bash
```

### Cấu hình môi trường

Docker sử dụng file `.env.docker` cho cấu hình containers. File này đã được cấu hình sẵn với:

- ✅ APP_KEY đã được generate
- ✅ Database connection đến MySQL container
- ✅ Redis cho cache và sessions
- ✅ Mailhog cho email testing
- ✅ VNPay gateway configuration

**Lưu ý quan trọng:**
- File `.env` trong container sẽ được tự động tạo từ `.env.docker`
- Không cần chạy `php artisan key:generate` thủ công
- Migrations sẽ tự động chạy khi container khởi động

## 💻 Cài đặt thủ công (không dùng Docker)

### Yêu cầu

- PHP 8.2+
- Composer
- Node.js 20+
- MySQL 8.0+
- Redis (optional)

### Các bước cài đặt

```bash
# 1. Clone repository
git clone <repository-url>
cd Thiuu

# 2. Cài đặt dependencies
composer install
npm install

# 3. Tạo file .env
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Cấu hình database trong .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# 6. Chạy migrations và seeders
php artisan migrate --seed

# 7. Tạo storage symlink
php artisan storage:link

# 8. Build frontend assets
npm run build

# 9. Khởi động server
php artisan serve
```

Truy cập: http://localhost:8000

## 🔧 Troubleshooting

### Docker Issues

**Port đã được sử dụng:**
```powershell
# Thay đổi ports trong docker-compose.yml
ports:
  - "8081:80"  # Nginx
  - "3308:3306"  # MySQL
  - "8090:80"  # phpMyAdmin
```

**Container không khởi động:**
```powershell
# Xem logs chi tiết
docker-compose logs app

# Rebuild container
docker-compose build --no-cache app
docker-compose up -d
```

**Database connection failed:**
```powershell
# Kiểm tra MySQL container
docker-compose logs mysql

# Restart MySQL
docker-compose restart mysql
```

**APP_KEY không được set:**
```powershell
# Generate key trong container
docker-compose exec app php artisan key:generate
docker-compose restart app
```

**Frontend assets không load:**
```powershell
# Rebuild assets
docker-compose exec app npm run build
docker-compose restart nginx
```

**Queue không chạy:**
```powershell
# Kiểm tra queue worker
docker-compose logs queue

# Restart queue worker
docker-compose restart queue
```

### General Issues

**500 Server Error:**
- Kiểm tra file permissions: `storage/` và `bootstrap/cache/` phải writeable
- Xem log: `storage/logs/laravel.log`
- Clear cache: `php artisan optimize:clear`

**Database migration lỗi:**
- Kiểm tra database credentials trong `.env`
- Reset database: `php artisan migrate:fresh --seed`

**Email không gửi được:**
- Với Docker: Kiểm tra http://localhost:8025 (Mailhog)
- Kiểm tra cấu hình MAIL trong `.env`

## 📝 Cấu hình VNPay

Để sử dụng tính năng thanh toán VNPay, cập nhật các biến môi trường trong `.env` hoặc `.env.docker`:

```env
VNPAY_TMN_CODE=your_terminal_code
VNPAY_HASH_SECRET=your_hash_secret
VNPAY_URL=https://sandbox.vnpayment.vn/paymentv2/vpcpay.html
VNPAY_RETURN_URL="${APP_URL}/payment/vnpay/return"
```

## 🔑 Tài khoản mặc định

Sau khi seed database:

**Admin:**
- Email: `admin@thiuurental.com`
- Password: `password`

**User:**
- Email: `user@example.com`
- Password: `password`

## 📚 Tài liệu

- [Laravel Documentation](https://laravel.com/docs)
- [Backpack Documentation](https://backpackforlaravel.com/docs)
- [VNPay Integration Guide](https://sandbox.vnpayment.vn/apis/docs/)
- [Docker Documentation](https://docs.docker.com/)

## 🤝 Đóng góp

Mọi đóng góp đều được chào đón! Vui lòng:

1. Fork repository
2. Tạo feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

## 📄 License

Dự án này được phát hành dưới [MIT License](LICENSE).

## 👨‍💻 Tác giả

**Thiuu Rental Elite Team**

---

⭐ Nếu dự án hữu ích, hãy cho chúng tôi một star!
