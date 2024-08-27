# TODOLIST APP
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity)

Todolist App adalah aplikasi website yang dibangun dengan 
Laravel, HTML, CSS, dan JavaScript.
.
## Features

- Pengelolaan Tugas Berdasarkan Email: Setiap pengguna dapat memiliki to-do list yang terpisah sesuai dengan alamat email yang digunakan, memungkinkan pengaturan yang lebih terorganisir.
- Fleksibilitas dalam Mengatur Kategori: Pengguna dapat menambah, mengedit, dan menghapus kategori dengan mudah, memberikan kebebasan dalam mengelola tugas.
- Penjadwalan Tugas untuk Hari Berikutnya:** Aplikasi ini memungkinkan pengguna untuk menjadwalkan tugas untuk hari-hari mendatang, membantu Anda tetap teratur dan efisien.



> Kebanyakan orang tidak mengatur waktu dengan baik. 
> Dengan mengatur waktu dengan baik, Anda akan lebih produktif.



## Aplikasi tambahan

Sebelum bisa menjalankan proyek ini wajib menginstall:

- [Composer](https://getcomposer.org/download/) - untuk mengelola dependensi PHP.
- [Node.js](https://nodejs.org/) - untuk menjalankan JavaScript di server.r
- [XAMPP](https://www.apachefriends.org/index.html) - untuk menyediakan lingkungan server lokal yang diperlukan.
- [VScode](https://code.visualstudio.com) - compiler atau text editor untuk mengubah kode didalamnya.

And of course Dillinger itself is open source with a [public repository][dill]
 on GitHub.

## Installation

Akses tautan ini melalui website [Github](https://github.com/ConsLet0/todolist-app) untuk mendapatkan kode lengkapnya.

Silahkan duplikasi dengan menjalankan code ini di command prompt (sebelumnya pilih folder yang akan menyimpan kode ini).

```sh
git clone https://github.com/ConsLet0/todolist-app
```

Lalu buka dengan Visual Studio Code atau Text Editor lain.

## Persiapan

Setelah Visual Studio Code atau Text Editor terbuka.

Buka Terminal pada Text Editor.
Lalu ketikan
```sh
composer install
```
Jalankan xampp dengan menekan tombol start pada mysql dan apache.
Klik Admin pada menu Mysql.

Buat Database baru (nama dibebaskan).

Copy paste

```sh
.env.example
```
Pada folder kode yang sudah dibuka di text editor dan ganti namanya menjadi
```sh
.env
```
Buka .env dan silahkan ganti
```sh
DB_DATABASE=laravel
```
menjadi
```sh
DB_DATABASE=[nama database yang sudah dibuat tanpa kurung]
```

Jalankan perintah dibawah ini untuk menginstall node modules.
```sh
npm install
npm run build
```

## Menjalankan Aplikasi
Jalankan perintah dibawah ini untuk membuat kunci unik pada aplikasi tersebut

```sh
php artisan key:generate
```

Setalah itu jalankan perintah ini untuk mengintegrasi struktur database dan menginput data yang sudah ditambahkan.
```sh
php artisan migrate:fresh --seed
```

Jalankan website dengan perintah dibawah ini.
```sh
php artisan serv.
```

## Data

Dalam kode tersebut disediakan satu akun pengguna contoh yaitu admin
dengan email dan password dibawah ini. Klik menu login pada bagian kanan
atas layar lalu gunakan data dibawah ini.
```sh
admin@example.com
admin123
```

Akses pada tautan dibawah
```sh
http://127.0.0.1:8000
```

## License
MIT


[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [dill]: <https://github.com/joemccann/dillinger>
   [git-repo-url]: <https://github.com/joemccann/dillinger.git>
   [john gruber]: <http://daringfireball.net>
   [df1]: <http://daringfireball.net/projects/markdown/>
   [markdown-it]: <https://github.com/markdown-it/markdown-it>
   [Ace Editor]: <http://ace.ajax.org>
   [node.js]: <http://nodejs.org>
   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [jQuery]: <http://jquery.com>
   [@tjholowaychuk]: <http://twitter.com/tjholowaychuk>
   [express]: <http://expressjs.com>
   [AngularJS]: <http://angularjs.org>
   [Gulp]: <http://gulpjs.com>

   [PlDb]: <https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md>
   [PlGh]: <https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md>
   [PlGd]: <https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md>
   [PlOd]: <https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md>
   [PlMe]: <https://github.com/joemccann/dillinger/tree/master/plugins/medium/README.md>
   [PlGa]: <https://github.com/RahulHP/dillinger/blob/master/plugins/googleanalytics/README.md>
