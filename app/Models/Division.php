<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['level_id', 'name', 'slug', 'description'])]
class Division extends Model
{
    /** @use HasFactory<\Database\Factories\DivisionFactory> */
    use HasFactory;
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function unit(): HasOne
    {
        return $this->hasOne(UnitDivision::class, 'division_id');
    }

    public function position(): HasMany
    {
        return $this->hasMany(DivisionPosition::class, 'division_id');
    }

    public function assign(): HasOne
    {
        return $this->hasOne(AssignSupervisor::class, 'division_id');
    }
    public function worktime(): HasMany
    {
        return $this->hasMany(DivisionWorkTime::class, 'division_id');
    }

    //Aksesor
    public function getuser()
    {
        return User::whereHas('divisionPosition.divisionPosition.division', function ($query) {
            $query->where('id', '=', $this->id);
        })->get();
    }

    public function gethead()
    {
        return User::whereHas('divisionPosition.divisionPosition.position', function ($query) {
            $query->where('name', '=', 'Head');
        })->whereHas('divisionPosition.divisionPosition.division', function ($query) {
            $query->where('id', '=', $this->id);
        })->first();
    }

    public function getstaff()
    {
        return User::whereHas('divisionPosition.divisionPosition.position', function ($query) {
            $query->where('name', '=', 'Staff');
        })->whereHas('divisionPosition.divisionPosition.division', function ($query) {
            $query->where('id', '=', $this->id);
        })->get();
    }
}
