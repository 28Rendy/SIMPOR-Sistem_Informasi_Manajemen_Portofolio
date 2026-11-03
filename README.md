<p align="center">
  <a href="https://github.com/28Rendy/SIMPOR-Sistem_Informasi_Manajemen_Portofolio" target="_blank">
    <img src="https://arifszn.github.io/ezfolio/img/short-logo.png" alt="SIMPOR" title="SIMPOR" width="80">
  </a>
</p>

<h1 align="center">SIMPOR</h1>
<p align="center">Sistem Informasi Manajemen Portofolio</p>

<p align="center">
    <a href="https://laravel.com/"><img src="https://img.shields.io/badge/laravel-8-blue" alt="laravel 8"></a>
    <a href="https://reactjs.org/"><img src="https://img.shields.io/badge/react-17-blue" alt="react 17"></a>
    <a href="https://ant.design/"><img src="https://img.shields.io/badge/antd-4-blue" alt="antd 4"></a>
    <a href="https://github.com/arifszn/ezfolio/blob/main/LICENSE"><img src="https://img.shields.io/github/license/arifszn/ezfolio"/></a>
</p>

<br/>

<p align="center">
    <a href="https://arifszn.github.io/ezfolio">
        <img src="https://arifszn.github.io/ezfolio/img/assets/preview.gif" alt="Cover"/>
    </a>
    <br/>
</p>

---

## 🛡️ Pernyataan Orisinalitas & Penafian (Disclaimer)

