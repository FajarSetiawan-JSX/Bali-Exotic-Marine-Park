<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\Priority;
use App\Models\TypeSchedule;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
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
        //Jabatan
        $head = Position::create([
            'name' => 'Head',
            'slug' => 'head'
        ]);
        $employe = Position::create([
            'name' => 'Employe',
            'slug' => 'employe'
        ]);
        // Jenis waktu kerja
        $fullTime = TypeSchedule::create([
            'name' => 'Full Time',
            'slug' => 'full-time'
        ]);
        $shifting = TypeSchedule::create([
            'name' => 'Shifting',
            'slug' => 'shifting'
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
        $superadmin = $level1->division()->create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'description' => 'The division with the highest access rights, responsible for managing system operations, master data, and all company activities.'
        ]);
        $supervisor = $level2->division()->create([
            'name' => 'Supervisor',
            'slug' => 'supervisor',
            'description' => 'Oversee divisional operations, manage the report approval process, and ensure the smooth functioning of each divisions activities.'
        ]);
        $security = $level3->division()->create([
            'name' => 'Security',
            'slug' => 'security',
            'description' => 'Maintaining the security of the company premises, monitoring access, and ensuring order and operational safety.'
        ]);
        $fishroom = $level3->division()->create([
            'name' => 'Fishroom',
            'slug' => 'fishroom',
            'description' => 'Manage fishroom operations, carry out fish husbandry, and ensure the maintenance of environmental quality and fish health.'
        ]);
        $veterinary = $level3->division()->create([
            'name' => 'Veterirary',
            'slug' => 'veterirary',
            'description' => 'Managing animal health, and performing examinations, treatments, and disease prevention to ensure animal welfare.'
        ]);
        $sustainable = $level3->division()->create([
            'name' => 'Sustainable',
            'slug' => 'sustainable',
            'description' => 'Responsible for developing and overseeing the implementation of sustainability practices, environmental management, and resource efficiency, as well as ensuring company operations comply with applicable standards and regulations.'
        ]);
        $development = $level3->division()->create([
            'name' => 'Development',
            'slug' => 'development',
            'description' => 'Responsible for designing, developing, and implementing innovations to enhance product quality and operational efficiency, as well as supporting the companys business development.'
        ]);
        $trainer = $level3->division()->create([
            'name' => 'Trainer',
            'slug' => 'trainer',
            'description' => 'Managing and conducting employee training and competency development programs.'
        ]);
        $kitchen = $level3->division()->create([
            'name' => 'Kitchen',
            'slug' => 'kitchen',
            'description' => 'Responsible for preparing, processing, and serving food in accordance with company standards, as well as maintaining cleanliness, quality, and food safety in the kitchen area.'
        ]);
        $facility = $level3->division()->create([
            'name' => 'Facility Care',
            'slug' => 'facility-care',
            'description' => 'Responsible for facility maintenance, the repair of infrastructure and amenities, and utility management, as well as ensuring the work environment remains safe, comfortable, and conducive to the smooth operation of the company.'
        ]);
        $office = $level3->division()->create([
            'name' => 'Admin Office',
            'slug' => 'admin-office',
            'description' => 'Responsible for managing company administration, document archiving, report preparation, and correspondence, as well as supporting coordination and smooth operations across all divisions.'
        ]);
        $reception = $level3->division()->create([
            'name' => 'Reception',
            'slug' => 'reception',
            'description' => 'Responsible for receiving and welcoming guests, managing telephone communications, scheduling visits, providing information to visitors, and supporting smooth operations and administration in the reception area.'
        ]);
        $reservation = $level3->division()->create([
            'name' => 'Reservation',
            'slug' => 'reservation',
            'description' => 'Responsible for managing the reservation process, scheduling services, confirming bookings, and ensuring that all reservation data is accurately recorded and well-coordinated.'
        ]);
        $photoboth = $level3->division()->create([
            'name' => 'Photoboth',
            'slug' => 'photoboth',
            'description' => 'Responsible for managing photobooth service operations, serving customers, ensuring equipment functions properly, and producing high-quality photo documentation.'
        ]);
        $host = $level3->division()->create([
            'name' => 'Host',
            'slug' => 'host',
            'description' => 'Responsible for greeting guests, coordinating guest services, providing information, and ensuring a welcoming and enjoyable experience throughout their visit.'
        ]);
        $waiter = $level3->division()->create([
            'name' => 'Waiter',
            'slug' => 'waiter',
            'description' => 'Responsible for providing professional table service, taking customer orders, serving food and beverages, and ensuring guest satisfaction throughout the dining experience.'
        ]);
        $Sanik = '1234567891011121';
        $Saphone = '12345678910';
        $Saemergency = '01987654321';
        $SaFajar = $superadmin->user()->create([
            'name' => 'Fajar Gates',
            'nik' => encrypt($Sanik),
            'nik_hash' => hash_hmac('sha256', $Sanik, config('app.key')),
            'username' => 'Gateskuy123',
            'email' => 'fajarstn21@gmail.com',
            'password' => Hash::make('password'),
            'phone' => encrypt($Saphone),
            'phone_hash' => hash_hmac('sha256', $Saphone, config('app.key')),
            'emergency' => encrypt($Saemergency),
            'emergency_hash' => hash_hmac('sha256', $Saemergency, config('app.key')),
            'gender' => 'male',
            'born_at' => 'Munich',
            'birthday' => today(),
            'address' => 'Jakarta keras RT69 RW666'
        ]);
        $spvnik = '121110987654321';
        $spvphone = '111111111111';
        $spvemergency = '22222222222';
        $SpvRans = $supervisor->user()->create([
            'name' => 'Rans Queen',
            'nik' => encrypt($spvnik),
            'nik_hash' => hash_hmac('sha256', $spvnik, config('app.key')),
            'username' => 'Quenku123',
            'email' => '21102183@ittelkom-pwt.ac.id',
            'password' => Hash::make('password'),
            'phone' => encrypt($spvphone),
            'phone_hash' => hash_hmac('sha256', $spvphone, config('app.key')),
            'emergency' => encrypt($spvemergency),
            'emergency_hash' => hash_hmac('sha256', $spvemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Milan',
            'birthday' => today(),
            'address' => 'Sebelah monas kiri dikit ada parkiran nah disitu'
        ]);
        $hostnik = '2122232425262728';
        $hostphone = '333333333333';
        $hostemergency = '333333333333';
        $Host = $host->user()->create([
            'name' => 'Alma pion',
            'nik' => encrypt($hostnik),
            'nik_hash' => hash_hmac('sha256', $hostnik, config('app.key')),
            'username' => 'StupidJ0cker',
            'email' => 'bella062@gmail.com',
            'password' => Hash::make('password'),
            'phone' => encrypt($hostphone),
            'phone_hash' => hash_hmac('sha256', $hostphone, config('app.key')),
            'emergency' => encrypt($hostemergency),
            'emergency_hash' => hash_hmac('sha256', $hostemergency, config('app.key')),
            'gender' => 'female',
            'born_at' => 'Manchaster',
            'birthday' => today(),
            'address' => 'Bawah kolong tol bekasi'
        ]);
    }
}
