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
- [ ] Code of Conduct
- [x] Meetups
- [x] RSVP to Event

Note: Silahkan edit file ini jika ada yang ingin ditambahkan di Dev progress atau ada list yang udah beres.
