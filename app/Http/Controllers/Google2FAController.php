<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google2FA;

class Google2FAController extends Controller
{
    public function index(){
//        return Google2FA::generateSecretKey();
        $google2fa_secret = Google2FA::generateSecretKey();
//        dd($google2fa_secret);
        $google2fa_url  = Google2FA::getQRCodeGoogleUrl('PowerKnit', 'ldt1992@gmail.com', $google2fa_secret);
        return view('tests.google2fa', compact('google2fa_url', 'google2fa_secret'));
    }

    public function active(Request $request){
        $secret = $request->input('secret');
        $google2fa_secret = $request->google2fa_secret;
        $valid = Google2FA::verifyKey($google2fa_secret, $secret);

        dd($valid);
    }
}
