# PRD — Sistem Inventaris Barang Himpunan Mahasiswa

> **Platform:** Web  
> **Tipe Sistem:** Inventory Management + Borrowing System  
> **Status:** In Development

---

## 1. Product Overview

Sistem berbasis **web** untuk mengelola inventaris barang milik himpunan mahasiswa, mencakup:
- Pencatatan data barang (CRUD)
- Proses pengajuan dan persetujuan peminjaman
- Pencatatan pengembalian barang
- Pemantauan status ketersediaan stok secara real-time

**Masalah yang diselesaikan:** Menggantikan proses pencatatan manual agar pengelolaan barang lebih terstruktur, terpantau, dan mudah diakses.

---

## 2. User Roles

| Role | Deskripsi | Hak Akses |
|---|---|---|
| **Admin** | Pengurus himpunan — Divisi Kesektariatan | Kelola barang (CRUD), setujui/tolak peminjaman, catat pengembalian, lihat semua riwayat, akses Dashboard Admin |
| **Peminjam** | Anggota himpunan atau pihak luar | Registrasi akun, ajukan peminjaman, lihat status & riwayat peminjaman sendiri, akses Dashboard Peminjam |

---

## 3. Borrowing Status Flow

```
[Peminjam ajukan] → "Menunggu"
                        ├─ Admin Setujui → "Dipinjam"  → Admin Catat Kembali → "Dikembalikan"
                        └─ Admin Tolak   → "Ditolak"
```

**Efek pada stok:**
- Disetujui → `jumlah_tersedia` **berkurang**
- Dikembalikan → `jumlah_tersedia` **bertambah kembali**
- Ditolak → `jumlah_tersedia` **tidak berubah**

---

## 4. Functional Requirements

### Autentikasi
| Kode | Requirement |
|---|---|
| FR-01 | Peminjam dapat registrasi akun baru |
| FR-02 | Pengguna dapat login dengan email + password |
| FR-03 | Pengguna dapat logout |
| FR-04 | Sistem membedakan hak akses berdasarkan role (admin / peminjam) |

### Manajemen Barang (CRUD — Admin only)
| Kode | Requirement |
|---|---|
| FR-05 | Admin dapat menambah data barang inventaris |
| FR-06 | Admin dapat melihat daftar seluruh barang beserta stok dan kondisi |
| FR-07 | Admin dapat mengubah data barang |
| FR-08 | Admin dapat menghapus data barang |

### Manajemen Peminjaman
| Kode | Requirement |
|---|---|
| FR-09 | Peminjam dapat mengajukan permohonan peminjaman barang |
| FR-10 | Admin dapat menyetujui atau menolak permohonan |
| FR-11 | Admin dapat mencatat pengembalian barang |
| FR-12 | Sistem otomatis memperbarui `jumlah_tersedia` saat peminjaman disetujui atau barang dikembalikan |

### Dashboard
| Kode | Requirement |
|---|---|
| FR-13 | Admin melihat: total barang, jumlah sedang dipinjam, jumlah pending |
| FR-14 | Peminjam melihat: ringkasan status dan riwayat peminjaman miliknya |

### Riwayat
| Kode | Requirement |
|---|---|
| FR-15 | Admin dapat melihat seluruh riwayat peminjaman semua pengguna |
| FR-16 | Peminjam hanya dapat melihat riwayat peminjaman miliknya sendiri |

---

## 5. Non-Functional Requirements

| Kode | Requirement | Prioritas |
|---|---|---|
| NFR-01 | Tampilan antarmuka responsif (mobile-friendly) | Must-Have |
| NFR-02 | Halaman dapat dimuat dalam waktu < 3 detik | Must-Have |

---

## 6. User Stories & Acceptance Criteria

### US-01 — Registrasi Akun Baru
**Role:** Peminjam | **Priority:** High | **Points:** 3

> Sebagai Peminjam, saya ingin mendaftarkan akun menggunakan nama, email, dan password, agar saya dapat mengakses sistem dan mengajukan peminjaman.

| Skenario | Given | When | Then |
|---|---|---|---|
| Registrasi berhasil | Di halaman registrasi | Isi nama, email valid, password → klik "Daftar" | Akun tersimpan, redirect ke login + pesan "Registrasi berhasil" |
| Email sudah terdaftar | Di halaman registrasi | Masukkan email yang sudah dipakai | Tampil pesan "Email sudah terdaftar" |
| Format email tidak valid | Di halaman registrasi | Masukkan email tanpa "@" atau domain salah | Tampil pesan "Format email tidak sesuai" |
| Password terlalu pendek | Di halaman registrasi | Masukkan password < 8 karakter | Tampil pesan "Password minimal 8 karakter" |