Proyek ini merupakan **karya turunan (*derived work*) yang dimodifikasi** dari proyek sumber terbuka (*open-source*) bernama **[Ezfolio](https://github.com/arifszn/ezfolio)** yang dikembangkan oleh **arifszn**. Proyek asli dilisensikan di bawah **Lisensi MIT**, yang mengizinkan modifikasi dan penggunaan kembali secara bebas.

### 📌 Tujuan Proyek
Pengembangan dan modifikasi pada repositori ini dilakukan oleh **Rendy** dengan tujuan:
* **Portofolio Pribadi:** Sebagai materi unjuk kerja dan demonstrasi keterampilan teknis dalam pengembangan *Full-Stack Developer*.
* **Eksplorasi Teknis:** Mempelajari arsitektur integrasi sistem, penyesuaian fungsionalitas, serta pengelolaan kode berbasis *open-source*.

### 🛠️ Kontribusi & Perubahan yang Dilakukan
Seluruh hak cipta atas struktur dasar kode, logika bawaan, dan lisensi awal tetap menjadi milik pengembang asli (**arifszn**). Namun, dalam repositori ini, saya telah melakukan beberapa perubahan dan kustomisasi personal, yang meliputi:
* **Penamaan ulang proyek** dari *Ezfolio* menjadi **SIMPOR** (*Sistem Informasi Manajemen Portofolio*) - mencakup pembaruan nama aplikasi, konfigurasi, dan seluruh referensi terkait.
* **Lokalisasi penuh ke Bahasa Indonesia** - seluruh antarmuka pengguna (UI) pada tema frontend (*Procyon*, *Rigel*, *Vega*) dan panel admin diterjemahkan ke Bahasa Indonesia, termasuk menu navigasi (*Beranda, Tentang, Layanan, Proyek, Kontak*), label formulir, dan pesan validasi.
* **Pembaruan halaman autentikasi admin** - judul halaman, placeholder input, dan pesan error pada halaman Login, Lupa Kata Sandi, dan Reset Kata Sandi diubah ke Bahasa Indonesia.
* **Konfigurasi regional & zona waktu** - `timezone` diubah ke `Asia/Jakarta`, `locale` diubah ke `id` (Indonesia), dan `faker_locale` diubah ke `id_ID` untuk penyesuaian data lokal.
* **Penambahan file bahasa Indonesia** - menambahkan `resources/lang/id/` beserta file `auth.php`, `pagination.php`, `passwords.php`, dan `validation.php` sebagai dukungan multilingual.
* **Rename file migrasi ke Bahasa Indonesia** - seluruh 12 file migrasi database diganti namanya menggunakan istilah Bahasa Indonesia (misal: `buat_tabel_pengaturan`, `buat_tabel_admin`, dll) untuk konsistensi penamaan.
* **Perbaikan teknis: BOM character** - menghapus *Byte Order Mark* (BOM) pada 12 file `app/Services/*.php` yang menyebabkan error `Namespace declaration` pada PHP 8.
* **Pembaruan dependensi** - memperbarui `composer.lock` agar kompatibel dengan **PHP 8.3** (Laragon) dengan melakukan `composer update`.

Saya sangat menghormati hak kekayaan intelektual dan komunitas *open-source*. Oleh karena itu, lisensi asli (`LICENSE`) tetap dipertahankan di dalam repositori ini sebagai bentuk kepatuhan hukum dan etika.

---

**SIMPOR** (*Sistem Informasi Manajemen Portofolio*) adalah CMS portofolio berbasis proyek *open-source* **Ezfolio**, dibangun menggunakan **Laravel**, **React**, dan **Ant Design**. Pilih dari berbagai template keren dan kendalikan apa yang ingin Anda tampilkan ke audiens. Menawarkan antarmuka admin minimalis dengan banyak opsi kustomisasi. Dapatkan semua fitur situs portofolio termasuk pelacak pengunjung, Google Analytics, mode maintenance, formulir kontak, SEO, dan masih banyak lagi.

- Dibangun dengan Laravel, React dan Ant Design
- JWT Authentication
- Single Page Application
- Desain Modern dan Responsif
- Berbagai Template
- Kustomisasi Warna Tema
- Custom Scripting
- Pelacak Pengunjung
- Pelacak Lokasi
- Google Analytics
- Mode Maintenance
- Formulir Kontak
- Search Engine Optimization (SEO)
- Kontrol Visibilitas Section
- Dan Masih Banyak Lagi…

> Client: https://github.com/arifszn/ezfolio/tree/main/resources/js/client


## Docs

Lihat <a href="http://arifszn.github.io/ezfolio">dokumentasi</a> proyek asli (Ezfolio).


## Installation

### Tanpa Docker

- Jalankan `cp .env.example .env`
- Jalankan `composer install` (atau `composer update` jika ada konflik versi PHP)
- Isi nama database, username, dan password di file `.env`
- Jalankan `php artisan migrate --seed`
- Jalankan `php artisan storage:link`
- Jalankan `npm install`
- Jalankan `npm run prod` atau `npm run watch`
- Jalankan `php artisan serve`

Kredensial Admin Default:

```
Email: admin@admin.com
Password: 12345
```

### Dengan Docker

- Jalankan `cp .env.example .env`.
- Jalankan perintah berikut untuk menginstal dependensi Composer:
    ```sh
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs
    ```
- Jalankan `./vendor/bin/sail up -d`.
- Jalankan `./vendor/bin/sail artisan migrate --seed`. Jika muncul error `Connection refused`, set `DB_HOST=mysql` di file `.env`.
- Jalankan `./vendor/bin/sail npm install`.
- Jalankan `./vendor/bin/sail npm run prod` atau `./vendor/bin/sail npm run watch`.

`sail` adalah ekuivalen dari `docker-compose`, baca dokumentasi [`laravel/sail`](https://laravel.com/docs/8.x/sail).

For more info, visit the <a href="http://arifszn.github.io/ezfolio">docs</a>.



### Admin Panel
<h1 align="center">BackEnd-SIMPOR</h1>
<img width="1920" height="935" alt="Dashboard - SIMPOR" src="https://github.com/user-attachments/assets/257833cd-1fcb-410f-8e97-137de121aea2" />

### Front
<h1 align="center">FrontEnd-SIMPOR</h1>
<img width="1920" height="6387" alt="Rendy 28" src="https://github.com/user-attachments/assets/62d8f6b9-03ff-4f4a-b193-4c931deb1fa5" />


## License

**SIMPOR** adalah karya turunan dari **Ezfolio** yang dilisensikan di bawah [Lisensi MIT](https://github.com/arifszn/ezfolio/blob/main/LICENSE).
