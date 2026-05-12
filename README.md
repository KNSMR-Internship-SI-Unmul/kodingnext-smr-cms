# Content Management System (CMS) - Koding Next Samarinda

Sistem Informasi Manajemen Konten (CMS) yang dibangun khusus untuk **Koding Next Samarinda** guna mengelola dan mengintegrasikan data operasional untuk kebutuhan pemasaran.

## 🚀 Fitur Utama

Sistem ini dilengkapi dengan berbagai fitur untuk mendukung efisiensi operasional:
*   **Secure Authentication & Authorization:** Sistem login/logout dengan role based access.
*   **Human Resources Management:** 
    *   Manajemen Role (Akses khusus untuk Admin).
    *   Manajemen Data Employee.
*   **Curriculum Management:**
    *   Manajemen Course Types.
    *   Manajemen Module.
*   **Student Management:**
    *   Manajemen Data Student.
    *   Student Projects & Project Reviews.
*   **Marketing & Public Relations:**
    *   Manajemen Events.
    *   Manajemen Promotions.
    *   General Testimonials.
*   **Global Features:** Live search, pagination, bulk actions (Checkbox delete).

### Hak Akses (Role & Authorization)

* Admin: Memiliki akses penuh terhadap semua fitur.
* Student Advisor, Teacher, dan Advanced Teacher: Dapat mengelola semua fitur kecuali Role dan Employee.

## 🛠️ Teknologi yang Digunakan (Tech Stack)