---

### US-02 — Login Pengguna
**Role:** Admin, Peminjam | **Priority:** High | **Points:** 2

> Sebagai pengguna, saya ingin login dengan email dan password, agar saya dapat mengakses fitur sesuai peran saya.

| Skenario | Given | When | Then |
|---|---|---|---|
| Login berhasil sebagai Admin | Di halaman login | Email + password Admin valid → klik "Login" | Redirect ke Dashboard Admin |
| Login berhasil sebagai Peminjam | Di halaman login | Email + password Peminjam valid → klik "Login" | Redirect ke Dashboard Peminjam |
| Email/password salah | Di halaman login | Masukkan kredensial yang tidak sesuai | Tampil pesan "Email atau password salah" |
| Form kosong | Di halaman login | Klik "Login" tanpa mengisi form | Tampil pesan "Email dan password wajib diisi" |

---

### US-03 — Logout
**Role:** Admin, Peminjam | **Priority:** Medium | **Points:** 1

> Sebagai pengguna, saya ingin logout, agar sesi saya berakhir dengan aman.

| Skenario | Given | When | Then |
|---|---|---|---|
| Logout berhasil | Sedang login | Klik "Logout" | Sesi berakhir, redirect ke halaman login |
| Akses setelah logout | Sudah logout | Akses URL halaman protected langsung | Redirect ke halaman login |

---

### US-04 — Tambah Data Barang
**Role:** Admin | **Priority:** High | **Points:** 3

> Sebagai Admin, saya ingin menambahkan data barang inventaris, agar barang baru tercatat di sistem.

| Skenario | Given | When | Then |
|---|---|---|---|
| Tambah berhasil | Di halaman Manajemen Barang | Isi nama, stok, kondisi, keterangan, foto (opsional) → klik "Simpan" | Barang tersimpan dan muncul di daftar inventaris |
| Field wajib kosong | Di formulir tambah barang | Klik "Simpan" tanpa isi nama/stok | Tampil pesan "Field wajib tidak boleh kosong" |
| Stok tidak valid | Di formulir tambah barang | Masukkan nilai negatif atau bukan angka pada stok | Tampil pesan "Jumlah stok harus berupa angka positif" |

---

### US-05 — Lihat Daftar Barang
**Role:** Admin | **Priority:** High | **Points:** 2

> Sebagai Admin, saya ingin melihat daftar seluruh barang beserta stok dan kondisinya.

| Skenario | Given | When | Then |
|---|---|---|---|
| Daftar tampil | Di halaman Manajemen Barang | Halaman dimuat | Tampil semua barang: nama, stok total, stok tersedia, kondisi, keterangan |
| Data kosong | Di halaman Manajemen Barang | Belum ada barang tersimpan | Tampil pesan "Belum ada data barang" |

---

### US-06 — Ubah Data Barang
**Role:** Admin | **Priority:** Medium | **Points:** 2

> Sebagai Admin, saya ingin mengubah data barang agar informasi inventaris selalu akurat.

| Skenario | Given | When | Then |
|---|---|---|---|
| Ubah berhasil | Di halaman Manajemen Barang | Klik "Edit" → ubah data → klik "Simpan" | Data diperbarui dan perubahan tampil di daftar |
| Field wajib dikosongkan | Di formulir edit barang | Hapus nama/stok → klik "Simpan" | Tampil pesan "Field wajib tidak boleh kosong" |

---

### US-07 — Hapus Data Barang
**Role:** Admin | **Priority:** Medium | **Points:** 1

> Sebagai Admin, saya ingin menghapus data barang yang sudah tidak ada agar daftar tetap akurat.

| Skenario | Given | When | Then |
|---|---|---|---|
| Hapus berhasil | Di halaman Manajemen Barang | Klik "Hapus" → konfirmasi | Barang terhapus dan tidak muncul di daftar |
| Konfirmasi dibatalkan | Dialog konfirmasi hapus terbuka | Klik "Batal" | Data tidak terhapus, kembali ke daftar |
| Barang masih dipinjam | Di halaman Manajemen Barang | Coba hapus barang berstatus "Dipinjam" | Tampil pesan "Barang tidak dapat dihapus karena masih dalam status dipinjam" |

---

### US-08 — Ajukan Permohonan Peminjaman
**Role:** Peminjam | **Priority:** High | **Points:** 5

> Sebagai Peminjam, saya ingin mengajukan permohonan peminjaman barang.

