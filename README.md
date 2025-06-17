Bookstore - PROJECT FINAL UNTUK KELAS LNT BACK END BNCC

Sebuah aplikasi web e-commerce fungsional yang dibangun dengan Laravel untuk platform penjualan buku. Proyek ini mencakup fitur-fitur penting seperti manajemen produk, sistem otentikasi dengan peran (Admin & User), keranjang belanja, dan sistem invoice.
Daftar Isi

    ✨ Fitur Utama
    🛠️ Stack Teknologi
    📋 Prasyarat
    🚀 Instalasi & Setup
    🧑‍💻 Cara Penggunaan
    🗄️ Struktur Database

✨ Fitur Utama

Aplikasi ini memiliki dua peran utama dengan fungsionalitas yang berbeda:
Fitur Pengguna (User & Guest)

    Otentikasi: Pengguna dapat membuat akun (Register), masuk (Login), dan keluar (Logout).
    Katalog Produk: Melihat semua buku yang tersedia dengan fitur pencarian dan paginasi.
    Detail Produk: Melihat informasi mendetail untuk setiap buku.
    Keranjang Belanja: Menambah, melihat, mengubah kuantitas, dan menghapus item dari keranjang.
    Sistem Pembelian:
        Beli Langsung: Melakukan pembelian instan untuk satu item.
        Checkout: Memproses semua item di keranjang menjadi sebuah transaksi.
    Validasi Saldo: Sistem akan memvalidasi saldo (money) pengguna sebelum transaksi berhasil.
    Riwayat Transaksi: Pengguna dapat melihat daftar semua invoice/pembelian yang pernah dilakukan.

Fitur Admin

    Dashboard: Melihat ringkasan data statistik aplikasi (total pengguna, buku, transaksi, dll).
    Manajemen Produk (CRUD): Admin memiliki kontrol penuh untuk Menambah, Melihat, Mengedit, dan Menghapus data buku.
    Upload Foto: Mengunggah gambar sampul untuk setiap buku.
    Manajemen Kategori: Admin dapat mengelola kategori buku (CRUD).
    Manajemen Pengguna: Admin dapat melihat daftar semua pengguna yang terdaftar.
    Manajemen Invoice: Admin dapat melihat semua transaksi yang terjadi di dalam sistem.

🛠️ Stack Teknologi

    Backend: Laravel 11, PHP 8.2+
    Database: MySQL
    Frontend: Blade Templating Engine, Bootstrap 5
    Server Lokal: XAMPP / Laragon

📋 Prasyarat

Sebelum memulai, pastikan Anda sudah menginstall perangkat lunak berikut di komputer Anda:

    PHP (versi 8.2 atau lebih baru)
    Composer
    Server Database MySQL (disediakan oleh XAMPP atau Laragon)

🚀 Instalasi & Setup

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

    Clone Repositori
    Bash

git clone https://github.com/username/nama-repo.git
cd nama-repo

Install Dependencies
Jalankan Composer untuk menginstall semua library PHP yang dibutuhkan.
Bash

composer install

Buat File Environment
Salin file .env.example menjadi .env.
Bash

cp .env.example .env

Generate Application Key
Buat kunci enkripsi unik untuk aplikasi Anda.
Bash

php artisan key:generate

Konfigurasi Database

    Buka phpMyAdmin dan buat database baru (misalnya: book_store).
    Buka file .env dan sesuaikan pengaturan database Anda:
    Code snippet

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=book_store
    DB_USERNAME=root
    DB_PASSWORD=

🗄️ Struktur Database

Struktur database aplikasi ini didasarkan pada Class Diagram berikut, dengan penambahan tabel carts dan kolom stock pada books untuk mendukung fungsionalitas e-commerce.

Proyek ini dibuat untuk memenuhi tugas Final Project LNT Backend Development BNCC.
Dibuat oleh: Leonard FRS
