```markdown
# CRUD Portfolio — PHP + MySQL

A simple portfolio web app to manage profile and experiences. Built for assignment: Advanced Programming.

## Fitur
- Edit profile (nama, email, bio, foto)
- CRUD pengalaman (judul, organisasi, deskripsi, tanggal, gambar)
- Upload gambar

## Setup (lokal, Laragon)
1. Import `db.sql` ke MySQL melalui phpMyAdmin atau HeidiSQL bawaan Laragon.
2. Update `app/config.php` sesuai kredensial MySQL default Laragon (biasanya: user `root`, password kosong).
3. Letakkan folder proyek di direktori `C:\laragon\www\crud-portfolio`.
4. Jalankan Laragon dan klik tombol **Start All** untuk mengaktifkan Apache & MySQL.
5. Buka browser dan akses `http://crud-portfolio.test` (Laragon otomatis membuat virtual host).
Jika belum muncul, klik **Menu → Tools → Quick add → Host crud-portfolio.test**.
6. Pastikan folder `public/uploads` memiliki izin tulis (writable).

## Tips
- Jangan commit folder upload besar ke GitHub. Tambahkan `/public/uploads/` di `.gitignore`.
- Untuk live demo tanpa backend, bisa gunakan screenshot di README dan GitHub Pages (frontend-only).
```
