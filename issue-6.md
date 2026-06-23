# Issue #6: Implementasi Tampilan Frontend Utama dengan Blade & Livewire                                                                             
                                                                                                                                                     
**Status:** 📋 Direncanakan                                                                                                                          
**Prioritas:** Tinggi                                                                                                                                
**Estimasi Waktu:** 5 hari kerja                                                                                                                     
**Tujuan:** Mengembangkan antarmuka pengguna dasar untuk OPLAN. Ini mencakup *layout* umum, alur autentikasi (login, register), dasbor, dan          
halaman-halaman untuk melihat, menambah, mengedit, serta menghapus data Armada, Driver, dan Pesanan Pengiriman. Targetnya adalah pengalaman pengguna 
yang interaktif dan responsif di berbagai perangkat.                                                                                                 
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## 🚀 Langkah-langkah Implementasi Detail:                                                                                                           
                                                                                                                                                     
### Fase 1: Persiapan Dasar (Hari 1)                                                                                                                 
                                                                                                                                                     
1.  **Verifikasi Lingkungan Frontend:**                                                                                                              
    *   Pastikan Laravel Breeze sudah terinstal.                                                                                                     
    *   Pastikan Livewire 3 terinstal dan dikonfigurasi.                                                                                             
    *   Pastikan Tailwind CSS sudah terintegrasi dan berfungsi (jalankan `npm run dev` atau `npm run build` untuk memverifikasi kompilasi CSS).      
                                                                                                                                                     
2.  **Buat Layout Dasar Aplikasi (`resources/views/layouts/app.blade.php`):**                                                                        
    *   Buat file `resources/views/layouts/app.blade.php`.                                                                                           
    *   Ini akan menjadi kerangka utama untuk semua halaman setelah pengguna login.                                                                  
    *   Sertakan:                                                                                                                                    
        *   HTML `<head>` dengan `@vite(['resources/css/app.css', 'resources/js/app.js'])`.                                                          
        *   `@livewireStyles` sebelum penutup `</head>`.                                                                                             
        *   Navigasi (bisa menggunakan `<x-app-layout>` dari Breeze atau membuat navigasi sederhana dengan link ke Dashboard, Fleets, Drivers,       
Delivery Orders, My Orders).                                                                                                                         
        *   Area utama untuk konten: `<main>{{ $slot ?? '' }}</main>` atau `@yield('content')`.                                                      
        *   `@livewireScripts` sebelum penutup `</body>`.                                                                                            
                                                                                                                                                     
3.  **Buat Layout Dasar Tamu (`resources/views/layouts/guest.blade.php`):**                                                                          
    *   Buat file `resources/views/layouts/guest.blade.php`.                                                                                         
    *   Ini akan menjadi kerangka untuk halaman yang tidak memerlukan login (seperti Login, Register).                                               
    *   Sertakan:                                                                                                                                    
        *   HTML `<head>` dengan `@vite(['resources/css/app.css', 'resources/js/app.js'])`.                                                          
        *   `@livewireStyles` sebelum penutup `</head>`.                                                                                             
        *   Area utama untuk konten: `{{ $slot ?? '' }}` atau `@yield('content')`.                                                                   
        *   `@livewireScripts` sebelum penutup `</body>`.                                                                                            
                                                                                                                                                     
4.  **Verifikasi Tampilan Autentikasi Laravel Breeze:**                                                                                              
    *   Periksa folder `resources/views/auth/`. Semua file di sana harus sudah ada dari Breeze.                                                      
    *   Pastikan tampilan tersebut menggunakan `<x-guest-layout>` atau `@extends('layouts.guest')`. Tidak ada perubahan signifikan yang diperlukan di
sini.                                                                                                                                                
                                                                                                                                                     
5.  **Buat Tampilan Dasbor (`resources/views/dashboard.blade.php`):**                                                                                
    *   Buat file `resources/views/dashboard.blade.php`.                                                                                             
    *   Gunakan `@extends('layouts.app')` atau `<x-app-layout>`.                                                                                     
    *   Tambahkan judul sederhana seperti "Selamat Datang di Dasbor OPLAN" dan beberapa teks placeholder.                                            
    *   Pastikan rute `/dashboard` menunjuk ke tampilan ini.                                                                                         
                                                                                                                                                     
