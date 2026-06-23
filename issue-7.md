### 📋 Issue #7 - Operational Dashboard (PLANNED)                                                                                                    
**Title:** Feature: Implement Operational Dashboard for Admin & Manager                                                                              
**Status:** 📋 Planned                                                                                                                               
**Prioritas:** Tinggi                                                                                                                                
**Estimasi Waktu:** 5 hari kerja                                                                                                                     
**Tujuan:** Menyediakan dasbor operasional yang komprehensif untuk `Admin Logistik` dan `Manager`, memungkinkan pemantauan status armada, driver, dan
pesanan pengiriman secara real-time (atau mendekati real-time melalui Livewire) serta antarmuka sederhana untuk penugasan driver.                    
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## 🚀 Langkah-langkah Implementasi Detail:                                                                                                           
                                                                                                                                                     
### Fase 1: Dasar Dasbor & Ringkasan Status (Hari 1-2)                                                                                               
                                                                                                                                                     
1.  **Perbarui Tampilan Dasbor Utama (`resources/views/dashboard.blade.php`):**                                                                      
    *   Gunakan `dashboard.blade.php` sebagai titik awal untuk dasbor operasional.                                                                   
    *   Pastikan dasbor ini hanya dapat diakses oleh `Admin Logistik` dan `Manager` (gunakan `@role('Admin Logistik|Manager')`).                     
                                                                                                                                                     
2.  **Tampilkan Statistik Ringkasan (Widgets):**                                                                                                     
    *   Buat beberapa "kartu" (widgets) yang menampilkan:                                                                                            
        *   Jumlah total Armada (Aktif/Tidak Aktif).                                                                                                 
        *   Jumlah total Driver (Tersedia/Ditugaskan/Tidak Bertugas).                                                                                
        *   Jumlah total Pesanan Pengiriman (Pending/Ditugaskan/Dalam Perjalanan/Terkirim/Gagal).                                                    
    *   Ambil data ini dari *backend* (controller) dan tampilkan di Blade. Pertimbangkan menggunakan komponen Livewire sederhana (`php artisan       
make:livewire DashboardStats`) untuk membuat widget ini *auto-refresh* setiap beberapa detik/menit.                                                  
                                                                                                                                                     
3.  **Tampilkan Status Armada & Driver Sederhana:**                                                                                                  
    *   Di dasbor, tampilkan daftar sederhana semua Armada beserta statusnya.                                                                        
    *   Tampilkan daftar semua Driver beserta status ketersediaannya.                                                                                
    *   *(Untuk kesederhanaan awal, belum perlu peta atau pelacakan GPS real-time. Cukup status teks).*                                              
                                                                                                                                                     
4.  **Konfigurasi Rute:**                                                                                                                            
    *   Pastikan rute `/dashboard` dilindungi agar hanya `Admin Logistik` dan `Manager` yang bisa mengaksesnya.                                      
                                                                                                                                                     
### Fase 2: Antarmuka Penugasan Driver & Jadwal Pesanan (Hari 3-4)                                                                                   
                                                                                                                                                     
1.  **Antarmuka Penugasan Driver (Livewire Component):**                                                                                             
    *   Buat komponen Livewire baru: `php artisan make:livewire AssignDriver`.                                                                       
    *   Tempatkan komponen ini di `dashboard.blade.php` atau di halaman terpisah seperti `resources/views/assignments/index.blade.php`.              
    *   Komponen ini harus:                                                                                                                          
        *   Menampilkan daftar Pesanan Pengiriman dengan status `pending` atau `assigned` (belum terkirim).                                          
        *   Untuk setiap pesanan, sediakan dropdown `select` yang berisi daftar Driver yang `available`.                                             
        *   Memiliki tombol "Tugaskan" di samping setiap pesanan.                                                                                    
        *   Ketika tombol "Tugaskan" diklik, panggil metode di *backend* (DeliveryOrderController atau Livewire component) untuk memperbarui         
`driver_id` pesanan tersebut.                                                                                                                        
        *   Tampilkan pesan sukses/gagal setelah penugasan.                                                                                          
                                                                                                                                                     
