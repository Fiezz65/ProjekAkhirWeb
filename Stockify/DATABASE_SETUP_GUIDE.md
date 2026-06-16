# Panduan Lengkap Database Laravel (Sesuai PRD Stockify)

Halo! Sebagai rekan kerjamu di bagian Database, aku sudah menyiapkan seluruh kode dasar yang kamu butuhkan untuk proyek Stockify. 

Menjawab pertanyaanmu: **"Apakah menangani database di Laravel hanya sebatas routing dan config?"**
**Jawabannya: Tidak.** 

Di Laravel, pengelolaan database jauh lebih rapi dan canggih dibandingkan hanya menulis _query_ SQL secara manual. Ada 3 pilar utama dalam menangani database di Laravel yang **wajib** kamu pahami:

---

## 1. Konfigurasi (`.env`)
Ini adalah file tempat kamu mengatur koneksi ke database. Secara default di Laravel terbaru, kita menggunakan **SQLite** karena sangat mudah dan tidak memerlukan instalasi aplikasi database server seperti XAMPP/MySQL saat pengembangan. 
*(Kamu hanya perlu memastikan ada file `database/database.sqlite` nantinya).*

## 2. Migrations (Skema Database)
Laravel menggunakan **Migration** sebagai "Version Control" untuk database. Alih-alih membuat tabel langsung di _phpMyAdmin_, kita menuliskan struktur tabelnya dalam kode PHP. 

Aku sudah membuatkan file migration berdasarkan PRD yang kamu miliki:
- `database/migrations/0001_01_01_000000_create_users_table.php` -> Tabel `users` dengan `id_users`, `role`, dll.
- `database/migrations/2024_06_16_000001_create_barang_table.php` -> Tabel `barang`
- `database/migrations/2024_06_16_000002_create_peminjaman_table.php` -> Tabel `peminjaman` lengkap dengan Foreign Key ke users.
- `database/migrations/2024_06_16_000003_create_detail_peminjaman_table.php` -> Tabel relasi _many-to-many_ antara peminjaman dan barang.

> [!TIP]
> Dengan Migration, teman setimmu (Backend) nanti tinggal menjalankan perintah `php artisan migrate`, dan _boom!_ semua tabel langsung terbuat di komputer mereka tanpa harus saling kirim file SQL.

## 3. Eloquent Models (Representasi Tabel)
Ini bagian paling keren di Laravel! **Model** adalah representasi tabel database ke dalam bentuk *Object* PHP (disebut Object Relational Mapping / ORM). 

Melalui Model, kita bisa melakukan CRUD (Create, Read, Update, Delete) tanpa menuliskan `SELECT * FROM ...`. Cukup panggil `$barang = Barang::find(1);`. Selain itu, Model juga mendefinisikan relasi antar tabel.

Aku sudah menuliskan model untuk semua tabel kita:
- `app/Models/User.php` -> Punya relasi _hasMany_ (punya banyak) ke peminjaman.
- `app/Models/Barang.php` -> Relasi ke detail peminjaman.
- `app/Models/Peminjaman.php` -> Relasi _belongsTo_ (milik) ke user, dan _hasMany_ ke detail peminjaman.
- `app/Models/DetailPeminjaman.php` -> Relasi ke Peminjaman dan Barang.

---

## Langkah Selanjutnya (Action Item Untukmu)

Saat ini, kodenya sudah aku selesaikan. Namun, komputer kamu sepertinya **belum terinstal PHP** (atau PHP belum masuk ke Environment Variables/PATH system Windows).

Agar setup ini benar-benar selesai dan bisa digunakan oleh tim Backend, kamu perlu melakukan hal berikut di komputermu:

1. **Instal PHP / XAMPP / Herd:** Pastikan PHP bisa dijalankan di Terminal komputer kamu.
2. **Buka Terminal di dalam folder `Stockify`**
3. **Jalankan Command Setup berikut secara berurutan:**
```bash
# Membuat copy dari file environment
copy .env.example .env

# Generate Key aplikasi laravel
php artisan key:generate

# Membuat file database sqlite kosong (jika belum ada)
type nul > database\database.sqlite

# Menjalankan migration yang sudah aku buat
php artisan migrate
```

Setelah kamu menjalankan `php artisan migrate`, seluruh tabel yang ada di PRD akan langsung tercipta! Kamu bisa serahkan proyek ini ke teman Backend kamu untuk mulai membuat fitur-fiturnya. 🚀