| Skenario | Given | When | Then |
|---|---|---|---|
| Permohonan berhasil | Di halaman daftar barang | Pilih barang tersedia → isi tgl_pinjam & tgl_kembali → klik "Ajukan" | Status tersimpan sebagai "Menunggu", tampil pesan "Permohonan berhasil diajukan" |
| Barang tidak tersedia | Di halaman daftar barang | Coba ajukan barang dengan `jumlah_tersedia = 0` | Tampil pesan "Barang tidak tersedia untuk dipinjam" |
| Tanggal kembali lebih awal | Di formulir peminjaman | `tgl_kembali < tgl_pinjam` | Tampil pesan "Tanggal kembali harus setelah tanggal pinjam" |

---

### US-09 — Setujui / Tolak Permohonan
**Role:** Admin | **Priority:** High | **Points:** 3

> Sebagai Admin, saya ingin menyetujui atau menolak permohonan peminjaman.

| Skenario | Given | When | Then |
|---|---|---|---|
| Disetujui | Di halaman Manajemen Peminjaman, ada status "Menunggu" | Klik "Setujui" | Status → "Dipinjam", `jumlah_tersedia` **berkurang** |
| Ditolak | Di halaman Manajemen Peminjaman, ada status "Menunggu" | Klik "Tolak" | Status → "Ditolak", `jumlah_tersedia` **tidak berubah** |

---

### US-10 — Catat Pengembalian Barang
**Role:** Admin | **Priority:** High | **Points:** 2

> Sebagai Admin, saya ingin mencatat pengembalian barang agar stok diperbarui.

| Skenario | Given | When | Then |
|---|---|---|---|
| Pengembalian tercatat | Di halaman Manajemen Peminjaman, ada status "Dipinjam" | Klik "Catat Kembali" | Status → "Dikembalikan", `jumlah_tersedia` **bertambah** |

---

### US-11 — Lihat Riwayat Peminjaman (Admin)
**Role:** Admin | **Priority:** Medium | **Points:** 2

> Sebagai Admin, saya ingin melihat seluruh riwayat peminjaman dari semua pengguna.

| Skenario | Given | When | Then |
|---|---|---|---|
| Riwayat tampil | Di halaman Riwayat Peminjaman | Halaman dimuat | Tampil: nama peminjam, nama barang, tgl pinjam, tgl kembali, status |
| Data kosong | Di halaman Riwayat Peminjaman | Belum ada transaksi | Tampil pesan "Belum ada riwayat peminjaman" |

---

### US-12 — Lihat Status & Riwayat (Peminjam)
**Role:** Peminjam | **Priority:** Medium | **Points:** 2

> Sebagai Peminjam, saya ingin melihat status dan riwayat peminjaman saya sendiri.

| Skenario | Given | When | Then |
|---|---|---|---|
| Riwayat tampil | Di halaman Riwayat Peminjaman | Halaman dimuat | Tampil: nama barang, tgl pinjam, tgl kembali, status (Menunggu/Dipinjam/Dikembalikan/Ditolak) — hanya milik sendiri |
| Data kosong | Di halaman Riwayat Peminjaman | Belum pernah ajukan permohonan | Tampil pesan "Belum ada riwayat peminjaman" |

---

### US-13 — Dashboard Admin
**Role:** Admin | **Priority:** High | **Points:** 5

> Sebagai Admin, saya ingin melihat ringkasan inventaris di dashboard.

| Skenario | Given | When | Then |
|---|---|---|---|
| Dashboard tampil | Admin berhasil login, di halaman Dashboard | Halaman dimuat | Tampil: total barang, jumlah sedang dipinjam, jumlah pending, daftar peminjaman terbaru |

---

### US-14 — Dashboard Peminjam
**Role:** Peminjam | **Priority:** Medium | **Points:** 3

> Sebagai Peminjam, saya ingin melihat ringkasan peminjaman saya di dashboard.

| Skenario | Given | When | Then |
|---|---|---|---|
| Dashboard tampil | Peminjam berhasil login, di halaman Dashboard | Halaman dimuat | Tampil: jumlah peminjaman aktif, jumlah pending, daftar peminjaman terbaru milik sendiri |

---

## 7. Database Schema

### Tabel: `users`
| Kolom | Tipe | Constraint | Keterangan |
|---|---|---|---|
| `id_users` | INT | PK, Auto Increment | |
| `nama` | VARCHAR | NOT NULL | Nama lengkap pengguna |
| `email` | VARCHAR | UNIQUE, NOT NULL | |
| `password` | VARCHAR | NOT NULL | Di-hash dengan bcrypt |
| `role` | ENUM | `'admin'`, `'peminjam'` | Menentukan hak akses |
| `alamat` | VARCHAR | | |
| `fakultas` | VARCHAR | | |
| `program_studi` | VARCHAR | | |
| `created_at` | TIMESTAMP | | |

