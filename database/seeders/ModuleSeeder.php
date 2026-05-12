<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            // Little Koders
            [
                'name' => 'Coding Stories',
                'description' => 'Memperkenalkan konsep dasar pemrograman melalui aktivitas menyenangkan, melatih logika, serta membuat game sederhana dan cerita interaktif.',
                'age_range' => '4-6',
                'duration_per_session' => 45,
                'course_type_id' => 1,
            ],
            [
                'name' => 'Coding World Safari',
                'description' => 'Memperkaya pemahaman siswa tentang konsep pemrograman dengan mempelajari pengenalan pola serta keterampilan berpikir motorik dan logis.',
                'age_range' => '4-6',
                'duration_per_session' => 45,
                'course_type_id' => 1,
            ],
            [
                'name' => 'Coding Robot Adventure',
                'description' => 'Mengasah kemampuan berpikir logis dan analitis siswa dalam pemrograman. Siswa akan diperkenalkan pada dunia teknologi yang luas dengan belajar memberikan perintah dasar kepada robot dan menggunakan blok fisik.',
                'age_range' => '4-6',
                'duration_per_session' => 45,
                'course_type_id' => 1,
            ],
            [
                'name' => 'Games & Apps',
                'description' => 'Siswa akan belajar berpikir algoritmik dan pemecahan masalah menggunakan aplikasi pemrograman di iPad atau tablet, serta menggunakan beberapa alat komputasi fisik tingkat lanjut yang dirancang khusus untuk anak-ana.',
                'age_range' => '6-8',
                'duration_per_session' => 60,
                'course_type_id' => 1,
            ],
            [
                'name' => 'Robots',
                'description' => 'Siswa akan mempraktikkan konsep dasar coding menggunakan robot yang dirancang khusus untuk pendidikan anak-anak. Siswa juga akan belajar tentang komponen dan fungsi dasarnya.',
                'age_range' => '6-8',
                'duration_per_session' => 60,
                'course_type_id' => 1,
            ],
            [
                'name' => 'Computer Programming',
                'description' => 'Siswa akan belajar membuat game dan proyek interaktif menggunakan komputer, serta mengenal keterampilan motorik untuk menggunakan komputer seperti menggunakan mouse danmengetik dengan keyboard, mempersiapkan mereka untuk melanjutkan ke Junior Koders.',
                'age_range' => '6-8',
                'duration_per_session' => 60,
                'course_type_id' => 1,
            ],
            [
                'name' => 'Coding with Math',
                'description' => 'Siswa akan belajar menerapkan konsep matematika untuk membuat program coding. Sebaliknya, mereka akan menggunakan keterampilan coding untuk meningkatkan pemahaman mereka tentang matematika. Program ini akan meningkatkan keterampilan coding anak-anak ke tingkat yang lebih tinggi.',
                'age_range' => '6-8',
                'duration_per_session' => 60,
                'course_type_id' => 1,
            ],
            [
                'name' => 'STEAM & Coding',
                'description' => 'Selama kursus STEAM, siswa mengembangkan pemikiran ilmiah, keterampilan teknologi dalam teknik dan listrik dengan mengerjakan proyek interdisipliner. Dan tentunya, mereka juga belajar coding.',
                'age_range' => '6-8',
                'duration_per_session' => 60,
                'course_type_id' => 1,
            ],
            [
                'name' => 'Active AI',
                'description' => 'Siswa akan mengembangkan kefasihan dalam konsep dan praktik computing. Selain itu, mereka akan terlibat dalam pembuatan proyek interaktif berbasis Artificial Intelligence (AI) untuk pertama kalinya! Mereka akan belajar berpikir kritis tentang AI dan interaksi manusia-komputer.',
                'age_range' => '6-8',
                'duration_per_session' => 60,
                'course_type_id' => 1,
            ],
            // Junior Koders
            [
                'name' => '2D Games With Roblox',
                'description' => 'Siswa akan memperkuat dasar pemrograman mereka dan diperkenalkan pada konsep yang lebih lanjut dengan membuat game dan animasi menarik menggunakan Scratch, Roblox, dan Construct 3.',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'course_type_id' => 2,
            ],
            [
                'name' => 'Minecraft I',
                'description' => 'Siswa akan belajar coding berbasis blok menggunakan Code Builder di Minecraft serta mengeksplorasi konsep dasar AI dan keamanan siber. Mereka akan membuat proyek yang berhubungan dengan Sustainable Development Goals dan berkolaborasi dalam merancang solusi di Minecraft.',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Game Development',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Minecraft II',
                'description' => '',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Game Development',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Roblox I',
                'description' => 'Modul ini berfokus pada bahasa pemrograman LUA dan pembuatan game menggunakan Roblox Studio sehingga siswa dapat membuat game Roblox mereka sendiri.',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Game Development',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Roblox II',
                'description' => 'Siswa akan melanjutkan pembelajaran pemrograman menggunakan LUA dengan fokus lebih pada desain 3D untuk membuat game yang lebih profesional.',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Game Development',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Unity 2D Game Development',
                'description' => '',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Game Development',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Mobile Apps Development',
                'description' => 'Siswa akan mempelajari konsep dasar pemrograman dengan membuat wireframe aplikasi, kemudian mengembangkan aplikasi mobile untuk Android atau iOS menggunakan Thunkable dan Figma.',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Tech Innovator',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Cyber Security',
                'description' => '',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Tech Innovator',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Artificial Intelligence',
                'description' => '',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Tech Innovator',
                'course_type_id' => 2,
            ],
            [
                'name' => '2D & 3D Design',
                'description' => 'Belajar desain seperti profesional melalui kursus 2D & 3D. Siswa akan mempelajari grafis 2D, membuat desain 3D menggunakan TinkerCAD, serta mencetak hasilnya dengan printer 3D.',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Tech Innovator',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Vibe Coding',
                'description' => '',
                'age_range' => '8-12',
                'duration_per_session' => 90,
                'category' => 'Tech Innovator',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Python: First Programmes',
                'description' => 'Siswa akan mempelajari pemrograman berbasis teks dan konsep dasar pemrograman menggunakan Python. Mereka juga akan menggunakan library dan API Python untuk membuat proyek GUI seperti Google Translator.',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'course_type_id' => 2,
            ],
            [
                'name' => 'Artificial Intelligence',
                'description' => 'Siswa akan mempelajari dasar Artificial Intelligence dan Machine Learning, mengeksplorasi Natural Language Processing, meningkatkan kemampuan Python, serta membuat chatbot berbasis AI menggunakan framework RASA.',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'course_type_id' => 2,
            ],
            [
                'name' => 'Website Development',
                'description' => 'Siswa akan belajar membuat website menggunakan HTML, CSS, JavaScript, dan Bootstrap, serta pengenalan PHP dan SQL untuk membuat website dinamis.',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'category' => 'Software Development',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Python: Arcade Games',
                'description' => 'Kelanjutan dari pembelajaran Python. Siswa akan menggunakan library arcade untuk membuat proyek mereka sendiri serta mengembangkan game yang lebih kompleks.',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'category' => 'Software Development',
                'course_type_id' => 2,
            ],
            [
                'name' => 'JavaScript',
                'description' => 'Siswa akan mempelajari dasar JavaScript seperti variabel, percabangan, dan perulangan, kemudian dilanjutkan dengan framework seperti NodeJS dan ExpressJS, serta integrasi database seperti MongoDB untuk membuat website dinamis.',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'category' => 'Software Development',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Unity 3D Game Development',
                'description' => '',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'category' => 'Software Development',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Cyber Security',
                'description' => '',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'category' => 'Tech Innovator',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Internet of Things (IoT)',
                'description' => 'Siswa akan diperkenalkan pada dunia IoT dengan membuat proyek yang mendukung kehidupan sehari-hari. Proyek akan menggunakan mikrokontroler Arduino dengan bahasa C/C++ serta API untuk mengontrol sensor melalui internet.',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'category' => 'Tech Innovator',
                'course_type_id' => 2,
            ],
            [
                'name' => 'Space Tech',
                'description' => '',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'category' => 'Tech Innovator',
                'course_type_id' => 2,
            ],
            // RoboNext
            [
                'name' => 'Robo Explorers',
                'description' => 'Siswa akan mengeksplorasi dasar mekanika dan pergerakan melalui permainan kreatif dan kegiatan membangun. Mereka akan mempelajari cara kerja roda, roda gigi, serta pola gerakan dalam membuat mesin sederhana.',
                'age_range' => '4-7',
                'duration_per_session' => 45,
                'course_type_id' => 3,
            ],
            [
                'name' => 'My First Smart Robot',
                'description' => 'Dalam modul ini, siswa akan berkenalan dengan robot pintar pertama mereka! Menggunakan WhalesBot AI Module 1s, siswa belajar memberikan instruksi sederhana, mengenali sensor seperti line-following, serta mengontrol robot melalui tantangan interaktif.',
                'age_range' => '4-7',
                'duration_per_session' => 45,
                'course_type_id' => 3,
            ],
            [
                'name' => 'Smart Moves with AI Bot',
                'description' => 'Siswa akan mempelajari dasar AI dan robotika cerdas menggunakan WhalesBot AI 5s. Mereka akan belajar tentang sensor, otomatisasi, dan block coding untuk memprogram perilaku robot seperti mengikuti garis, menghindari rintangan, dan mengenali perintah suara.',
                'age_range' => '8-12',
                'duration_per_session' => 60,
                'course_type_id' => 3,
            ],
            [
                'name' => 'Code Your Robo-Car',
                'description' => 'Siswa akan membangun dan memprogram mobil robot menggunakan Arduino dan block coding. Mereka akan mempelajari konsep dasar robotika seperti motor, roda, kontrol kecepatan, serta logika pergerakan melalui misi rekayasa yang menyenangkan.',
                'age_range' => '8-12',
                'duration_per_session' => 60,
                'course_type_id' => 3,
            ],
            [
                'name' => 'Drone Coding & Autonomous Flight',
                'description' => 'Siswa akan diperkenalkan pada robotika udara dan teknologi drone menggunakan AI Eagle Drone. Mereka akan menggunakan coding berbasis teks atau hybrid untuk mengontrol penerbangan, mengotomatisasi misi, serta mengintegrasikan sensor dalam skenario dunia nyata seperti pencarian dan pemantauan lingkungan.',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'course_type_id' => 3,
            ],
            [
                'name' => 'Arduino Smart Car',
                'description' => 'Siswa akan meningkatkan kemampuan robotika mereka dengan mempelajari pemrograman tekstual (C/C++) menggunakan Arduino. Mereka akan memahami integrasi hardware dan software, percabangan, perulangan, serta logika sensor untuk membangun sistem otomasi nyata.',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'course_type_id' => 3,
            ],
            [
                'name' => 'Connected World – Smart IoT Solutions',
                'description' => 'Siswa akan mempelajari konsep Internet of Things (IoT), di mana perangkat keras, perangkat lunak, dan internet saling terhubung. Mereka akan membuat sistem pintar menggunakan sensor, mikrokontroler, dan platform cloud yang dapat mengumpulkan data, merespons lingkungan, serta dikendalikan dari jarak jauh.',
                'age_range' => '12-16',
                'duration_per_session' => 90,
                'course_type_id' => 3,
            ],
        ];
        
        foreach ($modules as $module) {
            Module::updateOrCreate(
                ['name' => $module['name']],
                $module
            );
        }
    }
}



