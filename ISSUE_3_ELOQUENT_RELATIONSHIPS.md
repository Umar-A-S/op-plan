## Chore: Implement Eloquent Relationships, Factories, and Seeders

### 📋 Deskripsi Singkat

Untuk mendukung testing dan development fase berikutnya, project memerlukan:
1. **Relasi Eloquent** antar model (Fleet → Drivers, Fleet → DeliveryOrders, Driver → DeliveryOrders) agar querying data lebih efisien dan maintainable.
2. **Model Factory** untuk setiap entitas (Fleet, Driver, DeliveryOrder) guna generate data dummy dengan realistic values.
3. **Database Seeder** untuk populate database dengan sample data yang memudahkan testing dashboard, routing logic, dan features operasional.

Tanpa setup ini, development controllers dan views akan terhambat karena tidak ada data sample untuk testing. Issue ini adalah prerequisite untuk Phase berikutnya (Controllers & Dashboard Development).

---

### ✅ Checklist Tugas

**Eloquent Relationships:**
- [ ] Setup relasi `hasMany` di Fleet model (fleet memiliki banyak driver & delivery orders)
- [ ] Setup relasi `belongsTo` di Driver model (driver milik fleet)
- [ ] Setup relasi `belongsTo` di DeliveryOrder model (DO dimiliki driver & fleet)
- [ ] Tambahkan inverse relations (hasMany) di Driver untuk DeliveryOrders
- [ ] Verify relationships dengan tinker command: `php artisan tinker`

**Factory Implementation:**
- [ ] Buat FleetFactory dengan realistic data (name, code, vehicles count)
- [ ] Buat DriverFactory dengan realistic data (name, phone, license_number, expiry date)
- [ ] Buat DeliveryOrderFactory dengan realistic data (DO number, addresses, status transitions)
- [ ] Implementasikan state() methods jika diperlukan (misal: Factory::active(), Factory::pending())
- [ ] Test factory dengan `php artisan tinker` (create sample records)

**Seeder Implementation:**
- [ ] Buat DatabaseSeeder dengan call ke sub-seeders
- [ ] Buat FleetSeeder (create 3-5 fleets)
- [ ] Buat DriverSeeder (create 10-15 drivers, distribute ke fleets)
- [ ] Buat DeliveryOrderSeeder (create 20-30 orders, assign ke drivers & fleets)
- [ ] Seeder harus idempotent (dapat dijalankan multiple times tanpa duplicate errors)

**Testing & Validation:**
- [ ] Run `php artisan migrate:fresh --seed` tanpa errors
- [ ] Verify data integrity (foreign key constraints, relationships working)
- [ ] Dump sample queries untuk confirm relationships function correctly

---

### 🎯 Kriteria Penerimaan

**Relasi Eloquent:**
- ✅ Semua relationships dapat di-load dengan eager loading: `Fleet::with('drivers', 'deliveryOrders')->get()`
- ✅ Inverse relationships bekerja: `Driver::find(1)->fleet()` returns Fleet object
- ✅ Relasi tidak menghasilkan N+1 queries (tested dengan Laravel Debugbar atau query log)

**Model Factory:**
- ✅ `Fleet::factory()->count(5)->create()` menghasilkan 5 fleet records
- ✅ `Driver::factory()->count(10)->create()` menghasilkan 10 driver records  
- ✅ `DeliveryOrder::factory()->count(20)->create()` menghasilkan 20 DO records
- ✅ Factory-generated data valid dan sesuai constraints (unique phone, license_number; valid status enum)

**Seeder:**
- ✅ Command `php artisan db:seed` berjalan tanpa errors
- ✅ Command `php artisan migrate:fresh --seed` berjalan tanpa errors
- ✅ Database populated dengan:
  - Minimum 5 Fleets
  - Minimum 15 Drivers (distributed across fleets)
  - Minimum 30 Delivery Orders (mixed status: pending, assigned, in_transit, delivered)
- ✅ Semua foreign key constraints terpenuhi (no orphaned records)
- ✅ Seeder dapat dijalankan multiple times tanpa duplicate errors (idempotent)

**Code Quality:**
- ✅ Relationships documented dengan comments (return types)
- ✅ Factories menggunakan faker provider yang appropriate (dates, phone numbers, addresses)
- ✅ No hardcoded values di Seeders (use randomization untuk realistic data)

---

### 📌 Catatan Teknis

#### Struktur Relasi yang Diharapkan:
```
Fleet (1) ──┬──→ (M) Drivers
            └──→ (M) DeliveryOrders

Driver (M) ──→ (1) Fleet
Driver (1) ──→ (M) DeliveryOrders

DeliveryOrder (M) ──→ (1) Driver
DeliveryOrder (M) ──→ (1) Fleet
```

#### Contoh Implementasi:
```php
// Fleet.php
public function drivers() { return $this->hasMany(Driver::class); }
public function deliveryOrders() { return $this->hasMany(DeliveryOrder::class); }

// Driver.php
public function fleet() { return $this->belongsTo(Fleet::class); }
public function deliveryOrders() { return $this->hasMany(DeliveryOrder::class); }

// DeliveryOrder.php
public function driver() { return $this->belongsTo(Driver::class); }
public function fleet() { return $this->belongsTo(Fleet::class); }
```

#### Sample Seeder Data:
- **Fleets**: Express Fleet, Regional Logistics, Urban Delivery
- **Drivers**: Generated dengan Faker (name, phone, license)
- **DOs**: Mix of statuses (30% pending, 30% assigned, 20% in_transit, 20% delivered)

---

### 📚 Referensi

- [Laravel Eloquent Relationships](https://laravel.com/docs/11.x/eloquent-relationships)
- [Model Factories](https://laravel.com/docs/11.x/eloquent-factories)
- [Database Seeders](https://laravel.com/docs/11.x/seeding)

---

### 🏷️ Labels
- `chore` - Setup/maintenance task
- `enhancement` - Improves development workflow
- `database` - Database-related changes
- `dependencies` - Prerequisite for other issues

---

### 📊 Estimate
- **Effort**: Medium (2-3 hours)
- **Priority**: High (blocker untuk next phase)
- **Complexity**: Low-Medium (straightforward Laravel patterns)

---

### 🔗 Related Issues
- Closes: Dependency untuk #4 (Controllers & CRUD Implementation)
- Related to: #2 (Project Setup & Planning)
