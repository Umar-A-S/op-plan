# OPLAN - Operational Logistics Management System

> Sistem informasi manajemen operasional berbasis web untuk mengotomatisasi logistik operasional.

## 📋 Tentang Proyek

OPLAN adalah platform command center untuk tim operasional yang mengelola:
- **Fleet Management** - Armada kendaraan dan aset
- **Driver Management** - Penugasan dan scheduling driver
- **Delivery Order Processing** - Pemrosesan pesanan pengiriman end-to-end

## 🏗️ Arsitektur Teknis

```
┌─────────────────────────────────────────┐
│  Frontend (Blade Templates/Livewire)    │
├─────────────────────────────────────────┤
│  Laravel 13 Monolith (Backend)          │
├─────────────────────────────────────────┤
│  MySQL Database                          │
└─────────────────────────────────────────┘
       Docker Compose Infrastructure
```

### Stack Teknologi
- **Framework**: Laravel 13
- **Database**: MySQL 8.0
- **Server**: Nginx + PHP-FPM 8.3
- **Containerization**: Docker & Docker Compose

## 📦 Struktur Database

### 1. Fleets Table
```
- id (PK)
- name (Nama armada)
- code (Identitas unik)
- total_vehicles (Jumlah kendaraan)
- status (active/inactive)
- description (Deskripsi)
```

### 2. Drivers Table
```
- id (PK)
- name (Nama pengemudi)
- phone (Nomor telepon)
- license_number (Nomor SIM)
- license_expiry (Masa berlaku SIM)
- status (available/assigned/off_duty)
- rating (Performa driver)
- notes (Catatan)
```

### 3. Delivery Orders Table
```
- id (PK)
- do_number (Identitas DO unik)
- recipient_name (Nama penerima)
- recipient_phone (Nomor penerima)
- delivery_address (Alamat pengiriman)
- status (pending/assigned/in_transit/delivered/failed)
- driver_id (FK)
- fleet_id (FK)
- scheduled_delivery (Jadwal pengiriman)
- actual_delivery (Waktu pengiriman aktual)
- notes (Catatan)
```

## 🚀 Quick Start

### Prerequisites
- Docker & Docker Compose
- Git

### Setup & Run

```bash
# Clone repository
git clone https://github.com/Umar-A-S/op-plan.git
cd op-plan

# Build & start containers
docker-compose up -d

# Run migrations
docker-compose exec app php artisan migrate

# Access application
# App: http://localhost:8080
# MySQL: localhost:3306 (user: oplan, password: oplan123)
```

### Environment Variables
Lihat `.env` untuk konfigurasi:
- APP_NAME=OPLAN
- DB_CONNECTION=mysql
- DB_HOST=db
- DB_PORT=3306
- DB_DATABASE=oplan
- DB_USERNAME=oplan
- DB_PASSWORD=oplan123

## 📋 Core Features (High-Level)

### Fleet Management
- [x] Dashboard armada & status kendaraan
- [ ] Maintenance tracking
- [ ] Dokumentasi izin & asuransi

### Driver Management
- [x] Profil pengemudi
- [x] Tracking skill/sertifikasi
- [ ] Availability scheduling
- [ ] Performance monitoring

### Delivery Order Processing
- [x] Intake & validation DO
- [ ] Intelligent routing & assignment
- [ ] Real-time tracking
- [ ] Proof of delivery (POD)

### Operational Dashboard
- [ ] Real-time command center view
- [ ] Analytics & reporting
- [ ] Notification system

## 📁 Project Structure

```
op-plan/
├── app/
│   ├── Models/              # Eloquent models (Fleet, Driver, DO)
│   ├── Http/
│   │   ├── Controllers/     # API & Web controllers
│   │   └── Requests/        # Form request validations
│   └── Services/            # Business logic
├── database/
│   ├── migrations/          # Schema migrations
│   └── seeders/             # Database seeders
├── resources/
│   ├── views/               # Blade templates
│   └── css/                 # Styling
├── routes/
│   ├── web.php              # Web routes
│   └── api.php              # API routes
├── docker/                  # Docker configuration
│   └── nginx.conf           # Nginx config
├── docker-compose.yml       # Docker Compose setup
├── Dockerfile               # PHP-FPM image
└── README.md                # Documentation
```

## 🔄 Development Workflow

1. **Issue Planning** - Breakdown features ke issues
2. **Database Schema** - Design & migrate schema
3. **Models & Relations** - Setup Eloquent models
4. **Controllers** - Build business logic
5. **Views & Frontend** - Create UI
6. **Testing** - Unit & integration tests
7. **Deployment** - Docker deployment

## 📝 Next Steps (Roadmap)

- [ ] Create seeders untuk demo data
- [ ] Build API endpoints (REST)
- [ ] Implement authentication & authorization
- [ ] Create command center dashboard
- [ ] Add real-time notifications
- [ ] Implement routing algorithm
- [ ] Add analytics & reporting

## 🛠️ Development Commands

```bash
# Run artisan commands
docker-compose exec app php artisan [command]

# Run migrations
docker-compose exec app php artisan migrate

# Create seeder
docker-compose exec app php artisan make:seeder

# Clear cache
docker-compose exec app php artisan cache:clear

# View logs
docker-compose logs -f app
```

## 📞 Support

Untuk pertanyaan atau issue, buat GitHub Issue di repository ini.

---

**Status**: Development Phase  
**Last Updated**: 2026-06-22  
**Version**: 1.0.0-planning
