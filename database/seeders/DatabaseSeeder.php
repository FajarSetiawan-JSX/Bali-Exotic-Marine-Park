<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Division;
use App\Models\DivisionPosition;
use App\Models\Level;
use App\Models\Methode;
use App\Models\Position;
use App\Models\Priority;
use App\Models\Question;
use App\Models\Section;
use App\Models\SessionWork;
use App\Models\Supplier;
use App\Models\Templete;
use App\Models\TypeSchedule;
use App\Models\Unit;
use App\Models\User;
use App\Models\WorkTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sectionNames = [
            'Area & Building Safety',
            'Security & Access Control',
            'Equipment & Facility Check',
            'Property & Asset Control',
            'People & Activities',
            'Incident / Problem Report',
            'Nothing to Report Confirmation',
        ];

        $sections = [];

        foreach ($sectionNames as $name) {
            $sections[$name] = Section::updateOrCreate(
                ['name' => $name],
                ['name' => $name]
            );
        }


        /*
|--------------------------------------------------------------------------
| QUESTIONS
|--------------------------------------------------------------------------
*/

        $sectionQuestions = [

            /*
    |--------------------------------------------------------------------------
    | 1. AREA & BUILDING SAFETY
    |--------------------------------------------------------------------------
    */

            'Area & Building Safety' => [

                [
                    'question' => 'Area masuk dan keluar dalam kondisi bebas dari hambatan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Pintu tertutup dan terkunci dengan baik sesuai kebutuhan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Pintu darurat dapat diakses',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Jalur evakuasi bebas dari hambatan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tangga dan koridor dalam kondisi bebas dari hambatan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat bau, asap, panas, atau suara yang tidak biasa',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat kebocoran air atau banjir',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat pecahan kaca atau benda berbahaya',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Lantai aman dan tidak terlalu basah atau licin',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Penerangan berfungsi dengan baik',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat kerusakan struktur atau kondisi yang tidak biasa',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Area terbatas diamankan dengan baik',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat orang yang tidak berwenang di area terbatas',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah ditemukan kondisi yang dapat menimbulkan risiko keselamatan bagi karyawan, pengunjung, tamu, atau properti?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],
            ],


            /*
    |--------------------------------------------------------------------------
    | 2. SECURITY & ACCESS CONTROL
    |--------------------------------------------------------------------------
    */

            'Security & Access Control' => [

                [
                    'question' => 'Pintu masuk utama dalam kondisi aman',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Pintu masuk sekunder dalam kondisi aman',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Pintu darurat terkunci tetapi tetap dapat digunakan saat keadaan darurat',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Gerbang berfungsi dengan baik',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Sistem kontrol akses berfungsi dengan baik',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Akses kartu atau kunci berfungsi dengan baik',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat orang yang mencurigakan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat orang yang tidak berwenang',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Aktivitas pengunjung terlihat normal',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat tas atau paket yang ditinggalkan tanpa pengawasan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat kendaraan yang mencurigakan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Area parkir dalam kondisi aman',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Perimeter atau pagar dalam kondisi aman',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat tanda-tanda pembobolan atau akses paksa',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah ditemukan pintu atau gerbang yang tidak terkunci secara tidak semestinya?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah ditemukan kartu akses atau kunci yang ditinggalkan tanpa pengawasan?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah ditemukan seseorang di area yang tidak berwenang untuk diakses?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah ditemukan aktivitas yang mencurigakan?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah ditemukan kendaraan atau orang yang tidak biasa?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],
            ],


            /*
    |--------------------------------------------------------------------------
    | 3. EQUIPMENT & FACILITY CHECK
    |--------------------------------------------------------------------------
    */

            'Equipment & Facility Check' => [

                // Peralatan Pemadam & Darurat

                [
                    'question' => 'Alat pemadam api tersedia',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Alat pemadam api dapat diakses dengan mudah',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Segel atau pin alat pemadam api masih utuh',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Panel alarm kebakaran dalam kondisi normal',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Lampu darurat berfungsi',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tanda jalur keluar darurat berfungsi',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Selang atau hydrant kebakaran dapat diakses',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Area sprinkler tidak terhalang',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Peralatan darurat tidak mengalami kerusakan yang terlihat',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                // Listrik / Mekanik

                [
                    'question' => 'Panel listrik dalam kondisi aman',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat kabel listrik yang terbuka',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat bau terbakar',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat suara yang tidak biasa dari peralatan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat kondisi peralatan yang terlalu panas',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Generator atau sistem cadangan terlihat normal',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Pompa atau peralatan lainnya terlihat normal',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat kebocoran air yang tidak normal',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat getaran atau suara yang tidak normal',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                // CCTV & Sistem Keamanan

                [
                    'question' => 'Kamera CCTV terlihat berfungsi',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat kerusakan fisik pada kamera',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat kamera yang terhalang',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Sistem perekaman terlihat normal',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Sistem kontrol akses berfungsi',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Sistem alarm menunjukkan status normal',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Radio atau komunikasi keamanan berfungsi',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                // Peralatan Kritis

                [
                    'question' => 'ID Peralatan',
                    'type' => 'Text',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Lokasi Peralatan',
                    'type' => 'Text',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Kondisi Peralatan',
                    'type' => 'Text',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Kelainan atau kondisi tidak normal yang ditemukan',
                    'type' => 'Text',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],
            ],


            /*
    |--------------------------------------------------------------------------
    | 4. PROPERTY & ASSET CONTROL
    |--------------------------------------------------------------------------
    */

            'Property & Asset Control' => [

                [
                    'question' => 'Peralatan perusahaan berada di lokasi yang telah ditentukan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak ditemukan peralatan yang hilang',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Area penyimpanan dalam kondisi aman',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Peralatan dan perlengkapan disimpan dengan baik',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat properti perusahaan yang rusak',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat pengambilan properti tanpa izin',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Barang atau material yang datang disimpan dengan baik',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Area penyimpanan peralatan berharga dalam kondisi aman',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah ditemukan barang yang terlihat hilang?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah ditemukan peralatan di lokasi yang tidak semestinya?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah ditemukan properti yang rusak?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah ditemukan seseorang memindahkan properti perusahaan?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah ditemukan properti yang ditinggalkan tanpa pengawasan?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],
            ],


            /*
    |--------------------------------------------------------------------------
    | 5. PEOPLE & ACTIVITIES
    |--------------------------------------------------------------------------
    */

            'People & Activities' => [

                [
                    'question' => 'Karyawan dan pengunjung berperilaku normal',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat kerumunan yang tidak berwenang',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat perilaku mencurigakan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat konflik atau perkelahian',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat orang yang membutuhkan bantuan',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Tidak terdapat aktivitas atau pekerjaan yang tidak berwenang',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Kontraktor memiliki izin',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Area kerja kontraktor dalam kondisi aman',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda menemukan seseorang yang membutuhkan bantuan?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah ada seseorang yang menolak mengikuti prosedur keamanan?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah Anda melihat perilaku yang mencurigakan?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah Anda menemukan aktivitas yang tidak berwenang?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],

                [
                    'question' => 'Apakah Anda menerima keluhan atau laporan dari karyawan atau pengunjung?',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => true,
                ],
            ],


            /*
    |--------------------------------------------------------------------------
    | 6. INCIDENT / PROBLEM REPORT
    |--------------------------------------------------------------------------
    */

            'Incident / Problem Report' => [

                // A. Apa yang terjadi?

                [
                    'question' => 'Jenis insiden',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],

                [
                    'question' => 'Tanggal kejadian',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],

                [
                    'question' => 'Waktu kejadian ditemukan',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],

                [
                    'question' => 'Lokasi kejadian',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],

                [
                    'question' => 'Area atau zona kejadian',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apa yang sebenarnya terjadi?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],

                [
                    'question' => 'Bagaimana masalah tersebut ditemukan?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah masalah tersebut sudah ada ketika patroli dimulai?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda menyaksikan kejadian tersebut secara langsung?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],

                [
                    'question' => 'Jika tidak, siapa yang melaporkan kejadian tersebut?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'A',
                    'trigger' => false,
                ],


                // B. Orang yang terlibat

                [
                    'question' => 'Apakah ada orang yang terlibat?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'Nama orang yang terlibat, jika diketahui',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'Status: Karyawan / Pengunjung / Kontraktor / Tidak Diketahui',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'ID atau perusahaan, jika diperlukan',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'Informasi kontak, jika diperlukan',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'Jumlah orang yang terlibat',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah ada orang yang terluka?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah ada orang yang meninggalkan lokasi?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'Arah kepergian',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah ada kendaraan yang terlibat?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],

                [
                    'question' => 'Nomor polisi kendaraan, jika diketahui',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'B',
                    'trigger' => false,
                ],


                // C. Pengamatan detail

                [
                    'question' => 'Apa yang Anda lihat, dengar, cium, atau perhatikan?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Bagaimana kondisi area?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Bagaimana kondisi peralatan atau properti?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah terdapat tanda-tanda pembobolan atau akses paksa?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah terdapat tanda-tanda kerusakan?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah terdapat suara yang tidak biasa?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah terdapat bau yang tidak biasa?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah ada alarm yang aktif?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah terdapat saksi?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah CCTV tersedia?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],

                [
                    'question' => 'Kamera CCTV mana yang kemungkinan merekam kejadian?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'C',
                    'trigger' => false,
                ],


                // D. Peralatan yang terlibat

                [
                    'question' => 'Nama peralatan',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'ID atau nomor seri peralatan',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'Lokasi peralatan',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'Kondisi normal peralatan',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'Kondisi peralatan saat ini',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apa masalah yang terlihat pada peralatan?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah peralatan masih beroperasi?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah peralatan masih aman untuk digunakan?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah peralatan sudah dimatikan atau diisolasi?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'Siapa yang sudah diberitahu?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah bagian maintenance sudah dihubungi?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'D',
                    'trigger' => false,
                ],


                // E. Tindakan segera

                [
                    'question' => 'Apa yang Anda lakukan segera setelah menemukan masalah?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda mengamankan area?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda membatasi akses?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda mengisolasi peralatan?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda menghubungi supervisor?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda menghubungi maintenance?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda menghubungi layanan darurat?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda membantu orang yang terluka?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah Anda menjaga atau mengamankan barang bukti?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah rekaman CCTV sudah diidentifikasi atau disimpan?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah situasi sudah terselesaikan?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'E',
                    'trigger' => false,
                ],


                // F. Eskalasi & notifikasi

                [
                    'question' => 'Siapa yang diberitahu?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'F',
                    'trigger' => false,
                ],

                [
                    'question' => 'Nama supervisor yang diberitahu',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'F',
                    'trigger' => false,
                ],

                [
                    'question' => 'Waktu pemberitahuan',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'F',
                    'trigger' => false,
                ],

                [
                    'question' => 'Metode pemberitahuan: Telepon / Radio / WhatsApp / Tatap muka / Lainnya',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'F',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah manajemen sudah diberitahu?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'F',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah maintenance sudah diberitahu?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'F',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah HR sudah diberitahu?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'F',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah polisi atau layanan darurat sudah dihubungi jika diperlukan?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'F',
                    'trigger' => false,
                ],


                // G. Bukti & dokumentasi

                [
                    'question' => 'Rekaman CCTV tersedia',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Foto diambil',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Video diambil',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Saksi berhasil diidentifikasi',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Barang bukti fisik diamankan',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Nomor seri peralatan dicatat',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Log akses diperiksa',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Data pengunjung diperiksa',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Dokumentasi lainnya',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Lokasi rekaman CCTV',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Periode waktu yang perlu diperiksa',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah foto telah diambil?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Siapa yang mengambil foto?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah saksi telah diidentifikasi?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah ada sesuatu yang dipindahkan setelah kejadian?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'G',
                    'trigger' => false,
                ],


                // H. Tindak lanjut

                [
                    'question' => 'Apakah masalah sudah terselesaikan? Ya / Tidak / Sebagian',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah area masih tidak aman?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah peralatan masih tidak dapat digunakan?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah diperlukan investigasi lebih lanjut?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah diperlukan maintenance?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah diperlukan tindak lanjut dari manajemen?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Apakah diperlukan pemantauan keamanan lebih lanjut?',
                    'type' => 'Checklist',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Siapa yang bertanggung jawab atas tindak lanjut?',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Target tanggal penyelesaian',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Tanggal tindak lanjut selesai',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],

                [
                    'question' => 'Penyelesaian atau tindakan akhir yang dilakukan',
                    'type' => 'Text',
                    'option' => 'Incident',
                    'part' => 'H',
                    'trigger' => false,
                ],
            ],


            /*
    |--------------------------------------------------------------------------
    | 7. NOTHING TO REPORT CONFIRMATION
    |--------------------------------------------------------------------------
    */

            'Nothing to Report Confirmation' => [

                [
                    'question' => 'Saya telah menyelesaikan patroli dan tidak menemukan kondisi tidak normal, masalah keamanan, bahaya keselamatan, peralatan rusak, properti hilang, orang atau aktivitas yang tidak berwenang, maupun masalah lain yang perlu dilaporkan, kecuali yang telah dicatat di atas.',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Nama atau tanda tangan petugas keamanan',
                    'type' => 'Text',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Waktu',
                    'type' => 'Text',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Verifikasi supervisor',
                    'type' => 'Checklist',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],

                [
                    'question' => 'Komentar supervisor',
                    'type' => 'Text',
                    'option' => 'Normal',
                    'part' => null,
                    'trigger' => false,
                ],
            ],
        ];


        /*
|--------------------------------------------------------------------------
| CREATE / UPDATE QUESTIONS
|--------------------------------------------------------------------------
*/

        $questionModels = [];

        foreach ($sectionQuestions as $sectionName => $questions) {

            $questionModels[$sectionName] = [];

            foreach ($questions as $questionData) {

                $question = Question::updateOrCreate(
                    [
                        'question' => $questionData['question'],
                    ],
                    [
                        'type' => $questionData['type'],
                        'option' => $questionData['option'],
                        'part' => $questionData['part'],
                        'trigger' => $questionData['trigger'],
                    ]
                );

                $questionModels[$sectionName][] = $question;
            }
        }


        /*
|--------------------------------------------------------------------------
| AREAS
|--------------------------------------------------------------------------
*/

        $areaNames = [
            'Parkiran Depan',
            'Tangga Lobby',
            'Lobby',
            'Parkiran 1',
            'Akses Pintu Belakang',
            'Parkiran 2',
            'Halaman Belakang',
            'Gedung 3',
            'Pumproom',
            'Gedung 2',
            'Kolam',
            'Proshop',
        ];

        $areas = [];

        foreach ($areaNames as $areaName) {

            $areas[$areaName] = Area::updateOrCreate(
                [
                    'name' => $areaName,
                ],
                [
                    'slug' => Str::slug($areaName),
                    'description' => null,
                ]
            );
        }


        /*
|--------------------------------------------------------------------------
| SEMUA AREA -> SEMUA SECTION
|--------------------------------------------------------------------------
*/

        foreach ($areas as $area) {

            foreach ($sections as $section) {

                DB::table('area_sections')->updateOrInsert(
                    [
                        'area_id' => $area->id,
                        'section_id' => $section->id,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }


        /*
|--------------------------------------------------------------------------
| SECTION -> QUESTIONS
|--------------------------------------------------------------------------
*/

        foreach ($sections as $sectionName => $section) {

            foreach ($questionModels[$sectionName] as $question) {

                DB::table('section_questions')->updateOrInsert(
                    [
                        'section_id' => $section->id,
                        'question_id' => $question->id,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        //supplier
        Supplier::create([
            'name' => 'KITCHEN - UD NUSA',
            'slug' => 'kitchen-ud-nusa'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - MEIDI ARTA',
            'slug' => 'kitchen-meidi-arta'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - UD KHRISNA JAYA',
            'slug' => 'kitchen-ud-khrisna-jaya'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - BALI GOLDEN MEAT',
            'slug' => 'kitchen-bali-golden-meat'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - PAKKA/FUSION NIAGA/BOGA PRIMA',
            'slug' => 'kitchen-pakka-fusion-niaga-boga-prima'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - SEGARA SEAFOOD',
            'slug' => 'kitchen-segara-seafood'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - BALI ES CUBE',
            'slug' => 'kitchen-bali-es-cube'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - AQUA TALESALES',
            'slug' => 'kitchen-aqua-talesales'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - QUADRO',
            'slug' => 'kitchen-quadro'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - LIM SIANG HUAT',
            'slug' => 'kitchen-lim-siang-huat'
        ]);
        Supplier::create([
            'name' => 'KITCHEN - ATLAKU KELAPA',
            'slug' => 'kitchen-atlaku-kelapa'
        ]);
        Supplier::create([
            'name' => 'TIRTA JATI',
            'slug' => 'tirta-jati'
        ]);
        Supplier::create([
            'name' => 'TIRTA JAYA POOL',
            'slug' => 'tirta-jaya-pool'
        ]);
        Supplier::create([
            'name' => 'SINAR JAYA POOL',
            'slug' => 'sinar-jaya-pool'
        ]);
        Supplier::create([
            'name' => 'NOVITA JAYA',
            'slug' => 'novita-jaya'
        ]);
        Supplier::create([
            'name' => 'RF PUTRA',
            'slug' => 'rf-putra'
        ]);
        Supplier::create([
            'name' => 'PT. SARI SEGARA',
            'slug' => 'pt-sari-segara'
        ]);
        Supplier::create([
            'name' => 'TIRTA SAKTI MANDIRI',
            'slug' => 'tirta-sakti-mandiri'
        ]);
        Supplier::create([
            'name' => 'BALI SOFT',
            'slug' => 'bali-soft'
        ]);
        Supplier::create([
            'name' => 'WANARA LAUNDRY',
            'slug' => 'wanara-laundry'
        ]);
        Supplier::create([
            'name' => 'NINA MONIKA',
            'slug' => 'nina-monika'
        ]);
        Supplier::create([
            'name' => 'BALI UNITED',
            'slug' => 'bali-united'
        ]);
        Supplier::create([
            'name' => 'TMBM SWIMWEAR',
            'slug' => 'tmbm-swimwear'
        ]);
        Supplier::create([
            'name' => 'LEONI',
            'slug' => 'leoni'
        ]);
        Supplier::create([
            'name' => 'PAK BALIK',
            'slug' => 'pak-balik'
        ]);
        Supplier::create([
            'name' => 'YULA RATTAN',
            'slug' => 'yula-rattan'
        ]);
        Supplier::create([
            'name' => 'MADE JEBOS',
            'slug' => 'made-jebos'
        ]);
        Supplier::create([
            'name' => 'BALINESE ART SHOP',
            'slug' => 'balinese-art-shop'
        ]);
        Supplier::create([
            'name' => 'PT. CONSERVANA',
            'slug' => 'pt-conservana'
        ]);
        Supplier::create([
            'name' => 'AMETHYST SKY',
            'slug' => 'amethyst-sky'
        ]);
        Supplier::create([
            'name' => 'CRAFTDEWATA',
            'slug' => 'craftdewata'
        ]);
        Supplier::create([
            'name' => 'SUNAKA JEWELRY',
            'slug' => 'sunaka-jewelry'
        ]);
        Supplier::create([
            'name' => 'NYOMAN SOUVENIR BALI',
            'slug' => 'nyoman-souvenir-bali'
        ]);
        Supplier::create([
            'name' => 'UD. BALIKUN',
            'slug' => 'ud-balikun'
        ]);
        Supplier::create([
            'name' => 'KLUK',
            'slug' => 'kluk'
        ]);
        Supplier::create([
            'name' => 'PT. SABOO',
            'slug' => 'pt-saboo'
        ]);
        Supplier::create([
            'name' => 'SIANA GARMENT',
            'slug' => 'siana-garment'
        ]);

        //Methode
        $get = Methode::create([
            'methode' => 'GET',
            'slug' => 'get'
        ]);
        $post = Methode::create([
            'methode' => 'POST',
            'slug' => 'post'
        ]);
        $patch = Methode::create([
            'methode' => 'PATCH',
            'slug' => 'patch'
        ]);
        $delete = Methode::create([
            'methode' => 'DELETE',
            'slug' => 'delete'
        ]);
        //Available page / web.php
        $dashboard = $get->web()->create([
            'name' => 'Dashboard page',
            'slug' => 'dashboard-page',
            'route' => 'dashboard',
            'scope' => 'General',
            'description' => 'Halaman utama aplikasi yang menampilkan ringkasan informasi penting dan akses cepat ke fitur utama. Halaman ini dirancang untuk memberikan pengguna gambaran umum tentang status sistem, notifikasi terbaru, dan akses ke modul-modul penting lainnya.'
        ]);
        $user = $get->web()->create([
            'name' => 'Users page',
            'slug' => 'users-page',
            'route' => 'super.admin.user',
            'scope' => 'Super Admin',
        ]);
        $area = $get->web()->create([
            'name' => 'Area page',
            'slug' => 'area-page',
            'route' => 'super.admin.area',
            'scope' => 'Super Admin',
        ]);
        $userDetail = $get->web()->create([
            'name' => 'User detail page',
            'slug' => 'user-detail-page',
            'route' => 'user.detail',
            'scope' => 'General',
            'description' => 'Halaman detail pengguna yang menampilkan informasi lengkap tentang pengguna tertentu.'
        ]);
        $userAccess = $get->web()->create([
            'name' => 'User access page',
            'slug' => 'user-access-page',
            'route' => 'super.admin.user.access',
            'scope' => 'Super Admin',
            'description' => 'Halaman akses pengguna yang memungkinkan pengelolaan izin dan hak akses pengguna.'
        ]);
        $userHistory = $get->web()->create([
            'name' => 'User history page',
            'slug' => 'user-history-page',
            'route' => 'user.history',
            'scope' => 'General',
            'description' => 'Halaman riwayat pengguna yang menampilkan aktivitas dan perubahan yang dilakukan oleh pengguna.'
        ]);
        $divisipage = $get->web()->create([
            'name' => 'Divisions page',
            'slug' => 'divisions-page',
            'route' => 'super.admin.division',
            'scope' => 'Super Admin',
            'description' => 'Halaman divisi yang menampilkan daftar divisi dan informasi terkait.'
        ]);
        $divisiposisipage = $get->web()->create([
            'name' => 'Division position page',
            'slug' => 'division-position-page',
            'route' => 'super.admin.division.position',
            'scope' => 'Super Admin',
            'description' => 'Halaman posisi / jabatan divisi yang menampilkan daftar jabatan / posisi yang tersedia oleh sistem berdasarkan divisi terkait.'
        ]);
        $divisiposisiaccesspage = $get->web()->create([
            'name' => 'Division position access management page',
            'slug' => 'division-position-access-management-page',
            'route' => 'super.admin.divisionposition.page',
            'scope' => 'Super Admin',
            'description' => 'Halaman manajemen akses halaman berdasarkan posisi / jabatan di divisi tertentu.'
        ]);
        $divisiposisiaccessapi = $get->web()->create([
            'name' => 'Division position access API management page',
            'slug' => 'division-position-access-api-management-page',
            'route' => 'super.admin.divisionposition.api',
            'scope' => 'Super Admin',
            'description' => 'Halaman manajemen akses data API berdasarkan posisi / jabatan di divisi tertentu.'
        ]);
        $assign = $get->web()->create([
            'name' => 'Assign Supervisor page',
            'slug' => 'assign-supervisor-page',
            'route' => 'super.admin.attachment',
            'scope' => 'Super Admin',
            'description' => 'Halaman penugasan supervisor yang memungkinkan pengelolaan penugasan supervisor kepada pengguna.'
        ]);
        $worktype = $get->web()->create([
            'name' => 'Work Type page',
            'slug' => 'work-type-page',
            'route' => 'super.admin.work',
            'scope' => 'Super Admin',
            'description' => 'Halaman tipe pekerjaan yang menampilkan daftar tipe pekerjaan dan informasi terkait.'
        ]);
        $web = $get->web()->create([
            'name' => 'WEB page',
            'slug' => 'web-page',
            'route' => 'super.admin.permision.web',
            'scope' => 'Super Admin',
            'description' => 'Halaman web yang menampilkan daftar halaman web dan informasi terkait.'
        ]);
        $api = $get->web()->create([
            'name' => 'API page',
            'slug' => 'api-page',
            'route' => 'super.admin.permission.api',
            'scope' => 'Super Admin',
            'description' => 'Halaman API yang menampilkan daftar endpoint API dan informasi terkait.'
        ]);
        $schedule = $get->web()->create([
            'name' => 'Schedule page',
            'slug' => 'schedule-page',
            'route' => 'schedule',
            'scope' => 'General',
            'description' => 'Halaman jadwal yang menampilkan daftar jadwal dan informasi terkait.'
        ]);
        $scheduledaily = $get->web()->create([
            'name' => 'Schedule Daily page',
            'slug' => 'schedule-daily-page',
            'route' => 'head.schedule.daily.create',
            'scope' => 'Specific',
            'description' => 'Halaman Schedule Daily untuk membuat jadwal harian dalam 1 bulan. Hanya Head of Division yang dizinkan oleh sistem.'
        ]);
        $reschedule = $get->web()->create([
            'name' => 'Reschedule page',
            'slug' => 'reschedule-page',
            'route' => 'reschedules',
            'scope' => 'General',
            'description' => 'Halaman reschedule yang menampilkan seluruh reschedule yang pernah dibuat. bagi supervisor, halaman ini untuk checklist. Bagi head of division, halaman ini meampilkan approval.'
        ]);
        $rescheduleCreate = $get->web()->create([
            'name' => 'Reschedule Create page',
            'slug' => 'reschedule-crrate-page',
            'route' => 'reschedule.create',
            'scope' => 'Specific',
            'description' => 'Halaman reschedule yang menampilkan form untuk submission reschedule.'
        ]);
        $visitorDaily = $get->web()->create([
            'name' => 'Visitor page',
            'slug' => 'visitor-page',
            'route' => 'security.visitor',
            'scope' => 'Specific',
            'description' => 'Halaman visitor page untuk menampilkan seluruh report visitor yang telah dibuat oleh user security. Akses ke halaman ini hanya Security.'
        ]);
        $profile = $get->web()->create([
            'name' => 'Profile Information page',
            'slug' => 'profile-information-page',
            'route' => 'profile.edit',
            'scope' => 'General',
            'description' => 'Halaman Profile Information menampilkan detail informasi user, memungkinkan user untuk mengubah profile, namun user selain Super Admin hanya diizinkan melihat, tidak untuk mengedit profile.'
        ]);
        $basicDaily = $get->Web()->create([
            'name' => 'Basic Information page',
            'slug' => 'basic-information-page',
            'route' => 'daily.basic',
            'scope' => 'General',
            'description' => 'Halaman Basic Information Page sebagai halaman utama sebelum membuat daily bagi semua user. Akses ke halaman ini untuk semua orang.'
        ]);
        $patrolDaily = $get->web()->create([
            'name' => 'Daily Security Patrol page',
            'slug' => 'daily-security-patrol-page',
            'route' => 'security.daily.patrols',
            'scope' => 'Specific',
            'description' => 'Halaman Daily Patrol menampilkan seluruh laporan hasil patroli user dengan divisi security. Halaman ini hanya bisa diakses oleh security'
        ]);
        $patrolDailyCreate = $get->web()->create([
            'name' => 'New Daily Security Patrol page',
            'slug' => 'new-daily-security-patrol-page',
            'route' => 'security.daily.patrol.create',
            'scope' => 'Specific',
            'description' => 'Halaman yang menampilkan form daily patrol bagi security. Form terdiri dari beberapa section. Halaman ini hanya bisa diakses oleh security'
        ]);
        $supplier = $get->web()->create([
            'name' => 'Supplier page',
            'slug' => 'supplier-page',
            'route' => 'super.admin.supplier',
            'scope' => 'Super Admin',
            'description' => 'Halaman Supplier khusus untuk Super Admin'
        ]);
        $questionpage = $get->web()->create([
            'name' => 'Question page',
            'slug' => 'question-page',
            'route' => 'super.admin.question',
            'scope' => 'Super Admin',
            'description' => 'Halaman Question menampilkan seluruh question yang tersedia di sistem. Question ini digunakan oleh Security saat patroli. Akses ke halaman ini hanya super admin.'
        ]);

        //Available api / api.php
        $webapi = $get->api()->create([
            'name' => 'Access Page Available',
            'slug' => 'access-page-available',
            'route' => 'super.admin.web.index',
            'url' => '/webs',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua halaman / page tersedia pada sistem',
        ]);
        $apiapi = $get->api()->create([
            'name' => 'Access API',
            'slug' => 'access-api',
            'route' => 'super.admin.api.index',
            'url' => '/apis',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua API tersedia pada sistem',
        ]);
        $apiusers = $get->api()->create([
            'name' => 'Access Users',
            'slug' => 'access-users',
            'route' => 'user.index',
            'url' => '/users',
            'scope' => 'General',
            'description' => 'Access untuk memperoleh data user pada sistem. Access ini hanya untuk Super Admin, Supervisor dan Head of Division',
        ]);
        $apicreateuser = $post->api()->create([
            'name' => 'New User',
            'slug' => 'new-user',
            'route' => 'super.admin.user.store',
            'url' => '/user',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan user baru pada sistem. Access fitur ini hanya untuk Super Admin',
        ]);
        $apishoweuser = $get->api()->create([
            'name' => 'Access Detail User',
            'slug' => 'access-detail-user',
            'route' => 'user.show',
            'url' => '/user/{id}',
            'scope' => 'General',
            'description' => 'Access untuk memperoleh data user lebih detail pada sistem berdasarkan ID user. Access ini hanya untuk Super Admin dan Supervisor',
        ]);
        $apipatchuser = $patch->api()->create([
            'name' => 'Update User',
            'slug' => 'update-user',
            'route' => 'super.admin.user.update',
            'url' => '/user/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui data user pada sistem berdasarkan ID user. Access fitur ini hanya untuk Super Admin',
        ]);
        $apipatchstatususer = $patch->api()->create([
            'name' => 'Update User Status',
            'slug' => 'update-user-status',
            'route' => 'super.admin.user.status',
            'url' => '/user/status/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk mengubah status user pada sistem berdasarkan ID user. Access fitur ini hanya untuk Super Admin',
        ]);
        $apideleteuser = $delete->api()->create([
            'name' => 'Delete user',
            'slug' => 'delete-user',
            'route' => 'super.admin.user.delete',
            'url' => '/user/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus data user pada sistem berdasarkan ID user. Access fitur ini hanya untuk Super Admin',
        ]);
        $apidivisions = $get->api()->create([
            'name' => 'Access divisions',
            'slug' => 'access-divisions',
            'route' => 'super.admin.division.index',
            'url' => '/divisions',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh divisi yang tersedia pada sistem. Access fitur ini hanya untuk Super Admin',
        ]);
        $apipostdivision = $post->api()->create([
            'name' => 'New division',
            'slug' => 'new-division',
            'route' => 'super.admin.division.store',
            'url' => '/division',
            'scope' => 'Super Admin',
            'description' => 'Access untuk membuat divisi baru pada sistem. Access fitur ini hanya untuk Super Admin',
        ]);
        $apipatchdivision = $patch->api()->create([
            'name' => 'Update division',
            'slug' => 'update-division',
            'route' => 'super.admin.division.update',
            'url' => '/division/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui data divisi yang tersedia pada sistem berdasarkan ID divisi. Access fitur ini hanya untuk Super Admin',
        ]);
        $apideletedivision = $delete->api()->create([
            'name' => 'Delete division',
            'slug' => 'delete-division',
            'route' => 'super.admin.division.delete',
            'url' => '/division/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus data divisi yang tersedia pada sistem berdasarkan ID divisi. Access fitur ini hanya untuk Super Admin',
        ]);

        $apicreatearea = $post->api()->create([
            'name' => 'New Area',
            'slug' => 'new-area',
            'route' => 'super.admin.area.store',
            'url' => '/area',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan area baru pada sistem. Access fitur ini hanya untuk Super Admin. Area digunakan untuk pemilihan opsi area untuk divisi Secuirty',
        ]);
        $apishowarea = $get->api()->create([
            'name' => 'Access Area',
            'slug' => 'access-area',
            'route' => 'super.admin.area.index',
            'url' => '/usera',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh data area pada sistem. Access fitur ini hanya untuk Super Admin. Area digunakan untuk pemilihan opsi area untuk divisi Secuirty',
        ]);
        $apipatcharea = $patch->api()->create([
            'name' => 'Update Area',
            'slug' => 'update-area',
            'route' => 'super.admin.area.update',
            'url' => '/area/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui informasi area pada sistem berdasarkan ID. Access fitur ini hanya untuk Super Admin. Area digunakan untuk pemilihan opsi area untuk divisi Secuirty',
        ]);
        $apideletarea = $delete->api()->create([
            'name' => 'Delete Area',
            'slug' => 'delete-area',
            'route' => 'super.admin.area.delete',
            'url' => '/area/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus area pada sistem berdasarkan ID. Access fitur ini hanya untuk Super Admin. Area digunakan untuk pemilihan opsi area untuk divisi Secuirty',
        ]);

        $apipositions = $get->api()->create([
            'name' => 'Access positions',
            'slug' => 'access-positions',
            'route' => 'super.admin.position.index',
            'url' => '/positions/{division}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh jabatan tersedia pada sistem berdasarkan divisi yang telah ditentukan. Access fitur ini hanya untuk Super Admin',
        ]);
        $apipostposition = $post->api()->create([
            'name' => 'New position',
            'slug' => 'new-position',
            'route' => 'super.admin.position.store',
            'url' => '/position/{slug}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambah jabatan baru pada sistem berdasarkan divisi yang telah ditentukan. Access fitur ini hanya untuk Super Admin',
        ]);
        $apipatchposition = $patch->api()->create([
            'name' => 'Update position',
            'slug' => 'update-position',
            'route' => 'super.admin.position.update',
            'url' => '/position/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui data jabatan berdasarkan ID posisi tersedia pada sistem berdasarkan divisi yang telah ditentukan. Access fitur ini hanya untuk Super Admin',
        ]);
        $apideleteposition = $delete->api()->create([
            'name' => 'Delete position',
            'slug' => 'delete-position',
            'route' => 'super.admin.position.delete',
            'url' => '/position/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus data jabatan berdasarkan ID posisi tersedia pada sistem berdasarkan divisi yang telah ditentukan. Access fitur ini hanya untuk Super Admin',
        ]);

        $apisupervisors = $get->api()->create([
            'name' => 'Access supervisors assigns',
            'slug' => 'access-supervisors',
            'route' => 'super.admin.supervisor.index',
            'url' => '/supervisor',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh user dangan divisi Supervisor beserta tugas pengawasan divisi. Access fitur ini hanya untuk Super Admin',
        ]);
        $apipostsupervisors = $post->api()->create([
            'name' => 'New supervisor assign',
            'slug' => 'new-supervisor-assign',
            'route' => 'super.admin.supervisor.store',
            'url' => '/supervisor',
            'scope' => 'Super Admin',
            'description' => 'Access untuk membuat penugasan baru terhadap user dengan divisi supervisor tertentu. Access fitur ini hanya untuk Super Admin',
        ]);
        $apideletesupervisors = $delete->api()->create([
            'name' => 'Delete supervisor assign',
            'slug' => 'delete-supervisor-assign',
            'route' => 'super.admin.supervisor.delete',
            'url' => '/supervisor/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk melepas / menghapus divisi berdasarkan ID dari penugasan supervisor. Access fitur ini hanya untuk Super Admin',
        ]);

        $apifulltime = $get->api()->create([
            'name' => 'Access fulltime',
            'slug' => 'access-fulltime',
            'route' => 'super.admin.fulltime.index',
            'url' => '/fulltime',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh Divisi dan jam kerja dengan sesi kerja Full Time. Akses ini hanya untuk Super Admin',
        ]);
        $apipostfulltime = $post->api()->create([
            'name' => 'New fulltime',
            'slug' => 'new-fulltime',
            'route' => 'super.admin.fulltime.store',
            'url' => '/fulltime',
            'scope' => 'Super Admin',
            'description' => 'Access untuk membuat sesi kerja Full Time baru pada sistem. Akses ini hanya untuk Super Admin',
        ]);
        $apishifting = $get->api()->create([
            'name' => 'Acess shifting',
            'slug' => 'access-shifting',
            'route' => 'super.admin.shifting.index',
            'url' => '/shifting',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh Divisi dan jam kerja dengan sesi kerja Shifting. Akses ini hanya untuk Super Admin',
        ]);
        $apipostshifting = $post->api()->create([
            'name' => 'New shifting',
            'slug' => 'new-shifting',
            'route' => 'super.admin.shifting.store',
            'url' => '/shifting',
            'scope' => 'Super Admin',
            'description' => 'Access untuk membuat sesi kerja Shifting baru pada sistem. Akses ini hanya untuk Super Admin',
        ]);
        $apideletetime = $delete->api()->create([
            'name' => 'Delete time',
            'slug' => 'delete-time',
            'route' => 'super.admin.time.delete',
            'url' => '/time/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus sesi kerja Full Time / Shifting baru pada sistem berdasarkan ID waktu. Akses ini hanya untuk Super Admin',
        ]);
        $apipatchtime = $patch->api()->create([
            'name' => 'Update time',
            'slug' => 'update-time',
            'route' => 'super.admin.time.patch',
            'url' => '/time/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui informasi sesi kerja Full Time / Shifting baru pada sistem berdasarkan ID waktu. Akses ini hanya untuk Super Admin',
        ]);

        $apiaccesswebs = $get->api()->create([
            'name' => 'Division Position Access Web',
            'slug' => 'division-position-access-web',
            'route' => 'super.admin.accessweb.index',
            'url' => '/accesswebs/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua izin halaman pada jabatan divisi berdasarkan parameter ID division position. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipostaccesswebs = $post->api()->create([
            'name' => 'New Division Position Access web',
            'slug' => 'new-division-position-access-web',
            'route' => 'super.admin.accessweb.store',
            'url' => '/accessweb/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan izin halaman baru pada jabatan divisi berdasarkan parameter ID division position. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchaccesswebs = $patch->api()->create([
            'name' => 'Update Division Position Access Web',
            'slug' => 'update-division-position-access-web',
            'route' => 'super.admin.accessweb.update',
            'url' => '/accessweb/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui izin halaman baru pada jabatan divisi berdasarkan parameter ID division position. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideleteaccesswebs = $delete->api()->create([
            'name' => 'Delete Division Position Access Web',
            'slug' => 'delete-division-position-access-web',
            'route' => 'super.admin.accessweb.delete',
            'url' => '/accessweb/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus izin halaman pada jabatan divisi berdasarkan parameter ID division position. Akses ke fitur ini hanya untuk Super Admin',
        ]);

        $apiaccessapis = $get->api()->create([
            'name' => 'Access Division Position Access API',
            'slug' => 'access-division-position-access-api',
            'route' => 'super.admin.accessapi.index',
            'url' => '/accessapis/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua privilage fitur yang berkaitan dengan data baik CREATE, READ, UPDATE dan DELETE pada jabatan divisi berdasarkan parameter ID division position. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipostaccessapis = $post->api()->create([
            'name' => 'New Division Position Access API',
            'slug' => 'new-division-position-access-api',
            'route' => 'super.admin.accessapi.store',
            'url' => '/accessapi/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan privilage fitur / permission fitur baru pada jabatan divisi berdasarkan parameter ID division position. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchaccessapis = $patch->api()->create([
            'name' => 'Update Division Position Access API',
            'slug' => 'update-division-position-access-api',
            'route' => 'super.admin.accessapi.update',
            'url' => '/accessapi/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui privilage fitur / permission fitur pada jabatan divisi berdasarkan parameter ID division position. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideleteaccessapis = $delete->api()->create([
            'name' => 'Delete Division Position Access API',
            'slug' => 'delete-division-position-access-api',
            'route' => 'super.admin.accessapi.delete',
            'url' => '/accessapi/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus privilage fitur / permission fitur pada jabatan divisi berdasarkan parameter ID division position. Akses ke fitur ini hanya untuk Super Admin',
        ]);

        $apimonthschedule = $get->api()->create([
            'name' => 'Access month schedule',
            'slug' => 'access-month-schedule',
            'route' => 'general.months.schedule',
            'url' => '/months',
            'scope' => 'General',
            'description' => 'Access fitur untuk memperoleh jadwal lengkap dalam 1 bulan. Akses ini untuk semua posisi dan divisi yang tersedia pada sistem',
        ]);
        $apimonthscheduledownload = $post->api()->create([
            'name' => 'Download month schedule',
            'slug' => 'download-month-schedule',
            'route' => 'specific.schedule.download',
            'url' => '/schedule/download',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk mengunduh jadwal lengkap dalam 1 bulan. Akses fitur ini hanya dimiliki oleh Admin HR pada divisi Office.',
        ]);
        $apimonthgenerate = $post->api()->create([
            'name' => 'New month schedule',
            'slug' => 'new-month-schedule',
            'route' => 'specific.months.generate',
            'url' => '/month',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat / generate hari baru lengkap dalam 1 bulan. Akses fitur ini hanya dimiliki oleh user dengan jabatan Admin HR pada divisi Office',
        ]);
        $apimonthdelete = $delete->api()->create([
            'name' => 'Delete Month Schedule',
            'slug' => 'delete-month-schedule',
            'route' => 'specific.months.delete',
            'url' => '/month/{id}',
            'scope' => 'Specific',
            'description' => 'Access fitur menghapus hari dalam 1 bulan beserta schedule yang telah dibuat oleh Head of Division. Akses fitur ini hanya dimiliki oleh user dengan jabatan Admin HR pada divisi Office',
        ]);
        $apischedulecreate = $post->api()->create([
            'name' => 'New Schedule',
            'slug' => 'new-schedule',
            'route' => 'specific.schedule.create',
            'url' => '/schedule',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat schedule baru. Akses fitur ini hanya dimiliki oleh head of division.',
        ]);
        $apireschedulecreate = $post->api()->create([
            'name' => 'New Reschedule',
            'slug' => 'new-reschedule',
            'route' => 'specific.reschedule.create',
            'url' => '/reschedule',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat reschedule. Akses fitur ini untuk seluruh user kecuali Super Admin dan user dengan divisi Supervisor.',
        ]);
        $apireschedule = $get->api()->create([
            'name' => 'Access Reschedule',
            'slug' => 'access-reschedule',
            'route' => 'general.reschedules',
            'url' => '/reschedules',
            'scope' => 'General',
            'description' => 'Access fitur untuk memperoleh Reschedule yang telah diajukan. Akses fitur ini untuk seluruh user.',
        ]);
        $apiabsencreate = $post->api()->create([
            'name' => 'New Not Present',
            'slug' => 'new-not-present',
            'route' => 'specific.schedule.absen',
            'url' => '/absen',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat laporan ketidak hadiran bagi seluruh karyawan. Akses fitur ini dimiliki oleh seluruh user kecuali Super Admin',
        ]);

        $apibasic = $get->api()->create([
            'name' => 'Access Daily Basic Information',
            'slug' => 'access-daily-basic-information',
            'route' => 'general.basics.information.daily',
            'url' => '/basics',
            'scope' => 'General',
            'description' => 'Access fitur untuk memperoleh Daily Basic Information dari daily report seluruh user. Akses fitur ini untuk seluruh user.',
        ]);
        $apibasiccreate = $post->api()->create([
            'name' => 'New Daily Basic Information',
            'slug' => 'new-daily-basic-information',
            'route' => 'specific.basics.information.daily.create',
            'url' => '/basic',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat Daily Basic Information oleh seluruh user. Akses fitur ini specific terhadap user yang diberi akses',
        ]);
        $apipatrols = $get->api()->create([
            'name' => 'Access Daily Patrol',
            'slug' => 'access-daily-patrol',
            'route' => 'specific.secuirty.patrols',
            'url' => '/patrols',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk memperoleh Daily Patrol yang telah dibuat oleh user pada divisi security. Akses fitur ini hanya untuk user Divisi Security selaku pemilik hak akses penuh dan Supervisor selaku penanggung jawab.',
        ]);
        $apipatrolcreate = $post->api()->create([
            'name' => 'New Daily Patrol',
            'slug' => 'new-daily-patrol',
            'route' => 'specific.secuirty.patrol.create',
            'url' => '/patrol',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat Daily Patrol oleh user pada divisi security. Akses fitur ini hanya untuk user divisi Security',
        ]);
        $apiincidents = $get->api()->create([
            'name' => 'Access Incidents',
            'slug' => 'access-incidents',
            'route' => 'general.incident.report',
            'url' => '/incidents',
            'scope' => 'General',
            'description' => 'Access fitur untuk memperoleh Incidents report dari seluruh User. Akses fitur ini hanya untuk seluruh user.',
        ]);
        $apiincidentcreate = $post->api()->create([
            'name' => 'New Incident',
            'slug' => 'new-incident',
            'route' => 'specific.incident.report.create',
            'url' => '/incident',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat report Incident baru pada sistem. Akses fitur ini hanya untuk user yang telah ditentukan, Super Admin dan Supervisor tidak diiznkan untuk membuat incident',
        ]);

        $apisupplies = $get->api()->create([
            'name' => 'Access Supplies',
            'slug' => 'access-supplies',
            'route' => 'super.admin.supplier.index',
            'url' => '/supplies',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua supplier yang tersedia pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipostsupplier = $post->api()->create([
            'name' => 'New Supplier',
            'slug' => 'new-supplier',
            'route' => 'super.admin.supplier.store',
            'url' => '/supplier',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan supplier baru ke dalam sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchsupplier = $patch->api()->create([
            'name' => 'Update Supplier',
            'slug' => 'update-supplier',
            'route' => 'super.admin.supplier.update',
            'url' => '/supplier/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui supplier berdasarkan ID. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideletesupplier = $delete->api()->create([
            'name' => 'Delete Supplier',
            'slug' => 'delete-supplier',
            'route' => 'super.admin.supplier.delete',
            'url' => '/supplier/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus supplier berdasarkan ID. Akses ke fitur ini hanya untuk Super Admin',
        ]);

        $apivisitors = $get->api()->create([
            'name' => 'Access Visitors',
            'slug' => 'access-visitors',
            'route' => 'specific.security.visitor.index',
            'url' => '/visitors',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh laporan visitor. Akses ke fitur ini hanya Security dan Supervisor',
        ]);
        $apipostvisitor = $post->api()->create([
            'name' => 'New Visitor',
            'slug' => 'new-visitor',
            'route' => 'specific.security.visitor.store',
            'url' => '/visitor',
            'scope' => 'Specific',
            'description' => 'Access untuk menambahkan laporan visitor baru ke dalam sistm. Akses ke fitur ini hanya untuk Security',
        ]);
        $apipatchvisitor = $patch->api()->create([
            'name' => 'Update Visitor',
            'slug' => 'update-visitor',
            'route' => 'specific.security.visitor.update',
            'url' => '/visitor/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui laporan visitor berdasarkan ID. Akses ke fitur ini hanya untuk Security.',
        ]);
        $apideletevisitor = $delete->api()->create([
            'name' => 'Delete Visitor',
            'slug' => 'delete-visitor',
            'route' => 'specific.security.visitor.delete',
            'url' => '/visitor/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus laporan visitor berdasarkan ID. Akses ke fitur ini hanya untuk Security.',
        ]);

        $apiquestions = $get->api()->create([
            'name' => 'Access Questions',
            'slug' => 'access-questions',
            'route' => 'super.admin.question.index',
            'url' => '/questions',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua question yang tersedia pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apiquestion = $post->api()->create([
            'name' => 'New Question',
            'slug' => 'new-question',
            'route' => 'super.admin.question.store',
            'url' => '/question',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan question baru ke dalam sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchquestion = $patch->api()->create([
            'name' => 'Update Question',
            'slug' => 'update-question',
            'route' => 'super.admin.question.update',
            'url' => '/question/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui question berdasarkan ID. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideletequestion = $delete->api()->create([
            'name' => 'Delete question',
            'slug' => 'delete-question',
            'route' => 'super.admin.question.delete',
            'url' => '/question/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus question berdasarkan ID. Akses ke fitur ini hanya untuk Super Admin',
        ]);

        $apiabsens = $get->api()->create([
            'name' => 'Access Absen',
            'slug' => 'access-absen',
            'route' => 'general.absen.index',
            'url' => '/absens',
            'scope' => 'General',
            'description' => 'Access untuk memperoleh absen ketidak hadiran yang telah dibuat oleh user pada sistem. Akses ke fitur ini untuk general',
        ]);
        $apiabsen = $post->api()->create([
            'name' => 'New Absen',
            'slug' => 'new-absen',
            'route' => 'specific.absen.store',
            'url' => '/absen',
            'scope' => 'Specific',
            'description' => 'Access untuk menambahkan absen ketidak hadiran pada sitem. Akses ke fitur ini untuk semua user level 2 dan 3',
        ]);
        $apipatchabsen = $patch->api()->create([
            'name' => 'Update Absen',
            'slug' => 'update-absen',
            'route' => 'specific.absen.update',
            'url' => '/absen/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui absen berdasarkan ID. Akses ke fitur ini untuk Admin HR',
        ]);
        $apideleteabsen = $delete->api()->create([
            'name' => 'Delete Absen',
            'slug' => 'delete-absen',
            'route' => 'specific.absen.delete',
            'url' => '/absen/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus absen berdasarkan ID. Akses ke fitur ini untuk Admin HR',
        ]);

        //Unit
        $FH = Unit::create([
            'name' => 'Front of House',
            'slug' => 'front-of-house'
        ]);
        $BH = Unit::create([
            'name' => 'Back of House',
            'slug' => 'back-of-house'
        ]);
        //Jabatan
        $head = Position::create([
            'name' => 'Head',
            'slug' => 'head'
        ]);
        $staff = Position::create([
            'name' => 'Staff',
            'slug' => 'staff'
        ]);

        //Jam kerja
        $fulltime = WorkTime::create([
            'name' => 'Full Time',
            'slug' => 'full-time',
        ]);
        $shifting = WorkTime::create([
            'name' => 'Shifting',
            'slug' => 'shifting',
        ]);
        $fulltime->time()->create([
            'name' => 'Full Time Morning',
            'slug' => 'full-time-morning',
            'start' => '08:00',
            'end' => '16:00',
            'break_start' => '12:00',
            'break_end' => '13:00'
        ]);
        $fulltime->time()->create([
            'name' => 'Full Time Afternoon',
            'slug' => 'full-time-afternoon',
            'start' => '10:00',
            'end' => '18:00',
            'break_start' => '14:00',
            'break_end' => '15:00'
        ]);
        $shift1 = $shifting->time()->create([
            'name' => 'Shift 1',
            'slug' => 'shift-1',
            'start' => '07:00',
            'end' => '15:00',
            'break_start' => '11:00',
            'break_end' => '12:00'
        ]);
        $shift2 = $shifting->time()->create([
            'name' => 'Shift 2',
            'slug' => 'shift-2',
            'start' => '15:00',
            'end' => '23:00',
            'break_start' => '19:00',
            'break_end' => '20:00'
        ]);
        $shift3 = $shifting->time()->create([
            'name' => 'Shift 3',
            'slug' => 'shift-3',
            'start' => '23:00',
            'end' => '07:00',
            'break_start' => '04:00',
            'break_end' => '05:00'
        ]);

        //Level user
        $level1 = Level::create([
            'level' => 1
        ]);
        $level2 = Level::create([
            'level' => 2
        ]);
        $level3 = Level::create([
            'level' => 3
        ]);

        //DIVISION
        //SUPER ADMIN
        $superadmin = $level1->division()->create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $headsuperadmin = DivisionPosition::create([
            'name' => 'Full Access',
            'slug' => 'full-access',
            'position_id' => $head->id,
            'division_id' => $superadmin->id
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $profile->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $web->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $userDetail->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $api->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $user->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $area->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $divisipage->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $divisiposisipage->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $assign->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $worktype->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $userAccess->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $userHistory->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $divisiposisiaccesspage->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $divisiposisiaccessapi->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $supplier->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $questionpage->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $webapi->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiapi->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apicreateuser->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apishoweuser->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchuser->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchstatususer->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideleteuser->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apidivisions->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostdivision->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchdivision->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletedivision->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipositions->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostposition->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchposition->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideleteposition->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apisupervisors->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostsupervisors->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletesupervisors->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apifulltime->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostfulltime->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apishifting->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostshifting->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletetime->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchtime->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiaccesswebs->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostaccesswebs->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchaccesswebs->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideleteaccesswebs->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiaccessapis->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostaccessapis->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchaccessapis->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideleteaccessapis->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apicreatearea->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apishowarea->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatcharea->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletarea->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apisupplies->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostsupplier->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchsupplier->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletesupplier->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiquestions->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiquestion->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchquestion->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletequestion->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiabsens->id,
        ]);

        //SUPERVISOR
        $supervisor = $level2->division()->create([
            'name' => 'Supervisor',
            'slug' => 'supervisor',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $supervisor->unit()->create([
            'unit_id' => $FH->id
        ]);
        $supervisor->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $supervisor->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 0
        ]);
        $headsupervisor = DivisionPosition::create([
            'name' => 'Head of Supervisor',
            'slug' => 'head-of-supervisor',
            'position_id' => $head->id,
            'division_id' => $supervisor->id
        ]);
        $headsupervisor->web()->create([
            'web_id' => $dashboard->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $profile->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apishoweuser->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffsupervisor = DivisionPosition::create([
            'name' => 'Staff of Supervisor',
            'slug' => 'staff-of-supervisor',
            'position_id' => $staff->id,
            'division_id' => $supervisor->id
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $dashboard->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $userDetail->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apishoweuser->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiabsen->id,
        ]);

        //CASHIER
        $cashier = $level3->division()->create([
            'name' => 'Cashier',
            'slug' => 'cashier',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $cashier->unit()->create([
            'unit_id' => $FH->id
        ]);
        $cashier->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $cashier->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 0
        ]);
        $headcashier = DivisionPosition::create([
            'name' => 'Head of Cashier',
            'slug' => 'head-of-cashier',
            'position_id' => $head->id,
            'division_id' => $cashier->id
        ]);
        $headcashier->web()->create([
            'web_id' => $dashboard->id,
        ]);
        $headcashier->web()->create([
            'web_id' => $profile->id,
        ]);
        $headcashier->web()->create([
            'web_id' => $userDetail->id,
        ]);
        $headcashier->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headcashier->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headcashier->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headcashier->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headcashier->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headcashier->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffcashier = DivisionPosition::create([
            'name' => 'Staff of Cashier',
            'slug' => 'staff-of-cashier',
            'position_id' => $staff->id,
            'division_id' => $cashier->id
        ]);
        $staffcashier->web()->create([
            'web_id' => $dashboard->id
        ]);
        $staffcashier->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffcashier->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffcashier->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffcashier->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffcashier->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffcashier->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        //RESERVATION
        $reservation = $level3->division()->create([
            'name' => 'Reservation',
            'slug' => 'reservation',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $reservation->unit()->create([
            'unit_id' => $FH->id
        ]);
        $reservation->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $reservation->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 0
        ]);
        $headreservation = DivisionPosition::create([
            'name' => 'Head of Reservation',
            'slug' => 'head-of-reservation',
            'position_id' => $head->id,
            'division_id' => $reservation->id
        ]);
        $staffreservation = DivisionPosition::create([
            'name' => 'Staff of Reservation',
            'slug' => 'staff-of-reservation',
            'position_id' => $staff->id,
            'division_id' => $reservation->id
        ]);
        $headreservation->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headreservation->web()->create([
            'web_id' => $profile->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $userDetail->id
        ]);
        $headreservation->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $dashboard->id
        ]);
        $staffreservation->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        //GUEST EXPERIENCE & EDUCATION
        $ged = $level3->division()->create([
            'name' => 'Guest Experience And Education',
            'slug' => 'guest-experience-and-education',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $ged->unit()->create([
            'unit_id' => $FH->id
        ]);
        $ged->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 1
        ]);
        $ged->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 0
        ]);
        $headged = DivisionPosition::create([
            'name' => 'Head of Host',
            'slug' => 'head-of-host',
            'position_id' => $head->id,
            'division_id' => $ged->id
        ]);
        $staffged = DivisionPosition::create([
            'name' => 'Staff of Host',
            'slug' => 'staff-of-host',
            'position_id' => $staff->id,
            'division_id' => $ged->id
        ]);
        $headged->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headged->web()->create([
            'web_id' => $profile->id,
        ]);
        $headged->web()->create([
            'web_id' => $userDetail->id
        ]);
        $headged->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headged->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headged->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headged->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headged->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headged->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headged->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headged->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headged->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headged->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headged->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headged->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headged->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headged->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headged->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headged->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headged->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffged->web()->create([
            'web_id' => $dashboard->id
        ]);
        $staffged->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffged->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffged->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffged->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffged->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffged->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        //MULTIMEDIA
        $mm = $level3->division()->create([
            'name' => 'Multimedia',
            'slug' => 'multimedia',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $mm->unit()->create([
            'unit_id' => $FH->id
        ]);
        $mm->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $mm->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 0
        ]);
        $headmultimedia = DivisionPosition::create([
            'name' => 'Head of Multimedia',
            'slug' => 'head-of-multimedia',
            'position_id' => $head->id,
            'division_id' => $mm->id
        ]);
        $headretail = DivisionPosition::create([
            'name' => 'Head of Retail',
            'slug' => 'head-of-retail',
            'position_id' => $head->id,
            'division_id' => $mm->id
        ]);
        $staffmultimedia = DivisionPosition::create([
            'name' => 'Staff of Multimedia',
            'slug' => 'staff-of-multimedia',
            'position_id' => $staff->id,
            'division_id' => $mm->id
        ]);
        $headmultimedia->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headmultimedia->web()->create([
            'web_id' => $profile->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $userDetail->id
        ]);
        $headmultimedia->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $headretail->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headretail->web()->create([
            'web_id' => $profile->id,
        ]);
        $headretail->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headretail->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headretail->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headretail->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headretail->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $dashboard->id
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        //MARKETING
        $marketing = $level3->division()->create([
            'name' => 'Marketing',
            'slug' => 'marketing',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $marketing->unit()->create([
            'unit_id' => $FH->id
        ]);
        $marketing->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $marketing->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 0
        ]);
        $headmarketing = DivisionPosition::create([
            'name' => 'Head of Marketing',
            'slug' => 'head-of-marketing',
            'position_id' => $head->id,
            'division_id' => $mm->id
        ]);
        $staffmarketing = DivisionPosition::create([
            'name' => 'Staff of Marketing',
            'slug' => 'staff-of-marketing',
            'position_id' => $staff->id,
            'division_id' => $mm->id
        ]);
        $headmarketing->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headmarketing->web()->create([
            'web_id' => $profile->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $userDetail->id
        ]);
        $headmarketing->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $dashboard->id
        ]);
        $staffmarketing->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        //AWF
        $awf = $level3->division()->create([
            'name' => 'AWF',
            'slug' => 'awf',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $awf->unit()->create([
            'unit_id' => $BH->id
        ]);
        $awf->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 1
        ]);
        $awf->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 0
        ]);
        $headawf = DivisionPosition::create([
            'name' => 'Head of AWF',
            'slug' => 'head-of-awf',
            'position_id' => $head->id,
            'division_id' => $awf->id
        ]);
        $veterinary = DivisionPosition::create([
            'name' => 'Veterinary',
            'slug' => 'veterinary',
            'position_id' => $head->id,
            'division_id' => $awf->id
        ]);
        $habitat = DivisionPosition::create([
            'name' => 'Habitat',
            'slug' => 'habitat',
            'position_id' => $head->id,
            'division_id' => $awf->id
        ]);
        $enrichment = DivisionPosition::create([
            'name' => 'Enrichment',
            'slug' => 'enrichment',
            'position_id' => $head->id,
            'division_id' => $awf->id
        ]);
        $fishroom = DivisionPosition::create([
            'name' => 'Fishroom',
            'slug' => 'fishroom',
            'position_id' => $head->id,
            'division_id' => $awf->id
        ]);
        $staffawf = DivisionPosition::create([
            'name' => 'Staff of AWF',
            'slug' => 'staff-of-awf',
            'position_id' => $staff->id,
            'division_id' => $awf->id
        ]);
        $headawf->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headawf->web()->create([
            'web_id' => $profile->id,
        ]);
        $headawf->web()->create([
            'web_id' => $userDetail->id
        ]);
        $headawf->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headawf->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headawf->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headawf->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headawf->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $dashboard->id
        ]);
        $veterinary->web()->create([
            'web_id' => $profile->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $schedule->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $habitat->web()->create([
            'web_id' => $dashboard->id
        ]);
        $habitat->web()->create([
            'web_id' => $profile->id,
        ]);
        $habitat->web()->create([
            'web_id' => $schedule->id,
        ]);
        $habitat->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $habitat->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $habitat->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $habitat->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $enrichment->web()->create([
            'web_id' => $dashboard->id
        ]);
        $enrichment->web()->create([
            'web_id' => $profile->id,
        ]);
        $enrichment->web()->create([
            'web_id' => $schedule->id,
        ]);
        $enrichment->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $enrichment->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $enrichment->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $enrichment->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $enrichment->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $dashboard->id
        ]);
        $fishroom->web()->create([
            'web_id' => $profile->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $schedule->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $dashboard->id
        ]);
        $staffawf->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        //SECURITY
        $security = $level3->division()->create([
            'name' => 'Security',
            'slug' => 'security',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $security->unit()->create([
            'unit_id' => $BH->id
        ]);
        $worksecurity = $security->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 1
        ]);
        $offsecurity = $security->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 0
        ]);
        $headsecurity = DivisionPosition::create([
            'name' => 'Head of Security',
            'slug' => 'head-of-security',
            'position_id' => $head->id,
            'division_id' => $security->id
        ]);
        $staffsecurity = DivisionPosition::create([
            'name' => 'Staff of Security',
            'slug' => 'staff-of-security',
            'position_id' => $staff->id,
            'division_id' => $security->id
        ]);
        $headsecurity->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headsecurity->web()->create([
            'web_id' => $profile->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $userDetail->id
        ]);
        $headsecurity->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $scheduledaily->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $patrolDailyCreate->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $visitorDaily->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatrols->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatrolcreate->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apivisitors->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipostvisitor->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatchvisitor->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apideletevisitor->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $dashboard->id
        ]);
        $staffsecurity->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $patrolDailyCreate->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $visitorDaily->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipatrols->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipatrolcreate->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apivisitors->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipostvisitor->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipatchvisitor->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apideletevisitor->id,
        ]);

        //FACILITY CARE
        $facility = $level3->division()->create([
            'name' => 'Facility Care',
            'slug' => 'facility-care',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $facility->unit()->create([
            'unit_id' => $BH->id
        ]);
        $facility->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 1
        ]);
        $facility->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 0
        ]);
        $headfacility = DivisionPosition::create([
            'name' => 'Head of Facility',
            'slug' => 'head-of-facility',
            'position_id' => $head->id,
            'division_id' => $facility->id
        ]);
        $stafffacility = DivisionPosition::create([
            'name' => 'Staff of Facility',
            'slug' => 'staff-of-facility',
            'position_id' => $staff->id,
            'division_id' => $facility->id
        ]);
        $headfacility->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headfacility->web()->create([
            'web_id' => $profile->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $userDetail->id
        ]);
        $headfacility->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $stafffacility->web()->create([
            'web_id' => $dashboard->id
        ]);
        $stafffacility->web()->create([
            'web_id' => $profile->id,
        ]);
        $stafffacility->web()->create([
            'web_id' => $schedule->id,
        ]);
        $stafffacility->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $stafffacility->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $stafffacility->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $stafffacility->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $stafffacility->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        //OFFICE
        $office = $level3->division()->create([
            'name' => 'Office',
            'slug' => 'office',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $office->unit()->create([
            'unit_id' => $BH->id
        ]);
        $office->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $office->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 0
        ]);
        $headoffice = DivisionPosition::create([
            'name' => 'Head of Office',
            'slug' => 'head-of-office',
            'position_id' => $head->id,
            'division_id' => $office->id
        ]);
        $hrd = DivisionPosition::create([
            'name' => 'Admin HRD',
            'slug' => 'admin-hrd',
            'position_id' => $head->id,
            'division_id' => $office->id
        ]);
        $inventory = DivisionPosition::create([
            'name' => 'Admin Inventory',
            'slug' => 'admin-inventory',
            'position_id' => $head->id,
            'division_id' => $office->id
        ]);
        $accounting = DivisionPosition::create([
            'name' => 'Accounting',
            'slug' => 'accounting',
            'position_id' => $head->id,
            'division_id' => $office->id
        ]);
        $receivable = DivisionPosition::create([
            'name' => 'receivable',
            'slug' => 'receivable',
            'position_id' => $head->id,
            'division_id' => $office->id
        ]);
        $staffoffice = DivisionPosition::create([
            'name' => 'Staff of Office',
            'slug' => 'staff-of-office',
            'position_id' => $staff->id,
            'division_id' => $office->id
        ]);
        $headoffice->web()->create([
            'web_id' => $dashboard->id
        ]);
        $headoffice->web()->create([
            'web_id' => $profile->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $userDetail->id
        ]);
        $headoffice->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $hrd->web()->create([
            'web_id' => $dashboard->id
        ]);
        $hrd->web()->create([
            'web_id' => $profile->id,
        ]);
        $hrd->web()->create([
            'web_id' => $schedule->id,
        ]);
        $hrd->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $hrd->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $hrd->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $hrd->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apimonthgenerate->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apimonthdelete->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apimonthscheduledownload->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apipatchabsen->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apideleteabsen->id,
        ]);
        $inventory->web()->create([
            'web_id' => $dashboard->id
        ]);
        $inventory->web()->create([
            'web_id' => $profile->id,
        ]);
        $inventory->web()->create([
            'web_id' => $schedule->id,
        ]);
        $inventory->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $inventory->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $inventory->web()->create([
            'web_id' => $schedule->id,
        ]);
        $inventory->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $inventory->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $inventory->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $accounting->web()->create([
            'web_id' => $dashboard->id
        ]);
        $accounting->web()->create([
            'web_id' => $profile->id,
        ]);
        $accounting->web()->create([
            'web_id' => $schedule->id,
        ]);
        $accounting->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $accounting->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $accounting->web()->create([
            'web_id' => $schedule->id,
        ]);
        $accounting->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $accounting->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $accounting->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $receivable->web()->create([
            'web_id' => $dashboard->id
        ]);
        $receivable->web()->create([
            'web_id' => $profile->id,
        ]);
        $receivable->web()->create([
            'web_id' => $schedule->id,
        ]);
        $receivable->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $receivable->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $receivable->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $receivable->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $dashboard->id
        ]);
        $staffoffice->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apiincidentcreate->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apiabsen->id,
        ]);

        //USER
        $Fanik = '1234567891011121';
        $Faphone = '12345678910';
        $Faemergency = '01987654321';
        $Fajar = User::create([
            'name' => 'Fajar Gates',
            'nik' => encrypt($Fanik),
            'nik_hash' => hash_hmac('sha256', $Fanik, config('app.key')),
            'username' => 'Gateskuy123',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($Faphone),
            'phone_hash' => hash_hmac('sha256', $Faphone, config('app.key')),
            'emergency' => encrypt($Faemergency),
            'emergency_hash' => hash_hmac('sha256', $Faemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Munich',
            'birthday' => today(),
            'address' => 'Jakarta keras RT69 RW666'
        ]);
        $SaFajar = $Fajar->divisionPosition()->create([
            'division_position_id' => $headsuperadmin->id
        ]);

        $Dimnik = '9998563236555212';
        $Dimphone = '1111444569';
        $Dimemergency = '8889996552';
        $Dimas = User::create([
            'name' => 'Dimas',
            'nik' => encrypt($Dimnik),
            'nik_hash' => hash_hmac('sha256', $Dimnik, config('app.key')),
            'username' => 'dimdim123',
            'email' => 'dim@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($Dimphone),
            'phone_hash' => hash_hmac('sha256', $Dimphone, config('app.key')),
            'emergency' => encrypt($Dimemergency),
            'emergency_hash' => hash_hmac('sha256', $Dimemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Milan',
            'birthday' => today(),
            'address' => 'Bawah Tol Bekasi'
        ]);
        $SpvDim = $Dimas->divisionPosition()->create([
            'division_position_id' => $headsupervisor->id
        ]);

        $launik = '7784565212545689';
        $lauphone = '7777778458';
        $lauemergency = '8888855540';
        $laura = User::create([
            'name' => 'Laura',
            'nik' => encrypt($launik),
            'nik_hash' => hash_hmac('sha256', $launik, config('app.key')),
            'username' => 'lau123',
            'email' => 'laura@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($lauphone),
            'phone_hash' => hash_hmac('sha256', $lauphone, config('app.key')),
            'emergency' => encrypt($lauemergency),
            'emergency_hash' => hash_hmac('sha256', $lauemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Andora',
            'birthday' => today(),
            'address' => 'Depan kantor'
        ]);
        $Spvstf = $laura->divisionPosition()->create([
            'division_position_id' => $staffsupervisor->id
        ]);

        $cikanik = '7878787898789878';
        $cikaphone = '8525896545';
        $cikaemergency = '7845698632';
        $cika = User::create([
            'name' => 'Cika',
            'nik' => encrypt($cikanik),
            'nik_hash' => hash_hmac('sha256', $cikanik, config('app.key')),
            'username' => 'cika123',
            'email' => 'cika@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($cikaphone),
            'phone_hash' => hash_hmac('sha256', $cikaphone, config('app.key')),
            'emergency' => encrypt($cikaemergency),
            'emergency_hash' => hash_hmac('sha256', $cikaemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Jakarta',
            'birthday' => today(),
            'address' => 'Pasar Senen'
        ]);
        $hr = $cika->divisionPosition()->create([
            'division_position_id' => $hrd->id
        ]);

        $emannik = '12325698569877456';
        $emanphone = '1114445878';
        $emanemergency = '9632365896';
        $emanuel = User::create([
            'name' => 'Emanuel',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'emanuel123',
            'email' => 'emanuel@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($emanphone),
            'phone_hash' => hash_hmac('sha256', $emanphone, config('app.key')),
            'emergency' => encrypt($emanemergency),
            'emergency_hash' => hash_hmac('sha256', $emanemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Tokyo',
            'birthday' => today(),
            'address' => 'Cililitan'
        ]);
        $headsatpam = $emanuel->divisionPosition()->create([
            'division_position_id' => $headsecurity->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offsecurity->id,
            'user_id' => $emanuel->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $worksecurity->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $worksecurity->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $worksecurity->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 3'
        ]);
        $templeteshift1->templetetime()->create([
            'time_id' => $shift1->id
        ]);
        $templeteshift2->templetetime()->create([
            'time_id' => $shift2->id
        ]);
        $templeteshift3->templetetime()->create([
            'time_id' => $shift3->id
        ]);

        $indranik = '5552369855544125';
        $indraphone = '5566698887';
        $indraemergency = '0101235654';
        $indra = User::create([
            'name' => 'Indra Wijaya',
            'nik' => encrypt($indranik),
            'nik_hash' => hash_hmac('sha256', $indranik, config('app.key')),
            'username' => 'indra123',
            'email' => 'indra@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($indraphone),
            'phone_hash' => hash_hmac('sha256', $indraphone, config('app.key')),
            'emergency' => encrypt($indraemergency),
            'emergency_hash' => hash_hmac('sha256', $indraemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Surabaya',
            'birthday' => today(),
            'address' => 'Pal Merah'
        ]);
        $staffsatpam = $indra->divisionPosition()->create([
            'division_position_id' => $staffsecurity->id
        ]);
        Templete::create([
            'division_work_time_id' => $offsecurity->id,
            'user_id' => $indra->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1indra = Templete::create([
            'division_work_time_id' => $worksecurity->id,
            'user_id' => $indra->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2indra = Templete::create([
            'division_work_time_id' => $worksecurity->id,
            'user_id' => $indra->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3indra = Templete::create([
            'division_work_time_id' => $worksecurity->id,
            'user_id' => $indra->id,
            'name' => 'Shift 3'
        ]);
        $templeteshift1indra->templetetime()->create([
            'time_id' => $shift1->id
        ]);
        $templeteshift2indra->templetetime()->create([
            'time_id' => $shift2->id
        ]);
        $templeteshift3indra->templetetime()->create([
            'time_id' => $shift3->id
        ]);

        $mailnik = '44632365698565421';
        $mailphone = '778999658';
        $mailemergency = '0147410147';
        $mail = User::create([
            'name' => 'Ismaele bin maele',
            'nik' => encrypt($mailnik),
            'nik_hash' => hash_hmac('sha256', $mailnik, config('app.key')),
            'username' => 'mail123',
            'email' => 'mail@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($mailphone),
            'phone_hash' => hash_hmac('sha256', $mailphone, config('app.key')),
            'emergency' => encrypt($mailemergency),
            'emergency_hash' => hash_hmac('sha256', $mailemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Lampung',
            'birthday' => today(),
            'address' => 'Jakpus'
        ]);
        $staffsatpam = $mail->divisionPosition()->create([
            'division_position_id' => $staffsecurity->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offsecurity->id,
            'user_id' => $mail->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $worksecurity->id,
            'user_id' => $mail->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $worksecurity->id,
            'user_id' => $mail->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $worksecurity->id,
            'user_id' => $mail->id,
            'name' => 'Shift 3'
        ]);
        $templeteshift1->templetetime()->create([
            'time_id' => $shift1->id
        ]);
        $templeteshift2->templetetime()->create([
            'time_id' => $shift2->id
        ]);
        $templeteshift3->templetetime()->create([
            'time_id' => $shift3->id
        ]);
    }
}
