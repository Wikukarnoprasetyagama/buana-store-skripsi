@component('mail::message')
# Hi, {{ $notifiable->name }}
<br>
Anda baru saja melakukan pendaftaran di aplikasi kami.
<br>
Nikmati fitur yang kami sediakan, dan penuhi kebutuhan anda, 
<br>
dengan belanja di aplikasi kami.
<br>
<br>
Jika anda merasa tidak melakukan pendaftaran, silahkan hubungi kami.
<br>
<ul>
    <li>
        +62822-9502-4272 (Hanya Pesan)
    </li>
    <li>
        me@wikukarno.id
    </li>
</ul>

@component('mail::button', ['url' => route('login')])
Masuk Sekarang
@endcomponent

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
