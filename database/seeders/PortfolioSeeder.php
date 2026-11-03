<?php

namespace Database\Seeders;

use CoreConstants;
use App\Services\Contracts\AboutInterface;
use App\Services\Contracts\EducationInterface;
use App\Services\Contracts\ExperienceInterface;
use App\Services\Contracts\MessageInterface;
use App\Services\Contracts\PortfolioConfigInterface;
use App\Services\Contracts\ProjectInterface;
use App\Services\Contracts\ServiceInterface;
use App\Services\Contracts\SkillInterface;
use App\Services\Contracts\VisitorInterface;
use Config;
use Illuminate\Database\Seeder;
use Log;
use Str;
use Faker\Factory as Faker;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $faker = Faker::create('id_ID');

            $portfolioConfig = resolve(PortfolioConfigInterface::class);
            $about = resolve(AboutInterface::class);
            $education = resolve(EducationInterface::class);
            $skill = resolve(SkillInterface::class);
            $experience = resolve(ExperienceInterface::class);
            $project = resolve(ProjectInterface::class);
            $service = resolve(ServiceInterface::class);
            $visitor = resolve(VisitorInterface::class);
            $message = resolve(MessageInterface::class);

            //portfolio config table seed

            //template
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__TEMPLATE,
                'setting_value' => 'procyon',
                'default_value' => 'procyon',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //accent color
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__ACCENT_COLOR,
                'setting_value' => '#1890ff',
                'default_value' => '#1890ff',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //google analytics ID
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__GOOGLE_ANALYTICS_ID,
                'setting_value' => Config::get('custom.demo_mode') ? 'G-PS8JF33VLD' : '',
                'default_value' => Config::get('custom.demo_mode') ? 'G-PS8JF33VLD' : '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //maintenance mode
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__MAINTENANCE_MODE,
                'setting_value' => CoreConstants::FALSE,
                'default_value' => CoreConstants::FALSE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            //visibility
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_ABOUT,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_SKILL,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_EDUCATION,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_EXPERIENCE,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_PROJECT,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_SERVICE,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_CONTACT,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_FOOTER,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_CV,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__VISIBILITY_SKILL_PROFICIENCY,
                'setting_value' => CoreConstants::TRUE,
                'default_value' => CoreConstants::TRUE,
            ];
            $portfolioConfig->insertOrUpdate($data);

            //header script
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__SCRIPT_HEADER,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //footer script
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__SCRIPT_FOOTER,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta title
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_TITLE,
                'setting_value' => 'SIMPOR - Sistem Informasi Manajemen Portofolio',
                'default_value' => 'SIMPOR - Sistem Informasi Manajemen Portofolio',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta author
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_AUTHOR,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta description
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_DESCRIPTION,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);

            //meta image
            try {
                if (is_dir('public/assets/common/img/meta-image')) {
                    $dir = 'public/assets/common/img/meta-image';
                } else {
                    $dir = 'assets/common/img/meta-image';
                }
                $leave_files = array('.gitkeep');
                
                foreach (glob("$dir/*") as $file) {
                    if (!in_array(basename($file), $leave_files)) {
                        unlink($file);
                    }
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
            $data = [
                'setting_key' => CoreConstants::PORTFOLIO_CONFIG__META_IMAGE,
                'setting_value' => '',
                'default_value' => '',
            ];
            $portfolioConfig->insertOrUpdate($data);


            //about table seed
            try {
                try {
                    //avatar
                    if (is_dir('public/assets/common/img/avatar')) {
                        $dir = 'public/assets/common/img/avatar';
                    } else {
                        $dir = 'assets/common/img/avatar';
                    }
                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }

                    if (is_dir('public/assets/common/img/avatar')) {
                        copy('public/assets/common/default/avatar/default.png', $dir.'/default.png');
                    } else {
                        copy('assets/common/default/avatar/default.png', $dir.'/default.png');
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }

                try {
                    //cover
                    if (is_dir('public/assets/common/img/cover')) {
                        $dir = 'public/assets/common/img/cover';
                    } else {
                        $dir = 'assets/common/img/cover';
                    }
                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }

                    if (is_dir('public/assets/common/img/cover')) {
                        copy('public/assets/common/default/cover/default.png', $dir.'/default.png');
                    } else {
                        copy('assets/common/default/cover/default.png', $dir.'/default.png');
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }

                try {
                    //cv
                    if (is_dir('public/assets/common/cv')) {
                        $dir = 'public/assets/common/cv';
                    } else {
                        $dir = 'assets/common/cv';
                    }

                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }
                    if (is_dir('public/assets/common/default/cv/')) {
                        copy('public/assets/common/default/cv/default.pdf', $dir.'/default.pdf');
                    } else {
                        copy('assets/common/default/cv/default.pdf', $dir.'/default.pdf');
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }
                
                $data = [
                    'name' => 'Rendy 28',
                    'email' => 'admin@admin.com',
                    'avatar' => 'assets/common/img/avatar/default.png',
                    'cover' => 'assets/common/img/cover/default.png',
                    'phone' => '081234567890',
                    'address' => 'Jl. Jenderal Sudirman No. 45, Jakarta Pusat, DKI Jakarta',
                    'description' => 'Halo! Saya seorang Software Engineer yang berfokus pada pengembangan aplikasi web modern, cepat, dan handal. Memiliki pengalaman dalam merancang sistem backend dan frontend dengan teknologi terkini.',
                    'taglines' => ["Saya Software Engineer", "Saya Web Developer", "Saya Full Stack Developer"],
                    'social_links' => [
                        [
                            'title' => 'LinkedIn',
                            'iconClass' => 'fab fa-linkedin-in',
                            'link' => 'https://www.linkedin.com'
                        ],
                        [
                            'title' => 'Github',
                            'iconClass' => 'fab fa-github',
                            'link' => 'https://github.com/28Rendy'
                        ],
                        [
                            'title' => 'Twitter',
                            'iconClass' => 'fab fa-twitter',
                            'link' => 'https://twitter.com'
                        ],
                        [
                            'title' => 'Mail',
                            'iconClass' => 'far fa-envelope',
                            'link' => 'mailto:admin@admin.com'
                        ],
                    ],
                    'seederCV' => 'assets/common/cv/default.pdf',
                ];
                $about->store($data);

                //education table seed
                try {
                    $data = [
                        'institution' => 'Institut Teknologi Bandung',
                        'period' => '2006-2010',
                        'degree' => 'Sarjana Komputer (S.Kom)',
                        'cgpa' => 'IPK 3.85 / 4.00',
                        'department' => 'Teknik Informatika',
                        'thesis' => 'Peminatan Rekayasa Perangkat Lunak'
                    ];
                    $education->store($data);

                    $data = [
                        'institution' => 'SMA Negeri 1',
                        'period' => '2002-2006',
                        'degree' => 'Jurusan IPA',
                        'cgpa' => 'Nilai Rata-rata 88.5',
                        'department' => null,
                        'thesis' => null
                    ];
                    $education->store($data);
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            //skill table seed
            try {
                $data = [
                    'name' => 'Laravel',
                    'proficiency' => '100'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'PHP',
                    'proficiency' => '100'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'JavaScript',
                    'proficiency' => '95'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'React.js',
                    'proficiency' => '95'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'Vue.js',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'jQuery',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'MySQL',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'CSS',
                    'proficiency' => '90'
                ];
                $skill->store($data);

                $data = [
                    'name' => 'Node.js',
                    'proficiency' => '80'
                ];
                $skill->store($data);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            //experience table seed
            try {
                $data = [
                    'company' => 'PT Solusi Digital Nusantara',
                    'period' => '2020 - Sekarang',
                    'position' => 'Senior Software Engineer',
                    'details' => 'Memimpin tim pengembang dalam merancang dan mengimplementasikan arsitektur aplikasi berbasis web skala besar, mengoptimalkan performa sistem, serta mengawasi standar penulisan kode dan alur deployment.'
                ];
                $experience->store($data);

                $data = [
                    'company' => 'PT Solusi Digital Nusantara',
                    'period' => '2017-2019',
                    'position' => 'Software Engineer',
                    'details' => 'Mengembangkan modul dan fitur baru pada aplikasi web perusahaan menggunakan Laravel dan Vue.js, mengoptimalkan kueri database, serta mengintegrasikan RESTful API pihak ketiga.'
                ];
                $experience->store($data);

                $data = [
                    'company' => 'PT Inovasi Teknologi Bangsa',
                    'period' => '2015-2017',
                    'position' => 'Junior Software Engineer',
                    'details' => 'Membantu pengembangan modul frontend dan backend, memperbaiki bug aplikasi, menulis pengujian unit, serta berkolaborasi erat dengan tim desainer UI/UX.'
                ];
                $experience->store($data);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            //project table seed
            try {
                try {
                    //images
                    if (is_dir('public/assets/common/img/projects')) {
                        $dir = 'public/assets/common/img/projects';
                    } else {
                        $dir = 'assets/common/img/projects';
                    }
                    
                    $leave_files = array('.gitkeep');
                    
                    foreach (glob("$dir/*") as $file) {
                        if (!in_array(basename($file), $leave_files)) {
                            unlink($file);
                        }
                    }
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }

                $data = [
                    'title' => 'Sistem Manajemen Portofolio',
                    'categories' => ['pribadi'],
                    'link' => 'https://www.youtube.com',
                    'details' => 'Platform pengelolaan portofolio digital interaktif yang dilengkapi fitur analisis statistik pengunjung, manajemen proyek, kustomisasi tema, dan penerimaan pesan kontak secara langsung.',
                    'seeder_thumbnail' => 'assets/common/img/projects/demo_project_1_1.png',
                    'seeder_images' => [
                        'assets/common/img/projects/demo_project_1_1.png',
                        'assets/common/img/projects/demo_project_1_2.png'
                    ]
                ];
                if (is_dir('public/assets/common/default/projects')) {
                    copy('public/assets/common/default/projects/demo_project_1_1.png', $dir.'/demo_project_1_1.png');
                    copy('public/assets/common/default/projects/demo_project_1_2.png', $dir.'/demo_project_1_2.png');
                } else {
                    copy('assets/common/default/projects/demo_project_1_1.png', $dir.'/demo_project_1_1.png');
                    copy('assets/common/default/projects/demo_project_1_2.png', $dir.'/demo_project_1_2.png');
                }
                
                $project->store($data);

                $data = [
                    'title' => 'Aplikasi E-Commerce Terpadu',
                    'categories' => ['profesional'],
                    'link' => 'https://www.facebook.com',
                    'details' => 'Aplikasi perdagangan elektronik lengkap dengan integrasi gateway pembayaran, manajemen inventaris produk, pelacakan pengiriman barang, dan panel administrasi yang mudah digunakan.',
                    'seeder_thumbnail' => 'assets/common/img/projects/demo_project_2_1.png',
                    'seeder_images' => [
                        'assets/common/img/projects/demo_project_2_1.png',
                        'assets/common/img/projects/demo_project_2_2.png'
                    ]
                ];

                if (is_dir('public/assets/common/default/projects')) {
                    copy('public/assets/common/default/projects/demo_project_2_1.png', $dir.'/demo_project_2_1.png');
                    copy('public/assets/common/default/projects/demo_project_2_2.png', $dir.'/demo_project_2_2.png');
                } else {
                    copy('assets/common/default/projects/demo_project_2_1.png', $dir.'/demo_project_2_1.png');
                    copy('assets/common/default/projects/demo_project_2_2.png', $dir.'/demo_project_2_2.png');
                }

                $project->store($data);

                $data = [
                    'title' => 'Dashboard Analisis Data',
                    'categories' => ['pribadi'],
                    'link' => 'https://www.linkedin.com',
                    'details' => 'Aplikasi dashboard analitik modern untuk visualisasi data bisnis, pemantauan metrik kinerja secara real-time, dan ekspor laporan otomatis.',
                    'seeder_thumbnail' => 'assets/common/img/projects/demo_project_3_1.png',
                    'seeder_images' => [
                        'assets/common/img/projects/demo_project_3_1.png',
                        'assets/common/img/projects/demo_project_3_2.png'
                    ]
                ];
                
                if (is_dir('public/assets/common/default/projects')) {
                    copy('public/assets/common/default/projects/demo_project_3_1.png', $dir.'/demo_project_3_1.png');
                    copy('public/assets/common/default/projects/demo_project_3_2.png', $dir.'/demo_project_3_2.png');
                } else {
                    copy('assets/common/default/projects/demo_project_3_1.png', $dir.'/demo_project_3_1.png');
                    copy('assets/common/default/projects/demo_project_3_2.png', $dir.'/demo_project_3_2.png');
                }
                
                $project->store($data);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            //service table seed
            try {
                $data = [
                    'title' => 'Pengembangan Web',
                    'icon' => 'fas fa-code',
                    'details' => 'Membangun aplikasi web kustom yang responsif, cepat, dan aman menggunakan teknologi web modern sesuai kebutuhan Anda.'
                ];
                $service->store($data);

                $data = [
                    'title' => 'Desain UI/UX',
                    'icon' => 'fas fa-basketball-ball',
                    'details' => 'Merancang antarmuka dan pengalaman pengguna yang modern, intuitif, dan menarik demi kenyamanan interaksi pengguna.'
                ];
                $service->store($data);

                $data = [
                    'title' => 'Keamanan & Optimasi',
                    'icon' => 'fas fa-shield-alt',
                    'details' => 'Meningkatkan kecepatan loading website serta memperkuat keamanan aplikasi dari celah kerentanan dan ancaman siber.'
                ];
                $service->store($data);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            try {
                //visitor table seed
                foreach (range(1, 72) as $index) {
                    $data = [
                        'tracking_id' => Str::random(30),
                        'is_new' => $faker->boolean(60),
                        'ip' => $faker->ipv4,
                        'is_desktop' => $faker->boolean(70),
                        'browser' => $faker->randomElement(['Chrome', 'Firefox', 'Safari', 'Opera', 'Edge']),
                        'platform' => $faker->randomElement(['Windows', 'OS X', 'AndroidOS', 'iOS']),
                        'location' => $faker->randomElement(['Indonesia', 'Malaysia', 'Singapura', 'Jepang', 'Australia', 'Amerika Serikat', 'Jerman', 'Belanda', 'Korea Selatan']),
                        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                    ];
                    $visitor->forceStore($data);
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            try {
                //message table seed
                $subjects = [
                    'Tawaran Kerja Sama Proyek Pembuatan Website',
                    'Pertanyaan Mengenai Jasa Pengembangan Aplikasi',
                    'Undangan Menjadi Pembicara Seminar Teknologi',
                    'Konsultasi Pengembangan Sistem Informasi Perusahaan',
                    'Peluang Kolaborasi Remote Software Engineer',
                    'Permintaan Penawaran Harga Pembuatan Aplikasi Web',
                    'Tanya Jawab Seputar Layanan Desain UI/UX',
                    'Konsultasi Optimasi dan Keamanan Sistem Web',
                    'Diskusi Proyek Aplikasi E-Commerce',
                    'Pertanyaan Terkait Portofolio dan Pengalaman Kerja',
                ];

                $bodies = [
                    'Halo, saya melihat portofolio Anda dan sangat tertarik dengan hasil karya yang Anda buat. Apakah saat ini Anda bersedia menerima proyek pembuatan website baru?',
                    'Selamat siang, kami dari tim pengembangan startup ingin mengajak Anda berdiskusi terkait arsitektur sistem web kami.',
                    'Halo, kami sangat terkesan dengan rekam jejak Anda. Apakah Anda tertarik untuk membahas peluang karier sebagai Senior Developer bersama tim kami?',
                    'Selamat pagi, perusahaan kami berencana merombak sistem informasi internal. Bisakah kami mendapatkan estimasi waktu dan biaya untuk pengerjaan proyek tersebut?',
                    'Halo, saya ingin berkonsultasi mengenai kebutuhan audit keamanan dan peningkatan kecepatan akses pada platform toko online kami.',
                    'Selamat sore, kami membutuhkan jasa pembuatan tampilan antarmuka (UI/UX) untuk aplikasi web kami. Apakah Anda dapat mengirimkan penawaran harga?',
                    'Halo, salam kenal! Apakah Anda memiliki waktu luang minggu ini untuk mengadakan diskusi daring singkat mengenai kerja sama proyek baru?',
                    'Selamat siang, kami ingin mendiskusikan integrasi sistem pembayaran otomatis untuk website klien kami. Mohon informasi lebih lanjut.',
                ];

                foreach (range(1, 17) as $index) {
                    $data = [
                        'name' => $faker->name(),
                        'email' => $faker->email,
                        'subject' => $faker->randomElement($subjects),
                        'body' => $faker->randomElement($bodies),
                        'replied' => $faker->boolean(60),
                        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                    ];
                    $message->store($data);
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}