*   **Backend:** [Laravel](https://laravel.com/) (PHP Framework)
*   **Database:** MySQL
*   **Frontend Styling:** [Tailwind CSS](https://tailwindcss.com/)
*   **Frontend Interactivity:** [Alpine.js](https://alpinejs.dev/) (Untuk interaktivitas UI seperti modal, dropdown, dan toast).

## 💻 Panduan Instalasi (Setup Guide)

Langkah-langkah untuk menjalankan aplikasi ini di environment lokal atau server baru:

### 1. Prasyarat Sistem (Prerequisites)
Pastikan sistem sudah terinstal:
*   PHP (Sesuai versi Laravel yang digunakan)
*   Composer
*   MySQL
*   Node.js & NPM
*   Git 

### 2. Langkah Instalasi
1. **Clone repositori**
   ```bash
   git clone https://github.com/KNSMR-Internship-SI-Unmul/kodingnext-smr-cms.git
2. **Masuk ke direktori proyek**
   ```bash
   cd kodingnext-smr-cms
3. **Install dependensi backend**
   ```bash
   composer install
4. **Install dependensi frontend**
   ```bash
   npm install
5. **Setup file konfigurasi**

    Copy file .env.example dan ubah namanya menjadi .env.
   ```bash
   cp .env.example .env
6. **Buat database**
   
   Buat database baru (kosong) dengan nama kodingsmr_cms (atau sesuaikan kembali dengan konfigurasi file .env).
7. **Generate Application Key**
   ```bash
   php artisan key:generate
8. **Jalankan migrasi database**
   ```bash
   php artisan migrate
9. **Jalankan seeder database**
   ```bash
   php artisan db:seed
10. **Hubungkan folder storage**
    ```bash
    php artisan storage:link
11. **Jalankan local server**
    
    Jalankan kedua perintah tersebut di terminal yang berbeda secara bersamaan.
    ```bash
    # Terminal 1
    npm run dev

    # Terminal 2
    php artisan serve
12. Akses aplikasi melalui browser di: `http://localhost:8000`

## 📂 Struktur Direktori & File Utama

Proyek ini dibangun di atas arsitektur standar Laravel. Namun, untuk memudahkan *developer* selanjutnya, berikut adalah pemetaan direktori dan file utama yang **dibuat dan dikustomisasi secara khusus** untuk kebutuhan CMS Koding Next Samarinda:

    kodingnext-smr-cms/
    ├── app/
    │   ├── Http/
    │   │   ├── Controllers/          # Logika bisnis & kendali alur
    |   |   |   ├──Api/               # API untuk website profile
    |   |   |   |   ├── CourseTypeController.php
    |   |   |   |   ├── EmployeeController.php
    |   |   |   |   └── ... (File Controller lainnya)
    │   │   │   ├── AuthController.php
    |   |   |   ├── CourseTypeController.php
    │   │   │   ├── DashboardController.php
    │   │   │   ├── EmployeeController.php
    │   │   │   ├── EventController.php
    │   │   │   ├── GeneralTestimonialController.php
    │   │   │   ├── ModuleController.php
    │   │   │   ├── ProjectReviewController.php
    │   │   │   ├── PromotionController.php
    │   │   │   ├── RoleController.php
    │   │   │   ├── StudentController.php
    │   │   │   └── StudentProjectController.php
    │   │   ├── Requests/             # Validasi input form (Security)
    │   │   │   ├── AddStudentProjectRequest.php
    │   │   │   ├── UpdateStudentProjectRequest.php
    │   │   │   └── ... (File Request lainnya)
    │   │   └── Resources/
    │   │   │   ├── CourseTypeResources.php
    │   │   │   ├── Employee Resources.php
    │   │   │   └── ... (File Resources lainnya)
    │   ├── Models/                   # Representasi database & relasi (Eloquent)
    │   │   ├── CourseType.php
    │   │   ├── Event.php
    │   │   ├── GeneralTestimonial.php
    │   │   ├── Module.php
    │   │   ├── ProjectReview.php
    │   │   ├── Promotion.php
    │   │   ├── Role.php
    │   │   ├── Student.php
    │   │   ├── StudentProject.php
    │   │   └── User.php              # Di-extend untuk kapabilitas Employee
    │   └── Policies/                 # Logika keamanan & otorisasi 
    │       └── UserPolicy.php        # Membatasi hak akses
    │
    ├── database/
    │   ├── migrations/               # Skema database (tabel & relasi)
    │   │   └── (File migrasi untuk seluruh entitas sistem)
    │   └── seeders/                  # Data master & dummy
    │       ├── CourseTypeSeeder.php
    │       ├── DatabaseSeeder.php 
    │       ├── EventSeeder.php
    │       ├── GeneralTestimonialSeeder.php
    │       ├── ModuleSeeder.php
    │       ├── ProjectReviewSeeder.php
    │       ├── PromotionSeeder.php
    │       ├── RoleSeeder.php
    │       ├── StudentProjectSeeder.php
    │       ├── StudentSeeder.php
    │       └── UserSeeder.php
    │
    ├── resources/
    │   ├── js/
    │   |   ├── app.js                # Entry point utama & inisialisasi Alpine.js
    │   |   └── component.js          # Component Manager berisi logika x-data Alpine.js untuk disuntikkan ke tampilan
    │   └── views/                    # Tampilan frontend
    │       ├── auth/
    │       │   └── login.blade.php
    │       ├── components/           # Komponen UI reusable
    │       │   ├── empty-state.blade.php
    │       │   └── toast.blade.php
    │       ├── layouts/              # Template utama
    │       │   ├── app.blade.php     # Layout master HTML
    │       │   └── auth.blade.php    # Layout untuk halaman autentikasi
    │       ├── pages/                # Tampilan per fitur (index, show)
    │       │   ├── courses/
    │       │   ├── employees/
    │       │   ├── events/
    │       │   ├── general-testimonials/
    │       │   ├── modules/
    │       │   ├── promotions/
    │       │   ├── roles/
    │       │   ├── student-projects/
    │       │   ├── students/
    │       │   └── dashboard.index.php
    │       └── partials/
    │           ├── navbar.blade.php
    |           └── sidebar.blade.php
    │
    └── routes/
        ├── api.php 
        └── web.php     


## 🚀 Status Proyek & Catatan Deployment

**Status:** Selesai & siap deployment (Ready for production)

**Catatan khusus:** Migrasi Tailwind CSS

Selama fase *development*, proyek ini menggunakan Tailwind CSS via CDN untuk mempercepat proses *prototyping*. Sebelum aplikasi ini ke tahap *server production*, sangat disarankan untuk melakukan *build* aset CSS menggunakan Vite demi performa dan kecepatan *loading* halaman.
