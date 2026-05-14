<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Customer;

class FacebookController extends Controller
{
    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback() {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = Customer::where('facebook_id', $user->id)->first();
            if ($finduser) {
                Auth::guard('customer')->login($finduser);
                return redirect()->route('candidateList')->with('success', 'Melden Sie sich erfolgreich an');
            } else {
                $newUser = Customer::create([
                    'name' => $user->name, 
                    'email' => $user->email, 
                    'status'=>0,
                    'password' => bcrypt('cubon123456789'),
                    'facebook_id' => $user->id]
                );
                Auth::guard('customer')->login($newUser);
                return redirect()->route('candidateList')->with('success', 'Melden Sie sich erfolgreich an');
            }
        }
        catch(Exception $e) {
            return redirect('auth/facebook');
        }
    }
}
