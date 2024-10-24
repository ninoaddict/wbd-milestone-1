<h1 align="center">
  LinkinPurry
</h1>

<p align="center">
  <img src="php/src/public/images/logo.webp" width="200" alt="LinkinPurry Logo" />
</p>


## ✨ Deskripsi
LinkinPurry adalah sebuah platform yang dirancang agar para pencari kerja dapat dengan mudah menemukan lowongan kerja yang sesuai dengan spesialisasi mereka, serta mempermudah akses terhadap informasi lowongan pekerjaan. Dengan fitur pencarian yang intuitif, kemudahan navigasi, serta keamanan data pengguna yang terjamin, LinkinPurry bertujuan untuk menjadi solusi utama bagi para jobseeker dalam mencari pengalaman kerja yang relevan.

Platform ini tidak hanya memberikan kemudahan bagi para jobseeker dalam mencari lowongan yang sesuai dengan spesialisasi mereka, tetapi juga menyediakan wadah bagi perusahaan atau pemberi kerja untuk mengunggah lowongan pekerjaan baru. LinkinPurry memungkinkan perusahaan untuk melihat lamaran yang masuk dan meresponsnya secara langsung, menciptakan jalur komunikasi yang lebih efisien antara agen pencari kerja dan pemberi kerja.

<h2 id="table-of-contents">🔍 Table of Contents</h2>
- <a href="#description">Description</a><br/>
- <a href="#table-of-contents">Table of Contents</a><br/>
- <a href="#tech-stack">Tech Stack</a><br/>
- <a href="#requirements">Requirements</a><br/>
- <a href="#how-to-run">How To Run</a><br/>

<h2 id="tech-stack">💻 Tech Stack</h2>

- Docker
- Javascript
- HTML
- CSS
- PostgreSQL

<h2 id="requirements">⚠️ Requirements</h2>

Untuk menjalankan projek ini, pastikan bahwa Docker sudah terunduh dan dapat berjalan pada perangkat Anda. Anda dapat menginstall Docker Engine pada link [berikut](https://docs.docker.com/engine/install/).

<h2 id="how-to-run">🏃 How To Run</h2>

- Untuk memulai menjalankan LinkinPurry, _clone_ repository ini dan pindah ke direktori tempat projek ini berada
```bash
git clone https://github.com/Labpro-21/if3110-tubes-2024-k02-21
cd if3110-tubes-2024-k02-21
```

- Jalankan program dengan _command_
```bash
docker compose up
```

- Buka localhost:8000 pada browser Anda untuk melihat website ini
- Jika ingin memberhentikan program ini, jalankan _command_ berikut
```bash
docker compose down
```
- Atau jika Anda juga ingin sekalian menghapus volume yang berisi _database_, jalankan _command_ berikut
```bash
docker compose down -v
```