### Fase 2: Tampilan CRUD untuk Sumber Daya (Hari 2-4)                                                                                               
                                                                                                                                                     
Untuk setiap sumber daya (Armada, Driver, Pesanan Pengiriman), ikuti langkah-langkah di bawah. Gunakan Tailwind CSS untuk styling dasar agar terlihat
rapi.                                                                                                                                                
                                                                                                                                                     
#### 2a. Tampilan Manajemen Armada (Fleets)                                                                                                          
*   **Buat Folder:** `resources/views/fleets/`                                                                                                       
*   **`index.blade.php` (Daftar):**                                                                                                                  
    *   Buat file ini.                                                                                                                               
    *   Gunakan `@extends('layouts.app')`.                                                                                                           
    *   Tampilkan tabel HTML dengan kolom: `ID`, `Nama`, `Kode`, `Jumlah Kendaraan`, `Status`, `Aksi`.                                               
    *   Di kolom `Aksi`, tambahkan tombol/link "Lihat", "Edit", "Hapus".                                                                             
    *   Tambahkan tombol "Tambah Armada Baru" di atas tabel.                                                                                         
    *   Implementasikan paginasi untuk daftar armada (gunakan `$fleets->links()`).                                                                   
*   **`create.blade.php` (Tambah Baru):**                                                                                                            
    *   Buat file ini.                                                                                                                               
    *   Gunakan `@extends('layouts.app')`.                                                                                                           
    *   Buat formulir HTML dengan input untuk `name`, `code`, `total_vehicles` (tipe number), `status` (dropdown: 'active', 'inactive'),             
`description` (textarea).                                                                                                                            
    *   Sertakan tombol "Simpan" dan "Batal".                                                                                                        
    *   Tampilkan pesan error validasi di bawah setiap input yang salah (`@error('nama_field') ... @enderror`).                                      
*   **`show.blade.php` (Detail):**                                                                                                                   
    *   Buat file ini.                                                                                                                               
    *   Gunakan `@extends('layouts.app')`.                                                                                                           
    *   Tampilkan detail `Fleet` secara terpisah (misalnya: Nama: [value], Kode: [value]).                                                           
    *   Sertakan tombol "Edit" dan "Kembali".                                                                                                        
*   **`edit.blade.php` (Edit):**                                                                                                                     
    *   Buat file ini.                                                                                                                               
    *   Gunakan `@extends('layouts.app')`.                                                                                                           
    *   Sama seperti `create.blade.php`, tetapi pra-isi formulir dengan data armada yang sedang diedit.                                              
                                                                                                                                                     
#### 2b. Tampilan Manajemen Driver                                                                                                                   
*   **Buat Folder:** `resources/views/drivers/`                                                                                                      
*   **`index.blade.php` (Daftar):** Ikuti pola `fleets/index.blade.php`. Kolom: `ID`, `Nama`, `Telepon`, `No. SIM`, `Armada`, `Status`, `Aksi`.      
*   **`create.blade.php` (Tambah Baru):** Ikuti pola `fleets/create.blade.php`. Input: `name`, `phone`, `license_number`, `license_expiry` (tipe     
date), `status` (dropdown: 'available', 'assigned', 'off_duty'), `fleet_id` (dropdown select dari semua armada).                                     
*   **`show.blade.php` (Detail):** Ikuti pola `fleets/show.blade.php`.                                                                               
*   **`edit.blade.php` (Edit):** Ikuti pola `fleets/edit.blade.php`.                                                                                 
                                                                                                                                                     
