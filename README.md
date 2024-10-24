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
- <a href="#screenshots">Tampilan Layar</a><br/>
- <a href="#contributions">Pembagian Tugas</a><br/>

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

<h2 id="screenshots">📱 Tampilan Layar</h2>

1. Login Page
![Login Page](/php/src/public/images/login.png)
![Login Page](/php/src/public/images/login-mobile.png)
![Login Page](/php/src/public/images/login-lighthouse.png)

2. Register Page
![Login Page](/php/src/public/images/register.png)
![Login Page](/php/src/public/images/register-mobile.png)
![Login Page](/php/src/public/images/register-lighthouse.png)

3. Home Page (Job Seeker)
![Home Page Job Seeker](/php/src/public/images/home-job-seeker.png)
![Home Page Job Seeker](/php/src/public/images/home-jobseeker-mobile.png)
![Home Page Job Seeker](/php/src/public/images/home-jobseeker-lighthouse.png)

4. Home Page (Company)
![Home Page Company](/php/src/public/images/home-company.png)
![Home Page Company](/php/src/public/images/home-company-mobile.png)
![Home Page Company](/php/src/public/images/home-company-lighthouse.png)

5. Add Lowongan Page
![Add Lowongan Page](/php/src/public/images/add-lowongan.png)
![Add Lowongan Page](/php/src/public/images/add-job-mobile.png)
![Add Lowongan Page](/php/src/public/images/add-job-lighthouse.png)

6. Detail Lowongan (Company)
![Detail Lowongan Page](/php/src/public/images/detail-lowongan-company.png)
![Detail Lowongan Page](/php/src/public/images/detail-lowongan-mobile.png)
![Detail Lowongan Page](/php/src/public/images/detail-lowongan-lighthouse.png)

7. Detail Lamaran (Company)
![Detail Lamaran Page](/php/src/public/images/detail-lamaran.png)
![Detail Lamaran Page](/php/src/public/images/detail-lamaran-mobile.png)
![Detail Lamaran Page](/php/src/public/images/detail-lamaran-lighthouse.png)

8. Edit Lowongan Page
![Edit Lowongan Page](/php/src/public/images/edit-lowongan.png)
![Detail Lamaran Page](/php/src/public/images/edit-job-mobile.png)
![Detail Lamaran Page](/php/src/public/images/edit-job-lighthouse.png)

9. Profile Page
![Profile Page](/php/src/public/images/profile.png)
![Profile Page](/php/src/public/images/profile-mobile.png)
![Profile Page](/php/src/public/images/profile-lighthouse.png)

10. Lamaran Page
![Lamaran Page](/php/src/public/images/lamaran.png)
![Lamaran Page](/php/src/public/images/lamaran-mobile.png)
![Lamaran Page](/php/src/public/images/lamaran-lighthouse.png)

11. Detail Lowongan Page (Job Seeker)
![Detail Lowongan](/php/src/public/images/detail-lamaran-js.png)
![Detail Lowongan](/php/src/public/images/detail-lowonganjs-mobile.png)
![Detail Lowongan](/php/src/public/images/detail-lowonganjs-lighthouse.png)

12. History Page
![History Page](/php/src/public/images/history.png)
![History Page](/php/src/public/images/history-mobile.png)
![History Page](/php/src/public/images/history-lighthouse.png)

<h2 id='contributions'>Pembagian Tugas</h2>
<h3>Server Side</h3>

| 13522068                                 | 13522105    | 13522110                |
| ---------------------------------------- | ----------- | ----------------------- |
| Set up project architecture              |             | CRUD lowongan           |
| Set up database                          |             | Get Data for CSV Export |
| Set up base class and functions          |             |                         |
| Set up docker                            |             |                         |
| CRUD user                                |             |                         |
| Search and filter lowongan               |             |                         |
| Job recommendation for job seeker        |             |                         |
| CRUD lamaran                             |             |                         |
| Review CRUD                              |             |                         |
| Utilities                                |             |                         |

<h3>Client Side</h3>

| 13522068                                 | 13522105    | 13522110                            |
| ---------------------------------------- | ----------- | ----------------------------------- |
| Navbar                                   |             | Detail lowongan page for comopany   |
| Footer                                   |             | Detail lowongan page for job seeker |
| Toast error and success message          |             | Edit lowongan                       |
| Login page                               |             | Export to CSV                       |
| Register page                            |             | Add lowongan                        |
| Home page for job seeker                 |             |                                     |
| Home page for company                    |             |                                     |
| Lamaran page                             |             |                                     |
| Detail lamaran page                      |             |                                     |
