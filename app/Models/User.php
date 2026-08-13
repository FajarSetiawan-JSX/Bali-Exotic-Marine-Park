<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'nik', 'nik_hash', 'username', 'email', 'password', 'status', 'phone', 'phone_hash', 'emergency', 'emergency_hash', 'gender', 'born_at', 'birthday', 'address', 'profile', 'last_activity'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //Aksesor
    public function getlevel(): ?int
    {
        return Level::whereHas('division.position.user.user', function ($query) {
            $query->where('id', '=', $this->id);
        })->value('level');
    }

    public function getdivision(): ?string
    {
        return Division::whereHas('position.user.user', function ($query) {
            $query->where('id', '=', $this->id);
        })->value('name');
    }

    public function getposition()
    {
        return DivisionPosition::whereHas('user.user', function ($query) {
            $query->where('id', '=', $this->id);
        })->pluck('name');
    }
    //penutup aksesor

    public function log(): HasMany
    {
        return $this->hasMany(Log::class, 'user_id');
    }
    public function otp(): HasMany
    {
        return $this->hasMany(Log::class, 'user_id');
    }
    public function divisionPosition(): HasMany
    {
        return $this->hasMany(UserDivisionPosition::class, 'user_id');
    }
}
