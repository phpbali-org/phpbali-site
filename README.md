# phpbali-site
Site of PHPBali

Halaman admin:
localhost:8000/adminpage/login atau yoursite.domain/adminpage/login

akun admin:
email: admin@phpbali.com
pass: phpbaliadmin002

# Installation
* buka terminal, clone repo https://github.com/BaliPHP/phpbali-site.git dan pindah ke direktori phpbali-site
* Jalankan command ```composer install```
* Buat file ```.env``` (dengan meng-copy pattern yang telah di sediakan di .env.example)
* Jalankan command ```php artisan key:generate```
* Jalankan command ```php artisan migrate --seed```
* App siap untuk digunakan (```php artisan serve```)

# Installation (Docker)
1. Fork dan Clone
1. `cp .env.example .env` Edit konfigurasi database `DB_DATABASE=phpbali` dan `DB_PASSWORD=root` 
1. `docker-compose up`
1. `docker-compose exec app php artisan migrate --seed`

# Development Progress
* BACKEND
- [x] Manage Events (Add, Edit, Delete)
- [x] Manage Topic (Add, Edit, Delete)
- [x] Manage Users
- [x] Manage RSVP
- [x] Register with Github

* FRONT END
- [x] Homepage
- [x] Member List
- [x] Contact
- [x] Code of Conduct
- [x] Meetups
- [x] RSVP to Event

Note: Silahkan edit file ini jika ada yang ingin ditambahkan di Dev progress atau ada list yang udah beres.
