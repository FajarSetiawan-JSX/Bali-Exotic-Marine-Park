<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['email', 'token', 'used'])]
class ForgetPassword extends Model
{
    //
}
