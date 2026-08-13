<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\DivisionPosition;
use App\Models\Level;
use App\Models\Position;
use App\Models\Priority;
use App\Models\SessionWork;
use App\Models\TypeSchedule;
use App\Models\Unit;
use App\Models\User;
use App\Models\WorkTime;
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
        WorkTime::create([
            'name' => 'Full Time',
            'slug' => 'full-time',
        ]);

        WorkTime::create([
            'name' => 'Shifting',
            'slug' => 'shifting',
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

        $Fanik = '1234567891011121';
        $Faphone = '12345678910';
        $Faemergency = '01987654321';
        $Fajar = User::create([
            'name' => 'Fajar Gates',
            'nik' => encrypt($Fanik),
            'nik_hash' => hash_hmac('sha256', $Fanik, config('app.key')),
            'username' => 'Gateskuy123',
            'email' => 'fajarstn21@gmail.com',
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
    }
}