#### 2c. Tampilan Manajemen Pesanan Pengiriman (Delivery Orders)                                                                                     
*   **Buat Folder:** `resources/views/delivery-orders/`                                                                                              
*   **`index.blade.php` (Daftar):** Ikuti pola `fleets/index.blade.php`. Kolom: `ID`, `No. DO`, `Penerima`, `Alamat`, `Status`, `Driver`, `Armada`,  
`Aksi`.                                                                                                                                              
*   **`create.blade.php` (Tambah Baru):** Ikuti pola `fleets/create.blade.php`. Input: `do_number`, `recipient_name`, `recipient_phone`,             
`delivery_address`, `scheduled_delivery` (tipe date), `status` (dropdown: 'pending', 'assigned', 'in_transit', 'delivered', 'failed'), `driver_id`   
(dropdown select dari semua driver, bisa nullable), `fleet_id` (dropdown select dari semua armada).                                                  
*   **`show.blade.php` (Detail):** Ikuti pola `fleets/show.blade.php`.                                                                               
*   **`edit.blade.php` (Edit):** Ikuti pola `fleets/edit.blade.php`.                                                                                 
                                                                                                                                                     
### Fase 3: Fitur Driver dan Interaktivitas Sederhana (Hari 5)                                                                                       
                                                                                                                                                     
1.  **Tampilan Pesanan Saya untuk Driver (`resources/views/my-orders/index.blade.php`):**                                                            
    *   Buat file ini.                                                                                                                               
    *   Gunakan `@extends('layouts.app')`.                                                                                                           
    *   Tampilkan tabel pesanan yang hanya ditugaskan kepada driver yang sedang *login*. Kolom: `No. DO`, `Penerima`, `Alamat`, `Status`, `Aksi`.    
    *   Di kolom `Aksi`, tambahkan tombol "Perbarui Status".                                                                                         
                                                                                                                                                     
2.  **Integrasi Livewire Sederhana untuk Perbarui Status:**                                                                                          
    *   Buat komponen Livewire baru: `php artisan make:livewire UpdateDeliveryStatus`.                                                               
    *   Pindahkan tombol "Perbarui Status" dari `my-orders/index.blade.php` ke dalam komponen Livewire ini.                                          
    *   Komponen ini harus bisa:                                                                                                                     
        *   Menerima `DeliveryOrder` sebagai prop.                                                                                                   
        *   Menampilkan status saat ini.                                                                                                             
        *   Menyediakan dropdown untuk memilih status baru (`in_transit`, `delivered`, `failed`).                                                    
        *   Memiliki tombol "Simpan" yang memanggil metode *backend* `updateStatus`.                                                                 
        *   Tampilkan pesan sukses/gagal.                                                                                                            
                                                                                                                                                     
3.  **Implementasi Otorisasi Frontend:**                                                                                                             
    *   Gunakan direktif Blade `@can` dan `@role` untuk menyembunyikan atau menampilkan tombol/link tertentu berdasarkan peran atau izin pengguna.   
    *   Contoh: Tombol "Hapus" hanya terlihat untuk Admin Logistik. Tombol "Edit" hanya untuk Admin Logistik dan Manager.                            
                                                                                                                                                     
4.  **Konfigurasi Rute Web (`routes/web.php`):**                                                                                                     
    *   Pastikan semua rute untuk `fleets`, `drivers`, `delivery-orders` sudah diatur sebagai `resource` dan dilindungi oleh *middleware* peran yang 
sesuai (`->middleware(['auth', 'role:Admin Logistik|Manager'])`).                                                                                    
    *   Tambahkan rute untuk `my-orders` dan lindungi dengan `->middleware(['auth', 'role:Driver'])`.                                                
    *   Tambahkan rute untuk pembaruan status oleh driver.                                                                                           
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## 📂 File-file yang akan Dibuat/Dimodifikasi:                                                                                                       
                                                                                                                                                     
