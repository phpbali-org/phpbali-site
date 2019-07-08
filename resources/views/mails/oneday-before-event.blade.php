@component('mail::message')
# Pengingat {{ $event->name }}

Halo {{ $user->name }}, ingat tanggal {{ $event->eventDate() }} adalah {{ $event->name }} di [tempat] jam {{ $event->eventTime() }}.
Pastikan kamu datang ya! Untuk info lebih lanjut, silahkan melalui grup Telegram PHPBali https://t.me/phpbali.

Catatan: kamu menerima email ini karena telah mendaftar kegiatan ini di website https://phpbali.com dengan **login with Github**

Terima kasih,<br>
Komunitas PHPBali
@endcomponent
