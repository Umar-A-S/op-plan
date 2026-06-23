# Issue #8: Implementasi Sistem Pelacakan Pengiriman (Delivery Tracking)

**Status:** 📋 Direncanakan
**Prioritas:** Tinggi
**Estimasi Waktu:** 5 hari kerja
**Tujuan:** Menambahkan fitur pelacakan pengiriman secara real-time, antarmuka peta bagi admin, dan sistem bukti pengiriman (Proof of Delivery - POD) untuk driver.

---

## 🚀 Langkah-langkah Implementasi Detail:

### Fase 1: Perubahan Database & Backend (Hari 1-2)
1. **Migrasi Database:**
    * Tambahkan kolom `latitude`, `longitude`, dan `pod_image_path` ke tabel `delivery_orders`.
2. **Update Model & Request:**
    * Perbarui `DeliveryOrder` model.
    * Perbarui `UpdateDeliveryOrderRequest` untuk mendukung upload file gambar POD.
3. **Controller:**
    * Tambahkan metode `uploadPod` di `DeliveryOrderController`.
    * Tambahkan endpoint API/metode untuk update posisi driver (`updateLocation`).

### Fase 2: Fitur Driver (Bukti Pengiriman - POD) (Hari 3)
1. **Tampilan Upload POD:**
    * Perbarui tampilan "Perbarui Status" pada `resources/views/livewire/update-delivery-status.blade.php` untuk menyertakan input *file upload* saat status diubah menjadi 'delivered'.
2. **Logic Upload:**
    * Implementasikan logika *file storage* Laravel untuk menyimpan gambar POD ke `storage/app/public/pod`.

### Fase 3: Tampilan Admin/Manajer (Peta & Pelacakan) (Hari 4-5)
1. **Integrasi Peta (Leaflet.js):**
    * Tambahkan CDN Leaflet.js ke `resources/views/layouts/app.blade.php`.
    * Perbarui `resources/views/delivery-orders/show.blade.php` untuk menampilkan peta posisi terakhir driver (menggunakan `latitude` dan `longitude`).
2. **Dashboard Tracking:**
    * Tambahkan visualisasi status pengiriman pada dasbor operasional.

---

## 📂 File-file yang akan Dibuat/Dimodifikasi:
* `database/migrations/2026_06_23_XXXXXX_add_tracking_fields_to_delivery_orders_table.php`
* `app/Http/Controllers/DeliveryOrderController.php`
* `resources/views/delivery-orders/show.blade.php`
* `resources/views/livewire/update-delivery-status.blade.php`

---

## 👥 Cerita Pengguna (User Stories):
* Sebagai **Driver**, saya dapat mengunggah foto bukti pengiriman (POD) setelah status pesanan diubah menjadi 'delivered'.
* Sebagai **Admin Logistik/Manajer**, saya dapat melihat posisi terakhir driver pada peta di halaman detail pesanan.

## ✅ Kriteria Penerimaan (Acceptance Criteria):
* [ ] Driver berhasil mengunggah foto POD saat menyelesaikan pengiriman.
* [ ] Gambar POD tersimpan di penyimpanan yang sesuai dan dapat dilihat oleh Admin.
* [ ] Admin dapat melihat posisi koordinat driver pada peta (Leaflet.js) di halaman detail pengiriman.