2.  **Jadwal Pesanan Harian (Livewire Component):**                                                                                                  
    *   Buat komponen Livewire baru: `php artisan make:livewire DailySchedule`.                                                                      
    *   Tampilkan daftar pesanan yang dijadwalkan untuk hari ini atau tanggal yang bisa dipilih.                                                     
    *   Kolom yang ditampilkan: `No. DO`, `Penerima`, `Driver`, `Armada`, `Jadwal Pengiriman`, `Status`.                                             
    *   Sediakan input tanggal untuk memfilter jadwal.                                                                                               
    *   Terapkan paginasi jika daftar pesanan panjang.                                                                                               
                                                                                                                                                     
### Fase 3: Penyempurnaan & Otorisasi Frontend (Hari 5)                                                                                              
                                                                                                                                                     
1.  **Integrasi ke Dashboard:**                                                                                                                      
    *   Pastikan semua komponen (Statistik Ringkasan, Antarmuka Penugasan Driver, Jadwal Pesanan Harian) terintegrasi dengan rapi di                 
`dashboard.blade.php` menggunakan Blade `@livewire` directive.                                                                                       
    *   Gunakan Tailwind CSS untuk tata letak dan desain agar terlihat profesional dan responsif.                                                    
                                                                                                                                                     
2.  **Otorisasi Frontend:**                                                                                                                          
    *   Gunakan `@can` dan `@role` Blade directive untuk memastikan elemen UI (misalnya, tombol "Tugaskan Driver") hanya terlihat oleh peran yang    
memiliki izin (`Admin Logistik` dan `Manager`).                                                                                                      
                                                                                                                                                     
3.  **Responsivitas:**                                                                                                                               
    *   Pastikan dasbor terlihat baik di berbagai ukuran layar (desktop, tablet, mobile) menggunakan kelas-kelas responsif Tailwind CSS.             
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## 📂 File-file yang akan Dibuat/Dimodifikasi:                                                                                                       
                                                                                                                                                     
*   `resources/views/dashboard.blade.php` (Modifikasi utama)                                                                                         
*   `app/Livewire/DashboardStats.php`                                                                                                                
*   `resources/views/livewire/dashboard-stats.blade.php`                                                                                             
*   `app/Livewire/AssignDriver.php`                                                                                                                  
*   `resources/views/livewire/assign-driver.blade.php`                                                                                               
*   `app/Livewire/DailySchedule.php`                                                                                                                 
*   `resources/views/livewire/daily-schedule.blade.php`                                                                                              
*   `app/Http/Controllers/DeliveryOrderController.php` (Tambahkan/modifikasi metode untuk penugasan driver jika Livewire component tidak menangani   
semua logika backend)                                                                                                                                
*   `routes/web.php` (Pastikan rute `/dashboard` dan rute terkait lainnya sudah benar dan dilindungi)                                                
*   `resources/css/app.css` (penyesuaian Tailwind jika perlu)                                                                                        
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## 👥 Cerita Pengguna (User Stories):                                                                                                                
                                                                                                                                                     
*   Sebagai **Admin Logistik**, saya dapat melihat ringkasan status semua armada, driver, dan pesanan pengiriman di dasbor.                          
*   Sebagai **Admin Logistik**, saya dapat menugaskan driver ke pesanan yang belum ditugaskan melalui dasbor.                                        
*   Sebagai **Admin Logistik**, saya dapat melihat jadwal pesanan pengiriman harian.                                                                 
*   Sebagai **Manajer**, saya dapat melihat ringkasan status semua armada, driver, dan pesanan pengiriman di dasbor.                                 
*   Sebagai **Manajer**, saya dapat menugaskan driver ke pesanan yang belum ditugaskan melalui dasbor.                                               
*   Sebagai **Manajer**, saya dapat melihat jadwal pesanan pengiriman harian.                                                                        
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## ✅ Kriteria Penerimaan (Acceptance Criteria):                                                                                                     
                                                                                                                                                     
