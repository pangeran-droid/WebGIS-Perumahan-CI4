# GIS Perumahan Penerima Bantuan Pemerintah - CodeIgniter 4

Sistem Informasi Geografis (SIG) berbasis web untuk mendata dan memvisualisasikan lokasi perumahan yang menerima bantuan dari pemerintah. Aplikasi ini dibangun menggunakan framework **CodeIgniter 4** dan library **Leaflet.js** untuk menampilkan peta interaktif.

---

## 🛠️ Fitur Utama

- ✅ Autentikasi (Login & Register)
- ✅ Manajemen Data Penerima Bantuan
  - Tambah, Edit, Hapus Data
  - Upload Foto dan Dokumen
- ✅ Visualisasi Lokasi di Peta (Leaflet)
- ✅ Validasi Form dan Upload
- ✅ Admin Dashboard (dengan AdminLTE)

---

## 🗂️ Struktur Proyek

├── app/ # Logika utama aplikasi (Controllers, Models, Views)
├── public/ # Root web server (akses browser)
├── writable/ # Direktori penyimpanan sementara (log, upload, cache)
├── database/ # File SQL backup untuk import database
├── vendor/ # Dependency hasil install composer (tidak diupload)
├── .env # Konfigurasi lingkungan (tidak diupload)
├── composer.json # Daftar dependency PHP
├── README.md # Dokumentasi proyek

---

## ⚙️ Instalasi & Menjalankan

1. **Clone repository:**

```bash
git clone https://github.com/pangeran-droid/gis-perumahan-ci4.git
cd gis-perumahan-ci4

2. **Install dependency:**

composer install

3. **Copy konfigurasi env:**

cp .env.example .env

4. **Edit .env untuk sesuaikan database:**

database.default.hostname = localhost
database.default.database = nama_database
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi

5. **Import SQL ke database:**

Import file database/db_gis_perumahan.sql ke phpMyAdmin atau MySQL CLI.

6. **Jalankan server:**

php spark serve

Akses di browser: http://localhost:8080

🗺️ Peta & Koordinat
Peta menggunakan Leaflet.js, dan input koordinat didapat melalui klik langsung pada peta saat input/edit data.

📦 Teknologi yang Digunakan
- CodeIgniter 4 (PHP Framework)

- Leaflet.js (Peta Interaktif)

- MySQL (Database)

- AdminLTE (Tampilan dashboard)

- JavaScript & Bootstrap 4

📄 Lisensi
Proyek ini bebas digunakan untuk pembelajaran. Silakan modifikasi sesuai kebutuhan. Attribution appreciated.
```