*   `resources/views/layouts/app.blade.php`                                                                                                          
*   `resources/views/layouts/guest.blade.php`                                                                                                        
*   `resources/views/dashboard.blade.php`                                                                                                            
*   `resources/views/fleets/index.blade.php`                                                                                                         
*   `resources/views/fleets/create.blade.php`                                                                                                        
*   `resources/views/fleets/show.blade.php`                                                                                                          
*   `resources/views/fleets/edit.blade.php`                                                                                                          
*   `resources/views/drivers/index.blade.php`                                                                                                        
*   `resources/views/drivers/create.blade.php`                                                                                                       
*   `resources/views/drivers/show.blade.php`                                                                                                         
*   `resources/views/drivers/edit.blade.php`                                                                                                         
*   `resources/views/delivery-orders/index.blade.php`                                                                                                
*   `resources/views/delivery-orders/create.blade.php`                                                                                               
*   `resources/views/delivery-orders/show.blade.php`                                                                                                 
*   `resources/views/delivery-orders/edit.blade.php`                                                                                                 
*   `resources/views/my-orders/index.blade.php`                                                                                                      
*   `app/Livewire/UpdateDeliveryStatus.php`                                                                                                          
*   `resources/views/livewire/update-delivery-status.blade.php`                                                                                      
*   `routes/web.php` (penyesuaian rute dan middleware)                                                                                               
*   `resources/css/app.css` (penyesuaian Tailwind jika perlu)                                                                                        
*   `resources/js/app.js` (penyesuaian Livewire/Alpine jika perlu)                                                                                   
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## 👥 Cerita Pengguna (User Stories):                                                                                                                
                                                                                                                                                     
*   Sebagai **Admin Logistik**, saya dapat melihat daftar, menambah, mengedit, dan menghapus Armada, Driver, dan Pesanan Pengiriman melalui antarmuka
web.                                                                                                                                                 
*   Sebagai **Manajer**, saya dapat melihat daftar, menambah, dan mengedit Armada, Driver, dan Pesanan Pengiriman melalui antarmuka web. Saya *tidak*
bisa menghapus.                                                                                                                                      
*   Sebagai **Driver**, saya dapat melihat daftar pesanan yang ditugaskan kepada saya dan memperbarui status pesanan tersebut. Saya *tidak* bisa     
menambah, mengedit (selain status), atau menghapus pesanan.                                                                                          
*   Sebagai **Pengguna**, saya dapat login, logout, dan mengelola informasi profil saya.                                                             
                                                                                                                                                     
---                                                                                                                                                  
                                                                                                                                                     
## ✅ Kriteria Penerimaan (Acceptance Criteria):                                                                                                     
                                                                                                                                                     
*   [ ] Pengguna dapat mengakses halaman Dasbor setelah login.                                                                                       
*   [ ] Pengguna dengan peran `Admin Logistik` dan `Manager` dapat melihat daftar Armada, Driver, dan Pesanan Pengiriman.                            
*   [ ] Formulir "Tambah" dan "Edit" untuk Armada, Driver, dan Pesanan Pengiriman ditampilkan dengan benar dan mengirimkan data ke *backend*.        
*   [ ] Pesan validasi dari *backend* ditampilkan dengan jelas di bawah setiap input formulir yang salah.                                            
*   [ ] Daftar Armada, Driver, dan Pesanan Pengiriman menampilkan data dengan paginasi yang berfungsi.                                               
*   [ ] Semua tampilan terlihat rapi dan responsif di berbagai ukuran layar (desktop, tablet, mobile) menggunakan Tailwind CSS.                      
*   [ ] Tombol/link "Edit" dan "Hapus" hanya terlihat dan berfungsi untuk pengguna dengan izin yang sesuai (`Admin Logistik` untuk semua CRUD,       
`Manager` hanya untuk View/Create/Edit).                                                                                                             
*   [ ] Halaman "Pesanan Saya" (My Orders) hanya menampilkan pesanan yang ditugaskan kepada driver yang sedang *login*.                              
*   [ ] Driver dapat memperbarui status pesanan mereka melalui komponen Livewire di halaman "Pesanan Saya".                                          
*   [ ] Halaman autentikasi (Login, Register) berfungsi dengan benar dan menggunakan layout `guest`.                                                 
*   [ ] Semua rute web yang diperlukan untuk frontend diatur dengan benar di `routes/web.php` dan dilindungi oleh *middleware* peran yang sesuai.