*   [ ] Halaman dasbor operasional dapat diakses oleh `Admin Logistik` dan `Manager`.                                                                
*   [ ] Dasbor menampilkan widget ringkasan jumlah Armada, Driver, dan Pesanan Pengiriman.                                                           
*   [ ] Dasbor menampilkan daftar status terkini dari Armada dan Driver.                                                                             
*   [ ] `Admin Logistik` dan `Manager` dapat menugaskan driver ke pesanan yang belum ditugaskan melalui antarmuka di dasbor.                         
*   [ ] Dasbor menampilkan jadwal pesanan pengiriman harian/berdasarkan tanggal yang dipilih.                                                        
*   [ ] Semua fitur di dasbor diimplementasikan menggunakan komponen Livewire untuk interaktivitas.                                                  
*   [ ] Semua tampilan dasbor terlihat rapi dan responsif di berbagai perangkat.                                                                     
*   [ ] Elemen UI untuk penugasan driver hanya terlihat oleh `Admin Logistik` dan `Manager`.                                                         
                                                                                                                                                     
### Issue #8 - Delivery Tracking (Planned)                                                                                                           
- [ ] GPS tracking integration                                                                                                                       
- [ ] Real-time order status updates                                                                                                                 
- [ ] Driver location mapping                                                                                                                        
- [ ] Route optimization                                                                                                                             
- [ ] Delivery proof of delivery (POD)                                                                                                               
=======                                                                                                                                              
### 📋 Issue #7 - Operational Dashboard (PLANNED)                                                                                                    
**Title:** Feature: Implement Operational Dashboard for Admin & Manager                                                                              
**Status:** 📋 Planned                                                                                                                               
**Prioritas:** Tinggi                                                                                                                                
**Estimasi Waktu:** 5 hari kerja                                                                                                                     
**Tujuan:** Menyediakan dasbor operasional yang komprehensif untuk `Admin Logistik` dan `Manager`, memungkinkan pemantauan status armada, driver, dan
pesanan pengiriman secara *real-time* (atau mendekati *real-time* melalui Livewire) serta antarmuka sederhana untuk penugasan driver. Ini akan       
dibangun di atas fondasi tampilan frontend dari [Issue #6](#issue-6---frontend-views-planned).                                                       
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## 🚀 Langkah-langkah Implementasi Detail:                                                                                                           
                                                                                                                                                     
### Fase 1: Persiapan & Statistik Ringkasan (Hari 1-2)                                                                                               
                                                                                                                                                     
1.  **Gunakan Tampilan Dasar dari Issue #6:**                                                                                                        
    *   Dasbor operasional akan menggunakan `resources/views/dashboard.blade.php` yang sudah dibuat di Issue #6.                                     
    *   Pastikan `dashboard.blade.php` menggunakan `layouts/app.blade.php` dan memiliki `@livewireStyles` serta `@livewireScripts`.                  
                                                                                                                                                     
2.  **Otorisasi Akses Dashboard:**                                                                                                                   
    *   Pastikan rute `/dashboard` di `routes/web.php` dilindungi agar hanya `Admin Logistik` dan `Manager` yang bisa mengaksesnya (contoh:          
`Route::get('/dashboard', ...)->middleware(['auth', 'role:Admin Logistik|Manager']);`).                                                              
                                                                                                                                                     
3.  **Buat Komponen Livewire untuk Statistik Ringkasan:**                                                                                            
    *   **Tujuan:** Menampilkan ringkasan jumlah data utama yang *auto-refresh*.                                                                     
    *   Jalankan `php artisan make:livewire DashboardStats`.                                                                                         
    *   Di `app/Livewire/DashboardStats.php`:                                                                                                        
        *   Ambil data jumlah total Armada (Aktif/Tidak Aktif), Driver (Tersedia/Ditugaskan/Tidak Bertugas), dan Pesanan Pengiriman                  
(Pending/Ditugaskan/Dalam Perjalanan/Terkirim/Gagal).                                                                                                
        *   Gunakan properti `$poll = '30s'` untuk *auto-refresh* setiap 30 detik.                                                                   
    *   Di `resources/views/livewire/dashboard-stats.blade.php`:                                                                                     
        *   Buat kartu-kartu (widgets) sederhana menggunakan Tailwind CSS untuk menampilkan statistik ini.                                           
    *   Di `resources/views/dashboard.blade.php`:                                                                                                    
        *   Sertakan komponen ini: `<livewire:dashboard-stats />`.                                                                                   
                                                                                                                                                     
4.  **Tampilkan Status Armada & Driver Sederhana:**                                                                                                  
    *   Di `dashboard.blade.php`, di bawah statistik, tampilkan daftar ringkas semua Armada beserta statusnya. Ini bisa berupa tabel sederhana atau  
daftar kartu.                                                                                                                                        
    *   Tampilkan juga daftar ringkas semua Driver beserta status ketersediaannya.                                                                   
    *   *(Catatan: Ini akan menampilkan status teks saja, bukan peta atau pelacakan GPS, karena itu akan ditangani di Issue #8).*                    
                                                                                                                                                     
### Fase 2: Antarmuka Penugasan Driver & Jadwal Pesanan (Hari 3-4)                                                                                   
                                                                                                                                                     
1.  **Buat Komponen Livewire untuk Penugasan Driver:**                                                                                               
    *   **Tujuan:** Memberikan antarmuka yang mudah untuk menugaskan driver ke pesanan.                                                              
    *   Jalankan `php artisan make:livewire AssignDriver`.                                                                                           
    *   Di `app/Livewire/AssignDriver.php`:                                                                                                          
        *   Ambil daftar Pesanan Pengiriman dengan status `pending` atau `assigned` (yang belum `delivered` atau `failed`).                          
        *   Ambil daftar Driver yang `available`.                                                                                                    
        *   Sediakan metode untuk memperbarui `driver_id` dari sebuah pesanan.                                                                       
        *   Sertakan validasi sederhana.                                                                                                             
    *   Di `resources/views/livewire/assign-driver.blade.php`:                                                                                       
        *   Tampilkan daftar pesanan dalam tabel atau kartu.                                                                                         
        *   Untuk setiap pesanan, sertakan `select` dropdown dengan pilihan driver `available`.                                                      
        *   Sertakan tombol "Tugaskan" untuk setiap baris pesanan.                                                                                   
        *   Gunakan Tailwind CSS untuk styling.                                                                                                      
    *   Di `resources/views/dashboard.blade.php`:                                                                                                    
        *   Sertakan komponen ini: `<livewire:assign-driver />`.                                                                                     
                                                                                                                                                     
2.  **Buat Komponen Livewire untuk Jadwal Pesanan Harian:**                                                                                          
    *   **Tujuan:** Menampilkan pesanan yang dijadwalkan untuk hari tertentu.                                                                        
    *   Jalankan `php artisan make:livewire DailySchedule`.                                                                                          
    *   Di `app/Livewire/DailySchedule.php`:                                                                                                         
        *   Ambil daftar pesanan yang `scheduled_delivery` nya untuk hari ini (atau tanggal yang dipilih).                                           
        *   Sediakan properti untuk tanggal filter.                                                                                                  
    *   Di `resources/views/livewire/daily-schedule.blade.php`:                                                                                      
        *   Tampilkan input `date` untuk memilih tanggal.                                                                                            
        *   Tampilkan tabel pesanan dengan kolom: `No. DO`, `Penerima`, `Driver`, `Armada`, `Jadwal Pengiriman`, `Status`.                           
        *   Implementasikan paginasi Livewire jika daftar panjang.                                                                                   
    *   Di `resources/views/dashboard.blade.php`:                                                                                                    
        *   Sertakan komponen ini: `<livewire:daily-schedule />`.                                                                                    
                                                                                                                                                     
### Fase 3: Penyempurnaan & Otorisasi Frontend (Hari 5)                                                                                              
                                                                                                                                                     
1.  **Integrasi Rapi ke Dashboard:**                                                                                                                 
    *   Atur tata letak `dashboard.blade.php` agar semua komponen Livewire (`DashboardStats`, `AssignDriver`, `DailySchedule`) tertata rapi          
menggunakan grid atau flexbox Tailwind CSS.                                                                                                          
                                                                                                                                                     
2.  **Otorisasi Frontend yang Detail:**                                                                                                              
    *   Gunakan `@can` dan `@role` Blade directive untuk memastikan elemen UI seperti formulir penugasan driver hanya terlihat oleh `Admin Logistik` 
dan `Manager`.                                                                                                                                       
    *   Misalnya, `Manager` mungkin bisa menugaskan driver, tetapi tidak bisa menghapus fleet (yang dikontrol di Issue #6).                          
                                                                                                                                                     
3.  **Responsivitas:**                                                                                                                               
    *   Pastikan seluruh dasbor operasional terlihat baik dan berfungsi optimal di berbagai ukuran layar (desktop, tablet, mobile) menggunakan       
kelas-kelas responsif Tailwind CSS.                                                                                                                  
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## 📂 File-file yang akan Dibuat/Dimodifikasi:                                                                                                       
                                                                                                                                                     
*   `resources/views/dashboard.blade.php` (Modifikasi utama, integrasi Livewire components)                                                          
*   `app/Livewire/DashboardStats.php`                                                                                                                
*   `resources/views/livewire/dashboard-stats.blade.php`                                                                                             
*   `app/Livewire/AssignDriver.php`                                                                                                                  
*   `resources/views/livewire/assign-driver.blade.php`                                                                                               
*   `app/Livewire/DailySchedule.php`                                                                                                                 
*   `resources/views/livewire/daily-schedule.blade.php`                                                                                              
*   `routes/web.php` (Pastikan rute `/dashboard` dilindungi dengan benar)                                                                            
*   `resources/css/app.css` (penyesuaian Tailwind jika perlu untuk styling dasbor)                                                                   
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## 👥 Cerita Pengguna (User Stories):                                                                                                                
                                                                                                                                                     
*   Sebagai **Admin Logistik**, saya dapat melihat ringkasan status terkini (jumlah armada, driver, pesanan) di dasbor.                              
*   Sebagai **Admin Logistik**, saya dapat melihat daftar sederhana semua armada dan driver beserta statusnya di dasbor.                             
*   Sebagai **Admin Logistik**, saya dapat menugaskan driver ke pesanan yang belum ditugaskan langsung dari dasbor.                                  
*   Sebagai **Admin Logistik**, saya dapat melihat jadwal pesanan pengiriman harian atau untuk tanggal tertentu di dasbor.                           
*   Sebagai **Manajer**, saya dapat melihat ringkasan status terkini (jumlah armada, driver, pesanan) di dasbor.                                     
*   Sebagai **Manajer**, saya dapat melihat daftar sederhana semua armada dan driver beserta statusnya di dasbor.                                    
*   Sebagai **Manajer**, saya dapat menugaskan driver ke pesanan yang belum ditugaskan langsung dari dasbor.                                         
*   Sebagai **Manajer**, saya dapat melihat jadwal pesanan pengiriman harian atau untuk tanggal tertentu di dasbor.                                  
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## ✅ Kriteria Penerimaan (Acceptance Criteria):                                                                                                     
                                                                                                                                                     
*   [ ] Halaman dasbor operasional dapat diakses oleh `Admin Logistik` dan `Manager`.                                                                
*   [ ] Dasbor menampilkan widget ringkasan jumlah total Armada, Driver, dan Pesanan Pengiriman. Widget ini harus diperbarui secara berkala          
(auto-refresh).                                                                                                                                      
*   [ ] Dasbor menampilkan daftar ringkas status terkini dari Armada dan Driver.                                                                     
*   [ ] `Admin Logistik` dan `Manager` dapat menugaskan driver ke pesanan yang belum ditugaskan melalui antarmuka *AssignDriver* di dasbor.          
*   [ ] Dasbor menampilkan jadwal pesanan pengiriman harian atau untuk tanggal yang dipilih melalui antarmuka *DailySchedule*.                       
*   [ ] Semua fitur di dasbor yang memerlukan interaktivitas (statistik *auto-refresh*, penugasan driver, filter jadwal) diimplementasikan           
menggunakan komponen Livewire.                                                                                                                       
*   [ ] Semua tampilan dasbor terlihat rapi, terstruktur, dan responsif di berbagai perangkat (desktop, tablet, mobile) dengan Tailwind CSS.         
*   [ ] Elemen UI seperti formulir penugasan driver hanya terlihat dan dapat digunakan oleh `Admin Logistik` dan `Manager` sesuai dengan izin mereka.
                                                                                                                                                     
### Issue #8 - Delivery Tracking (Planned)                                                                                                           
- [ ] GPS tracking integration                                                                                                                       
- [ ] Real-time order status updates                                                                                                                 
- [ ] Driver location mapping                                                                                                                        
- [ ] Route optimization                                                                                                                             
- [ ] Delivery proof of delivery (POD) ia