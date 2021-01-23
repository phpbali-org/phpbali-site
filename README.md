# phpbali-site [MOVING TO NEW REPOSITORY: https://github.com/komunitas-phpbali/next-site]
Website Komunitas PHPBali.

## Teknologi
Teknologi yang digunakan adalah Laravel, Tailwind CSS, dan Github untuk autentikasi.

## Instalasi
* Buka terminal atau command prompt,
* Masukan perintah ```git clone https://github.com/BaliPHP/phpbali-site.git```.
* Jalankan perintah ```composer install```
* Buat file ```.env``` (dengan menyalin pola yang telah di sediakan di .env.example)
* Buat database baru di MySQL (misalnya: ```phpbali_site```). Selanjutnya pasang nama database tersebut
di `DB_DATABASE`
* Jalankan perintah ```php artisan key:generate``` untuk menghasilkan nilai (value) pada `APP_KEY` di file ```.env```
* Jalankan perintah ```php artisan migrate --seed```
* Web siap untuk digunakan dengan menggunakan perintah ```php artisan serve```

## Instalasi menggunakan Docker
1. Fork dan clone
1. Jalankan perintah `cp .env.example .env` di command prompt atau terminal. Edit konfigurasi database `DB_DATABASE=phpbali`, `DB_HOST=db` dan `DB_PASSWORD=root` pada file `.env`.
1. Jalankan perintah `docker-compose up` di command prompt atau terminal.
1. Jalankan perintah `composer install` pada service `app` dengan menjalankan perintah `docker-compose exec app composer install`
1. Jalankan perintah `docker-compose exec app php artisan key:generate` di command prompt atau terminal.
1. Jalankan perintah `docker-compose exec app php artisan migrate --seed` di command prompt atau terminal.

## Berkontribusi
Kami terbuka dengan kontribusi Anda, entah itu berupa memberi tanda bintang ⭐️ pada repository ini, mengirimkan [issue](https://github.com/BaliPHP/phpbali-site/issues) dan pull request. Untuk detailnya silahkan dibaca di halaman [kontribusi](CONTRIBUTING.md).
