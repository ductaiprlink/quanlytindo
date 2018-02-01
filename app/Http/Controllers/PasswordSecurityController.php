<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PasswordSecurity;
use Auth;
use Hash;

class PasswordSecurityController extends Controller
{
    public function show2faForm()
    {
        $user = Auth::user();

        $google2fa_url = '';

        // nếu user đã có password Security
        if (count($user->passwordSecurity))
        {
            $google2fa = app('pragmarx.google2fa');
            $google2fa_url = $google2fa->getQRCodeGoogleUrl(
                'Quan ly tin do Phat duong',
                $user->email,
                $user->passwordSecurity->google2fa_secret
            );
        }

        $data = array(
            'user' => $user,
            'google2fa_url' => $google2fa_url
        );

        return view('auth.2fa')->with('data', $data);
    }

    // tạo key cho 2fa
    public function generate2faSecret()
    {
        $user = Auth::user();
        // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // Add the secret key to the registration data
        PasswordSecurity::create([
            'user_id' => $user->id,
            'google2fa_enable' => 0,
            'google2fa_secret' => $google2fa->generateSecretKey(),
        ]);

        return redirect()->route('2fa')->with('success', 'Mã bí mật đã được tạo thành công. Vui lòng xác thực để kích hoạt 2FA');
    }

    // bật chế độ 2fa
    public function enable2fa(Request $request)
    {
        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');
        $secret = $request->input('verify-code');
        $valid = $google2fa->verifyKey($user->passwordSecurity->google2fa_secret, $secret);
        if($valid){
            $user->passwordSecurity->google2fa_enable = 1;
            $user->passwordSecurity->save();
            return redirect('/admin/2fa')->with('success',"2FA được kích hoạt thành công.");
        }else{
            return redirect('/admin/2fa')->with('error',"Mã OTP không đúng, vui lòng thử lại");
        }
    }

    // tắt chế độ 2fa
    public function disable2fa(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Mật khẩu của bạn không đúng. Vui lòng thử lại");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user = Auth::user();
        $user->passwordSecurity->google2fa_enable = 0;
        $user->passwordSecurity->save();
        return redirect('/admin/2fa')->with('success',"2FA đã bị vô hiệu hóa.");
    }
}
