# phpbali-site
Website Komunitas PHPBali.

## Prasyarat
Website ini menggunakan Laravel versi 5.7. Jadi pastikan Anda menggunakan PHP minimal versi 7.1.3 atau lebih dan Anda pernah mencoba belajar PHP dan MySQL serta belajar Laravel sebelumnya.

## Catatan
Untuk login ke halaman admin: `phpbali-site.test/adminpage/login`, berikut email dan passwordnya:
```
email: admin@phpbali.com,
password: phpbaliadmin002,
```

## Instalasi
* Buka terminal atau command prompt,
* Masukan perintah ```git clone url_repo``` (contoh: ```git clone https://github.com/BaliPHP/phpbali-site.git```) dan pindah ke direktori phpbali-site.
* Jalankan perintah ```composer install```
* Buat file ```.env``` (dengan menyalin pola yang telah di sediakan di .env.example)
* Buat database baru di MySQL (misalnya: ```phpbali_site```). Selanjutnya pasang nama database tersebut
di `DB_DATABASE`
* Jalankan perintah ```php artisan key:generate``` untuk menghasilkan nilai (value) pada `APP_KEY` di file ```.env```
* Jalankan perintah ```php artisan migrate --seed```
* Web siap untuk digunakan dengan menggunakan perintah ```php artisan serve```

## Instalasi menggunakan Docker
1. Fork dan clone
1. Jalankan perintah `cp .env.example .env` di command prompt atau terminal. Edit konfigurasi database `DB_DATABASE=phpbali` dan `DB_PASSWORD=root` pada file `.env`.
1. Jalankan perintah `docker-compose up` di command prompt atau terminal.
1. Jalankan perintah `docker-compose exec app php artisan migrate --seed` di command prompt atau terminal.
