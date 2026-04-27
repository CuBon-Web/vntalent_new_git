<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordRequest;
use App\models\PasswordReset;
use App\Customer;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function showForgetForm()
    {
        return view('auth.forgot_password');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = Customer::where('email', $request->email)->first();
        if($user){
            $passwordReset = PasswordReset::updateOrCreate([
                'email' => $user->email,
            ], [
                'token' => Str::random(60),
                'created_at' => Carbon::now(),
            ]);
            if ($passwordReset) {
                $user->notify(new ResetPasswordRequest($passwordReset->token));
            }
      
            return back()->with('success','Chúng tôi sẽ gửi thông báo về email của bạn');
        }else{
            return back()->with('error', 'Email không tồn tại');
        }
        
    }
    public function reset(Request $request, $token)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed'
        ]);

        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset) {
            return back()->with('error', 'Link không hợp lệ hoặc đã hết hạn');
        }
        if (Carbon::parse($passwordReset->created_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return back()->with('error', 'Link đã hết hạn');
        }
        $user = Customer::where('email', $passwordReset->email)->first();
        if (!$user) {
            return back()->with('error', 'Tài khoản không tồn tại');
        }
        $user->password = bcrypt($request->new_password);
        $user->save();
        $passwordReset->delete();
        return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công, vui lòng đăng nhập lại');
    }
    public function getReset($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset) {
            return redirect()->route('password.forgot')->with('error', 'Link không hợp lệ hoặc đã hết hạn');
        }

        if (Carbon::parse($passwordReset->created_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return redirect()->route('password.forgot')->with('error', 'Link đã hết hạn');
        }

        $data['email'] = $passwordReset->email;
        return view('auth.reset_pass', $data);
    }
}
