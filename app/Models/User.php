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
use PhpParser\Node\Expr\Assign;

#[Fillable(['name', 'nik', 'nik_hash', 'username', 'email', 'password', 'status', 'phone', 'phone_hash', 'emergency', 'emergency_hash', 'gender', 'born_at', 'birthday', 'religion', 'status_tk', 'rekening', 'rekening_hash', 'bpjs_kes', 'bpjs_kes_hash', 'bpjs_tk', 'bpjs_tk_hash', 'address', 'profile', 'last_activity'])]
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

    public function getunit(): ?string
    {
        return Unit::whereHas('division.division.position.user.user', function ($query) {
            $query->where('id', '=', $this->id);
        })->value('name');
    }

    public function getdivision(): ?string
    {
        return Division::whereHas('position.user.user', function ($query) {
            $query->where('id', '=', $this->id);
        })->value('name');
    }

    public function getposition(): ?string
    {
        return DivisionPosition::whereHas('user.user', function ($query) {
            $query->where('id', '=', $this->id);
        })->value('name');
    }

    public function web()
    {
        return Permission_web::whereHas('divisionPosition', function ($query) {
            $query->where('name', '=', $this->getposition());
        })->with(['web'])->get();
    }
    public function api()
    {
        return Permission_api::whereHas('divisionPosition', function ($query) {
            $query->where('name', '=', $this->getposition());
        })->with(['api'])->get();
    }
    public function getpermissionweb($position)
    {
        return Web::whereHas('permissionweb.divisionPosition', function ($query) use ($position) {
            $query->where('name', '=', $position);
        })->pluck('route');
    }
    public function getpermissionapi($position)
    {
        return Api::whereHas('permissionapi.divisionPosition', function ($query) use ($position) {
            $query->where('name', '=', $position);
        })->pluck('route');
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
    public function divisionPosition(): HasOne
    {
        return $this->hasOne(UserDivisionPosition::class, 'user_id');
    }
    public function division(): HasMany
    {
        return $this->hasMany(AssignSupervisor::class, 'user_id');
    }
    public function templete(): HasMany
    {
        return $this->hasMany(Templete::class, 'user_id');
    }
    public function contract(): HasMany
    {
        return $this->hasMany(ContractUser::class, 'user_id');
    }
    public function purchaseorder(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'spv_id');
    }
    public function workorder(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'spv_id');
    }
}