### Tabel: `barang`
| Kolom | Tipe | Constraint | Keterangan |
|---|---|---|---|
| `id_barang` | INT | PK, Auto Increment | |
| `nama_barang` | VARCHAR | NOT NULL | |
| `jumlah_total` | INT | NOT NULL | Total unit yang dimiliki himpunan |
| `jumlah_tersedia` | INT | NOT NULL | Unit yang tersedia saat ini ⚠️ |
| `kondisi` | ENUM | `'Baik'`, `'Rusak Ringan'`, `'Rusak Berat'` | |
| `keterangan` | TEXT | NULLABLE | Catatan tambahan |
| `foto` | VARCHAR | NULLABLE | Path / nama file foto |
| `created_at` | TIMESTAMP | | |

> ⚠️ **`jumlah_tersedia` adalah denormalisasi terencana** — nilainya dikelola secara manual oleh sistem (bukan dihitung dari tabel lain) untuk kemudahan cek ketersediaan secara langsung.

### Tabel: `peminjaman`
| Kolom | Tipe | Constraint | Keterangan |
|---|---|---|---|
| `id_peminjaman` | INT | PK, Auto Increment | |
| `id_users` | INT | FK → `users.id_users` | Peminjam yang mengajukan |
| `tgl_pinjam` | DATE | NOT NULL | Tanggal mulai pinjam |
| `tgl_kembali_plan` | DATE | NOT NULL | Tanggal rencana kembali |
| `tgl_kembali_asli` | DATE | NULLABLE | Diisi Admin saat barang dikembalikan |
| `status` | ENUM | `'Menunggu'`, `'Dipinjam'`, `'Dikembalikan'`, `'Ditolak'` | |
| `created_at` | TIMESTAMP | | |

### Tabel: `detail_peminjaman` _(junction table)_
| Kolom | Tipe | Constraint | Keterangan |
|---|---|---|---|
| `id_detail_peminjaman` | INT | PK, Auto Increment | |
| `id_peminjaman` | INT | FK → `peminjaman.id_peminjaman` | |
| `id_barang` | INT | FK → `barang.id_barang` | |
| `jumlah` | INT | NOT NULL | Jumlah unit yang dipinjam |

---

## 8. Relasi Antar Tabel

```
users          1 ──< peminjaman         1 ──< detail_peminjaman >── 1 barang
(id_users)         (id_users FK)            (id_peminjaman FK)         (id_barang FK)
                                            (id_barang FK)
```

- `users` → `peminjaman` : **One-to-Many** (1 user bisa punya banyak transaksi peminjaman)
- `peminjaman` → `detail_peminjaman` : **One-to-Many** (1 transaksi bisa mencakup banyak barang)
- `barang` → `detail_peminjaman` : **One-to-Many** (1 barang bisa muncul di banyak transaksi)

---

## 9. DBML Schema (dbdiagram.io)

```dbml
Table users {
  id_users int [pk]
  nama varchar
  email varchar [unique]
  password varchar
  role enum('admin', 'peminjam')
  alamat varchar
  fakultas varchar
  program_studi varchar
  created_at timestamp
}

Table barang {
  id_barang int [pk]
  nama_barang varchar
  jumlah_total int
  jumlah_tersedia int
  kondisi enum('Baik', 'Rusak Ringan', 'Rusak Berat')
  keterangan text [null]
  foto varchar [null]
  created_at timestamp
}

Table peminjaman {
  id_peminjaman int [pk]
  id_users int [ref: > users.id_users]
  tgl_pinjam date
  tgl_kembali_plan date
  tgl_kembali_asli date [null]
  status enum('Menunggu', 'Dipinjam', 'Dikembalikan', 'Ditolak')
  created_at timestamp
}

Table detail_peminjaman {
  id_detail_peminjaman int [pk]
  id_peminjaman int [ref: > peminjaman.id_peminjaman]
  id_barang int [ref: > barang.id_barang]
  jumlah int
}
```

---

## 10. Business Rules Penting

1. Peminjam **tidak bisa** mengajukan peminjaman jika `jumlah_tersedia = 0`
2. Barang **tidak bisa dihapus** jika masih ada transaksi berstatus `"Dipinjam"`
3. `tgl_kembali_plan` **harus lebih besar** dari `tgl_pinjam`
4. `tgl_kembali_asli` hanya diisi oleh Admin saat mencatat pengembalian
5. Satu permohonan peminjaman (`peminjaman`) dapat memuat **lebih dari satu barang** via `detail_peminjaman`
6. Password disimpan dalam format **terenkripsi (bcrypt)**
7. Halaman protected harus **redirect ke login** jika diakses tanpa sesi aktif

---

_Authors: Muhammad Azriel Akbar & Muhammad Alfi Gunawan_
