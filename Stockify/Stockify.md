# Sistem Inventaris Barang Himpunan Mahasiswa
### Dokumen Gabungan: PRD & Physical Data Model

---

## Daftar Isi

1. [Overview](#1-overview)
2. [Functional Requirements](#2-functional-requirements)
3. [Non-Functional Requirements](#3-non-functional-requirements)
4. [User Roles](#4-user-roles)
5. [User Stories & Acceptance Criteria](#5-user-stories--acceptance-criteria)
6. [Physical Data Model (PDM)](#6-physical-data-model-pdm)
7. [Skema Database (DBML)](#7-skema-database-dbml)
8. [Deskripsi Tabel](#8-deskripsi-tabel)
9. [Relasi Antar Tabel](#9-relasi-antar-tabel)

---

## 1. Overview

| Atribut | Keterangan |
|---|---|
| **Nama Sistem** | Sistem Inventaris Barang Himpunan Mahasiswa |
| **Deskripsi Singkat** | Sistem berbasis web untuk mengelola inventaris barang milik himpunan mahasiswa, mencakup pencatatan data barang dan pengelolaan proses peminjaman barang oleh anggota himpunan. |

### Tujuan Sistem

Sistem ini dikembangkan untuk menggantikan proses pencatatan manual yang selama ini dilakukan, sehingga pengelolaan barang inventaris dan proses peminjaman dapat dilakukan secara lebih terstruktur, terpantau, dan mudah diakses.

### Ruang Lingkup

Sistem ini mencakup:

- Pengelolaan data barang inventaris himpunan
- Proses pengajuan dan persetujuan peminjaman barang
- Pencatatan pengembalian barang
- Pemantauan status ketersediaan stok barang secara real-time

### Pengguna Sistem

Sistem ini digunakan oleh dua peran pengguna, yaitu **Admin** dan **Peminjam**.

---

## 2. Functional Requirements

### Autentikasi

- **FR-01** : Pengguna dapat melakukan registrasi akun baru sebagai Peminjam
- **FR-02** : Pengguna dapat melakukan login menggunakan email dan password
- **FR-03** : Pengguna dapat logout dari sistem
- **FR-04** : Sistem membedakan hak akses berdasarkan peran pengguna

### Manajemen Barang (CRUD)

- **FR-05** : Admin dapat menambah data barang inventaris
- **FR-06** : Admin dapat melihat daftar seluruh barang beserta informasi stok dan kondisi
- **FR-07** : Admin dapat mengubah data barang inventaris
- **FR-08** : Admin dapat menghapus data barang inventaris

### Manajemen Peminjaman

- **FR-09** : Peminjam dapat mengajukan permohonan peminjaman barang
- **FR-10** : Admin dapat menyetujui atau menolak permohonan peminjaman
- **FR-11** : Admin dapat mencatat pengembalian barang
- **FR-12** : Sistem memperbarui jumlah stok tersedia ketika peminjaman atau pengembalian dicatat

### Dashboard

- **FR-13** : Admin dapat melihat ringkasan total barang, jumlah barang sedang dipinjam, dan jumlah peminjaman pending
- **FR-14** : Peminjam dapat melihat ringkasan riwayat dan status peminjaman miliknya

### Riwayat

- **FR-15** : Admin dapat melihat seluruh riwayat peminjaman
- **FR-16** : Peminjam dapat melihat riwayat peminjaman miliknya sendiri

---

## 3. Non-Functional Requirements

- **NFR-01** : Tampilan antarmuka responsif
- **NFR-02** : Halaman dapat dimuat dalam waktu kurang dari 3 detik

---

## 4. User Roles

### Role 1 — Admin

**Deskripsi:** Admin adalah pengurus himpunan dari Divisi Kesektariatan yang bertanggung jawab atas pengelolaan inventaris barang himpunan. Admin memiliki akses penuh terhadap seluruh fitur sistem.

**Hak Akses:**

- Mengelola data barang inventaris (tambah, lihat, ubah, hapus)
- Menyetujui atau menolak permohonan peminjaman barang
- Mencatat pengembalian barang
- Melihat seluruh riwayat peminjaman
- Mengakses dashboard ringkasan inventaris

### Role 2 — Peminjam

**Deskripsi:** Peminjam adalah pihak luar ataupun anggota himpunan yang ingin menggunakan barang inventaris himpunan untuk keperluan tertentu. Peminjam dapat mendaftarkan akun sendiri dan mengajukan permohonan peminjaman melalui sistem.

**Hak Akses:**

- Mendaftarkan akun baru
- Mengajukan permohonan peminjaman barang
- Melihat status permohonan miliknya
- Melihat riwayat peminjaman miliknya
- Mengakses dashboard ringkasan peminjaman pribadi

---

## 5. User Stories & Acceptance Criteria

### Daftar User Stories

| Kode | Judul |
|---|---|
| US-01 | Registrasi Akun Baru (Peminjam) |
| US-02 | Login Pengguna |
| US-03 | Logout Pengguna |
| US-04 | Tambah Data Barang |
| US-05 | Lihat Daftar Barang |
| US-06 | Ubah Data Barang |
| US-07 | Hapus Data Barang |
| US-08 | Ajukan Permohonan Peminjaman |
| US-09 | Setujui atau Tolak Permohonan Peminjaman |
| US-10 | Catat Pengembalian Barang |
| US-11 | Lihat Riwayat Peminjaman (Admin) |
| US-12 | Lihat Status dan Riwayat Peminjaman (Peminjam) |
| US-13 | Dashboard Admin |
| US-14 | Dashboard Peminjam |

---

### US-01 — Registrasi Akun Baru

- **Title** : Registrasi Akun Baru
- **Priority** : High
- **Estimated** : 3 Story Points
- **Role** : Peminjam

**User Story:** Sebagai Peminjam, saya ingin mendaftarkan akun baru menggunakan nama, email, dan password, agar saya dapat mengakses sistem dan mengajukan peminjaman barang.

**Acceptance Criteria:**

**Scenario: Registrasi berhasil.**
- **Given** Peminjam berada di halaman registrasi.
- **When** mengisi nama, email yang valid, dan password lalu menekan tombol "Daftar".
- **Then** sistem menyimpan akun baru dan mengarahkan Peminjam ke halaman login dengan pesan "Registrasi berhasil".

**Scenario: Email sudah terdaftar.**
- **Given** Peminjam berada di halaman registrasi.
- **When** memasukkan email yang sudah digunakan oleh akun lain.
- **Then** sistem menampilkan pesan "Email sudah terdaftar".

**Scenario: Format email tidak valid.**
- **Given** Peminjam berada di halaman registrasi.
- **When** memasukkan email tanpa simbol "@" atau domain yang salah.
- **Then** sistem menampilkan pesan "Format email tidak sesuai".

**Scenario: Password terlalu pendek.**
- **Given** Peminjam berada di halaman registrasi.
- **When** memasukkan password kurang dari 8 karakter.
- **Then** sistem menampilkan pesan "Password minimal 8 karakter".

---

### US-02 — Login Pengguna

- **Title** : Login Pengguna
- **Priority** : High
- **Estimated** : 2 Story Points
- **Role** : Admin, Peminjam

**User Story:** Sebagai pengguna (Admin atau Peminjam), saya ingin login menggunakan email dan password, agar saya dapat mengakses fitur sesuai peran saya.

**Acceptance Criteria:**

**Scenario: Login berhasil sebagai Admin.**
- **Given** Admin berada di halaman login.
- **When** memasukkan email dan password Admin yang valid lalu menekan tombol "Login".
- **Then** sistem mengarahkan Admin ke halaman Dashboard Admin.

**Scenario: Login berhasil sebagai Peminjam.**
- **Given** Peminjam berada di halaman login.
- **When** memasukkan email dan password Peminjam yang valid lalu menekan tombol "Login".
- **Then** sistem mengarahkan Peminjam ke halaman Dashboard Peminjam.

**Scenario: Email atau password salah.**
- **Given** Pengguna berada di halaman login.
- **When** memasukkan email atau password yang tidak sesuai.
- **Then** sistem menampilkan pesan "Email atau password salah".

**Scenario: Form Pengisian email dan password kosong.**
- **Given** Pengguna berada di halaman login.
- **When** menekan tombol "Login" tanpa mengisi email atau password.
- **Then** sistem menampilkan pesan "Email dan password wajib diisi".

---

### US-03 — Logout Pengguna

- **Title** : Logout Pengguna
- **Priority** : Medium
- **Estimated** : 1 Story Points
- **Role** : Admin, Peminjam

**User Story:** Sebagai pengguna (Admin atau Peminjam), saya ingin logout dari sistem, agar sesi saya berakhir dengan aman.

**Acceptance Criteria:**

**Scenario: Logout berhasil.**
- **Given** Pengguna sedang dalam kondisi login.
- **When** menekan tombol "Logout".
- **Then** sistem mengakhiri sesi dan mengarahkan pengguna ke halaman login.

**Scenario: Akses halaman setelah logout.**
- **Given** Pengguna telah logout dari sistem.
- **When** mencoba mengakses halaman yang memerlukan login melalui URL langsung.
- **Then** sistem mengarahkan kembali ke halaman login.

---

### US-04 — Tambah Data Barang

- **Title** : Tambah Data Barang
- **Priority** : High
- **Estimated** : 3 Story Points
- **Role** : Admin

**User Story:** Sebagai Admin, saya ingin menambahkan data barang inventaris, agar barang baru milik himpunan tercatat di sistem.

**Acceptance Criteria:**

**Scenario: Tambah barang berhasil.**
- **Given** Admin berada di halaman Manajemen Barang.
- **When** mengisi nama barang, jumlah stok, kondisi, keterangan, dan foto (opsional) lalu menekan tombol "Simpan".
- **Then** sistem menyimpan data barang dan menampilkan barang baru di daftar inventaris.

**Scenario: Field yang harus diisi tidak diisi.**
- **Given** Admin berada di formulir tambah barang.
- **When** menekan tombol "Simpan" tanpa mengisi nama barang atau jumlah stok.
- **Then** sistem menampilkan pesan "Field wajib tidak boleh kosong".

**Scenario: Jumlah stok tidak valid.**
- **Given** Admin berada di formulir tambah barang.
- **When** memasukkan nilai negatif atau bukan angka pada field jumlah stok.
- **Then** sistem menampilkan pesan "Jumlah stok harus berupa angka positif".

---

### US-05 — Lihat Daftar Barang

- **Title** : Lihat Daftar Barang
- **Priority** : High
- **Estimated** : 2 Story Points
- **Role** : Admin

**User Story:** Sebagai Admin, saya ingin melihat daftar seluruh barang beserta informasi stok dan kondisinya, agar saya dapat memantau inventaris himpunan.

**Acceptance Criteria:**

**Scenario: Daftar barang berhasil ditampilkan.**
- **Given** Admin berada di halaman Manajemen Barang.
- **When** halaman berhasil dimuat.
- **Then** sistem menampilkan seluruh data barang beserta nama, jumlah total stok, jumlah tersedia, kondisi, dan keterangan.

**Scenario: Belum ada data barang.**
- **Given** Admin berada di halaman Manajemen Barang.
- **When** belum ada barang yang tersimpan di sistem.
- **Then** sistem menampilkan pesan "Belum ada data barang".

---

### US-06 — Ubah Data Barang

- **Title** : Ubah Data Barang
- **Priority** : Medium
- **Estimated** : 2 Story Points
- **Role** : Admin

**User Story:** Sebagai Admin, saya ingin mengubah data barang yang sudah ada, agar informasi inventaris selalu akurat.

**Acceptance Criteria:**

**Scenario: Ubah data barang berhasil.**
- **Given** Admin berada di halaman Manajemen Barang.
- **When** menekan tombol "Edit" pada salah satu barang, mengubah data, lalu menekan tombol "Simpan".
- **Then** sistem memperbarui data barang dan menampilkan perubahan di daftar inventaris.

**Scenario: Field wajib dikosongkan.**
- **Given** Admin berada di formulir edit barang.
- **When** menghapus isi field nama barang atau jumlah stok lalu menekan tombol "Simpan".
- **Then** sistem menampilkan pesan "Field wajib tidak boleh kosong".

---

### US-07 — Hapus Data Barang

- **Title** : Hapus Data Barang
- **Priority** : Medium
- **Estimated** : 1 Story Points
- **Role** : Admin

**User Story:** Sebagai Admin, saya ingin menghapus data barang yang sudah tidak ada, agar daftar inventaris tetap bersih dan akurat.

**Acceptance Criteria:**

**Scenario: Hapus barang berhasil.**
- **Given** Admin berada di halaman Manajemen Barang.
- **When** menekan tombol "Hapus" pada salah satu barang dan mengonfirmasi penghapusan.
- **Then** sistem menghapus data barang dan barang tidak lagi muncul di daftar.

**Scenario: Konfirmasi hapus dibatalkan.**
- **Given** Admin menekan tombol "Hapus" pada salah satu barang.
- **When** menekan tombol "Batal" pada dialog konfirmasi.
- **Then** sistem tidak menghapus data dan kembali ke daftar barang.

**Scenario: Barang masih dalam status dipinjam.**
- **Given** Admin berada di halaman Manajemen Barang.
- **When** mencoba menghapus barang yang masih berstatus dipinjam.
- **Then** sistem menampilkan pesan "Barang tidak dapat dihapus karena masih dalam status dipinjam".

---

### US-08 — Ajukan Permohonan Peminjaman

- **Title** : Ajukan Permohonan Peminjaman
- **Priority** : High
- **Estimated** : 5 Story Points
- **Role** : Peminjam

**User Story:** Sebagai Peminjam, saya ingin mengajukan permohonan peminjaman barang, agar saya dapat menggunakan barang yang dibutuhkan.

**Acceptance Criteria:**

**Scenario: Permohonan berhasil diajukan.**
- **Given** Peminjam berada di halaman daftar barang.
- **When** memilih barang yang tersedia, mengisi tanggal pinjam dan tanggal kembali, lalu menekan tombol "Ajukan".
- **Then** sistem menyimpan permohonan dengan status "Menunggu" dan menampilkan pesan "Permohonan berhasil diajukan".

**Scenario: Barang tidak tersedia.**
- **Given** Peminjam berada di halaman daftar barang.
- **When** mencoba mengajukan peminjaman pada barang dengan jumlah tersedia sama dengan 0.
- **Then** sistem menampilkan pesan "Barang tidak tersedia untuk dipinjam".

**Scenario: Tanggal kembali lebih awal dari tanggal pinjam.**
- **Given** Peminjam berada di formulir ajukan peminjaman.
- **When** mengisi tanggal kembali yang lebih awal dari tanggal pinjam.
- **Then** sistem menampilkan pesan "Tanggal kembali harus setelah tanggal pinjam".

---

### US-09 — Setujui atau Tolak Permohonan Peminjaman

- **Title** : Setujui atau Tolak Permohonan Peminjaman
- **Priority** : High
- **Estimated** : 3 Story Points
- **Role** : Admin

**User Story:** Sebagai Admin, saya ingin menyetujui atau menolak permohonan peminjaman, agar saya dapat mengontrol barang yang keluar dari inventaris himpunan.

**Acceptance Criteria:**

**Scenario: Permohonan berhasil disetujui.**
- **Given** Admin berada di halaman Manajemen Peminjaman dan terdapat permohonan berstatus "Menunggu".
- **When** menekan tombol "Setujui" pada permohonan tersebut.
- **Then** sistem mengubah status peminjaman menjadi "Dipinjam" dan memperbarui jumlah stok tersedia barang berkurang.

**Scenario: Permohonan berhasil ditolak.**
- **Given** Admin berada di halaman Manajemen Peminjaman dan terdapat permohonan berstatus "Menunggu".
- **When** menekan tombol "Tolak" pada permohonan tersebut.
- **Then** sistem mengubah status peminjaman menjadi "Ditolak" dan jumlah stok tersedia tidak berubah.

---

### US-10 — Catat Pengembalian Barang

- **Title** : Catat Pengembalian Barang
- **Priority** : High
- **Estimated** : 2 Story Points
- **Role** : Admin

**User Story:** Sebagai Admin, saya ingin mencatat pengembalian barang, agar stok tersedia kembali diperbarui di sistem.

**Acceptance Criteria:**

**Scenario: Pengembalian berhasil dicatat.**
- **Given** Admin berada di halaman Manajemen Peminjaman dan terdapat peminjaman berstatus "Dipinjam".
- **When** menekan tombol "Catat Kembali" pada peminjaman tersebut.
- **Then** sistem mengubah status peminjaman menjadi "Dikembalikan" dan menambahkan kembali jumlah stok tersedia barang.

---

### US-11 — Lihat Riwayat Peminjaman (Admin)

- **Title** : Lihat Riwayat Peminjaman
- **Priority** : Medium
- **Estimated** : 2 Story Points
- **Role** : Admin

**User Story:** Sebagai Admin, saya ingin melihat seluruh riwayat peminjaman, agar semua transaksi peminjaman barang dapat terpantau.

**Acceptance Criteria:**

**Scenario: Riwayat berhasil ditampilkan.**
- **Given** Admin berada di halaman Riwayat Peminjaman.
- **When** halaman berhasil dimuat.
- **Then** sistem menampilkan seluruh data peminjaman beserta nama peminjam, nama barang, tanggal pinjam, tanggal kembali, dan status.

**Scenario: Belum ada riwayat peminjaman.**
- **Given** Admin berada di halaman Riwayat Peminjaman.
- **When** belum ada transaksi peminjaman di sistem.
- **Then** sistem menampilkan pesan "Belum ada riwayat peminjaman".

---

### US-12 — Lihat Status dan Riwayat Peminjaman (Peminjam)

- **Title** : Lihat Status dan Riwayat Peminjaman
- **Priority** : Medium
- **Estimated** : 2 Story Points
- **Role** : Peminjam

**User Story:** Sebagai Peminjam, saya ingin melihat status dan riwayat peminjaman saya, agar saya dapat melacak permohonan yang pernah saya ajukan.

**Acceptance Criteria:**

**Scenario: Status dan riwayat berhasil ditampilkan.**
- **Given** Peminjam berada di halaman Riwayat Peminjaman.
- **When** halaman berhasil dimuat.
- **Then** sistem menampilkan daftar peminjaman milik Peminjam tersebut beserta nama barang, tanggal pinjam, tanggal kembali, dan status (Menunggu / Dipinjam / Dikembalikan / Ditolak).

**Scenario: Belum ada riwayat peminjaman.**
- **Given** Peminjam berada di halaman Riwayat Peminjaman.
- **When** Peminjam belum pernah mengajukan permohonan.
- **Then** sistem menampilkan pesan "Belum ada riwayat peminjaman".

---

### US-13 — Dashboard Admin

- **Title** : Dashboard Admin
- **Priority** : High
- **Estimated** : 5 Story Points
- **Role** : Admin

**User Story:** Sebagai Admin, saya ingin melihat ringkasan inventaris di dashboard, agar saya dapat memantau kondisi barang secara cepat tanpa harus membuka setiap halaman.

**Acceptance Criteria:**

**Scenario: Dashboard Admin berhasil ditampilkan.**
- **Given** Admin berhasil login dan berada di halaman Dashboard.
- **When** halaman berhasil dimuat.
- **Then** sistem menampilkan total barang, jumlah barang sedang dipinjam, jumlah peminjaman pending, dan daftar peminjaman terbaru.

---

### US-14 — Dashboard Peminjam

- **Title** : Dashboard Peminjam
- **Priority** : Medium
- **Estimated** : 3 Story Points
- **Role** : Peminjam

**User Story:** Sebagai Peminjam, saya ingin melihat ringkasan peminjaman saya di dashboard, agar saya dapat memantau status permohonan secara cepat.

**Acceptance Criteria:**

**Scenario: Dashboard Peminjam berhasil ditampilkan.**
- **Given** Peminjam berhasil login dan berada di halaman Dashboard.
- **When** halaman berhasil dimuat.
- **Then** sistem menampilkan jumlah peminjaman aktif, jumlah permohonan pending, dan daftar peminjaman terbaru milik Peminjam.

---

## 6. Physical Data Model (PDM)

### Gambaran Umum

Database sistem ini terdiri dari empat tabel utama, yaitu `users`, `barang`, `peminjaman`, dan `detail_peminjaman`. Keempat tabel ini saling berelasi membentuk alur data mulai dari pengguna yang mengajukan peminjaman, barang yang dipinjam, hingga detail jumlah barang dalam setiap transaksi peminjaman.

### Definisi Kolom Per Tabel

#### Tabel `users`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id_users` | INT, PK, Auto Increment | Primary key pengguna |
| `nama` | VARCHAR | Nama lengkap pengguna |
| `email` | VARCHAR, UNIQUE | Email pengguna, tidak boleh duplikat |
| `password` | VARCHAR | Password terenkripsi (bcrypt) |
| `role` | ENUM(`admin`, `peminjam`) | Peran pengguna dalam sistem |
| `alamat` | VARCHAR | Alamat tempat tinggal pengguna |
| `fakultas` | VARCHAR | Nama fakultas pengguna |
| `program_studi` | VARCHAR | Nama program studi pengguna |
| `created_at` | TIMESTAMP | Waktu akun dibuat (otomatis) |

#### Tabel `barang`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id_barang` | INT, PK, Auto Increment | Primary key barang |
| `nama_barang` | VARCHAR | Nama barang |
| `jumlah_total` | INT | Total keseluruhan unit barang yang dimiliki |
| `jumlah_tersedia` | INT | Jumlah unit yang tersedia untuk dipinjam |
| `kondisi` | ENUM(`Baik`, `Rusak Ringan`, `Rusak Berat`) | Kondisi fisik barang saat ini |
| `keterangan` | TEXT, Nullable | Catatan tambahan mengenai barang |
| `foto` | VARCHAR, Nullable | Path atau nama file foto barang |
| `created_at` | TIMESTAMP | Waktu data barang pertama kali dimasukkan |

#### Tabel `peminjaman`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id_peminjaman` | INT, PK, Auto Increment | Primary key transaksi peminjaman |
| `id_users` | INT, FK → `users.id_users` | Pengguna yang mengajukan peminjaman |
| `tgl_pinjam` | DATE | Tanggal rencana pengambilan barang |
| `tgl_kembali_plan` | DATE | Tanggal rencana pengembalian barang |
| `tgl_kembali_asli` | DATE, Nullable | Tanggal aktual pengembalian barang (diisi admin) |
| `status` | ENUM(`Menunggu`, `Dipinjam`, `Dikembalikan`, `Ditolak`) | Status tahapan peminjaman |
| `created_at` | TIMESTAMP | Waktu pengajuan peminjaman dibuat |

#### Tabel `detail_peminjaman`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id_detail_peminjaman` | INT, PK, Auto Increment | Primary key detail peminjaman |
| `id_peminjaman` | INT, FK → `peminjaman.id_peminjaman` | Transaksi peminjaman induk |
| `id_barang` | INT, FK → `barang.id_barang` | Barang yang dipinjam |
| `jumlah` | INT | Jumlah unit barang yang dipinjam |

---

## 7. Skema Database (DBML)

```dbml
// Sistem Inventaris Barang Himpunan Mahasiswa
// Docs: https://dbml.dbdiagram.io/docs

Table users {
  id_users      int       [pk]
  nama          varchar
  email         varchar   [unique]
  password      varchar
  role          enum('admin', 'peminjam')
  alamat        varchar
  fakultas      varchar
  program_studi varchar
  created_at    timestamp
}

Table barang {
  id_barang       int     [pk]
  nama_barang     varchar
  jumlah_total    int
  jumlah_tersedia int
  kondisi         enum('Baik', 'Rusak Ringan', 'Rusak Berat')
  keterangan      text    [null]
  foto            varchar [null]
  created_at      timestamp
}

Table peminjaman {
  id_peminjaman    int  [pk]
  id_users         int  [ref: > users.id_users]
  tgl_pinjam       date
  tgl_kembali_plan date
  tgl_kembali_asli date [null]
  status           enum('Menunggu', 'Dipinjam', 'Dikembalikan', 'Ditolak')
  created_at       timestamp
}

Table detail_peminjaman {
  id_detail_peminjaman int [pk]
  id_peminjaman        int [ref: > peminjaman.id_peminjaman]
  id_barang            int [ref: > barang.id_barang]
  jumlah               int
}
```

---

## 8. Deskripsi Tabel

### Tabel `users`

Tabel `users` menyimpan data seluruh pengguna sistem, baik admin maupun peminjam. Karena lingkup peminjam dibatasi pada tingkat universitas, tabel ini juga menyimpan informasi akademik pengguna untuk keperluan identifikasi. Tabel ini memiliki sembilan kolom.

- Kolom `id_users` bertipe integer dan berfungsi sebagai primary key dengan nilai auto increment.
- Kolom `nama` bertipe varchar menyimpan nama lengkap pengguna.
- Kolom `email` bertipe varchar bersifat unique, artinya tidak boleh ada dua pengguna dengan email yang sama.
- Kolom `password` bertipe varchar menyimpan password yang sudah dienkripsi menggunakan bcrypt.
- Kolom `role` bertipe enum dengan dua pilihan nilai yaitu `admin` dan `peminjam`, yang menentukan hak akses pengguna di dalam sistem.
- Kolom `alamat` bertipe varchar menyimpan alamat tempat tinggal pengguna.
- Kolom `fakultas` bertipe varchar menyimpan nama fakultas tempat pengguna terdaftar sebagai mahasiswa.
- Kolom `program_studi` bertipe varchar menyimpan nama program studi pengguna.
- Kolom `created_at` bertipe timestamp menyimpan waktu akun pengguna dibuat secara otomatis.

### Tabel `barang`

Tabel `barang` menyimpan data seluruh barang milik himpunan yang dapat dipinjam. Tabel ini memiliki delapan kolom.

- Kolom `id_barang` bertipe integer dan berfungsi sebagai primary key dengan nilai auto increment.
- Kolom `nama_barang` bertipe varchar menyimpan nama barang.
- Kolom `jumlah_total` bertipe integer menyimpan jumlah keseluruhan unit barang yang dimiliki himpunan.
- Kolom `jumlah_tersedia` bertipe integer menyimpan jumlah unit barang yang saat ini tersedia untuk dipinjam. Nilai kolom ini akan berkurang ketika ada peminjaman disetujui dan bertambah kembali ketika barang dikembalikan. Kolom ini merupakan hasil keputusan denormalisasi terencana untuk kemudahan implementasi pengecekan ketersediaan barang secara langsung tanpa harus menghitung dari tabel lain.
- Kolom `kondisi` bertipe enum dengan tiga pilihan nilai yaitu `Baik`, `Rusak Ringan`, dan `Rusak Berat`, yang menggambarkan kondisi fisik barang saat ini.
- Kolom `keterangan` bertipe text dan bersifat nullable, digunakan untuk menyimpan catatan tambahan mengenai barang jika diperlukan.
- Kolom `foto` bertipe varchar dan bersifat nullable, menyimpan path atau nama file foto barang.
- Kolom `created_at` bertipe timestamp menyimpan waktu data barang pertama kali dimasukkan ke sistem.

### Tabel `peminjaman`

Tabel `peminjaman` menyimpan data setiap transaksi pengajuan peminjaman yang dibuat oleh pengguna. Tabel ini memiliki tujuh kolom.

- Kolom `id_peminjaman` bertipe integer dan berfungsi sebagai primary key dengan nilai auto increment.
- Kolom `id_users` bertipe integer dan berfungsi sebagai foreign key yang merujuk ke kolom `id_users` pada tabel `users`, menunjukkan pengguna mana yang membuat pengajuan peminjaman ini.
- Kolom `tgl_pinjam` bertipe date menyimpan tanggal rencana pengambilan atau mulai penggunaan barang.
- Kolom `tgl_kembali_plan` bertipe date menyimpan tanggal rencana pengembalian barang yang diinput saat pengajuan.
- Kolom `tgl_kembali_asli` bertipe date dan bersifat nullable, menyimpan tanggal aktual pengembalian barang yang diisi oleh admin ketika barang benar-benar dikembalikan. Kolom ini nullable karena pada saat pengajuan pertama dibuat, barang belum dikembalikan sehingga nilainya belum tersedia.
- Kolom `status` bertipe enum dengan empat pilihan nilai yaitu `Menunggu`, `Dipinjam`, `Dikembalikan`, dan `Ditolak`, yang merepresentasikan tahapan alur peminjaman secara real-time.
- Kolom `created_at` bertipe timestamp menyimpan waktu pengajuan peminjaman dibuat.

### Tabel `detail_peminjaman`

Tabel `detail_peminjaman` adalah tabel junction yang menyimpan rincian barang-barang yang termasuk dalam satu transaksi peminjaman. Satu baris di tabel `peminjaman` dapat memiliki banyak baris di tabel ini, sehingga satu pengajuan peminjaman bisa mencakup lebih dari satu jenis barang sekaligus. Tabel ini memiliki empat kolom.

- Kolom `id_detail_peminjaman` bertipe integer dan berfungsi sebagai primary key dengan nilai auto increment.
- Kolom `id_peminjaman` bertipe integer dan berfungsi sebagai foreign key yang merujuk ke kolom `id_peminjaman` pada tabel `peminjaman`, menghubungkan detail ini ke transaksi peminjaman induknya.
- Kolom `id_barang` bertipe integer dan berfungsi sebagai foreign key yang merujuk ke kolom `id_barang` pada tabel `barang`, menunjukkan barang mana yang dipinjam dalam baris detail ini.
- Kolom `jumlah` bertipe integer menyimpan jumlah unit barang yang dipinjam untuk barang tersebut dalam satu transaksi peminjaman.

---

## 9. Relasi Antar Tabel

### Ringkasan Relasi

| Tabel Asal | Relasi | Tabel Tujuan | Deskripsi |
|---|---|---|---|
| `users` | One-to-Many | `peminjaman` | Satu pengguna dapat memiliki banyak riwayat pengajuan peminjaman |
| `peminjaman` | One-to-Many | `detail_peminjaman` | Satu transaksi peminjaman dapat memiliki banyak baris detail barang |
| `barang` | One-to-Many | `detail_peminjaman` | Satu barang dapat muncul di banyak transaksi peminjaman yang berbeda |

### Detail Relasi

**`users` → `peminjaman` (One-to-Many)**
Tabel `users` berelasi one-to-many dengan tabel `peminjaman`, artinya satu pengguna dapat memiliki banyak riwayat pengajuan peminjaman, tetapi setiap baris peminjaman hanya dimiliki oleh satu pengguna. Relasi ini diwujudkan melalui kolom `id_users` di tabel `peminjaman` yang merujuk ke `id_users` di tabel `users`.

**`peminjaman` → `detail_peminjaman` (One-to-Many)**
Tabel `peminjaman` berelasi one-to-many dengan tabel `detail_peminjaman`, artinya satu transaksi peminjaman dapat memiliki banyak baris detail barang, tetapi setiap baris detail hanya milik satu transaksi peminjaman. Relasi ini diwujudkan melalui kolom `id_peminjaman` di tabel `detail_peminjaman` yang merujuk ke `id_peminjaman` di tabel `peminjaman`.

**`barang` → `detail_peminjaman` (One-to-Many)**
Tabel `barang` berelasi one-to-many dengan tabel `detail_peminjaman`, artinya satu barang dapat muncul di banyak transaksi peminjaman yang berbeda, tetapi setiap baris detail merujuk ke satu barang spesifik. Relasi ini diwujudkan melalui kolom `id_barang` di tabel `detail_peminjaman` yang merujuk ke `id_barang` di tabel `barang`.

---

*Dokumen ini merupakan gabungan dari Product Requirements Document (PRD) dan Physical Data Model (PDM) Sistem Inventaris Barang Himpunan Mahasiswa.*
