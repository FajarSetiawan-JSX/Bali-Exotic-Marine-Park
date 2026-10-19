<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\bookingMethode;
use App\Models\Contract;
use App\Models\Division;
use App\Models\DivisionPosition;
use App\Models\Level;
use App\Models\Mamals;
use App\Models\Methode;
use App\Models\Pool;
use App\Models\Position;
use App\Models\Priority;
use App\Models\Program;
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

        //Methode Booking
        bookingMethode::create([
            'name' => 'WhatsApp',
            'slug' => 'whatsapp'
        ]);
        bookingMethode::create([
            'name' => 'Traveloka',
            'slug' => 'traveloka'
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

        //Programs
        $discovery = Program::create([
            'name' => 'Discovery',
            'slug' => 'discovery',
        ]);
        $discoveryplus = Program::create([
            'name' => 'Discovery+',
            'slug' => 'discovery+',
        ]);
        $explorer = Program::create([
            'name' => 'Explorer',
            'slug' => 'explorer',
        ]);
        $encounter = Program::create([
            'name' => 'Encounter',
            'slug' => 'encounter',
        ]);
        //program available
        $adultdiscovery = $discovery->category()->create([
            'category' => 'Adult',
            'price' => 1499000
        ]);
        $childdiscovery = $discovery->category()->create([
            'category' => 'Child',
            'price' => 1350000
        ]);
        $adultexplorer = $explorer->category()->create([
            'category' => 'Adult',
            'price' => 350000
        ]);
        $childexplorer = $explorer->category()->create([
            'category' => 'Child',
            'price' => 350000
        ]);
        $adultencounter = $encounter->category()->create([
            'category' => 'Adult',
            'price' => 650000
        ]);
        $childencounter = $encounter->category()->create([
            'category' => 'Child',
            'price' => 580000
        ]);
        $adultdiscoveryplus = $discoveryplus->category()->create([
            'category' => 'Adult',
            'price' => 8580000
        ]);
        $childdiscoveryplus = $discoveryplus->category()->create([
            'category' => 'Child',
            'price' => 85800000
        ]);

        //kontrak kerja
        $probation = Contract::create([
            'name' => 'Probation',
            'slug' => 'probation',
            'duration' => 3
        ]);
        $pkwt = Contract::create([
            'name' => 'PKWT',
            'slug' => 'pkwt',
            'duration' => 12
        ]);

        //Pool
        Pool::create([
            'name' => 'Main Pool',
            'slug' => 'main-pool'
        ]);
        Pool::create([
            'name' => 'Quarantine Pool',
            'slug' => 'quarantine-pool'
        ]);

        //Mamals
        Mamals::create([
            'name' => 'Simba',
            'slug' => 'simba'
        ]);
        Mamals::create([
            'name' => 'Emon',
            'slug' => 'emon'
        ]);
        Mamals::create([
            'name' => 'Arafiq',
            'slug' => 'arafiq'
        ]);
        Mamals::create([
            'name' => 'Marco',
            'slug' => 'marco'
        ]);
        Mamals::create([
            'name' => 'Rico',
            'slug' => 'rico'
        ]);
        Mamals::create([
            'name' => 'Rama',
            'slug' => 'rama'
        ]);
        Mamals::create([
            'name' => 'Bima',
            'slug' => 'bima'
        ]);
        Mamals::create([
            'name' => 'Jesica',
            'slug' => 'jesica'
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
            'name' => 'User Detail page',
            'slug' => 'user-detail-page',
            'route' => 'user.detail',
            'scope' => 'General',
            'description' => 'Halaman detail pengguna yang menampilkan informasi lengkap tentang pengguna tertentu.'
        ]);
        $userConteact = $get->web()->create([
            'name' => 'User Contract page',
            'slug' => 'user-contract-page',
            'route' => 'user.contract',
            'scope' => 'General',
            'description' => 'Halaman Contract pengguna menampilkan seluruh informasi kontrak kerja pengguna berdasarkan ID tertentu.'
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
            'scope' => 'Specific',
            'description' => 'Halaman Basic Information Page sebagai halaman utama sebelum membuat daily bagi semua user. Akses ke halaman ini untuk semua orang.'
        ]);
        $basicDetail = $get->Web()->create([
            'name' => 'Basic Detail Information page',
            'slug' => 'basic-detail-information-page',
            'route' => 'daily.basic.detail',
            'scope' => 'Specific',
            'description' => 'Halaman Basic Information Page sebagai halaman utama sebelum membuat daily bagi semua user. Akses ke halaman ini untuk semua orang.'
        ]);
        $patrolDaily = $get->web()->create([
            'name' => 'Daily Patrol page',
            'slug' => 'daily-patrol-page',
            'route' => 'daily.patrols',
            'scope' => 'Specific',
            'description' => 'Halaman Daily Patrol menampilkan seluruh laporan hasil patroli user divisi security dan facility. Halaman ini hanya bisa diakses oleh security, facility dan supervisor'
        ]);
        $patrolDailyCreate = $get->web()->create([
            'name' => 'New Daily Patrol page',
            'slug' => 'new-daily-patrol-page',
            'route' => 'daily.patrol.create',
            'scope' => 'Specific',
            'description' => 'Halaman yang menampilkan form daily question patrol bagi security dan facility. Form terdiri dari beberapa section untuk security. Halaman ini hanya bisa diakses oleh security dan facility.'
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
        $incident = $get->web()->create([
            'name' => 'Incident page',
            'slug' => 'incident-page',
            'route' => 'incidents',
            'scope' => 'Specific',
            'description' => 'Halaman incident yang menampilkan seluruh incident yang pernah dibuat. Hanya user level 2 dan 3 yang memiliki akses ke halaman ini.'
        ]);
        $incidentCreate = $get->web()->create([
            'name' => 'New Incident page',
            'slug' => 'new-incident-page',
            'route' => 'incident.create',
            'scope' => 'Specific',
            'description' => 'Halaman yang menampilkan form question incident baru. Akses ke halaman ini hanya untuk security.'
        ]);
        $bookingmethode = $get->web()->create([
            'name' => 'Booking Methode page',
            'slug' => 'booking-mrthode-page',
            'route' => 'super.admin.booking.methode',
            'scope' => 'Super Admin',
            'description' => 'Halaman booking methode menampilkan seluruh booking methode yang tersdia dalam sistem. Akses ke halaman ini hanya Super Admin.'
        ]);
        $booking = $get->web()->create([
            'name' => 'Booking page',
            'slug' => 'booking-page',
            'route' => 'specific.bookings',
            'scope' => 'Specific',
            'description' => 'Halaman booking yang menampilkan seluruh booking yang pernah dibuat. Hanya user level 2 dan 3 yang memiliki akses ke halaman ini.'
        ]);
        $logistics = $get->web()->create([
            'name' => 'Logistics page',
            'slug' => 'logistics-page',
            'route' => 'logistics',
            'scope' => 'Specific',
            'description' => 'Halaman Logistics menampilkan seluruh logistics yang telah dibuat oleh Security dan atau Admin Office. Akses ke halaman ini adalah user level 2 dan 3 bagi Security dan Admin Office.'
        ]);
        $delivery = $get->web()->create([
            'name' => 'Deliveries page',
            'slug' => 'deliveries-page',
            'route' => 'security.delivery',
            'scope' => 'Specific',
            'description' => 'Halaman Delivery menampilkan seluruh delivery yang telah dibuat oleh security. Akses ke halaman ini adalah user level 2 dan 3 divisi Securtiy.'
        ]);
        $sales = $get->web()->create([
            'name' => 'Sales page',
            'slug' => 'sales-page',
            'route' => 'sales',
            'scope' => 'Specific',
            'description' => 'Halaman Sales menampilkan seluruh sales yang telah dibuat oleh Cashier. Akses ke halaman ini adalah user level 2, Cashier, Host, AWF dan Photographer.'
        ]);
        $consumption = $get->web()->create([
            'name' => 'Consumptions page',
            'slug' => 'consumptions-page',
            'route' => 'specific.consumptions',
            'scope' => 'Specific',
            'description' => 'Halaman Consumption menampilkan seluruh consumption yang telah dibuat oleh Fishrom. Akses ke halaman ini adalah user level 2 dan fishroom.'
        ]);
        $healthcheck = $get->web()->create([
            'name' => 'Healtch Checks page',
            'slug' => 'healtch-checks-page',
            'route' => 'specific.healthchecks',
            'scope' => 'Specific',
            'description' => 'Halaman Health Check menampilkan seluruh health check yang telah dibuat oleh Veterinary. Akses ke halaman ini adalah user level 2 dan veterinary.'
        ]);
        $waterquality = $get->web()->create([
            'name' => 'Water Qualities page',
            'slug' => 'water-qualities-page',
            'route' => 'specific.waterqualities',
            'scope' => 'Specific',
            'description' => 'Halaman Health Check menampilkan seluruh health check yang telah dibuat oleh Sustainable Development. Akses ke halaman ini adalah user level 2 dan sustainable development.'
        ]);
        $poolarea = $get->web()->create([
            'name' => 'Pool Area page',
            'slug' => 'pool-area-page',
            'route' => 'specific.poolareas',
            'scope' => 'Specific',
            'description' => 'Halaman Pool & Area menampilkan seluruh Pool & Area yang telah dibuat oleh Trainer. Akses ke halaman ini adalah user level 2 dan trainer.'
        ]);
        $program = $get->web()->create([
            'name' => 'Program page',
            'slug' => 'program-page',
            'route' => 'super.admin.program',
            'scope' => 'Super Admin',
            'description' => 'Halaman Program menampilkan seluruh program dan detail category program yang tersedia didalam sistem. Akses ke halaman ini hanya untuk Super Admin'
        ]);
        $programcategory = $get->web()->create([
            'name' => 'Program Category page',
            'slug' => 'program-category-page',
            'route' => 'super.admin.program.category',
            'scope' => 'Super Admin',
            'description' => 'Halaman Program menampilkan seluruh program category tersedia didalam sistem. Akses ke halaman ini hanya untuk Super Admin'
        ]);
        $contract = $get->web()->create([
            'name' => 'Contract page',
            'slug' => 'contract-page',
            'route' => 'super.admin.contract',
            'scope' => 'Super Admin',
            'description' => 'Halaman Contract menampilkan seluruh Contract tersedia didalam sistem. Akses ke halaman ini hanya untuk Super Admin'
        ]);
        $order = $get->Web()->create([
            'name' => 'Order page',
            'slug' => 'order-page',
            'route' => 'specific.purchase.order',
            'scope' => 'Specific',
            'description' => 'Halaman Order Page sebagai halaman utama untuk menampilkan informasi Purchase Order . Akses ke halaman ini untuk Supervisor dan Head of Division.'
        ]);
        $notification = $get->Web()->create([
            'name' => 'Notification page',
            'slug' => 'notification-page',
            'route' => 'specific.notification',
            'scope' => 'Specific',
            'description' => 'Halaman Notification page merupakan halaman untuk menejemen norifikasi. Akses ke halaman ini hanya untuk Super Admin, HRD dan Head of Diviision.'
        ]);
        $mammalsreport = $get->Web()->create([
            'name' => 'Mammals Report page',
            'slug' => 'mammals-report-page',
            'route' => 'specific.mammal.report',
            'scope' => 'Specific',
            'description' => 'Halaman Mammals Report page merupakan halaman untuk menejemen laporan mamalia. Akses ke halaman ini hanya untuk Supervisor, Veterinary dan Head of AWF.'
        ]);
        $diets = $get->Web()->create([
            'name' => 'Diet page',
            'slug' => 'diet-page',
            'route' => 'specific.diet',
            'scope' => 'Specific',
            'description' => 'Halaman Diet page merupakan halaman untuk menejemen informasi diet plan. Akses ke halaman ini hanya untuk Supervisor, Fishroom Veterinary dan Head of AWF.'
        ]);
        $pool = $get->web()->create([
            'name' => 'Pool page',
            'slug' => 'pool-page',
            'route' => 'super.admin.pool',
            'scope' => 'Super Admin',
            'description' => 'Halaman Pool menampilkan seluruh Pool yang tersedia didalam sistem. Akses ke halaman ini hanya untuk Super Admin'
        ]);
        $workorder = $get->web()->create([
            'name' => 'Work Order Page',
            'slug' => 'work-order-page',
            'route' => 'specific.work.order',
            'scope' => 'Specific',
            'description' => 'Halaman Work Order menampilkan seluruh Work Order yang tersedia didalam sistem. Akses ke halaman ini hanya untuk Super Admin, Supervisor dan Head of Division'
        ]);
        $mamal = $get->web()->create([
            'name' => 'Mamals page',
            'slug' => 'mamals-page',
            'route' => 'super.admin.mamal',
            'scope' => 'Super Admin',
            'description' => 'Halaman web yang menampilkan mamal yang tersedia pada sistem.'
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
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh data user pada sistem. Access ini hanya untuk Super Admin, Supervisor, Head of Division dan Admin HRD',
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
        $apipatchadditionaluser = $patch->api()->create([
            'name' => 'Update User Additional',
            'slug' => 'update-user-additional',
            'route' => 'super.admin.user.update.additional',
            'url' => '/user/{id}/additional',
            'scope' => 'Super Admin',
            'description' => 'Access untuk mengubah informasi rekening, ID BPJS Kesehatan dan ID BPJS Ketenagakerjaan user pada sistem berdasarkan ID user. Access fitur ini hanya untuk Super Admin',
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
            'route' => 'specific.basics.information.daily',
            'url' => '/basics',
            'scope' => 'Specific',
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
        $apibasicdone = $patch->api()->create([
            'name' => 'Daily Basic Information Done Status',
            'slug' => 'daily-basic-information-done-status',
            'route' => 'specific.basics.information.daily.done',
            'url' => '/basic/{id}/done',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk mengubah status basic information. Akses ke fitur ini hanya untuk Supervisor dan user level 3.',
        ]);
        $apipatchbasic = $patch->api()->create([
            'name' => 'Update Daily Basic Information',
            'slug' => 'update-daily-basic-information',
            'route' => 'specific.basics.information.daily.update',
            'url' => '/basic/{id}',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk mengubah information basic information. Akses ke fitur ini hanya untuk Supervisor.',
        ]);
        $apideletebasic = $delete->api()->create([
            'name' => 'Delete Daily Basic Information',
            'slug' => 'delete-daily-basic-information',
            'route' => 'specific.basics.information.daily.delete',
            'url' => '/basic/{id}',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk menghapus basic information. Akses ke fitur ini hanya untuk Supervisor.',
        ]);

        $apipatrols = $get->api()->create([
            'name' => 'Access Daily Patrol',
            'slug' => 'access-daily-patrol',
            'route' => 'specific.patrol.index',
            'url' => '/patrols',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk memperoleh Daily Patrol yang telah dibuat oleh user pada divisi security. Akses fitur ini hanya untuk user Divisi Security selaku pemilik hak akses penuh dan Supervisor selaku penanggung jawab.',
        ]);
        $apipatrolcreate = $post->api()->create([
            'name' => 'New Daily Patrol',
            'slug' => 'new-daily-patrol',
            'route' => 'specific.patrol.store',
            'url' => '/patrol',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat Daily Patrol oleh user pada divisi security. Akses fitur ini hanya untuk user divisi Security.',
        ]);
        $apipatrolbasic = $get->api()->create([
            'name' => 'Access Show Daily Patrol Today',
            'slug' => 'access-show-daily-patrol-today',
            'route' => 'specific.patrol.show',
            'url' => '/patrol/{basic}',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk memperoleh Daily Patrol berdasarkan ID Basic Information yang telah dibuat oleh user pada divisi security dan atau facility. Akses fitur ini hanya untuk user Divisi Security dan atau Facility.',
        ]);
        $apipatchpatrol = $patch->api()->create([
            'name' => 'Update Patrol',
            'slug' => 'update-patrol',
            'route' => 'specific.patrol.update',
            'url' => '/patrol/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui patrol berdasarkan ID. Akses ke fitur ini hanya untuk Security dan atau facility',
        ]);
        $apideletepatrol = $delete->api()->create([
            'name' => 'Delete Patrol',
            'slug' => 'delete-patrol',
            'route' => 'specific.patrol.delete',
            'url' => '/patrol/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus patrol berdasarkan ID. Akses ke fitur hanya untuk Supervisor.',
        ]);

        $apiincidents = $get->api()->create([
            'name' => 'Access Incidents',
            'slug' => 'access-incidents',
            'route' => 'specific.incident.report.index',
            'url' => '/incidents',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk memperoleh Incidents report dari seluruh User. Akses fitur ini hanya untuk user level 2 dan 3.',
        ]);
        $apipostincident = $post->api()->create([
            'name' => 'New Incident',
            'slug' => 'new-incident',
            'route' => 'specific.incident.report.store',
            'url' => '/incident',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat report Incident baru pada sistem. Akses fitur ini hanya untuk user yang telah ditentukan.',
        ]);
        $apipatchincident = $patch->api()->create([
            'name' => 'Update Incident',
            'slug' => 'update-incident',
            'route' => 'specific.incident.report.update',
            'url' => '/incident/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui Incident berdasarkan ID. Akses ke fitur ini hanya untuk Supervisor',
        ]);
        $apideleteincident = $delete->api()->create([
            'name' => 'Delete Incident',
            'slug' => 'delete-incident',
            'route' => 'specific.incident.report.delete',
            'url' => '/incident/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus Incident berdasarkan ID. Akses ke fitur ini hanya untuk Supervisor',
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

        $apimethodebookings = $get->api()->create([
            'name' => 'Access Methode Bookings',
            'slug' => 'access-methode-bookings',
            'route' => 'super.admin.methode.booking.index',
            'url' => '/methodes',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh Methode Booking yang tersedia pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipostmethodebooking = $post->api()->create([
            'name' => 'New Methode Booking',
            'slug' => 'new-methode-booking',
            'route' => 'super.admin.methode.booking.store',
            'url' => '/methode',
            'scope' => 'Super Admin',
            'description' => 'Access untuk membuat Methode Booking baru pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchmethodebooking = $patch->api()->create([
            'name' => 'Update Methode Booking',
            'slug' => 'update-methode-booking',
            'route' => 'super.admin.methode.booking.update',
            'url' => '/methode/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui Methode Booking berdasarkan ID pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideletemethodebooking = $delete->api()->create([
            'name' => 'Delete Methode Booking',
            'slug' => 'delete-methode-booking',
            'route' => 'super.admin.methode.booking.delete',
            'url' => '/methode/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus Methode Booking berdasarkan ID pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);

        $apibookings = $get->api()->create([
            'name' => 'Access Bookings',
            'slug' => 'access-booking',
            'route' => 'specific.booking.index',
            'url' => '/bookings',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh jabatan tersedia pada sistem berdasarkan divisi yang telah ditentukan. Access fitur ini hanya untuk Super Admin',
        ]);
        $apipostbooking = $post->api()->create([
            'name' => 'New Booking',
            'slug' => 'new-booking',
            'route' => 'specific.booking.store',
            'url' => '/booking',
            'scope' => 'Specific',
            'description' => 'Access untuk menambah booking baru pada sistem. Access fitur ini hanya untuk user pada divisi Reservation.',
        ]);
        $apipatchbooking = $patch->api()->create([
            'name' => 'Update Booking',
            'slug' => 'update-booking',
            'route' => 'specific.booking.update',
            'url' => '/booking/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui booking berdasarkan ID pada sistem. Access fitur ini hanya untuk Supervisor dan Reservation.',
        ]);
        $apideletebooking = $delete->api()->create([
            'name' => 'Delete Booking',
            'slug' => 'delete-booking',
            'route' => 'specific.booking.delete',
            'url' => '/booking/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus booking berdasarkan ID posisi tersedia pada sistem. Access fitur ini hanya untuk supervisor',
        ]);

        $apilogistics = $get->api()->create([
            'name' => 'Access Logistics',
            'slug' => 'access-logistic',
            'route' => 'specific.logistic.index',
            'url' => '/logistics',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh Logistic pada sistem. Access fitur ini hanya untuk Supervisor, Security dan Admin Office',
        ]);
        $apipostlogistic = $post->api()->create([
            'name' => 'New Logistic',
            'slug' => 'new-logistic',
            'route' => 'specific.logistic.store',
            'url' => '/logistic',
            'scope' => 'Specific',
            'description' => 'Access untuk menambah logistic baru pada sistem. Access fitur ini hanya untuk user pada divisi Security dan Admin Office',
        ]);
        $apipatchlogistic = $patch->api()->create([
            'name' => 'Update Logistic',
            'slug' => 'update-logistic',
            'route' => 'specific.logistic.update',
            'url' => '/logistic/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui logistic berdasarkan ID pada sistem. Access fitur ini hanya untuk Supervisor, Securirty dan Admin Office.',
        ]);
        $apideletelogistic = $delete->api()->create([
            'name' => 'Delete Logistic',
            'slug' => 'delete-logistic',
            'route' => 'specific.logistic.delete',
            'url' => '/logistic/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus logistic berdasarkan ID pada sistem. Access fitur ini hanya untuk supervisor.',
        ]);

        $apideliveries = $get->api()->create([
            'name' => 'Access Deliveries',
            'slug' => 'access-delivery',
            'route' => 'specific.delivery.index',
            'url' => '/deliveries',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh Delivery pada sistem. Access fitur ini hanya untuk Supervisor dan Security.',
        ]);
        $apipostdelivery = $post->api()->create([
            'name' => 'New Delivery',
            'slug' => 'new-delivery',
            'route' => 'specific.security.delivery.store',
            'url' => '/delivery',
            'scope' => 'Specific',
            'description' => 'Access untuk menambah delivery baru pada sistem. Access fitur ini hanya untuk user pada divisi Security.',
        ]);
        $apipatchdelivery = $patch->api()->create([
            'name' => 'Update Delivery',
            'slug' => 'update-delivery',
            'route' => 'specific.security.delivery.update',
            'url' => '/delivery/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui delivery berdasarkan ID pada sistem. Access fitur ini hanya untuk Supervisor dan Securirty.',
        ]);
        $apideletedelivery = $delete->api()->create([
            'name' => 'Delete Delivery',
            'slug' => 'delete-delivery',
            'route' => 'specific.security.delivery.delete',
            'url' => '/delivery/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus delivery berdasarkan ID pada sistem. Access fitur ini hanya untuk supervisor',
        ]);

        $apisales = $get->api()->create([
            'name' => 'Access Sales',
            'slug' => 'access-sales',
            'route' => 'specific.sales.index',
            'url' => '/sales',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh Sales pada sistem. Access fitur ini hanya untuk Supervisor, Cashier, Host, AWF dan Photographer.',
        ]);
        $apipostsales = $post->api()->create([
            'name' => 'New Sales',
            'slug' => 'new-sales',
            'route' => 'specific.sales.store',
            'url' => '/sale',
            'scope' => 'Specific',
            'description' => 'Access untuk menambah Sales baru pada sistem. Access fitur ini hanya untuk user pada divisi Cashier, Host, AWF dan Photographer.',
        ]);
        $apipatchsales = $patch->api()->create([
            'name' => 'Update Sales',
            'slug' => 'update-sales',
            'route' => 'specific.sales.update',
            'url' => '/sale/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui Sales berdasarkan ID pada sistem. Access fitur ini hanya untuk Supervisor, Cashier, Host, AWF dan Photographer.',
        ]);
        $apideletesales = $delete->api()->create([
            'name' => 'Delete Sales',
            'slug' => 'delete-sales',
            'route' => 'specific.sales.delete',
            'url' => '/sale/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus Sales berdasarkan ID pada sistem. Access fitur ini hanya untuk supervisor',
        ]);

        $apiconsumption = $get->api()->create([
            'name' => 'Access Consumption',
            'slug' => 'access-consumption',
            'route' => 'specific.consumption.index',
            'url' => '/consumptions',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh Consumptions pada sistem. Access fitur ini hanya untuk Supervisor dan Fishroom',
        ]);
        $apipostconsumption = $post->api()->create([
            'name' => 'New Consumption',
            'slug' => 'new-consumption',
            'route' => 'specific.fishroom.consumption.store',
            'url' => '/consumption',
            'scope' => 'Specific',
            'description' => 'Access untuk menambah Consumption baru pada sistem. Access fitur ini hanya untuk user pada divisi Fishroom',
        ]);
        $apipatchconsumption = $patch->api()->create([
            'name' => 'Update Consumption',
            'slug' => 'update-consumption',
            'route' => 'specific.fishroom.consumption.update',
            'url' => '/consumption/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui Consumption berdasarkan ID pada sistem. Access fitur ini hanya untuk Supervisor dan Fishroom.',
        ]);
        $apideleteconsumption = $delete->api()->create([
            'name' => 'Delete Consumption',
            'slug' => 'delete-consumption',
            'route' => 'specific.fishroom.consumption.delete',
            'url' => '/consumption/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus Consumption berdasarkan ID pada sistem. Access fitur ini hanya untuk supervisor',
        ]);

        $apihealthcheck = $get->api()->create([
            'name' => 'Access Health Check',
            'slug' => 'access-healthcheck',
            'route' => 'specific.healthcheck.index',
            'url' => '/healthchecks',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh Health Check pada sistem. Access fitur ini hanya untuk Supervisor dan Veterinary.',
        ]);
        $apiposthealthcheck = $post->api()->create([
            'name' => 'New Health Check',
            'slug' => 'new-health-check',
            'route' => 'specific.veterinary.healthcheck.store',
            'url' => '/healthcheck',
            'scope' => 'Specific',
            'description' => 'Access untuk menambah Health Check baru pada sistem. Access fitur ini hanya untuk user pada divisi Veterinary.',
        ]);
        $apipatchhealthcheck = $patch->api()->create([
            'name' => 'Update Health Check',
            'slug' => 'update-health-check',
            'route' => 'specific.veterinary.healthcheck.update',
            'url' => '/healthcheck/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui Health Check berdasarkan ID pada sistem. Access fitur ini hanya untuk Veterinary.',
        ]);
        $apideletehealthcheck = $delete->api()->create([
            'name' => 'Delete Health Check',
            'slug' => 'delete-health-check',
            'route' => 'specific.veterinary.healthcheck.delete',
            'url' => '/healthcheck/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus health Check berdasarkan ID pada sistem. Access fitur ini hanya untuk supervisor.',
        ]);

        $apiwaterqualities = $get->api()->create([
            'name' => 'Access Water Qualities',
            'slug' => 'access-water-qualities',
            'route' => 'specific.waterquality.index',
            'url' => '/waterqualities',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh Water Quality pada sistem. Access fitur ini hanya untuk Supervisor dan Sustainable.',
        ]);
        $apipostwaterquality = $post->api()->create([
            'name' => 'New Water Quality',
            'slug' => 'new-water-quality',
            'route' => 'specific.sustainable.waterquality.store',
            'url' => '/waterquality',
            'scope' => 'Specific',
            'description' => 'Access untuk menambah Water Quality baru pada sistem. Access fitur ini hanya untuk user pada divisi Sustainable.',
        ]);
        $apipatchwaterquality = $patch->api()->create([
            'name' => 'Update Water Quality',
            'slug' => 'update-water-quality',
            'route' => 'specific.sustainable.waterquality.update',
            'url' => '/waterquality/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui Water Quality berdasarkan ID pada sistem. Access fitur ini hanya untuk Sustainable.',
        ]);
        $apideletewaterquality = $delete->api()->create([
            'name' => 'Delete Water Quality',
            'slug' => 'delete-water-quality',
            'route' => 'specific.sustainable.waterquality.delete',
            'url' => '/waterquality/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus Water Quality berdasarkan ID pada sistem. Access fitur ini hanya untuk Supervisor.',
        ]);

        $apipoolarea = $get->api()->create([
            'name' => 'Access Pool Area',
            'slug' => 'access-pool-area',
            'route' => 'specific.poolarea.index',
            'url' => '/poolareas',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh Pool & Area pada sistem. Access fitur ini hanya untuk Supervisor dan Trainer.',
        ]);
        $apipostpoolarea = $post->api()->create([
            'name' => 'New Pool Area',
            'slug' => 'new-pool-area',
            'route' => 'specific.trainer.poolarea.store',
            'url' => '/poolarea',
            'scope' => 'Specific',
            'description' => 'Access untuk menambah Pool & Area baru pada sistem. Access fitur ini hanya untuk user pada divisi Trainer.',
        ]);
        $apipatchpoolarea = $patch->api()->create([
            'name' => 'Update Pool Area',
            'slug' => 'update-pool-area',
            'route' => 'specific.trainer.poolarea.update',
            'url' => '/poolarea/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui Pool & Area berdasarkan ID pada sistem. Access fitur ini hanya untuk Trainer.',
        ]);
        $apideletepoolarea = $delete->api()->create([
            'name' => 'Delete Pool Area',
            'slug' => 'delete-pool-area',
            'route' => 'specific.trainer.poolarea.delete',
            'url' => '/poolarea/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus Pool & Area berdasarkan ID pada sistem. Access fitur ini hanya untuk Supervisor.',
        ]);

        $apiaccessprogram = $get->api()->create([
            'name' => 'Access Program',
            'slug' => 'access-program',
            'route' => 'super.admin.program.index',
            'url' => '/programs',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua Program inti yang tersedia pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipostprogram = $post->api()->create([
            'name' => 'New Program',
            'slug' => 'new-program',
            'route' => 'super.admin.program.store',
            'url' => '/program',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan program inti baru pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchprogram = $patch->api()->create([
            'name' => 'Update Program',
            'slug' => 'update-program',
            'route' => 'super.admin.program.update',
            'url' => '/program/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui program inti baru pada sistem berdasarkan parameter ID Program. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideleteprogram = $delete->api()->create([
            'name' => 'Delete Program',
            'slug' => 'delete-program',
            'route' => 'super.admin.program.delete',
            'url' => '/program/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus program inti baru pada sistem berdasarkan parameter ID Program. Akses ke fitur ini hanya untuk Super Admin',
        ]);

        $apiaccessprogramcategories = $get->api()->create([
            'name' => 'Access Program Categories',
            'slug' => 'access-program-categories',
            'route' => 'super.admin.program.category.index',
            'url' => '/programcategories',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua Program Category yang tersedia pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipostprogramcategory = $post->api()->create([
            'name' => 'New Program Category',
            'slug' => 'new-program-category',
            'route' => 'super.admin.program.category.store',
            'url' => '/programcategory',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan Program Category inti baru pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchprogramcategory = $patch->api()->create([
            'name' => 'Update Program Category',
            'slug' => 'update-program-category',
            'route' => 'super.admin.program.category.update',
            'url' => '/programcategory/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui Program Category inti baru pada sistem berdasarkan parameter ID Program. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideleteprogramcategory = $delete->api()->create([
            'name' => 'Delete Program Category',
            'slug' => 'delete-program-category',
            'route' => 'super.admin.program.category.delete',
            'url' => '/programcategory/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus Program Category inti baru pada sistem berdasarkan parameter ID Program. Akses ke fitur ini hanya untuk Super Admin',
        ]);

        $apicontract = $get->api()->create([
            'name' => 'Access Contract User',
            'slug' => 'access-contract-user',
            'route' => 'user.contract.index',
            'url' => '/user/{id}/contract',
            'scope' => 'General',
            'description' => 'Access fitur untuk memperoleh informasi kontrak pengguna berdasarkan ID user. Akses fitur ini untuk seluruh user',
        ]);
        $apipostcontractuser = $post->api()->create([
            'name' => 'New User Contract',
            'slug' => 'new-user-contract',
            'route' => 'user.contract.store',
            'url' => '/user/{id}/contract',
            'scope' => 'Specific',
            'description' => 'Access fitur untuk membuat kontrak baru pada sistem berdasarkan ID user. Akses fitur ini hanya untuk Admin HR.',
        ]);
        $apipatchcontractuser = $patch->api()->create([
            'name' => 'Update User Contract',
            'slug' => 'update-user-contract',
            'route' => 'user.contract.update',
            'url' => '/user/contract/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui kontrak user berdasarkan ID kontrak. Akses ke fitur ini hanya untuk Admin HR',
        ]);
        $apideletecontractuser = $delete->api()->create([
            'name' => 'Delete User Contract',
            'slug' => 'delete-user-contract',
            'route' => 'user.contract.delete',
            'url' => '/user/contract/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus kontrak user berdasarkan ID kontrak. Akses ke fitur ini hanya untuk Admin HR',
        ]);

        $apiuserdownloadpdf = $get->api()->create([
            'name' => 'Download User PDF',
            'slug' => 'download-user-pdf',
            'route' => 'user.download.pdf',
            'url' => '/user/{id}/pdf',
            'scope' => 'Specific',
            'description' => 'Access untuk mengunduh kontrak user berdasarkan ID dalam bentuk PDF. Akses ke fitur ini hanya untuk Admin HR',
        ]);
        $apiuseralldownloadpdf = $get->api()->create([
            'name' => 'Download All User PDF',
            'slug' => 'download-all-user-pdf',
            'route' => 'user.all.download.pdf',
            'url' => '/user/pdf',
            'scope' => 'Specific',
            'description' => 'Access untuk mengunduh all data user dalam bentuk PDF. Akses ke fitur ini hanya untuk Admin HR',
        ]);

        $apiaccesscontracts = $get->api()->create([
            'name' => 'Access Contract',
            'slug' => 'access-contract',
            'route' => 'super.admin.contract.index',
            'url' => '/contracts',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua Program Contract yang tersedia pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipostcontract = $post->api()->create([
            'name' => 'New Contract',
            'slug' => 'new-contract',
            'route' => 'super.admin.contract.store',
            'url' => '/contract',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan Contract baru pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchcontract = $patch->api()->create([
            'name' => 'Update Contract',
            'slug' => 'update-contract',
            'route' => 'super.admin.contract.update',
            'url' => '/contract/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui Contract pada sistem berdasarkan parameter ID Contract. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideletecontract = $delete->api()->create([
            'name' => 'Delete Contract',
            'slug' => 'delete-contract',
            'route' => 'super.admin.contract.delete',
            'url' => '/contract/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus Contract pada sistem berdasarkan parameter ID Contract. Akses ke fitur ini hanya untuk Super Admin',
        ]);

        $apiaccessorder = $get->api()->create([
            'name' => 'Access Order',
            'slug' => 'access-order',
            'route' => 'specific.order.index',
            'url' => '/orders',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh semua Order yang tersedia pada sistem. Akses ke fitur ini hanya untuk Supervisor dan Head of Division',
        ]);
        $apipostorder = $post->api()->create([
            'name' => 'New Order',
            'slug' => 'new-order',
            'route' => 'specific.order.store',
            'url' => '/order',
            'scope' => 'Specific',
            'description' => 'Access untuk menambahkan Order baru pada sistem. Akses ke fitur ini hanya untuk Head of Division',
        ]);
        $apipatchorder = $patch->api()->create([
            'name' => 'Update Order',
            'slug' => 'update-order',
            'route' => 'specific.order.update',
            'url' => '/order/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui Order pada sistem berdasarkan parameter ID Order. Akses ke fitur ini hanya untuk Supervisor.',
        ]);
        $apideleteorder = $delete->api()->create([
            'name' => 'Delete Order',
            'slug' => 'delete-order',
            'route' => 'specific.order.destroy',
            'url' => '/order/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus Order pada sistem berdasarkan parameter ID Order. Akses ke fitur ini hanya untuk Supervisor.',
        ]);
        $apiconfirmorder = $patch->api()->create([
            'name' => 'Confirm Order',
            'slug' => 'confirm-order',
            'route' => 'specific.order.confirm',
            'url' => '/order/{id}/confirm',
            'scope' => 'Specific',
            'description' => 'Access untuk mengkonfirmasi Order pada sistem berdasarkan parameter ID Order. Akses ke fitur ini hanya untuk Supervisor.',
        ]);
        $apiarriveorder = $patch->api()->create([
            'name' => 'Arrive Order',
            'slug' => 'arrive-order',
            'route' => 'specific.order.arrived',
            'url' => '/order/{id}/arrived',
            'scope' => 'Specific',
            'description' => 'Access untuk mengkonfirmasi ulang Order pada sistem berdasarkan parameter ID Order (apabila barang sudah sampai). Akses ke fitur ini hanya untuk Admin Inventory.',
        ]);

        $apiaccessnotification = $get->api()->create([
            'name' => 'Access Notifications',
            'slug' => 'access-notifications',
            'route' => 'general.notification.index',
            'url' => '/notifications',
            'scope' => 'General',
            'description' => 'Access untuk memperoleh semua Notification yang tersedia pada sistem. Akses ke fitur ini hanya untuk Supervisor dan Head of Division',
        ]);
        $apipostnotification = $post->api()->create([
            'name' => 'New Notification',
            'slug' => 'new-notification',
            'route' => 'specific.notification.store',
            'url' => '/notification',
            'scope' => 'Specific',
            'description' => 'Access untuk menambahkan Notification baru pada sistem. Akses ke fitur ini hanya untuk Super Admin, HRD dan Head of Division',
        ]);
        $apipatchnotification = $patch->api()->create([
            'name' => 'Update Notification',
            'slug' => 'update-notification',
            'route' => 'specific.notification.update',
            'url' => '/notification/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui Notification pada sistem berdasarkan parameter ID Notification. Akses ke fitur ini hanya untuk Super Admin, HRD dan Head of Division',
        ]);
        $apideletenotification = $delete->api()->create([
            'name' => 'Delete Notification',
            'slug' => 'delete-notification',
            'route' => 'specific.notification.delete',
            'url' => '/notification/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus Notification pada sistem berdasarkan parameter ID Notification. Akses ke fitur ini hanya untuk Super Admin, HRD dan Head of Division',
        ]);

        $apiaccessmamalreport = $get->api()->create([
            'name' => 'Access Mammal Reports',
            'slug' => 'access-mammal-reports',
            'route' => 'specific.mammal.report.index',
            'url' => '/mammalreports',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh semua laporan Mammal yang tersedia pada sistem. Akses ke fitur ini hanya untuk Supervisor dan Divisi AWF',
        ]);
        $apipostmamalreport = $post->api()->create([
            'name' => 'New Mammal Report',
            'slug' => 'new-mammal-report',
            'route' => 'specific.mammal.report.store',
            'url' => '/mammalreport',
            'scope' => 'Specific',
            'description' => 'Access untuk menambahkan laporan Mammal baru pada sistem. Akses ke fitur ini hanya Head of AWF ( TRAINER ) dan Staff AWF.',
        ]);
        $apipatchmamalreport = $patch->api()->create([
            'name' => 'Update Mammal Report',
            'slug' => 'update-mammal-report',
            'route' => 'specific.mammal.report.update',
            'url' => '/mammalreport/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui laporan Mammal pada sistem berdasarkan parameter ID Mammal report. Akses ke fitur ini hanya Head of AWF ( TRAINER ) dan Staff AWF.',
        ]);
        $apideletemamalreport = $delete->api()->create([
            'name' => 'Delete Mammal Report',
            'slug' => 'delete-mammal-report',
            'route' => 'specific.mammal.report.delete',
            'url' => '/mammalreport/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus laporan Mammal pada sistem berdasarkan parameter ID Mammal report. Akses ke fitur ini hanya Head of AWF ( TRAINER ) dan Staff AWF.',
        ]);
        $apipostmamalreportvet = $post->api()->create([
            'name' => 'New Mammal Report Veterinary',
            'slug' => 'new-mammal-report-veterinary',
            'route' => 'specific.mammal.report.vet.store',
            'url' => '/mammalreport/{id}/vet',
            'scope' => 'Specific',
            'description' => 'Access untuk menambahkan laporan Mammal Veterinary baru pada sistem. Akses ke fitur ini hanya Veterinary.',
        ]);
        $apipatchmamalreportvet = $patch->api()->create([
            'name' => 'Update Mammal Report Veterinary',
            'slug' => 'update-mammal-report-veterinary',
            'route' => 'specific.mammal.report.vet.update',
            'url' => '/mammalreport/{id}/vet',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui laporan Mammal Veterinary pada sistem berdasarkan parameter ID Mammal report. Akses ke fitur ini hanya Veterinary.',
        ]);

        $apiaccessdiet = $get->api()->create([
            'name' => 'Access Diets',
            'slug' => 'access-diets',
            'route' => 'specific.diet.index',
            'url' => '/diets',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh semua laporan Diet yang tersedia pada sistem. Akses ke fitur ini hanya untuk Supervisor Head of AWF, Fishroom dan Veterinary',
        ]);
        $apipostdiet = $post->api()->create([
            'name' => 'New Diet Report',
            'slug' => 'new-diet-report',
            'route' => 'specific.diet.store',
            'url' => '/diet',
            'scope' => 'Specific',
            'description' => 'Access untuk menambahkan laporan Diet baru pada sistem. Akses ke fitur ini hanya Fishroom',
        ]);
        $apipatchdiet = $patch->api()->create([
            'name' => 'Update Diet Report',
            'slug' => 'update-diet-report',
            'route' => 'specific.diet.update',
            'url' => '/diet/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui laporan Diet pada sistem berdasarkan parameter ID Diet. Akses ke fitur ini hanya untuk Fishroom',
        ]);
        $apideletediet = $delete->api()->create([
            'name' => 'Delete Diet Report',
            'slug' => 'delete-diet-report',
            'route' => 'specific.diet.destroy',
            'url' => '/diet/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus laporan Diet pada sistem berdasarkan parameter ID Diet. Akses ke fitur ini hanya untuk Fishroom',
        ]);
        $apipatchdietapprove = $patch->api()->create([
            'name' => 'Approve Diet Report',
            'slug' => 'approve-diet-report',
            'route' => 'specific.diet.approve',
            'url' => '/diet/{id}/approve',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui approve laporan Diet pada sistem berdasarkan parameter ID Diet. Akses ke fitur ini hanya untuk Veterinary',
        ]);
        $apipatchdietexecute = $patch->api()->create([
            'name' => 'Execute Diet Report',
            'slug' => 'execute-diet-report',
            'route' => 'specific.diet.execute',
            'url' => '/diet/{id}/execute',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui execute laporan Diet pada sistem berdasarkan parameter ID Diet. Akses ke fitur ini hanya untuk Head of AWF',
        ]);

        $apiaccpool = $get->api()->create([
            'name' => 'Access Pools',
            'slug' => 'access-pools',
            'route' => 'super.admin.pool.index',
            'url' => '/pools',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua pool yang tersedia pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipostpool = $post->api()->create([
            'name' => 'New Mammal Pool',
            'slug' => 'new-mammal-pool',
            'route' => 'super.admin.pool.store',
            'url' => '/pool',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan pool baru pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchpool = $patch->api()->create([
            'name' => 'Update Mammal Pool',
            'slug' => 'update-mammal-pool',
            'route' => 'super.admin.pool.update',
            'url' => '/pool/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui pool pada sistem berdasarkan parameter ID pool. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideletepool = $delete->api()->create([
            'name' => 'Delete Mammal Pool',
            'slug' => 'delete-mammal-pool',
            'route' => 'super.admin.pool.delete',
            'url' => '/pool/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus pool pada sistem berdasarkan parameter ID Mammal. Akses ke fitur ini hanya untuk Super Admin',
        ]);

        $apiaccessworkorder = $get->api()->create([
            'name' => 'Access Work Orders',
            'slug' => 'access-work-orders',
            'route' => 'specific.work.order.index',
            'url' => '/workorders',
            'scope' => 'Specific',
            'description' => 'Access untuk memperoleh semua Work Order yang tersedia pada sistem. Akses ke fitur ini hanya untuk Supervisor, Super Admin dan Head of Division',
        ]);
        $apipostworkorder = $post->api()->create([
            'name' => 'New Work Order',
            'slug' => 'new-work-order',
            'route' => 'specific.work.order.store',
            'url' => '/workorder',
            'scope' => 'Specific',
            'description' => 'Access untuk menambahkan Work Order baru pada sistem. Akses ke fitur ini hanya untuk Head of Division',
        ]);
        $apipatchworkorder = $patch->api()->create([
            'name' => 'Update-work-order',
            'slug' => 'update-work-order',
            'route' => 'specific.work.order.update',
            'url' => '/workorder/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk memperbarui Work Order pada sistem berdasarkan parameter ID Work Order. Akses ke fitur ini hanya untuk Head of Division',
        ]);
        $apiconfirmworkorder = $patch->api()->create([
            'name' => 'Confirm Work Order',
            'slug' => 'confirm-work-order',
            'route' => 'specific.work.order.confirm',
            'url' => '/workorder/{id}/confirm',
            'scope' => 'Specific',
            'description' => 'Access untuk mengkonfirmasi Work Order pada sistem berdasarkan parameter ID work order. Akses ke fitur ini hanya untuk Supervisor',
        ]);
        $apideleteworkorder = $delete->api()->create([
            'name' => 'Delete Work Order',
            'slug' => 'delete-work-order',
            'route' => 'specific.work.order.delete',
            'url' => '/workorder/{id}',
            'scope' => 'Specific',
            'description' => 'Access untuk menghapus Work Order pada sistem berdasarkan parameter ID Work Order. Akses ke fitur ini hanya untuk Supervisor dan Head of Division',
        ]);

        $apiaccessmamal = $get->api()->create([
            'name' => 'Access Mammals',
            'slug' => 'access-mamals',
            'route' => 'super.admin.mamal.index',
            'url' => '/mammals',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperoleh semua mammal yang tersedia pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipostmamal = $post->api()->create([
            'name' => 'New Mammal',
            'slug' => 'new-mammal',
            'route' => 'super.admin.mamal.store',
            'url' => '/mammal',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menambahkan mammal baru pada sistem. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apipatchmamal = $patch->api()->create([
            'name' => 'Update Mammal',
            'slug' => 'update-mammal',
            'route' => 'super.admin.mamal.update',
            'url' => '/mammal/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk memperbarui mammal berdasarkan parameter ID mammal. Akses ke fitur ini hanya untuk Super Admin',
        ]);
        $apideletemamal = $delete->api()->create([
            'name' => 'Delete Mammal',
            'slug' => 'delete-mammal',
            'route' => 'super.admin.mamal.delete',
            'url' => '/mammal/{id}',
            'scope' => 'Super Admin',
            'description' => 'Access untuk menghapus mammal berdasarkan parameter ID mammal. Akses ke fitur ini hanya untuk Super Admin',
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
        $morning = $fulltime->time()->create([
            'name' => 'Full Time Morning',
            'slug' => 'full-time-morning',
            'start' => '08:00',
            'end' => '16:00',
            'break_start' => '12:00',
            'break_end' => '13:00'
        ]);
        $afternoon = $fulltime->time()->create([
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
            'web_id' => $reschedule->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $supplier->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $questionpage->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $bookingmethode->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $program->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $programcategory->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $contract->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $notification->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $pool->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $workorder->id,
        ]);
        $headsuperadmin->web()->create([
            'web_id' => $mamal->id,
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
            'api_id' => $apipatchadditionaluser->id,
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
        $headsuperadmin->api()->create([
            'api_id' => $apimethodebookings->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostmethodebooking->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchmethodebooking->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletemethodebooking->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiaccessprogram->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostprogram->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchprogram->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideleteprogram->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiaccessprogramcategories->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostprogramcategory->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchprogramcategory->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideleteprogramcategory->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiuserdownloadpdf->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiuseralldownloadpdf->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiaccesscontracts->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostcontract->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchcontract->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletecontract->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostcontractuser->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchcontractuser->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletecontractuser->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiaccpool->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostpool->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchpool->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletepool->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apiaccessmamal->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipostmamal->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apipatchmamal->id,
        ]);
        $headsuperadmin->api()->create([
            'api_id' => $apideletemamal->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $incident->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $booking->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $logistics->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $delivery->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $sales->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $consumption->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $healthcheck->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $waterquality->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $poolarea->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $order->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $notification->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $mammalsreport->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $diets->id,
        ]);
        $headsupervisor->web()->create([
            'web_id' => $workorder->id,
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
        $headsupervisor->api()->create([
            'api_id' => $apibasicdone->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apipatchbasic->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideletebasic->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apipatchincident->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideleteincident->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideletebooking->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apipatchbooking->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apibookings->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apipatrols->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideletepatrol->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apilogistics->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideletelogistic->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideliveries->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideletedelivery->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apisales->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideletesales->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiconsumption->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideleteconsumption->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apihealthcheck->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideletehealthcheck->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiwaterqualities->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideletewaterquality->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apipoolarea->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideletepoolarea->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiconfirmorder->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideleteorder->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiaccessmamalreport->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiaccessdiet->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apiconfirmworkorder->id,
        ]);
        $headsupervisor->api()->create([
            'api_id' => $apideleteworkorder->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $booking->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $logistics->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $delivery->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $sales->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $consumption->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $healthcheck->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $waterquality->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $poolarea->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $order->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $notification->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $mammalsreport->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $diets->id,
        ]);
        $staffsupervisor->web()->create([
            'web_id' => $workorder->id,
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
        $staffsupervisor->api()->create([
            'api_id' => $apibasicdone->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apipatchbasic->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideletebasic->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apipatchincident->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideleteincident->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideletebooking->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apipatchbooking->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apibookings->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apipatrols->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideletepatrol->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apilogistics->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideletelogistic->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideliveries->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideletedelivery->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apisales->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideletesales->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiconsumption->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideleteconsumption->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apihealthcheck->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideletehealthcheck->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiwaterqualities->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideletewaterquality->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apipoolarea->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideletepoolarea->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiconfirmorder->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideleteorder->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiaccessmamalreport->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiaccessdiet->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apiconfirmworkorder->id,
        ]);
        $staffsupervisor->api()->create([
            'api_id' => $apideleteworkorder->id,
        ]);

        //KITCHEN
        $kitchen = $level3->division()->create([
            'name' => 'Kitchen',
            'slug' => 'kitchen',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $kitchen->unit()->create([
            'unit_id' => $BH->id
        ]);
        $kitchen->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 1
        ]);
        $kitchen->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 0
        ]);
        $headkitchen = DivisionPosition::create([
            'name' => 'Head of Kitchen',
            'slug' => 'head-of-kitchen',
            'position_id' => $head->id,
            'division_id' => $kitchen->id
        ]);
        $headkitchen->web()->create([
            'web_id' => $dashboard->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $profile->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $userDetail->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $schedule->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $basicDetail->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $incident->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $sales->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $order->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $notification->id,
        ]);
        $headkitchen->web()->create([
            'web_id' => $workorder->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apischedulecreate->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apibasicdone->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apipostworkorder->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apipatchworkorder->id,
        ]);
        $headkitchen->api()->create([
            'api_id' => $apideleteworkorder->id,
        ]);
        $staffkitchen = DivisionPosition::create([
            'name' => 'Staff of Kitchen',
            'slug' => 'staff-of-kitchen',
            'position_id' => $staff->id,
            'division_id' => $kitchen->id
        ]);
        $staffkitchen->web()->create([
            'web_id' => $dashboard->id
        ]);
        $staffkitchen->web()->create([
            'web_id' => $profile->id,
        ]);
        $staffkitchen->web()->create([
            'web_id' => $schedule->id,
        ]);
        $staffkitchen->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffkitchen->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $staffkitchen->web()->create([
            'web_id' => $basicDetail->id,
        ]);
        $staffkitchen->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffkitchen->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffkitchen->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffkitchen->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apibasicdone->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffkitchen->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);

        //RESERVATION
        $reservation = $level3->division()->create([
            'name' => 'Reservation / Cashier',
            'slug' => 'reservation-cashier',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $reservation->unit()->create([
            'unit_id' => $FH->id
        ]);
        $workreservation = $reservation->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $offreservation = $reservation->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 0
        ]);
        $headreservation = DivisionPosition::create([
            'name' => 'Head of Reservation / Cashier',
            'slug' => 'head-of-reservation-cashier-cashier',
            'position_id' => $head->id,
            'division_id' => $reservation->id
        ]);
        $staffreservation = DivisionPosition::create([
            'name' => 'Staff of Reservation',
            'slug' => 'staff-of-reservation',
            'position_id' => $staff->id,
            'division_id' => $reservation->id
        ]);
        $staffcashier = DivisionPosition::create([
            'name' => 'Staff of Cashier',
            'slug' => 'staff-of-cashier',
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
            'web_id' => $basicDetail->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $incident->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $booking->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $order->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $notification->id,
        ]);
        $headreservation->web()->create([
            'web_id' => $workorder->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apipatchbooking->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apibookings->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apipostbooking->id,
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
        $headreservation->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apipostworkorder->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apipatchworkorder->id,
        ]);
        $headreservation->api()->create([
            'api_id' => $apideleteworkorder->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $booking->id,
        ]);
        $staffreservation->web()->create([
            'web_id' => $userConteact->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apipatchbooking->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apibookings->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apipostbooking->id,
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
        $staffreservation->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffreservation->api()->create([
            'api_id' => $apiaccessnotification->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $staffcashier->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffcashier->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffcashier->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffcashier->web()->create([
            'web_id' => $userConteact->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apipostincident->id,
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
        $staffcashier->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffcashier->api()->create([
            'api_id' => $apiaccessnotification->id,
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
        $workged = $ged->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 1
        ]);
        $offged = $ged->worktime()->create([
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
            'web_id' => $basicDetail->id,
        ]);
        $headged->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headged->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headged->web()->create([
            'web_id' => $incident->id,
        ]);
        $headged->web()->create([
            'web_id' => $sales->id,
        ]);
        $headged->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headged->web()->create([
            'web_id' => $order->id,
        ]);
        $headged->web()->create([
            'web_id' => $notification->id,
        ]);
        $headged->web()->create([
            'web_id' => $workorder->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $headged->api()->create([
            'api_id' => $apipostincident->id,
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
        $headged->api()->create([
            'api_id' => $apisales->id,
        ]);
        $headged->api()->create([
            'api_id' => $apipostsales->id,
        ]);
        $headged->api()->create([
            'api_id' => $apipatchsales->id,
        ]);
        $headged->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headged->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headged->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headged->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $headged->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headged->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headged->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headged->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headged->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headged->api()->create([
            'api_id' => $apipostworkorder->id,
        ]);
        $headged->api()->create([
            'api_id' => $apipatchworkorder->id,
        ]);
        $headged->api()->create([
            'api_id' => $apideleteworkorder->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $staffged->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffged->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffged->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffged->web()->create([
            'web_id' => $sales->id,
        ]);
        $staffged->web()->create([
            'web_id' => $userConteact->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apipostincident->id,
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
        $staffged->api()->create([
            'api_id' => $apisales->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apipostsales->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apipatchsales->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffged->api()->create([
            'api_id' => $apiaccessnotification->id,
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
        $workmm = $mm->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $offmm = $mm->worktime()->create([
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
            'position_id' => $staff->id,
            'division_id' => $mm->id
        ]);
        $staffmultimedia = DivisionPosition::create([
            'name' => 'Staff of Multimedia',
            'slug' => 'staff-of-multimedia',
            'position_id' => $staff->id,
            'division_id' => $mm->id
        ]);
        $photographer = DivisionPosition::create([
            'name' => 'Photographer',
            'slug' => 'Photographer',
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
            'web_id' => $basicDetail->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $incident->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $order->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $notification->id,
        ]);
        $headmultimedia->web()->create([
            'web_id' => $workorder->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apipostincident->id,
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
        $headmultimedia->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apipostworkorder->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apipatchworkorder->id,
        ]);
        $headmultimedia->api()->create([
            'api_id' => $apideleteworkorder->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $headretail->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headretail->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headretail->web()->create([
            'web_id' => $incident->id,
        ]);
        $headretail->web()->create([
            'web_id' => $userConteact->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apipostincident->id,
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
        $headretail->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headretail->api()->create([
            'api_id' => $apiaccessnotification->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffmultimedia->web()->create([
            'web_id' => $userConteact->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apipostincident->id,
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
        $staffmultimedia->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffmultimedia->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $photographer->web()->create([
            'web_id' => $dashboard->id
        ]);
        $photographer->web()->create([
            'web_id' => $profile->id,
        ]);
        $photographer->web()->create([
            'web_id' => $schedule->id,
        ]);
        $photographer->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $photographer->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $photographer->web()->create([
            'web_id' => $basicDetail->id,
        ]);
        $photographer->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $photographer->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $photographer->web()->create([
            'web_id' => $incident->id,
        ]);
        $photographer->web()->create([
            'web_id' => $sales->id,
        ]);
        $photographer->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apibasicdone->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apisales->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apipostsales->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apipatchsales->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $photographer->api()->create([
            'api_id' => $apiaccessnotification->id,
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
        $workmarketing = $marketing->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $offmarketing = $marketing->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 0
        ]);
        $headmarketing = DivisionPosition::create([
            'name' => 'Head of Marketing',
            'slug' => 'head-of-marketing',
            'position_id' => $head->id,
            'division_id' => $marketing->id
        ]);
        $staffmarketing = DivisionPosition::create([
            'name' => 'Staff of Marketing',
            'slug' => 'staff-of-marketing',
            'position_id' => $staff->id,
            'division_id' => $marketing->id
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
            'web_id' => $basicDetail->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $incident->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $order->id,
        ]);
        $headmarketing->web()->create([
            'web_id' => $workorder->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apipostincident->id,
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
        $headmarketing->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apipostworkorder->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apipatchworkorder->id,
        ]);
        $headmarketing->api()->create([
            'api_id' => $apideleteworkorder->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffmarketing->web()->create([
            'web_id' => $userConteact->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apipostincident->id,
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
        $staffmarketing->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffmarketing->api()->create([
            'api_id' => $apiaccessnotification->id,
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
        $workawf = $awf->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 1
        ]);
        $offawf = $awf->worktime()->create([
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
            'position_id' => $staff->id,
            'division_id' => $awf->id
        ]);
        $habitat = DivisionPosition::create([
            'name' => 'Habitat',
            'slug' => 'habitat',
            'position_id' => $staff->id,
            'division_id' => $awf->id
        ]);
        $fishroom = DivisionPosition::create([
            'name' => 'Fishroom',
            'slug' => 'fishroom',
            'position_id' => $staff->id,
            'division_id' => $awf->id
        ]);
        $staffawf = DivisionPosition::create([
            'name' => 'Staff of AWF',
            'slug' => 'staff-of-awf',
            'position_id' => $staff->id,
            'division_id' => $awf->id
        ]);
        $assistanawf = DivisionPosition::create([
            'name' => 'Assistan Trainer',
            'slug' => 'assistan-trainer',
            'position_id' => $staff->id,
            'division_id' => $awf->id
        ]);
        $apprentice = DivisionPosition::create([
            'name' => 'Apprentice',
            'slug' => 'apprentice',
            'position_id' => $staff->id,
            'division_id' => $awf->id
        ]);
        $peralihan = DivisionPosition::create([
            'name' => 'Peralihan',
            'slug' => 'peralihan',
            'position_id' => $staff->id,
            'division_id' => $awf->id
        ]);
        $sustainable = DivisionPosition::create([
            'name' => 'Sustainable Development',
            'slug' => 'sustainable-development',
            'position_id' => $head->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $headawf->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headawf->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headawf->web()->create([
            'web_id' => $incident->id,
        ]);
        $headawf->web()->create([
            'web_id' => $sales->id,
        ]);
        $headawf->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headawf->web()->create([
            'web_id' => $order->id,
        ]);
        $headawf->web()->create([
            'web_id' => $notification->id,
        ]);
        $headawf->web()->create([
            'web_id' => $mammalsreport->id,
        ]);
        $headawf->web()->create([
            'web_id' => $diets->id,
        ]);
        $headawf->web()->create([
            'web_id' => $workorder->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipostincident->id,
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
        $headawf->api()->create([
            'api_id' => $apisales->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipostsales->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipatchsales->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiaccessmamalreport->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipostmamalreport->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipatchmamalreport->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apideletemamalreport->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiaccessdiet->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipatchdietexecute->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipostworkorder->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apipatchworkorder->id,
        ]);
        $headawf->api()->create([
            'api_id' => $apideleteworkorder->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $incident->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $healthcheck->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $order->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $mammalsreport->id,
        ]);
        $veterinary->web()->create([
            'web_id' => $diets->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apipostincident->id,
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
        $veterinary->api()->create([
            'api_id' => $apihealthcheck->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiposthealthcheck->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apipatchhealthcheck->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiaccessmamalreport->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apipostmamalreportvet->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apipatchmamalreportvet->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apipatchdietapprove->id,
        ]);
        $veterinary->api()->create([
            'api_id' => $apiaccessdiet->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $habitat->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $habitat->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $habitat->web()->create([
            'web_id' => $incident->id,
        ]);
        $habitat->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $habitat->web()->create([
            'web_id' => $order->id,
        ]);
        $habitat->web()->create([
            'web_id' => $mammalsreport->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apipostincident->id,
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
        $habitat->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apiaccessmamalreport->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apipostmamalreport->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apipatchmamalreport->id,
        ]);
        $habitat->api()->create([
            'api_id' => $apideletemamalreport->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $incident->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $consumption->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $order->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $diets->id,
        ]);
        $fishroom->web()->create([
            'web_id' => $mammalsreport->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apipostincident->id,
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
        $fishroom->api()->create([
            'api_id' => $apiconsumption->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apipostconsumption->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apipatchconsumption->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apiaccessdiet->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apipostdiet->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apipatchdiet->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apideletediet->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apiaccessmamalreport->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apipostmamalreport->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apipatchmamalreport->id,
        ]);
        $fishroom->api()->create([
            'api_id' => $apideletemamalreport->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $sales->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $staffawf->web()->create([
            'web_id' => $mammalsreport->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apipostincident->id,
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
        $staffawf->api()->create([
            'api_id' => $apisales->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apipostsales->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apipatchsales->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apiaccessmamalreport->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apipostmamalreport->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apipatchmamalreport->id,
        ]);
        $staffawf->api()->create([
            'api_id' => $apideletemamalreport->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $dashboard->id
        ]);
        $sustainable->web()->create([
            'web_id' => $profile->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $schedule->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $basicDetail->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $incident->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $waterquality->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $sustainable->web()->create([
            'web_id' => $order->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apibasicdone->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apiwaterqualities->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apipostwaterquality->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apipatchwaterquality->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $sustainable->api()->create([
            'api_id' => $apipatchorder->id,
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
            'web_id' => $basicDetail->id,
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
        $headsecurity->web()->create([
            'web_id' => $incident->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $delivery->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $incidentCreate->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $order->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $notification->id,
        ]);
        $headsecurity->web()->create([
            'web_id' => $workorder->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatrols->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatrolcreate->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatrolbasic->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatchpatrol->id,
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
        $headsecurity->api()->create([
            'api_id' => $apideliveries->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipostdelivery->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatchdelivery->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipostworkorder->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apipatchworkorder->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apideleteworkorder->id,
        ]);
        $headsecurity->api()->create([
            'api_id' => $apibookings->id,
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
            'web_id' => $basicDetail->id,
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
        $staffsecurity->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $delivery->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $staffsecurity->web()->create([
            'web_id' => $incidentCreate->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipatrols->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipatrolcreate->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipatrolbasic->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipatchpatrol->id,
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
        $staffsecurity->api()->create([
            'api_id' => $apideliveries->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipostdelivery->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apipatchdelivery->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $staffsecurity->api()->create([
            'api_id' => $apibookings->id,
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
        $workfacility = $facility->worktime()->create([
            'work_time_id' => $shifting->id,
            'work' => 1
        ]);
        $offfacility = $facility->worktime()->create([
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
        $cleaningservice = DivisionPosition::create([
            'name' => 'Cleaning Service',
            'slug' => 'cleaning-service',
            'position_id' => $staff->id,
            'division_id' => $facility->id
        ]);
        $engineering = DivisionPosition::create([
            'name' => 'Engineering',
            'slug' => 'engineering',
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
            'web_id' => $basicDetail->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $incident->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $patrolDailyCreate->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $order->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $notification->id,
        ]);
        $headfacility->web()->create([
            'web_id' => $workorder->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipostincident->id,
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
        $headfacility->api()->create([
            'api_id' => $apipatrols->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipatrolcreate->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipatrolbasic->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipatchpatrol->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipostworkorder->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apipatchworkorder->id,
        ]);
        $headfacility->api()->create([
            'api_id' => $apideleteworkorder->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $dashboard->id
        ]);
        $cleaningservice->web()->create([
            'web_id' => $profile->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $schedule->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $basicDetail->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $incident->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $patrolDailyCreate->id,
        ]);
        $cleaningservice->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apibasicdone->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apipatrols->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apipatrolcreate->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apipatrolbasic->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apipatchpatrol->id,
        ]);
        $cleaningservice->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $engineering->web()->create([
            'web_id' => $dashboard->id
        ]);
        $engineering->web()->create([
            'web_id' => $profile->id,
        ]);
        $engineering->web()->create([
            'web_id' => $schedule->id,
        ]);
        $engineering->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $engineering->web()->create([
            'web_id' => $basicDaily->id,
        ]);
        $engineering->web()->create([
            'web_id' => $basicDetail->id,
        ]);
        $engineering->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $engineering->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $engineering->web()->create([
            'web_id' => $incident->id,
        ]);
        $engineering->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $engineering->web()->create([
            'web_id' => $patrolDaily->id,
        ]);
        $engineering->web()->create([
            'web_id' => $patrolDailyCreate->id,
        ]);
        $engineering->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apimonthschedule->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apireschedulecreate->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apireschedule->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apibasic->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apiincidents->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apibasiccreate->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apibasicdone->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apipostincident->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apiabsencreate->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apiabsens->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apiabsen->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apipatrols->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apipatrolcreate->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apipatrolbasic->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apipatchpatrol->id,
        ]);
        $engineering->api()->create([
            'api_id' => $apicontract->id,
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
        $workoffice = $office->worktime()->create([
            'work_time_id' => $fulltime->id,
            'work' => 1
        ]);
        $offoffice = $office->worktime()->create([
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
            'web_id' => $basicDetail->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $incident->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $logistics->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $order->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $notification->id,
        ]);
        $headoffice->web()->create([
            'web_id' => $workorder->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apipostincident->id,
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
        $headoffice->api()->create([
            'api_id' => $apilogistics->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apipostlogistic->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apipatchlogistic->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apideletenotification->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apiaccessworkorder->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apipostworkorder->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apipatchworkorder->id,
        ]);
        $headoffice->api()->create([
            'api_id' => $apideleteworkorder->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $hrd->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $hrd->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $hrd->web()->create([
            'web_id' => $incident->id,
        ]);
        $hrd->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $hrd->web()->create([
            'web_id' => $order->id,
        ]);
        $hrd->web()->create([
            'web_id' => $notification->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apipostincident->id,
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
        $hrd->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apipostcontractuser->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apipatchcontractuser->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apideletecontractuser->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiuserdownloadpdf->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiuseralldownloadpdf->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiusers->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apipostnotification->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apipatchnotification->id,
        ]);
        $hrd->api()->create([
            'api_id' => $apideletenotification->id,
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
            'web_id' => $basicDetail->id,
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
        $inventory->web()->create([
            'web_id' => $incident->id,
        ]);
        $inventory->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $inventory->web()->create([
            'web_id' => $order->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apipostincident->id,
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
        $inventory->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apiarriveorder->id,
        ]);
        $inventory->api()->create([
            'api_id' => $apiaccessnotification->id,
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
            'web_id' => $basicDetail->id,
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
        $accounting->web()->create([
            'web_id' => $incident->id,
        ]);
        $accounting->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $accounting->web()->create([
            'web_id' => $order->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apipostincident->id,
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
        $accounting->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $accounting->api()->create([
            'api_id' => $apiaccessnotification->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $receivable->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $receivable->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $receivable->web()->create([
            'web_id' => $incident->id,
        ]);
        $receivable->web()->create([
            'web_id' => $userConteact->id,
        ]);
        $receivable->web()->create([
            'web_id' => $order->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apipostincident->id,
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
        $receivable->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apiaccessorder->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apipostorder->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apipatchorder->id,
        ]);
        $receivable->api()->create([
            'api_id' => $apiaccessnotification->id,
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
            'web_id' => $basicDetail->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $rescheduleCreate->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $reschedule->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $incident->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $logistics->id,
        ]);
        $staffoffice->web()->create([
            'web_id' => $userConteact->id,
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
            'api_id' => $apibasicdone->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apipostincident->id,
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
        $staffoffice->api()->create([
            'api_id' => $apilogistics->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apipostlogistic->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apipatchlogistic->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apicontract->id,
        ]);
        $staffoffice->api()->create([
            'api_id' => $apiaccessnotification->id,
        ]);

        //QUESTION
        $sectionNames = [
            'Area & Building Safety',
            'Security & Access Control',
            'Equipment & Facility Check',
            'Property & Asset Control',
            'People & Activities',
            'Nothing to Report Confirmation',
        ];
        $sections = [];
        foreach ($sectionNames as $name) {
            $sections[$name] = Section::updateOrCreate(
                ['name' => $name],
                [
                    'name' => $name,
                ]
            );
        }
        $sectionQuestions = [
            'Area & Building Safety' => [
                ['question' => 'Area masuk dan keluar dalam kondisi bebas dari hambatan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Pintu tertutup dan terkunci dengan baik sesuai kebutuhan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Pintu darurat dapat diakses', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Jalur evakuasi bebas dari hambatan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tangga dan koridor dalam kondisi bebas dari hambatan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat bau, asap, panas, atau suara yang tidak biasa', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat kebocoran air atau banjir', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat pecahan kaca atau benda berbahaya', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Lantai aman dan tidak terlalu basah atau licin', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Penerangan berfungsi dengan baik', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat kerusakan struktur atau kondisi yang tidak biasa', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Area terbatas diamankan dengan baik', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat orang yang tidak berwenang di area terbatas', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan kondisi yang dapat menimbulkan risiko keselamatan bagi karyawan, pengunjung, tamu, atau properti?', 'type' => 'Checklist', 'part' => null],
            ],

            'Security & Access Control' => [
                ['question' => 'Pintu masuk utama dalam kondisi aman', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Pintu masuk sekunder dalam kondisi aman', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Pintu darurat terkunci tetapi tetap dapat digunakan saat keadaan darurat', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Gerbang berfungsi dengan baik', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Sistem kontrol akses berfungsi dengan baik', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Akses kartu atau kunci berfungsi dengan baik', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat orang yang mencurigakan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat orang yang tidak berwenang', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Aktivitas pengunjung terlihat normal', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat tas atau paket yang ditinggalkan tanpa pengawasan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat kendaraan yang mencurigakan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Area parkir dalam kondisi aman', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Perimeter atau pagar dalam kondisi aman', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat tanda-tanda pembobolan atau akses paksa', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan pintu atau gerbang yang tidak terkunci secara tidak semestinya?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan kartu akses atau kunci yang ditinggalkan tanpa pengawasan?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan seseorang di area yang tidak berwenang untuk diakses?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan aktivitas yang mencurigakan?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan kendaraan atau orang yang tidak biasa?', 'type' => 'Checklist', 'part' => null],
            ],

            'Equipment & Facility Check' => [
                ['question' => 'Alat pemadam api tersedia', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Alat pemadam api dapat diakses dengan mudah', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Segel atau pin alat pemadam api masih utuh', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Panel alarm kebakaran dalam kondisi normal', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Lampu darurat berfungsi', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tanda jalur keluar darurat berfungsi', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Selang atau hydrant kebakaran dapat diakses', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Area sprinkler tidak terhalang', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Peralatan darurat tidak mengalami kerusakan yang terlihat', 'type' => 'Checklist', 'part' => null],

                ['question' => 'Panel listrik dalam kondisi aman', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat kabel listrik yang terbuka', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat bau terbakar', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat suara yang tidak biasa dari peralatan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat kondisi peralatan yang terlalu panas', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Generator atau sistem cadangan terlihat normal', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Pompa atau peralatan lainnya terlihat normal', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat kebocoran air yang tidak normal', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat getaran atau suara yang tidak normal', 'type' => 'Checklist', 'part' => null],

                ['question' => 'Kamera CCTV terlihat berfungsi', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat kerusakan fisik pada kamera', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat kamera yang terhalang', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Sistem perekaman terlihat normal', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Sistem kontrol akses berfungsi', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Sistem alarm menunjukkan status normal', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Radio atau komunikasi keamanan berfungsi', 'type' => 'Checklist', 'part' => null],

                ['question' => 'ID Peralatan', 'type' => 'Text', 'part' => null],
                ['question' => 'Lokasi Peralatan', 'type' => 'Text', 'part' => null],
                ['question' => 'Kondisi Peralatan', 'type' => 'Text', 'part' => null],
                ['question' => 'Kelainan atau kondisi tidak normal yang ditemukan', 'type' => 'Text', 'part' => null],
            ],

            'Property & Asset Control' => [
                ['question' => 'Peralatan perusahaan berada di lokasi yang telah ditentukan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak ditemukan peralatan yang hilang', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Area penyimpanan dalam kondisi aman', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Peralatan dan perlengkapan disimpan dengan baik', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat properti perusahaan yang rusak', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat pengambilan properti tanpa izin', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Barang atau material yang datang disimpan dengan baik', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Area penyimpanan peralatan berharga dalam kondisi aman', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan barang yang terlihat hilang?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan peralatan di lokasi yang tidak semestinya?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan properti yang rusak?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan seseorang memindahkan properti perusahaan?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ditemukan properti yang ditinggalkan tanpa pengawasan?', 'type' => 'Checklist', 'part' => null],
            ],

            'People & Activities' => [
                ['question' => 'Karyawan dan pengunjung berperilaku normal', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat kerumunan yang tidak berwenang', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat perilaku mencurigakan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat konflik atau perkelahian', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat orang yang membutuhkan bantuan', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Tidak terdapat aktivitas atau pekerjaan yang tidak berwenang', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Kontraktor memiliki izin', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Area kerja kontraktor dalam kondisi aman', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah Anda menemukan seseorang yang membutuhkan bantuan?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah ada seseorang yang menolak mengikuti prosedur keamanan?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah Anda melihat perilaku yang mencurigakan?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah Anda menemukan aktivitas yang tidak berwenang?', 'type' => 'Checklist', 'part' => null],
                ['question' => 'Apakah Anda menerima keluhan atau laporan dari karyawan atau pengunjung?', 'type' => 'Checklist', 'part' => null],
            ],

            'Nothing to Report Confirmation' => [
                [
                    'question' => 'Saya telah menyelesaikan patroli dan tidak menemukan kondisi tidak normal, masalah keamanan, bahaya keselamatan, peralatan rusak, properti hilang, orang atau aktivitas yang tidak berwenang, maupun masalah lain yang perlu dilaporkan, kecuali yang telah dicatat di atas.',
                    'type' => 'Checklist',
                    'part' => null,
                ],
            ],
        ];
        $questionModels = [];
        foreach ($sectionQuestions as $sectionName => $questions) {
            $questionModels[$sectionName] = [];

            foreach ($questions as $questionData) {
                $type = str_contains(
                    strtolower($questionData['question']),
                    'foto'
                )
                    ? 'Upload'
                    : $questionData['type'];

                $question = Question::updateOrCreate(
                    [
                        'question' => $questionData['question'],
                        'division_id' => $security->id,
                    ],
                    [
                        'type' => $type,
                        'part' => $questionData['part'],
                        'case' => 'Normal',
                        'division_id' => $security->id,
                    ]
                );

                $questionModels[$sectionName][] = $question;
            }
        }
        $incidentQuestions = [
            // A. Ringkasan kejadian
            ['question' => 'Jenis insiden', 'type' => 'Text', 'part' => 'A'],
            ['question' => 'Tanggal kejadian', 'type' => 'Text', 'part' => 'A'],
            ['question' => 'Waktu kejadian ditemukan', 'type' => 'Text', 'part' => 'A'],
            ['question' => 'Lokasi kejadian', 'type' => 'Text', 'part' => 'A'],
            ['question' => 'Area atau zona kejadian', 'type' => 'Text', 'part' => 'A'],
            ['question' => 'Apa yang sebenarnya terjadi?', 'type' => 'Text', 'part' => 'A'],
            ['question' => 'Bagaimana masalah tersebut ditemukan?', 'type' => 'Text', 'part' => 'A'],
            ['question' => 'Apakah masalah tersebut sudah ada ketika patroli dimulai?', 'type' => 'Checklist', 'part' => 'A'],
            ['question' => 'Apakah Anda menyaksikan kejadian tersebut secara langsung?', 'type' => 'Checklist', 'part' => 'A'],
            ['question' => 'Jika tidak, siapa yang melaporkan kejadian tersebut?', 'type' => 'Text', 'part' => 'A'],

            // B. Orang yang terlibat
            ['question' => 'Apakah ada orang yang terlibat?', 'type' => 'Checklist', 'part' => 'B'],
            ['question' => 'Nama orang yang terlibat, jika diketahui', 'type' => 'Text', 'part' => 'B'],
            ['question' => 'Status: Karyawan / Pengunjung / Kontraktor / Tidak Diketahui', 'type' => 'Text', 'part' => 'B'],
            ['question' => 'ID atau perusahaan, jika diperlukan', 'type' => 'Text', 'part' => 'B'],
            ['question' => 'Informasi kontak, jika diperlukan', 'type' => 'Text', 'part' => 'B'],
            ['question' => 'Jumlah orang yang terlibat', 'type' => 'Text', 'part' => 'B'],
            ['question' => 'Apakah ada orang yang terluka?', 'type' => 'Checklist', 'part' => 'B'],
            ['question' => 'Apakah ada orang yang meninggalkan lokasi?', 'type' => 'Checklist', 'part' => 'B'],
            ['question' => 'Arah kepergian', 'type' => 'Text', 'part' => 'B'],
            ['question' => 'Apakah ada kendaraan yang terlibat?', 'type' => 'Checklist', 'part' => 'B'],
            ['question' => 'Nomor polisi kendaraan, jika diketahui', 'type' => 'Text', 'part' => 'B'],

            // C. Pengamatan detail
            ['question' => 'Apa yang Anda lihat, dengar, cium, atau perhatikan?', 'type' => 'Text', 'part' => 'C'],
            ['question' => 'Bagaimana kondisi area?', 'type' => 'Text', 'part' => 'C'],
            ['question' => 'Bagaimana kondisi peralatan atau properti?', 'type' => 'Text', 'part' => 'C'],
            ['question' => 'Apakah terdapat tanda-tanda pembobolan atau akses paksa?', 'type' => 'Checklist', 'part' => 'C'],
            ['question' => 'Apakah terdapat tanda-tanda kerusakan?', 'type' => 'Checklist', 'part' => 'C'],
            ['question' => 'Apakah terdapat suara yang tidak biasa?', 'type' => 'Checklist', 'part' => 'C'],
            ['question' => 'Apakah terdapat bau yang tidak biasa?', 'type' => 'Checklist', 'part' => 'C'],
            ['question' => 'Apakah ada alarm yang aktif?', 'type' => 'Checklist', 'part' => 'C'],
            ['question' => 'Apakah terdapat saksi?', 'type' => 'Checklist', 'part' => 'C'],
            ['question' => 'Apakah CCTV tersedia?', 'type' => 'Checklist', 'part' => 'C'],
            ['question' => 'Kamera CCTV mana yang kemungkinan merekam kejadian?', 'type' => 'Text', 'part' => 'C'],

            // D. Peralatan yang terlibat
            ['question' => 'Nama peralatan', 'type' => 'Text', 'part' => 'D'],
            ['question' => 'ID atau nomor seri peralatan', 'type' => 'Text', 'part' => 'D'],
            ['question' => 'Lokasi peralatan', 'type' => 'Text', 'part' => 'D'],
            ['question' => 'Kondisi normal peralatan', 'type' => 'Text', 'part' => 'D'],
            ['question' => 'Kondisi peralatan saat ini', 'type' => 'Text', 'part' => 'D'],
            ['question' => 'Apa masalah yang terlihat pada peralatan?', 'type' => 'Text', 'part' => 'D'],
            ['question' => 'Apakah peralatan masih beroperasi?', 'type' => 'Checklist', 'part' => 'D'],
            ['question' => 'Apakah peralatan masih aman untuk digunakan?', 'type' => 'Checklist', 'part' => 'D'],
            ['question' => 'Apakah peralatan sudah dimatikan atau diisolasi?', 'type' => 'Checklist', 'part' => 'D'],
            ['question' => 'Siapa yang sudah diberitahu?', 'type' => 'Text', 'part' => 'D'],
            ['question' => 'Apakah bagian maintenance sudah dihubungi?', 'type' => 'Checklist', 'part' => 'D'],

            // E. Tindakan segera
            ['question' => 'Apa yang Anda lakukan segera setelah menemukan masalah?', 'type' => 'Text', 'part' => 'E'],
            ['question' => 'Apakah Anda mengamankan area?', 'type' => 'Checklist', 'part' => 'E'],
            ['question' => 'Apakah Anda membatasi akses?', 'type' => 'Checklist', 'part' => 'E'],
            ['question' => 'Apakah Anda mengisolasi peralatan?', 'type' => 'Checklist', 'part' => 'E'],
            ['question' => 'Apakah Anda menghubungi supervisor?', 'type' => 'Checklist', 'part' => 'E'],
            ['question' => 'Apakah Anda menghubungi maintenance?', 'type' => 'Checklist', 'part' => 'E'],
            ['question' => 'Apakah Anda menghubungi layanan darurat?', 'type' => 'Checklist', 'part' => 'E'],
            ['question' => 'Apakah Anda membantu orang yang terluka?', 'type' => 'Checklist', 'part' => 'E'],
            ['question' => 'Apakah Anda menjaga atau mengamankan barang bukti?', 'type' => 'Checklist', 'part' => 'E'],
            ['question' => 'Apakah rekaman CCTV sudah diidentifikasi atau disimpan?', 'type' => 'Checklist', 'part' => 'E'],
            ['question' => 'Apakah situasi sudah terselesaikan?', 'type' => 'Checklist', 'part' => 'E'],

            // F. Eskalasi & notifikasi
            ['question' => 'Siapa yang diberitahu?', 'type' => 'Text', 'part' => 'F'],
            ['question' => 'Nama supervisor yang diberitahu', 'type' => 'Text', 'part' => 'F'],
            ['question' => 'Waktu pemberitahuan', 'type' => 'Text', 'part' => 'F'],
            ['question' => 'Metode pemberitahuan: Telepon / Radio / WhatsApp / Tatap muka / Lainnya', 'type' => 'Text', 'part' => 'F'],
            ['question' => 'Apakah manajemen sudah diberitahu?', 'type' => 'Checklist', 'part' => 'F'],
            ['question' => 'Apakah maintenance sudah diberitahu?', 'type' => 'Checklist', 'part' => 'F'],
            ['question' => 'Apakah HR sudah diberitahu?', 'type' => 'Checklist', 'part' => 'F'],
            ['question' => 'Apakah polisi atau layanan darurat sudah dihubungi jika diperlukan?', 'type' => 'Checklist', 'part' => 'F'],

            // G. Bukti & dokumentasi
            ['question' => 'Rekaman CCTV tersedia', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Foto diambil', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Video diambil', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Saksi berhasil diidentifikasi', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Barang bukti fisik diamankan', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Nomor seri peralatan dicatat', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Log akses diperiksa', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Data pengunjung diperiksa', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Dokumentasi lainnya', 'type' => 'Text', 'part' => 'G'],
            ['question' => 'Lokasi rekaman CCTV', 'type' => 'Text', 'part' => 'G'],
            ['question' => 'Periode waktu yang perlu diperiksa', 'type' => 'Text', 'part' => 'G'],
            ['question' => 'Apakah foto telah diambil?', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Siapa yang mengambil foto?', 'type' => 'Text', 'part' => 'G'],
            ['question' => 'Apakah saksi telah diidentifikasi?', 'type' => 'Checklist', 'part' => 'G'],
            ['question' => 'Apakah ada sesuatu yang dipindahkan setelah kejadian?', 'type' => 'Checklist', 'part' => 'G'],

            // H. Tindak lanjut
            ['question' => 'Apakah masalah sudah terselesaikan? Ya / Tidak / Sebagian', 'type' => 'Text', 'part' => 'H'],
            ['question' => 'Apakah area masih tidak aman?', 'type' => 'Checklist', 'part' => 'H'],
            ['question' => 'Apakah peralatan masih tidak dapat digunakan?', 'type' => 'Checklist', 'part' => 'H'],
            ['question' => 'Apakah diperlukan investigasi lebih lanjut?', 'type' => 'Checklist', 'part' => 'H'],
            ['question' => 'Apakah diperlukan maintenance?', 'type' => 'Checklist', 'part' => 'H'],
            ['question' => 'Apakah diperlukan tindak lanjut dari manajemen?', 'type' => 'Checklist', 'part' => 'H'],
            ['question' => 'Apakah diperlukan pemantauan keamanan lebih lanjut?', 'type' => 'Checklist', 'part' => 'H'],
            ['question' => 'Siapa yang bertanggung jawab atas tindak lanjut?', 'type' => 'Text', 'part' => 'H'],
            ['question' => 'Target tanggal penyelesaian', 'type' => 'Text', 'part' => 'H'],
            ['question' => 'Tanggal tindak lanjut selesai', 'type' => 'Text', 'part' => 'H'],
            ['question' => 'Penyelesaian atau tindakan akhir yang dilakukan', 'type' => 'Text', 'part' => 'H'],
        ];
        foreach ($incidentQuestions as $questionData) {
            $type = str_contains(
                strtolower($questionData['question']),
                'foto'
            )
                ? 'Upload'
                : $questionData['type'];

            Question::updateOrCreate(
                [
                    'question' => $questionData['question'],
                    'division_id' => $security->id,
                ],
                [
                    'type' => $type,
                    'part' => $questionData['part'],
                    'case' => 'Incident',
                    'division_id' => $security->id,
                ]
            );
        }
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
                ['name' => $areaName],
                [
                    'slug' => Str::slug($areaName),
                    'description' => null,
                ]
            );
        }
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
        $facilityCareQuestions = [
            'GENSET SETIAP 2 HARI SEKALI (DIPANASKAN)',
            'FOTO METERAN LISTRIK',
            'CUCI AC SEMINGGU SEBULAN SEKALI',
            'BACK WASH FILTER AIR KOLAM SETIAP 3 HARI SEKALI',
            'TREATMENT KOLAM (PAGI SORE)',
            'PERKEBUNAN (PENYIRAMAN)',
            'PENGECEKAN PEMAKAIAN KENDARAAN PICKUP',
            'PENGECEKAN PANEL MCB METERAN SETIAP BULAN 1X',
            'PENGECEKAN INSTALASI MEP',
            'PENGECEKAN INSTALASI PIPA AIR/ TENDON AIR',
        ];
        foreach ($facilityCareQuestions as $questionText) {
            $type = str_contains(
                strtolower($questionText),
                'foto'
            )
                ? 'Upload'
                : 'Checklist';

            Question::updateOrCreate(
                [
                    'question' => $questionText,
                    'division_id' => $facility->id,
                ],
                [
                    'type' => $type,
                    'part' => null,
                    'case' => 'Normal',
                    'division_id' => $facility->id,
                ]
            );
        }

        //USER
        $Fanik = '1234567891011121';
        $Faphone = '12345678910';
        $Faemergency = '01987654321';
        $Fajar = User::create([
            'name' => 'Super Admin',
            'nik' => encrypt($Fanik),
            'nik_hash' => hash_hmac('sha256', $Fanik, config('app.key')),
            'username' => 'adminlifeexotic',
            'email' => 'admn.0124@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($Faphone),
            'phone_hash' => hash_hmac('sha256', $Faphone, config('app.key')),
            'emergency' => encrypt($Faemergency),
            'emergency_hash' => hash_hmac('sha256', $Faemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $SaFajar = $Fajar->divisionPosition()->create([
            'division_position_id' => $headsuperadmin->id
        ]);

        //SPV 1
        $Dimnik = '9998563236555212';
        $Dimphone = '1111444569';
        $Dimemergency = '8889996552';
        $Dimas = User::create([
            'name' => 'Supervisor 1',
            'nik' => encrypt($Dimnik),
            'nik_hash' => hash_hmac('sha256', $Dimnik, config('app.key')),
            'username' => 'SUPERVISOR001',
            'email' => 'spv1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($Dimphone),
            'phone_hash' => hash_hmac('sha256', $Dimphone, config('app.key')),
            'emergency' => encrypt($Dimemergency),
            'emergency_hash' => hash_hmac('sha256', $Dimemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $SpvDim = $Dimas->divisionPosition()->create([
            'division_position_id' => $headsupervisor->id
        ]);
        //SPV 2
        $launik = '7784565212545689';
        $lauphone = '7777778458';
        $lauemergency = '8888855540';
        $laura = User::create([
            'name' => 'Supervisor 2',
            'nik' => encrypt($launik),
            'nik_hash' => hash_hmac('sha256', $launik, config('app.key')),
            'username' => 'SUPERVISOR002',
            'email' => 'spv2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($lauphone),
            'phone_hash' => hash_hmac('sha256', $lauphone, config('app.key')),
            'emergency' => encrypt($lauemergency),
            'emergency_hash' => hash_hmac('sha256', $lauemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $Spvstf = $laura->divisionPosition()->create([
            'division_position_id' => $staffsupervisor->id
        ]);

        //CASHIER / RESERVATION
        //HEAD CASHIER / RESERVATION
        $tominik = '7788854565874589';
        $tomiphone = '5544589654';
        $tomiemergency = '7744111458';
        $tomi = User::create([
            'name' => 'Head of Cashier / Reservation',
            'nik' => encrypt($tominik),
            'nik_hash' => hash_hmac('sha256', $tominik, config('app.key')),
            'username' => 'CASHIERRESERVATION001',
            'email' => 'tbestemail@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($tomiphone),
            'phone_hash' => hash_hmac('sha256', $tomiphone, config('app.key')),
            'emergency' => encrypt($tomiemergency),
            'emergency_hash' => hash_hmac('sha256', $tomiemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $tomi->divisionPosition()->create([
            'division_position_id' => $staffcashier->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offreservation->id,
            'user_id' => $tomi->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $tomi->id,
            'name' => 'Full Time Morning'
        ]);
        $templeteafternoon = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $tomi->id,
            'name' => 'Full Time Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteafternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF RESERVATION 1
        $andreasnik = '7411477852125458';
        $andreasphone = '9656985656';
        $andreasemergency = '7845569856';
        $andreas = User::create([
            'name' => 'STAFF OF RESERVATION 1',
            'nik' => encrypt($andreasnik),
            'nik_hash' => hash_hmac('sha256', $andreasnik, config('app.key')),
            'username' => 'STAFFOFRESERVATION001',
            'email' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($andreasphone),
            'phone_hash' => hash_hmac('sha256', $andreasphone, config('app.key')),
            'emergency' => encrypt($andreasemergency),
            'emergency_hash' => hash_hmac('sha256', $andreasemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Denhag',
            'birthday' => today(),
            'address' => 'Tangerang'
        ]);
        $staffrservation = $andreas->divisionPosition()->create([
            'division_position_id' => $staffreservation->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Morning'
        ]);
        $templeteafternoon = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteafternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF RESERVATION 2
        $andreasnik = '200012032555201';
        $andreasphone = '4545663256';
        $andreasemergency = '1201203250';
        $andreas = User::create([
            'name' => 'STAFF OF RESERVATION 2',
            'nik' => encrypt($andreasnik),
            'nik_hash' => hash_hmac('sha256', $andreasnik, config('app.key')),
            'username' => 'STAFFOFRESERVATION002',
            'email' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($andreasphone),
            'phone_hash' => hash_hmac('sha256', $andreasphone, config('app.key')),
            'emergency' => encrypt($andreasemergency),
            'emergency_hash' => hash_hmac('sha256', $andreasemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Denhag',
            'birthday' => today(),
            'address' => 'Tangerang'
        ]);
        $staffrservation = $andreas->divisionPosition()->create([
            'division_position_id' => $staffreservation->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Morning'
        ]);
        $templeteafternoon = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteafternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF CASHIER 1
        $andreasnik = '1112220002123562';
        $andreasphone = '8856596521';
        $andreasemergency = '9998565235';
        $andreas = User::create([
            'name' => 'STAFF OF CASHIER 1',
            'nik' => encrypt($andreasnik),
            'nik_hash' => hash_hmac('sha256', $andreasnik, config('app.key')),
            'username' => 'STAFFOFCASHIER001',
            'email' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($andreasphone),
            'phone_hash' => hash_hmac('sha256', $andreasphone, config('app.key')),
            'emergency' => encrypt($andreasemergency),
            'emergency_hash' => hash_hmac('sha256', $andreasemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Denhag',
            'birthday' => today(),
            'address' => 'Tangerang'
        ]);
        $staffcashir = $andreas->divisionPosition()->create([
            'division_position_id' => $staffcashier->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Morning'
        ]);
        $templeteafternoon = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteafternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF CASHIER 2
        $andreasnik = '3275042204870016';
        $andreasphone = '0821576999';
        $andreasemergency = '0821576990';
        $andreas = User::create([
            'name' => 'STAFF OF CASHIER 2',
            'nik' => encrypt($andreasnik),
            'nik_hash' => hash_hmac('sha256', $andreasnik, config('app.key')),
            'username' => 'STAFFOFCASHIER002',
            'email' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($andreasphone),
            'phone_hash' => hash_hmac('sha256', $andreasphone, config('app.key')),
            'emergency' => encrypt($andreasemergency),
            'emergency_hash' => hash_hmac('sha256', $andreasemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Denhag',
            'birthday' => today(),
            'address' => 'Tangerang'
        ]);
        $staffcashir = $andreas->divisionPosition()->create([
            'division_position_id' => $staffcashier->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Morning'
        ]);
        $templeteafternoon = Templete::create([
            'division_work_time_id' => $workreservation->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteafternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);

        //MULTIMEDIA 
        //HEAD
        $headmmnik = '4411111114445986';
        $headmmphone = '7745589658';
        $headmmemergency = '770124558789';
        $cika = User::create([
            'name' => 'Head of Multimedia',
            'nik' => encrypt($headmmnik),
            'nik_hash' => hash_hmac('sha256', $headmmnik, config('app.key')),
            'username' => 'HEADOFMULTIMEDIA001',
            'email' => 'photos.bemp@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmmphone),
            'phone_hash' => hash_hmac('sha256', $headmmphone, config('app.key')),
            'emergency' => encrypt($headmmemergency),
            'emergency_hash' => hash_hmac('sha256', $headmmemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $headmultimedia->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmm->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //RETAIL
        $headmmnik = '5551232124551245';
        $headmmphone = '7445124568';
        $headmmemergency = '4111245652';
        $cika = User::create([
            'name' => 'Retail',
            'nik' => encrypt($headmmnik),
            'nik_hash' => hash_hmac('sha256', $headmmnik, config('app.key')),
            'username' => 'RETAIL001',
            'email' => 'retail.bemp@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmmphone),
            'phone_hash' => hash_hmac('sha256', $headmmphone, config('app.key')),
            'emergency' => encrypt($headmmemergency),
            'emergency_hash' => hash_hmac('sha256', $headmmemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $headretail->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmm->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF MM 1
        $headmmnik = '1245556323356895';
        $headmmphone = '4441254565';
        $headmmemergency = '4441245213';
        $cika = User::create([
            'name' => 'STAFF OF MULTIMEDIA 1',
            'nik' => encrypt($headmmnik),
            'nik_hash' => hash_hmac('sha256', $headmmnik, config('app.key')),
            'username' => 'STAFFOFMULTIMEDIA001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmmphone),
            'phone_hash' => hash_hmac('sha256', $headmmphone, config('app.key')),
            'emergency' => encrypt($headmmemergency),
            'emergency_hash' => hash_hmac('sha256', $headmmemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffmultimedia->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmm->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF MM 2
        $headmmnik = '3636362525858596';
        $headmmphone = '4555666660';
        $headmmemergency = '5151452123';
        $cika = User::create([
            'name' => 'STAFF OF MULTIMEDIA 2',
            'nik' => encrypt($headmmnik),
            'nik_hash' => hash_hmac('sha256', $headmmnik, config('app.key')),
            'username' => 'STAFFOFMULTIMEDIA002',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmmphone),
            'phone_hash' => hash_hmac('sha256', $headmmphone, config('app.key')),
            'emergency' => encrypt($headmmemergency),
            'emergency_hash' => hash_hmac('sha256', $headmmemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffmultimedia->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmm->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF MM 3
        $headmmnik = '3173011805860100';
        $headmmphone = '7756127380';
        $headmmemergency = '5856127380';
        $cika = User::create([
            'name' => 'STAFF OF MULTIMEDIA 3',
            'nik' => encrypt($headmmnik),
            'nik_hash' => hash_hmac('sha256', $headmmnik, config('app.key')),
            'username' => 'STAFFOFMULTIMEDIA003',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmmphone),
            'phone_hash' => hash_hmac('sha256', $headmmphone, config('app.key')),
            'emergency' => encrypt($headmmemergency),
            'emergency_hash' => hash_hmac('sha256', $headmmemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffmultimedia->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmm->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF MM 4
        $headmmnik = '8585969625152456';
        $headmmphone = '5554556259';
        $headmmemergency = '1515462596';
        $cika = User::create([
            'name' => 'STAFF OF MULTIMEDIA 4',
            'nik' => encrypt($headmmnik),
            'nik_hash' => hash_hmac('sha256', $headmmnik, config('app.key')),
            'username' => 'STAFFOFMULTIMEDIA004',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmmphone),
            'phone_hash' => hash_hmac('sha256', $headmmphone, config('app.key')),
            'emergency' => encrypt($headmmemergency),
            'emergency_hash' => hash_hmac('sha256', $headmmemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffmultimedia->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmm->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workmm->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);


        //MARKETING
        //HEAD
        $headmarketingnik = '1232125445774568';
        $headmarketingphone = '0111002308';
        $headmarketingemergency = '1100001245';
        $andreas = User::create([
            'name' => 'HEAD OF MARKETING',
            'nik' => encrypt($headmarketingnik),
            'nik_hash' => hash_hmac('sha256', $headmarketingnik, config('app.key')),
            'username' => 'HEADOFMARKETING001',
            'email' => 'bempbizdev@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmarketingphone),
            'phone_hash' => hash_hmac('sha256', $headmarketingphone, config('app.key')),
            'emergency' => encrypt($headmarketingemergency),
            'emergency_hash' => hash_hmac('sha256', $headmarketingemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $andreas->divisionPosition()->create([
            'division_position_id' => $headmarketing->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Morning'
        ]);
        $templeteafternoon = Templete::create([
            'division_work_time_id' => $workmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteafternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF MARKETING 1
        $headmarketingnik = '9656323584451254';
        $headmarketingphone = '7845125456';
        $headmarketingemergency = '4554124563';
        $andreas = User::create([
            'name' => 'STAFF OF MARKETING 001',
            'nik' => encrypt($headmarketingnik),
            'nik_hash' => hash_hmac('sha256', $headmarketingnik, config('app.key')),
            'username' => 'STAFFOFMARKETING001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmarketingphone),
            'phone_hash' => hash_hmac('sha256', $headmarketingphone, config('app.key')),
            'emergency' => encrypt($headmarketingemergency),
            'emergency_hash' => hash_hmac('sha256', $headmarketingemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $andreas->divisionPosition()->create([
            'division_position_id' => $staffmarketing->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Morning'
        ]);
        $templeteafternoon = Templete::create([
            'division_work_time_id' => $workmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteafternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF MARKETING 2
        $headmarketingnik = '7441245212563212';
        $headmarketingphone = '7451122236';
        $headmarketingemergency = '9996523658';
        $andreas = User::create([
            'name' => 'STAFF OF MARKETING 002',
            'nik' => encrypt($headmarketingnik),
            'nik_hash' => hash_hmac('sha256', $headmarketingnik, config('app.key')),
            'username' => 'STAFFOFMARKETING002',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmarketingphone),
            'phone_hash' => hash_hmac('sha256', $headmarketingphone, config('app.key')),
            'emergency' => encrypt($headmarketingemergency),
            'emergency_hash' => hash_hmac('sha256', $headmarketingemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $andreas->divisionPosition()->create([
            'division_position_id' => $staffmarketing->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Morning'
        ]);
        $templeteafternoon = Templete::create([
            'division_work_time_id' => $workmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteafternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //STAFF MARKETING 3
        $headmarketingnik = '0002120325541055';
        $headmarketingphone = '3030302056';
        $headmarketingemergency = '1010101254';
        $andreas = User::create([
            'name' => 'STAFF OF MARKETING 003',
            'nik' => encrypt($headmarketingnik),
            'nik_hash' => hash_hmac('sha256', $headmarketingnik, config('app.key')),
            'username' => 'STAFFOFMARKETING003',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headmarketingphone),
            'phone_hash' => hash_hmac('sha256', $headmarketingphone, config('app.key')),
            'emergency' => encrypt($headmarketingemergency),
            'emergency_hash' => hash_hmac('sha256', $headmarketingemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $andreas->divisionPosition()->create([
            'division_position_id' => $staffmarketing->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Morning'
        ]);
        $templeteafternoon = Templete::create([
            'division_work_time_id' => $workmarketing->id,
            'user_id' => $andreas->id,
            'name' => 'Full Time Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteafternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);

        //AWF
        //HEAD AWF / TRAINER
        $headawfnik = '9856988745556698';
        $headawfphone = '7447855459';
        $headawfemergency = '1455212548';
        $andreas = User::create([
            'name' => 'HEAD OF ANIMAL WELFARE',
            'nik' => encrypt($headawfnik),
            'nik_hash' => hash_hmac('sha256', $headawfnik, config('app.key')),
            'username' => 'HEADOFANIMALWELFARE001',
            'email' => 'animalwelfarebemp@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headawfphone),
            'phone_hash' => hash_hmac('sha256', $headawfphone, config('app.key')),
            'emergency' => encrypt($headawfemergency),
            'emergency_hash' => hash_hmac('sha256', $headawfemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $andreas->divisionPosition()->create([
            'division_position_id' => $headawf->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $andreas->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $andreas->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $andreas->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $andreas->id,
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
        //VETERINATY
        $veterinarynik = '4455588877744125';
        $veterinaryphone = '7854569856';
        $veterinaryergency = '7455458789';
        $cika = User::create([
            'name' => 'VETERINARY',
            'nik' => encrypt($veterinarynik),
            'nik_hash' => hash_hmac('sha256', $veterinarynik, config('app.key')),
            'username' => 'VETERINARY001',
            'email' => 'vetcare.bemp@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($veterinaryphone),
            'phone_hash' => hash_hmac('sha256', $veterinaryphone, config('app.key')),
            'emergency' => encrypt($veterinaryergency),
            'emergency_hash' => hash_hmac('sha256', $veterinaryergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $veterinary->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //HABITAT
        $veterinarynik = '1112222222101214';
        $veterinaryphone = '0002123025';
        $veterinaryergency = '7444512012';
        $cika = User::create([
            'name' => 'Habitat',
            'nik' => encrypt($veterinarynik),
            'nik_hash' => hash_hmac('sha256', $veterinarynik, config('app.key')),
            'username' => 'HABITAT001',
            'email' => 'habitat.bemp@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($veterinaryphone),
            'phone_hash' => hash_hmac('sha256', $veterinaryphone, config('app.key')),
            'emergency' => encrypt($veterinaryergency),
            'emergency_hash' => hash_hmac('sha256', $veterinaryergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $habitat->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //ENRICHMENT
        $enrichnik = '7898745447856665';
        $enrichphone = '5511000236';
        $enrichemergency = '784556985';
        $cika = User::create([
            'name' => 'Enrichment / Sustainable',
            'nik' => encrypt($enrichnik),
            'nik_hash' => hash_hmac('sha256', $enrichnik, config('app.key')),
            'username' => 'ENRICHMENT001',
            'email' => 'enrichment.bemp@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($enrichphone),
            'phone_hash' => hash_hmac('sha256', $enrichphone, config('app.key')),
            'emergency' => encrypt($enrichemergency),
            'emergency_hash' => hash_hmac('sha256', $enrichemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $sustainable->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //FISHROOM
        $fishroomnik = '4521123569877444';
        $fishroomphone = '0000021256';
        $fishroomemergency = '9999965680';
        $cika = User::create([
            'name' => 'Fishroom',
            'nik' => encrypt($fishroomnik),
            'nik_hash' => hash_hmac('sha256', $fishroomnik, config('app.key')),
            'username' => 'FISHROOM001',
            'email' => 'fishroom.bemp@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($fishroomphone),
            'phone_hash' => hash_hmac('sha256', $fishroomphone, config('app.key')),
            'emergency' => encrypt($fishroomemergency),
            'emergency_hash' => hash_hmac('sha256', $fishroomemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $fishroom->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //STAFF AWF 1
        $fishroomnik = '1220009652123456';
        $fishroomphone = '4441256325';
        $fishroomemergency = '5554124563';
        $cika = User::create([
            'name' => 'STAFF AWF 1',
            'nik' => encrypt($fishroomnik),
            'nik_hash' => hash_hmac('sha256', $fishroomnik, config('app.key')),
            'username' => 'TRAINER001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($fishroomphone),
            'phone_hash' => hash_hmac('sha256', $fishroomphone, config('app.key')),
            'emergency' => encrypt($fishroomemergency),
            'emergency_hash' => hash_hmac('sha256', $fishroomemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffawf->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //STAFF AWF 2
        $fishroomnik = '7745556821232149';
        $fishroomphone = '0012221239';
        $fishroomemergency = '9651245639';
        $cika = User::create([
            'name' => 'STAFF AWF 2',
            'nik' => encrypt($fishroomnik),
            'nik_hash' => hash_hmac('sha256', $fishroomnik, config('app.key')),
            'username' => 'TRAINER002',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($fishroomphone),
            'phone_hash' => hash_hmac('sha256', $fishroomphone, config('app.key')),
            'emergency' => encrypt($fishroomemergency),
            'emergency_hash' => hash_hmac('sha256', $fishroomemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffawf->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //STAFF AWF 3
        $fishroomnik = '0122200130259719';
        $fishroomphone = '0122232019';
        $fishroomemergency = '7899985653';
        $cika = User::create([
            'name' => 'STAFF AWF 3',
            'nik' => encrypt($fishroomnik),
            'nik_hash' => hash_hmac('sha256', $fishroomnik, config('app.key')),
            'username' => 'TRAINER003',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($fishroomphone),
            'phone_hash' => hash_hmac('sha256', $fishroomphone, config('app.key')),
            'emergency' => encrypt($fishroomemergency),
            'emergency_hash' => hash_hmac('sha256', $fishroomemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffawf->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //ASSISTAN TRAINER
        $fishroomnik = '0321125987541369';
        $fishroomphone = '9513578526';
        $fishroomemergency = '9632563237';
        $cika = User::create([
            'name' => 'Assistan Trainer',
            'nik' => encrypt($fishroomnik),
            'nik_hash' => hash_hmac('sha256', $fishroomnik, config('app.key')),
            'username' => 'ASSISTANT001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($fishroomphone),
            'phone_hash' => hash_hmac('sha256', $fishroomphone, config('app.key')),
            'emergency' => encrypt($fishroomemergency),
            'emergency_hash' => hash_hmac('sha256', $fishroomemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $assistanawf->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //APPRENTICE
        $fishroomnik = '1002312596664127';
        $fishroomphone = '1021236529';
        $fishroomemergency = '9565452129';
        $cika = User::create([
            'name' => 'Appreentice',
            'nik' => encrypt($fishroomnik),
            'nik_hash' => hash_hmac('sha256', $fishroomnik, config('app.key')),
            'username' => 'APPRENTICE001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($fishroomphone),
            'phone_hash' => hash_hmac('sha256', $fishroomphone, config('app.key')),
            'emergency' => encrypt($fishroomemergency),
            'emergency_hash' => hash_hmac('sha256', $fishroomemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $apprentice->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //PERALIHAN 1
        $fishroomnik = '5200012365495631';
        $fishroomphone = '1222001039';
        $fishroomemergency = '9515746250';
        $cika = User::create([
            'name' => 'Peralihan 1',
            'nik' => encrypt($fishroomnik),
            'nik_hash' => hash_hmac('sha256', $fishroomnik, config('app.key')),
            'username' => 'PERALIHAN001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($fishroomphone),
            'phone_hash' => hash_hmac('sha256', $fishroomphone, config('app.key')),
            'emergency' => encrypt($fishroomemergency),
            'emergency_hash' => hash_hmac('sha256', $fishroomemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $peralihan->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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
        //PERALIHAN 2
        $fishroomnik = '3174052809910007';
        $fishroomphone = '0857391264';
        $fishroomemergency = '0812684053';
        $cika = User::create([
            'name' => 'Peralihan 2',
            'nik' => encrypt($fishroomnik),
            'nik_hash' => hash_hmac('sha256', $fishroomnik, config('app.key')),
            'username' => 'PERALIHAN002',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($fishroomphone),
            'phone_hash' => hash_hmac('sha256', $fishroomphone, config('app.key')),
            'emergency' => encrypt($fishroomemergency),
            'emergency_hash' => hash_hmac('sha256', $fishroomemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $peralihan->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offawf->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workawf->id,
            'user_id' => $cika->id,
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

        //SECURITY
        //HEAD
        $emannik = '12325698569877456';
        $emanphone = '1114445878';
        $emanemergency = '9632365896';
        $emanuel = User::create([
            'name' => 'Head of Security',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'HEADOFSECURITY001',
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
            'address' => 'Bali, Indonesia'
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
        //STAFF SATPAM 1
        $indranik = '5552369855544125';
        $indraphone = '5566698887';
        $indraemergency = '0101235654';
        $indra = User::create([
            'name' => 'Staff of Security 1',
            'nik' => encrypt($indranik),
            'nik_hash' => hash_hmac('sha256', $indranik, config('app.key')),
            'username' => 'STAFFOFSECURITY001',
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
        //STAFF SATPAM 2
        $indranik = '8541124523656895';
        $indraphone = '4121245212';
        $indraemergency = '4121245215';
        $indra = User::create([
            'name' => 'Staff of Security 2',
            'nik' => encrypt($indranik),
            'nik_hash' => hash_hmac('sha256', $indranik, config('app.key')),
            'username' => 'STAFFOFSECURITY002',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($indraphone),
            'phone_hash' => hash_hmac('sha256', $indraphone, config('app.key')),
            'emergency' => encrypt($indraemergency),
            'emergency_hash' => hash_hmac('sha256', $indraemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Manila',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
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
        //STAFF SATPAM 3
        $indranik = '1071021408890138';
        $indraphone = '4121240212';
        $indraemergency = '4021245215';
        $indra = User::create([
            'name' => 'Staff of Security 3',
            'nik' => encrypt($indranik),
            'nik_hash' => hash_hmac('sha256', $indranik, config('app.key')),
            'username' => 'STAFFOFSECURITY003',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($indraphone),
            'phone_hash' => hash_hmac('sha256', $indraphone, config('app.key')),
            'emergency' => encrypt($indraemergency),
            'emergency_hash' => hash_hmac('sha256', $indraemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Manila',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
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
        //STAFF SATPAM 4
        $indranik = '1212220120211452';
        $indraphone = '9595966656';
        $indraemergency = '7454124589';
        $indra = User::create([
            'name' => 'Staff of Security 4',
            'nik' => encrypt($indranik),
            'nik_hash' => hash_hmac('sha256', $indranik, config('app.key')),
            'username' => 'STAFFOFSECURITY004',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($indraphone),
            'phone_hash' => hash_hmac('sha256', $indraphone, config('app.key')),
            'emergency' => encrypt($indraemergency),
            'emergency_hash' => hash_hmac('sha256', $indraemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Manila',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
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

        //FACILITY
        //HEAD
        $emannik = '787454511145258';
        $emanphone = '7874545895';
        $emanemergency = '854566589';
        $emanuel = User::create([
            'name' => 'Head of Facility',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'HEADOFFACILITY001',
            'email' => 'headfacility@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($emanphone),
            'phone_hash' => hash_hmac('sha256', $emanphone, config('app.key')),
            'emergency' => encrypt($emanemergency),
            'emergency_hash' => hash_hmac('sha256', $emanemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Tokyo',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $headfaslity = $emanuel->divisionPosition()->create([
            'division_position_id' => $headfacility->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workfacility->id,
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
        //ENGINERNG 1
        $emannik = '1271034506880021';
        $emanphone = '0896340721';
        $emanemergency = '0821576938';
        $emanuel = User::create([
            'name' => 'ENGINEERING 1',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'ENGINEERING001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($emanphone),
            'phone_hash' => hash_hmac('sha256', $emanphone, config('app.key')),
            'emergency' => encrypt($emanemergency),
            'emergency_hash' => hash_hmac('sha256', $emanemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Tokyo',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $headfaslity = $emanuel->divisionPosition()->create([
            'division_position_id' => $engineering->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workfacility->id,
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
        //ENGINERNG 2
        $emannik = '6471025309930082';
        $emanphone = '0813904627';
        $emanemergency = '0856127380';
        $emanuel = User::create([
            'name' => 'ENGINEERING 2',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'ENGINEERING002',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($emanphone),
            'phone_hash' => hash_hmac('sha256', $emanphone, config('app.key')),
            'emergency' => encrypt($emanemergency),
            'emergency_hash' => hash_hmac('sha256', $emanemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Tokyo',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $headfaslity = $emanuel->divisionPosition()->create([
            'division_position_id' => $engineering->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workfacility->id,
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
        //ENGINERNG 3
        $emannik = '3515033010020091';
        $emanphone = '0819307526';
        $emanemergency = '0877684120';
        $emanuel = User::create([
            'name' => 'ENGINEERING 3',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'ENGINEERING003',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($emanphone),
            'phone_hash' => hash_hmac('sha256', $emanphone, config('app.key')),
            'emergency' => encrypt($emanemergency),
            'emergency_hash' => hash_hmac('sha256', $emanemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Tokyo',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $headfaslity = $emanuel->divisionPosition()->create([
            'division_position_id' => $engineering->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workfacility->id,
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
        //ENGINERNG 4
        $emannik = '3374062912010149';
        $emanphone = '0852948601';
        $emanemergency = '0819307526';
        $emanuel = User::create([
            'name' => 'ENGINEERING 4',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'ENGINEERING004',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($emanphone),
            'phone_hash' => hash_hmac('sha256', $emanphone, config('app.key')),
            'emergency' => encrypt($emanemergency),
            'emergency_hash' => hash_hmac('sha256', $emanemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Tokyo',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $headfaslity = $emanuel->divisionPosition()->create([
            'division_position_id' => $engineering->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workfacility->id,
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
        //CLEANING SERVICE 1
        $emannik = '3173011805860167';
        $emanphone = '0813420987';
        $emanemergency = '0896573012';
        $emanuel = User::create([
            'name' => 'CLEANING SERVICE 1',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'CLEANINGSERVICE001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($emanphone),
            'phone_hash' => hash_hmac('sha256', $emanphone, config('app.key')),
            'emergency' => encrypt($emanemergency),
            'emergency_hash' => hash_hmac('sha256', $emanemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Tokyo',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $headfaslity = $emanuel->divisionPosition()->create([
            'division_position_id' => $cleaningservice->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workfacility->id,
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
        //CLEANING SERVICE 2
        $emannik = '3601057003920126';
        $emanphone = '0831459087';
        $emanemergency = '0877694120';
        $emanuel = User::create([
            'name' => 'CLEANING SERVICE 2',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'CLEANINGSERVICE002',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($emanphone),
            'phone_hash' => hash_hmac('sha256', $emanphone, config('app.key')),
            'emergency' => encrypt($emanemergency),
            'emergency_hash' => hash_hmac('sha256', $emanemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Tokyo',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $headfaslity = $emanuel->divisionPosition()->create([
            'division_position_id' => $cleaningservice->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workfacility->id,
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
        //CLEANING SERVICE 3
        $emannik = '3374062912014149';
        $emanphone = '0613904627';
        $emanemergency = '1813904627';
        $emanuel = User::create([
            'name' => 'CLEANING SERVICE 3',
            'nik' => encrypt($emannik),
            'nik_hash' => hash_hmac('sha256', $emannik, config('app.key')),
            'username' => 'CLEANINGSERVICE003',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($emanphone),
            'phone_hash' => hash_hmac('sha256', $emanphone, config('app.key')),
            'emergency' => encrypt($emanemergency),
            'emergency_hash' => hash_hmac('sha256', $emanemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Tokyo',
            'birthday' => today(),
            'address' => 'Bali, Indonesia'
        ]);
        $headfaslity = $emanuel->divisionPosition()->create([
            'division_position_id' => $cleaningservice->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2 = Templete::create([
            'division_work_time_id' => $workfacility->id,
            'user_id' => $emanuel->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3 = Templete::create([
            'division_work_time_id' => $workfacility->id,
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

        //OFFICE
        //HEAD
        $headofficenik = '778854411235698';
        $headofficephone = '1120012548';
        $headofficeemergency = '7778888555';
        $cika = User::create([
            'name' => 'Head of Office',
            'nik' => encrypt($headofficenik),
            'nik_hash' => hash_hmac('sha256', $headofficenik, config('app.key')),
            'username' => 'HEADOFOFFICE001',
            'email' => 'accstafbemp@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headofficephone),
            'phone_hash' => hash_hmac('sha256', $headofficephone, config('app.key')),
            'emergency' => encrypt($headofficeemergency),
            'emergency_hash' => hash_hmac('sha256', $headofficeemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $headoffice->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offoffice->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //HRD
        $cikanik = '7878787898789878';
        $cikaphone = '8525896545';
        $cikaemergency = '7845698632';
        $cika = User::create([
            'name' => 'Admin HRD',
            'nik' => encrypt($cikanik),
            'nik_hash' => hash_hmac('sha256', $cikanik, config('app.key')),
            'username' => 'ADMINHRD001',
            'email' => 'hr.baliexoticmarinepark@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($cikaphone),
            'phone_hash' => hash_hmac('sha256', $cikaphone, config('app.key')),
            'emergency' => encrypt($cikaemergency),
            'emergency_hash' => hash_hmac('sha256', $cikaemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $hr = $cika->divisionPosition()->create([
            'division_position_id' => $hrd->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offoffice->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //INVENTORY
        $cikanik = '4445552212457856';
        $cikaphone = '7888774583';
        $cikaemergency = '7411110000';
        $cika = User::create([
            'name' => 'Admin Inventory',
            'nik' => encrypt($cikanik),
            'nik_hash' => hash_hmac('sha256', $cikanik, config('app.key')),
            'username' => 'ADMININVENTORY001',
            'email' => 'abemp521@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($cikaphone),
            'phone_hash' => hash_hmac('sha256', $cikaphone, config('app.key')),
            'emergency' => encrypt($cikaemergency),
            'emergency_hash' => hash_hmac('sha256', $cikaemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $inventory->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offoffice->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //ACCOUNTING
        $cikanik = '412222512222201';
        $cikaphone = '7787856985';
        $cikaemergency = '4441124568';
        $cika = User::create([
            'name' => 'Accounting',
            'nik' => encrypt($cikanik),
            'nik_hash' => hash_hmac('sha256', $cikanik, config('app.key')),
            'username' => 'ACCOUNTING001',
            'email' => 'bempacct@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($cikaphone),
            'phone_hash' => hash_hmac('sha256', $cikaphone, config('app.key')),
            'emergency' => encrypt($cikaemergency),
            'emergency_hash' => hash_hmac('sha256', $cikaemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $accounting->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offoffice->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);
        //RECEIVABLE
        $cikanik = '7878896587454578';
        $cikaphone = '1114445452';
        $cikaemergency = '6698555212';
        $cika = User::create([
            'name' => 'Receivable',
            'nik' => encrypt($cikanik),
            'nik_hash' => hash_hmac('sha256', $cikanik, config('app.key')),
            'username' => 'RECEIVABLE001',
            'email' => 'officebemp@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($cikaphone),
            'phone_hash' => hash_hmac('sha256', $cikaphone, config('app.key')),
            'emergency' => encrypt($cikaemergency),
            'emergency_hash' => hash_hmac('sha256', $cikaemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $receivable->id
        ]);
        $templeteoff = Templete::create([
            'division_work_time_id' => $offoffice->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templetemorning = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Morning'
        ]);
        $templeteaternoon = Templete::create([
            'division_work_time_id' => $workoffice->id,
            'user_id' => $cika->id,
            'name' => 'Afternoon'
        ]);
        $templetemorning->templetetime()->create([
            'time_id' => $morning->id
        ]);
        $templeteaternoon->templetetime()->create([
            'time_id' => $afternoon->id
        ]);

        //GUEST EXPERIENCE & EDUCATION
        //HEAD
        $headofficenik = '7778544669999991';
        $headofficephone = '9990000212';
        $headofficeemergency = '0001221021';
        $cika = User::create([
            'name' => 'Head of Host',
            'nik' => encrypt($headofficenik),
            'nik_hash' => hash_hmac('sha256', $headofficenik, config('app.key')),
            'username' => 'HEADOFHOST001',
            'email' => 'headhost123@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headofficephone),
            'phone_hash' => hash_hmac('sha256', $headofficephone, config('app.key')),
            'emergency' => encrypt($headofficeemergency),
            'emergency_hash' => hash_hmac('sha256', $headofficeemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $headged->id
        ]);
        Templete::create([
            'division_work_time_id' => $offged->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
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
        //STAFF 1
        $headofficenik = '0202021356235689';
        $headofficephone = '8585654525';
        $headofficeemergency = '2021222459';
        $cika = User::create([
            'name' => 'Staff of Host 1',
            'nik' => encrypt($headofficenik),
            'nik_hash' => hash_hmac('sha256', $headofficenik, config('app.key')),
            'username' => 'STAFFOFHOST001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headofficephone),
            'phone_hash' => hash_hmac('sha256', $headofficephone, config('app.key')),
            'emergency' => encrypt($headofficeemergency),
            'emergency_hash' => hash_hmac('sha256', $headofficeemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffged->id
        ]);
        Templete::create([
            'division_work_time_id' => $offged->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
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
        //STAFF 2
        $headofficenik = '6666330000012028';
        $headofficephone = '9996665585';
        $headofficeemergency = '1515199650';
        $cika = User::create([
            'name' => 'Staff of Host 2',
            'nik' => encrypt($headofficenik),
            'nik_hash' => hash_hmac('sha256', $headofficenik, config('app.key')),
            'username' => 'STAFFOFHOST002',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headofficephone),
            'phone_hash' => hash_hmac('sha256', $headofficephone, config('app.key')),
            'emergency' => encrypt($headofficeemergency),
            'emergency_hash' => hash_hmac('sha256', $headofficeemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffged->id
        ]);
        Templete::create([
            'division_work_time_id' => $offged->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
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
        //STAFF 3
        $headofficenik = '0000000008000007';
        $headofficephone = '8552100019';
        $headofficeemergency = '9655412000';
        $cika = User::create([
            'name' => 'Staff of Host 3',
            'nik' => encrypt($headofficenik),
            'nik_hash' => hash_hmac('sha256', $headofficenik, config('app.key')),
            'username' => 'STAFFOFHOST003',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headofficephone),
            'phone_hash' => hash_hmac('sha256', $headofficephone, config('app.key')),
            'emergency' => encrypt($headofficeemergency),
            'emergency_hash' => hash_hmac('sha256', $headofficeemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffged->id
        ]);
        Templete::create([
            'division_work_time_id' => $offged->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
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
        //STAFF 4
        $headofficenik = '1111111171111129';
        $headofficephone = '1110002321';
        $headofficeemergency = '1917541239';
        $cika = User::create([
            'name' => 'Staff of Host 4',
            'nik' => encrypt($headofficenik),
            'nik_hash' => hash_hmac('sha256', $headofficenik, config('app.key')),
            'username' => 'STAFFOFHOST004',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => encrypt($headofficephone),
            'phone_hash' => hash_hmac('sha256', $headofficephone, config('app.key')),
            'emergency' => encrypt($headofficeemergency),
            'emergency_hash' => hash_hmac('sha256', $headofficeemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Bali',
            'birthday' => today(),
            'address' => 'Bali Indonesia'
        ]);
        $cika->divisionPosition()->create([
            'division_position_id' => $staffged->id
        ]);
        Templete::create([
            'division_work_time_id' => $offged->id,
            'user_id' => $cika->id,
            'name' => 'Off Day'
        ]);
        $templeteshift1indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 1'
        ]);
        $templeteshift2indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
            'name' => 'Shift 2'
        ]);
        $templeteshift3indra = Templete::create([
            'division_work_time_id' => $workged->id,
            'user_id' => $cika->id,
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
    }
}
