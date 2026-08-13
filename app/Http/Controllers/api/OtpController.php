<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\OTP as MailOTP;
use App\Models\Otp;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    private function generate(){
        return random_int(100000, 999999);
    }

    public function sendforchangepass(){
        $user = Auth::user();
        DB::beginTransaction();
        try{
            do{
                $otp = $this->generate();
                $otp_hash = hash_hmac('sha256', $otp, config('app.key'));
                $cek = Otp::where('otp_hash', '=', $otp_hash)->exists();
            }while(!$cek);
            $otp =  $user->otp()->create([
                'otp' => encrypt($otp),
                'otp_hash' => $otp_hash
            ]);
            $user->log()->create([
                'log' => 'Request OTP for change password'
            ]);
            Mail::to($user)->send(new MailOTP(decrypt($otp->otp)));
            DB::commit();
            return response()->json(['message' => 'succes']);
        }catch(Exception $e){
            DB::rollBack();
            Log::error([
                'file' => '/api/OtpController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Internal server Error'], 500);
        }
    }
}
