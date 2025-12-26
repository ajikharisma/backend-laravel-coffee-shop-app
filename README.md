☕ Coffee Shop Backend — Laravel API

Backend ini merupakan layanan REST API untuk aplikasi Coffee Shop berbasis Flutter.
API menyediakan fitur Register, Login, CRUD Produk, Upload Gambar Produk, dan Reset Password.

🛠️ Teknologi yang Digunakan

Laravel 10

MySQL Database

Laravel Sanctum (Autentikasi Token)

REST API JSON

Storage Link untuk upload gambar

📦 Instalasi & Menjalankan Backend

Ikuti langkah berikut untuk menjalankan backend pada komputer lokal:

1️⃣ Clone / Download Project

Jika project ada di GitHub:

<<<<<<< HEAD
git clone https://github.com/ajikharisma/backend-laravel-coffee-shop-app
=======
git clone [https://github.com/username/laravel-coffee-backend.git
cd laravel-coffee-backend](https://github.com/ajikharisma/backend-laravel-coffee-shop-app)
>>>>>>> 964a09ab14e391064c93642f01e4148afb842484


Jika project masih lokal → langsung masuk ke folder project:

cd nama_folder_project

2️⃣ Install dependency Laravel
composer install

3️⃣ Buat file environment .env
cp .env.example .env

4️⃣ Buat Application Key
php artisan key:generate

5️⃣ Konfigurasi Database

Edit di file .env

DB_DATABASE=coffee_app
DB_USERNAME=root
DB_PASSWORD=root123

6️⃣ Jalankan Migrasi Database
php artisan migrate

7️⃣ Buat Storage Link (perlu agar gambar bisa tampil di Flutter)
php artisan storage:link

8️⃣ Jalankan Server Laravel
php artisan serve


Backend akan berjalan pada:

http://127.0.0.1:8000

🔑 Autentikasi

Menggunakan Laravel Sanctum → setiap request ke endpoint API produk harus menyertakan token.

Contoh Header:

Authorization: Bearer your_token_here

📌 Endpoint API Utama
Fitur	Method	Endpoint	Keterangan
Register	POST	/api/register	Membuat akun
Login	POST	/api/login	Mendapatkan token
Reset Password	POST	/api/reset-password	Mengubah password
Get Produk	GET	/api/products	Ambil semua produk
Tambah Produk	POST	/api/products	Tambah produk + gambar
Update Produk	PUT	/api/products/{id}	Edit produk
Delete Produk	DELETE	/api/products/{id}	Hapus produk
🗂️ Struktur Folder Penting
app/
 └── Models/Product.php     # Model data produk
app/Http/Controllers/
 └── ProductController.php  # Logika CRUD Produk
public/storage/             # File gambar produk
routes/api.php              # Routing / Endpoint API

🌐 Koneksi Backend ke Flutter

Gunakan base URL berikut pada Flutter:

static const String baseUrl = 'http://10.0.2.2:8000/api';


Note: 10.0.2.2 digunakan untuk emulator Android.
Jika real device → sesuaikan dengan IP laptop kamu.

📝 Upload Project Laravel ke GitHub
git init
curl -o .gitignore https://raw.githubusercontent.com/laravel/laravel/master/.gitignore
git add .
git commit -m "Initial backend upload"
git branch -M main
git remote add origin https://github.com/username/laravel-coffee-backend.git
git push -u origin main

📚 Dokumentasi Tambahan

Laravel Docs → https://laravel.com/docs

Sanctum API → https://laravel.com/docs/sanctum

🤝 Kontribusi

Pull request & issue terbuka untuk perbaikan dan pengembangan lebih lanjut.

👤 Developer

Project untuk keperluan tugas mata kuliah — Jurusan Informatika
Dikembangkan oleh: Aji Kharisma Atmaja - 5230411292
