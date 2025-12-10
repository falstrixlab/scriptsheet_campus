# 🚀 AltoMusic - Quick Start Guide

## ⚡ 60-Second Setup

### 1. Install Dependencies
```bash
cd C:\xampp\htdocs\altomusic
composer install
```

### 2. Verify Configuration
```bash
php status_check.php
```
Expected: ✅ All 42 checks passing (100%)

### 3. Setup Database
```sql
-- Create database if not exists
CREATE DATABASE db_alto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Run migrations (if available)
-- php spark migrate
```

### 4. Start Development Server
```bash
php spark serve
```

### 5. Access Application
- **Homepage:** http://localhost:8080/altomusic/
- **Admin:** http://localhost:8080/altomusic/administrator/
- **API:** http://localhost:8080/altomusic/api/profile

---

## 📋 Verification Commands

### Check Status
```bash
php status_check.php
```
Verifies:
- Configuration files ✓
- Controllers ✓
- Models ✓
- Directory structure ✓
- Permissions ✓
- PHP extensions ✓

### Test Database Connection
```bash
php test_connection.php
```

### View Logs
```bash
tail -f writable\logs\log-*.log
```

### Clear Cache
```bash
php spark cache:clear
```

---

## 🛣️ Key Routes

### Frontend
- `/` - Homepage
- `/site/kanal/beranda` - Beranda channel
- `/site/kanal/galeri` - Gallery channel
- `/site/kanal/event` - Events channel
- `/site/kanal/studio` - Studios channel
- `/site/detail/1/berita` - News details
- `/site/studio_detail/1` - Studio details

### Authentication
- `/auth` - Login/Register
- `/auth/registrasi` - User registration
- `/auth/login` - User login (POST)
- `/auth/logout` - User logout
- `/auth/booking/1` - Studio booking
- `/auth/invoice/1` - Booking invoice
- `/auth/proses_konfirmasi` - Confirm booking

### Admin Dashboard
- `/administrator/` - Dashboard
- `/administrator/activation_account/1` - Approve accounts
- `/administrator/studio` - Studio management
- `/administrator/jadwal` - Schedule management
- `/administrator/news` - News management
- `/administrator/event` - Event management
- `/administrator/gallery` - Gallery management
- `/administrator/user` - User management

### Content Management
- `/configs/add_galeri` - Add gallery
- `/configs/add_berita` - Add news
- `/configs/add_event` - Add event
- `/configs/add_studio` - Add studio
- `/configs/add_jadwal` - Add schedule

### API
- `GET /api/profile` - List profiles
- `GET /api/profile/1` - Get profile
- `POST /api/profile` - Create profile
- `PUT /api/profile/1` - Update profile
- `DELETE /api/profile/1` - Delete profile
- `GET /api/profile/all` - All profiles
- `GET /api/profile/search/field/value` - Search profiles

---

## 📁 Directory Structure

```
altomusic/
├── app/
│   ├── Controllers/          # 6 controllers + API
│   ├── Models/               # Crud model
│   ├── Config/               # Configuration files
│   │   ├── App.php          # Application config
│   │   ├── Database.php     # Database config
│   │   ├── Routes.php       # URL routing (complete)
│   │   └── ...
│   └── Views/                # View templates
├── public/                    # Web root
├── writable/
│   ├── cache/                # Cache files
│   ├── logs/                 # Application logs
│   ├── session/              # Session storage
│   └── uploads/              # User files
│       ├── ktp/
│       ├── bukti/
│       ├── galeri/
│       ├── berita/
│       ├── event/
│       ├── logo/
│       ├── user/
│       └── gambar/
├── .env                      # Environment config
├── status_check.php          # Verification script
├── test_connection.php       # Database test
├── SETUP_GUIDE.md           # Setup instructions
├── MIGRATION_REPORT.md      # Migration details
└── README.md                 # Project info
```

---

## ⚙️ Configuration Files

### .env (Database & Environment)
```env
database.default.hostname = localhost
database.default.database = db_alto
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### app/Config/App.php (Application)
```php
public string $baseURL = 'http://localhost/altomusic/';
public string $indexPage = 'index.php';
public string $uriProtocol = 'REQUEST_URI';
```

### app/Config/Routes.php (Routing)
- Frontend: Site controller
- Auth: User authentication
- Admin: Administrator dashboard
- Config: Content management
- API: RESTful endpoints

---

## 🔧 Common Tasks

### Add New Route
Edit `app/Config/Routes.php`:
```php
$routes->get('path', 'Controller::method');
$routes->post('path', 'Controller::method');
```

### Create New Controller
```bash
php spark make:controller YourController
```

### Create New Model
```bash
php spark make:model YourModel
```

### Clear Application Cache
```bash
php spark cache:clear
```

### Run Database Migrations
```bash
php spark migrate
```

### Create Migration
```bash
php spark make:migration CreateTableName
```

---

## 🐛 Troubleshooting

### Page Not Found
- [ ] Verify route exists in `app/Config/Routes.php`
- [ ] Check .htaccess in public/
- [ ] Enable mod_rewrite in Apache
- [ ] Clear cache: `php spark cache:clear`

### Database Connection Error
- [ ] Verify .env database credentials
- [ ] Check MySQL running on port 3306
- [ ] Ensure database `db_alto` exists
- [ ] Run: `php test_connection.php`

### File Upload Fails
- [ ] Check directory permissions
- [ ] Verify upload directory exists
- [ ] Check file size limits in php.ini
- [ ] Review logs: `writable/logs/`

### Session Not Working
- [ ] Verify `writable/session/` is writable
- [ ] Check session driver in App.php
- [ ] Clear session directory
- [ ] Check PHP session settings

### API Not Responding
- [ ] Verify API routes in Routes.php
- [ ] Check Content-Type headers
- [ ] Review error logs
- [ ] Test with curl or Postman

---

## 📊 Performance Tips

1. **Enable Caching**
   - Configure in `app/Config/Cache.php`
   - Use database cache for better performance

2. **Database Optimization**
   - Add indexes on frequently queried columns
   - Use query caching where applicable
   - Regular database backups

3. **File Handling**
   - Limit upload file sizes
   - Implement virus scanning
   - Regular cleanup of old files

4. **Session Management**
   - Consider database or Redis for production
   - Set appropriate session timeouts
   - Regular session cleanup

5. **Code Optimization**
   - Use eager loading for relations
   - Cache frequently accessed data
   - Minimize database queries

---

## 🔐 Security Checklist

Before deploying to production:
- [ ] Change database password
- [ ] Enable HTTPS
- [ ] Set encryption key in .env
- [ ] Disable debug mode
- [ ] Set proper file permissions
- [ ] Implement input validation
- [ ] Use parameterized queries
- [ ] Add rate limiting
- [ ] Configure CORS properly
- [ ] Set security headers

---

## 📚 Documentation

- **SETUP_GUIDE.md** - Complete setup instructions
- **MIGRATION_REPORT.md** - Migration details & status
- **README.md** - Project information
- **QUICKSTART.md** - This file

---

## 🎯 What's New in CI4

✨ **Key Improvements:**
- Modern namespaced classes
- Service container & dependency injection
- Cleaner query builder with array syntax
- Native RESTful support
- Built-in security features
- Better error handling
- Modern routing system
- Helper functions instead of libraries

---

## 📞 Need Help?

- **CodeIgniter 4 Docs:** https://codeigniter.com/user_guide/
- **Status Check:** `php status_check.php`
- **Test Connection:** `php test_connection.php`
- **View Logs:** `tail -f writable/logs/log-*.log`

---

**✅ Project Status: READY TO USE**

Last Updated: 2025-12-10
