<?php
namespace Database\Seeders;

use Faker\Factory;
use App\Models\Cpmi;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Lokasi;
use App\Models\Negara;
use App\Models\Jabatan;
use App\Models\Kategori;
use Illuminate\Support\Str;
use App\Models\MataPelajaran;
use App\Models\JadwalPelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('11221122'),
        ]);

        $positions = [
            ['nama' => 'DIREKTUR UTAMA', 'gaji_pokok' => 23800000.00, 'tunjangan' => 7000000.00, 'tunjangan_pajak' => 2380000.00],
            ['nama' => 'GENERAL MANAGER', 'gaji_pokok' => 8500000.00, 'tunjangan' => 2500000.00, 'tunjangan_pajak' => 850000.00],
            ['nama' => 'KA.DIV.TAIWAN', 'gaji_pokok' => 9500000.00, 'tunjangan' => 2850000.00, 'tunjangan_pajak' => 950000.00],
            ['nama' => 'KA.DIV. FINANCE', 'gaji_pokok' => 7000000.00, 'tunjangan' => 2100000.00, 'tunjangan_pajak' => 700000.00],
            ['nama' => 'KA.DIV. DOKUMEN', 'gaji_pokok' => 4000000.00, 'tunjangan' => 1000000.00, 'tunjangan_pajak' => 400000.00],
            ['nama' => 'STAFF. DOKUMEN', 'gaji_pokok' => 5175000.00, 'tunjangan' => 1300000.00, 'tunjangan_pajak' => 517500.00],
            ['nama' => 'STAFF. LEGES & PAP', 'gaji_pokok' => 5500000.00, 'tunjangan' => 1400000.00, 'tunjangan_pajak' => 550000.00],
            ['nama' => 'STAFF VISA', 'gaji_pokok' => 5200000.00, 'tunjangan' => 1250000.00, 'tunjangan_pajak' => 520000.00],
            ['nama' => 'CUSTOMER SERVICE OFFICER - CSO', 'gaji_pokok' => 3500000.00, 'tunjangan' => 850000.00, 'tunjangan_pajak' => 350000.00],
            ['nama' => 'STAFF. OPERASIONAL - DRIVER', 'gaji_pokok' => 6000000.00, 'tunjangan' => 1500000.00, 'tunjangan_pajak' => 600000.00],
            ['nama' => 'STAFF. ADMIN - CAB. LAMPUNG', 'gaji_pokok' => 3000000.00, 'tunjangan' => 700000.00, 'tunjangan_pajak' => 300000.00],
            ['nama' => 'STOCK KEEPER', 'gaji_pokok' => 3000000.00, 'tunjangan' => 600000.00, 'tunjangan_pajak' => 300000.00],
            ['nama' => 'STAFF. DOKUMEN - DOMINICA', 'gaji_pokok' => 3000000.00, 'tunjangan' => 600000.00, 'tunjangan_pajak' => 300000.00],
            ['nama' => 'STAFF. PENGAJAR', 'gaji_pokok' => 4000000.00, 'tunjangan' => 900000.00, 'tunjangan_pajak' => 400000.00],
            ['nama' => 'STAFF.DIGITAL MARKETING', 'gaji_pokok' => 4500000.00, 'tunjangan' => 1000000.00, 'tunjangan_pajak' => 450000.00],
            ['nama' => 'MARKETING SUPPORT', 'gaji_pokok' => 3500000.00, 'tunjangan' => 800000.00, 'tunjangan_pajak' => 350000.00],
            ['nama' => 'STAFF. AR - FINANCE', 'gaji_pokok' => 4000000.00, 'tunjangan' => 900000.00, 'tunjangan_pajak' => 400000.00],
        ];

        foreach ($positions as $position) {
            Jabatan::create($position);
        }

        $locations = [
            [
                'kode'               => 'PUSAT',
                'nama'               => 'KANTOR PUSAT',
                'latitude'           => -6.2088,
                'longitude'          => 106.8456,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Jl. Gatot Subroto No. 123, Jakarta Selatan',
                'telepon'            => '021-12345678',
            ],
            [
                'kode'               => 'INDRAMAYU',
                'nama'               => 'INDRAMAYU - PAK KISNO',
                'latitude'           => -6.2088,
                'longitude'          => 106.8456,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Jl. Gatot Subroto No. 123, Jakarta Selatan',
                'telepon'            => '0234-567890',
            ],
            [
                'kode'               => 'SUBANG',
                'nama'               => 'SUBANG - PAK ANDI',
                'latitude'           => -6.2088,
                'longitude'          => 106.8456,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Jl. Gatot Subroto No. 123, Jakarta Selatan',
                'telepon'            => '0260-789012',
            ],
            [
                'kode'               => 'CIREBON',
                'nama'               => 'CIREBON - PAK IBAH',
                'latitude'           => -6.7320,
                'longitude'          => 108.5523,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Cirebon, Jawa Barat',
                'telepon'            => '0231-456789',
            ],
            [
                'kode'               => 'LAMPUNG1',
                'nama'               => 'LAMPUNG 1 - DAVINA',
                'latitude'           => -5.4501,
                'longitude'          => 105.2678,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Bandar Lampung, Lampung',
                'telepon'            => '0721-888999',
            ],
            [
                'kode'               => 'LAMPUNG2',
                'nama'               => 'LAMPUNG 2 - PAK CARSA',
                'latitude'           => -5.4501,
                'longitude'          => 105.2678,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Bandar Lampung, Lampung',
                'telepon'            => '0721-123456',
            ],
            [
                'kode'               => 'LAMPUNG3',
                'nama'               => 'LAMPUNG 3 - BU FATIMAH',
                'latitude'           => -5.4501,
                'longitude'          => 105.2678,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Bandar Lampung, Lampung',
                'telepon'            => '0721-987654',
            ],
            [
                'kode'               => 'CILACAP',
                'nama'               => 'CILACAP - BU ASMI',
                'latitude'           => -7.7267,
                'longitude'          => 109.0090,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Cilacap, Jawa Tengah',
                'telepon'            => '0282-654321',
            ],
            [
                'kode'               => 'GROBOGAN',
                'nama'               => 'GROBOGAN - PAK ALI',
                'latitude'           => -7.0136,
                'longitude'          => 110.9158,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Grobogan, Jawa Tengah',
                'telepon'            => '0292-345678',
            ],
            [
                'kode'               => 'PONOROGO',
                'nama'               => 'PONOROGO - PAK PRAS',
                'latitude'           => -7.8719,
                'longitude'          => 111.4629,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Ponorogo, Jawa Timur',
                'telepon'            => '0352-777888',
            ],
            [
                'kode'               => 'BANYUWANGI',
                'nama'               => 'BANYUWANGI - PAK NURALIN',
                'latitude'           => -8.2191,
                'longitude'          => 114.3691,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Banyuwangi, Jawa Timur',
                'telepon'            => '0333-999000',
            ],
            [
                'kode'               => 'BLITAR',
                'nama'               => 'BLITAR - PAK MAJID',
                'latitude'           => -8.0983,
                'longitude'          => 112.1681,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Blitar, Jawa Timur',
                'telepon'            => '0342-111222',
            ],
            [
                'kode'               => 'SRAGEN',
                'nama'               => 'SRAGEN - PAK SUGIYANTO',
                'latitude'           => -7.4305,
                'longitude'          => 111.0184,
                'jam_masuk_mulai'    => '07:30:00',
                'jam_masuk_selesai'  => '08:30:00',
                'jam_keluar_mulai'   => '16:30:00',
                'jam_keluar_selesai' => '17:30:00',
                'radius'             => 100,
                'alamat'             => 'Sragen, Jawa Tengah',
                'telepon'            => '0271-333444',
            ],
        ];

        $mataPelajaran = [
            [
                'kode'      => 'MP-001',
                'nama'      => 'Pelatihan Bahasa',
                'deskripsi' => 'Memberikan keterampilan berbahasa yang dibutuhkan untuk berkomunikasi di negara tujuan.',
            ],
            [
                'kode'      => 'MP-002',
                'nama'      => 'Materi Sosial Budaya',
                'deskripsi' => 'Membantu CPMI memahami dan beradaptasi dengan norma, nilai, dan kebiasaan masyarakat di negara tujuan.',
            ],
            [
                'kode'      => 'MP-003',
                'nama'      => 'Wawasan Kebangsaan',
                'deskripsi' => 'Memperkuat pemahaman CPMI tentang identitas dan kebangsaan Indonesia.',
            ],
            [
                'kode'      => 'MP-004',
                'nama'      => 'Literasi Keuangan',
                'deskripsi' => 'Memberikan pengetahuan tentang pengelolaan keuangan pribadi dan investasi, termasuk cara mengirimkan uang ke keluarga di Indonesia.',
            ],
            [
                'kode'      => 'MP-005',
                'nama'      => 'Keimigrasian',
                'deskripsi' => 'Memberikan pemahaman tentang aturan keimigrasian di negara tujuan, hak dan kewajiban CPMI, serta prosedur yang harus diikuti.',
            ],
        ];

        $mataPelajaranIds = [];
        foreach ($mataPelajaran as $item) {
            $mata               = MataPelajaran::create($item);
            $mataPelajaranIds[] = $mata->id;
        }

        foreach ($locations as $location) {
            $location = Lokasi::create($location);
            $kelas    = Kelas::create([
                'lokasi_id' => $location->id,
                'nama'      => $location->nama,
            ]);

            $hariKerja = [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
            ];

            foreach ($hariKerja as $index => $hari) {
                JadwalPelajaran::create([
                    'kelas_id'          => $kelas->id,
                    'hari'              => $hari,
                    'libur'             => false,
                    'mata_pelajaran_id' => $mataPelajaranIds[$index] ?? null,
                ]);
            }

            $hariLibur = ['Sabtu', 'Minggu'];
            foreach ($hariLibur as $hari) {
                JadwalPelajaran::create([
                    'kelas_id' => $kelas->id,
                    'hari'     => $hari,
                    'libur'    => true,
                ]);
            }

            for ($i = 0; $i < 20; $i++) {
                $name     = $faker->name;
                $username = strtolower(str_replace(' ', '.', $name));
                $username = preg_replace('/[^a-z0-9.]/', '', $username); // hilangkan karakter aneh

                Cpmi::create([
                    'lokasi_id' => $location->id,
                    'kelas_id'  => $kelas->id,
                    'nama'      => $name,
                    'email'     => $username . $i . '@gmail.com', // bikin unik dan nyambung
                    'telepon'   => $faker->unique()->e164PhoneNumber,
                    'password'  => Hash::make('11221122'),
                    'alamat'    => $faker->address,
                    'status'    => $faker->randomElement(['Aktif', 'Tidak Aktif', 'Sudah Terbang']),
                ]);
            }

        }

        $direkturUtama         = Jabatan::where('nama', 'DIREKTUR UTAMA')->first();                 // 1
        $generalManager        = Jabatan::where('nama', 'GENERAL MANAGER')->first();                // 2
        $kaDivTaiwan           = Jabatan::where('nama', 'KA.DIV.TAIWAN')->first();                  // 3
        $kaDivFinance          = Jabatan::where('nama', 'KA.DIV. FINANCE')->first();                // 4
        $kaDivDokumen          = Jabatan::where('nama', 'KA.DIV. DOKUMEN')->first();                // 5
        $staffDokumen          = Jabatan::where('nama', 'STAFF. DOKUMEN')->first();                 // 6
        $staffLegaPap          = Jabatan::where('nama', 'STAFF. LEGES & PAP')->first();             // 7
        $staffVisa             = Jabatan::where('nama', 'STAFF VISA')->first();                     // 8
        $cso                   = Jabatan::where('nama', 'CUSTOMER SERVICE OFFICER - CSO')->first(); // 9
        $driver                = Jabatan::where('nama', 'STAFF. OPERASIONAL - DRIVER')->first();    // 10
        $staffAdminCabLampung  = Jabatan::where('nama', 'STAFF. ADMIN - CAB. LAMPUNG')->first();    // 11
        $stockKeeper           = Jabatan::where('nama', 'STOCK KEEPER')->first();                   // 12
        $staffDokumenDominica  = Jabatan::where('nama', 'STAFF. DOKUMEN - DOMINICA')->first();      // 13
        $staffPengajar         = Jabatan::where('nama', 'STAFF. PENGAJAR')->first();                // 14
        $staffDigitalMarketing = Jabatan::where('nama', 'STAFF.DIGITAL MARKETING')->first();        // 15
        $marketingSupport      = Jabatan::where('nama', 'MARKETING SUPPORT')->first();              // 16
        $staffArFinance        = Jabatan::where('nama', 'STAFF. AR - FINANCE')->first();            // 17
        $listKelas             = Kelas::all();

        $employees = [
            [
                'name'            => 'ARIEF SURYOPRANOTO', // Direktur Utama (1)
                'jabatan_id'      => $direkturUtama->id,
                'alamat'          => 'JL. RAYA KODAU NO. 42 RT.005 RW 007 KEL. JATIMEKAR KEC. JATIASIH',
                'nomor_identitas' => '3275091709750015',
                'email'           => 'k2kk89@yahoo.com',
                'telepon'         => '+628129074585',
                'password'        => bcrypt('11221122'),
                'ptkp_status'     => 'K/1',
                'karyawan'        => true,
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'DADAN', // General Manager (2)
                'jabatan_id'      => $generalManager->id,
                'alamat'          => 'KP CICADAS - NO.-',
                'nomor_identitas' => '3203141011920000',
                'email'           => 'dadanemk2kk@gmail.com',
                'telepon'         => '+6281282115117',
                'password'        => bcrypt('11221122'),
                'ptkp_status'     => 'K/2',
                'karyawan'        => true,
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'BETTY', // Ka.Div.Taiwan (3)
                'jabatan_id'      => $kaDivTaiwan->id,
                'alamat'          => 'LINK. VIII DHARMA PSR.2 NO. 39',
                'nomor_identitas' => '1205074301890004',
                'email'           => 'dbest.bet89@gmail.com',
                'telepon'         => '+6281219920069',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'DEWI KOMALASARI', // Ka.Div.Finance (4)
                'jabatan_id'      => $kaDivFinance->id,
                'alamat'          => 'KOTA SERANG BARU BLOK F21 NO. 26',
                'nomor_identitas' => '3216065406880008',
                'email'           => 'dewiprince88@gmail.com',
                'telepon'         => '+6281218847089',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'K/3',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'AMANDA MARSELA PUTRI', // Ka.Div.Dokumen (5)
                'jabatan_id'      => $kaDivDokumen->id,
                'alamat'          => 'KP. PD RANGGON NO.9 JATIRANGGON JATISAMPURNA',
                'nomor_identitas' => '3275105110020010',
                'email'           => 'amandaptr111002@gmail.com',
                'telepon'         => '+6281806333829',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'HELENTINA MANUNGKALIT', // Staff Dokumen (6)
                'jabatan_id'      => $staffDokumen->id,
                'alamat'          => 'PERUM GRIYA BEKASI PERMAI',
                'nomor_identitas' => '82.486.800.4-413.000',
                'email'           => 'maragantim171158@gmail.com',
                'telepon'         => '+6281388507758',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'BAGUS RANO ANWAR', // Staff Leges & PAP (7)
                'jabatan_id'      => $staffLegaPap->id,
                'alamat'          => 'BALONG REJO BUMI MAS BATANGHARI',
                'nomor_identitas' => '1807061009920005',
                'email'           => 'bagusranoanwar@gmail.com',
                'telepon'         => '+6285840751796',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'K/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'GEDE WINARTANA', // Staff Visa (8)
                'jabatan_id'      => $staffVisa->id,
                'alamat'          => 'BANJAR DINAS TAMBLINGAN RT000 RW 000 KEL. MUNDUK. KEC. BANJAR',
                'nomor_identitas' => '5108041103970003',
                'email'           => 'winartana97@gmail.com',
                'telepon'         => '+6287820644551',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'LIS TYANINGRUM', // CSO (9)
                'jabatan_id'      => $cso->id,
                'alamat'          => 'KP. PONDOK RANGGON JATIRANGGON JATISAMPURNA',
                'nomor_identitas' => '3275104707020012',
                'email'           => 'listyaningrum.0707@gmail.com',
                'telepon'         => '+6285733398086',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'IMAM SETIAWAN', // Driver (10)
                'jabatan_id'      => $driver->id,
                'alamat'          => 'DUSUN BLENDER PURWOJATI PURWOJATI',
                'nomor_identitas' => '3302131109920002',
                'email'           => 'imamsetiawan184@gmail.com',
                'telepon'         => '+6281293806890',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'K/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'DEFA DEFINA WATI', // Staff Admin Cab.Lampung (11)
                'jabatan_id'      => $staffAdminCabLampung->id,
                'alamat'          => 'SUKADANA BARU RT.011 RW.003 KEL. SUKADANA BARU KEC. MARGA TIGA',
                'nomor_identitas' => '1807114912040003',
                'email'           => 'defadefinaw@gmail.com',
                'telepon'         => '+6285783808316',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'MUNZILA PERTIWI', // Stock Keeper (12)
                'jabatan_id'      => $stockKeeper->id,
                'alamat'          => 'DUSUN BLENDER RT.002 RW 004 PURWOJATI',
                'nomor_identitas' => '6104246608940001',
                'email'           => 'virgoceria94@gmail.com',
                'telepon'         => '+6281549477664',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'FEBRIYANTI CLAUDIA HARAHAP', // Staff Dokumen Dominica (13)
                'jabatan_id'      => $staffDokumenDominica->id,
                'alamat'          => 'JL. PASAR KECAPI RT.004 RW 003 KEL. HATIWARNA KEC. PONDOKMELATI',
                'nomor_identitas' => '3275124902050005',
                'email'           => 'febriyanticlaudia7@gmail.com',
                'telepon'         => '+6283890378637',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'SITI RONDHIYAH', // Staff Pengajar (14)
                'jabatan_id'      => $staffPengajar->id,
                'alamat'          => 'DESA PURWOKERTO RT.001 RW.004 KEL. PURWOKERTO KEC. PATEBON',
                'nomor_identitas' => '3324144406870001',
                'email'           => 'user@mybahana.com',
                'telepon'         => '+6285210296532',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'ENDANG MIRININGSIH', // Staff Digital Marketing (15)
                'jabatan_id'      => $staffDigitalMarketing->id,
                'alamat'          => 'DESA PURWOKERTO RT.001 RW.004 KEL. PURWOKERTO KEC. PATEBON',
                'nomor_identitas' => '3324144406870002',
                'email'           => 'endangmiriningsih@gmail.com',
                'telepon'         => '+6285210296533',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'GINA TRIE ANAYA', // Marketing Support (16)
                'jabatan_id'      => $marketingSupport->id,
                'alamat'          => 'JATIMAKMUR RT.005 RW. 008 KEL. JATIMAKMUR KEC. PONDOKGEDE',
                'nomor_identitas' => '3275084408060005',
                'email'           => 'anayaaa486@gmail.com',
                'telepon'         => '+6285159259553',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
            [
                'name'            => 'AUDINA NURPADILLAH', // Staff AR Finance (17)
                'jabatan_id'      => $staffArFinance->id,
                'alamat'          => 'JL. AMIL I RT. 001 RW 008 KEL. JATIWARINGIN KEC. PONDOK GEDE',
                'nomor_identitas' => '3275084103050011',
                'email'           => 'audinanur0195@gmail.com',
                'telepon'         => '+6289512569857',
                'password'        => bcrypt('11221122'),
                'karyawan'        => true,
                'ptkp_status'     => 'TK/0',
                'lokasi_id'       => Lokasi::where('kode', 'PUSAT')->first()->id,
            ],
        ];

        foreach ($employees as $employee) {
            User::create($employee);
        }

        foreach ($listKelas as $kelas) {
            $pengajars = [];

            for ($i = 0; $i < 5; $i++) {
                $name     = $faker->name;
                $username = strtolower(str_replace(' ', '.', $name));
                $username = preg_replace('/[^a-z0-9.]/', '', $username); // Bersihkan karakter aneh

                $pengajars[] = User::create([
                    'name'            => $name,
                    'jabatan_id'      => $staffPengajar->id,
                    'alamat'          => $faker->address,
                    'nomor_identitas' => Str::random(16),                 // atau pakai $faker->uuid jika nik tidak tersedia
                    'email'           => $username . $i . '@gmail.com', // Tambahkan index agar tetap unik
                    'telepon'         => $faker->unique()->e164PhoneNumber,
                    'password'        => bcrypt('11221122'),
                    'ptkp_status'     => 'TK/0',
                    'karyawan'        => true,
                    'lokasi_id'       => $kelas->lokasi_id,
                ]);
            }

            $jadwalPelajaran = JadwalPelajaran::where('kelas_id', $kelas->id)
                ->whereIn('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'])
                ->get();

            foreach ($jadwalPelajaran as $index => $jadwal) {
                $pengajar = $pengajars[$index % count($pengajars)];
                $jadwal->update(['pengajar_id' => $pengajar->id]);
            }
        }
        Kategori::create([
            'nama' => 'Formal',
        ]);

        Kategori::create([
            'nama' => 'Informal',
        ]);

        $countries = [
            [
                'kode'             => 'TWN',
                'nama'             => 'Taiwan',
                'mata_uang'        => 'New Taiwan Dollar',
                'kode_mata_uang'   => 'TWD',
                'simbol_mata_uang' => 'NT$',
            ],
            [
                'kode'             => 'DMA',
                'nama'             => 'Dominika',
                'mata_uang'        => 'East Caribbean Dollar',
                'kode_mata_uang'   => 'XCD',
                'simbol_mata_uang' => 'EC$',
            ],
        ];

        foreach ($countries as $country) {
            Negara::create($country);
        }
    }
}
