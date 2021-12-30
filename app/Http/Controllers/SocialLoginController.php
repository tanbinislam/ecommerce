<?php

namespace App\Http\Controllers;

use App\Models\SocialLogin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class SocialLoginController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver)
    {
        $oAuthUser = Socialite::driver($driver)->user();
        dd($oAuthUser);
        $socialUser = SocialLogin::where('driver', $driver)->where('driver_id', $oAuthUser->id)->first();
        $savedUser = User::where('email', $oAuthUser->email)->first();

        if($socialUser){
            $socialUser->update([
                'token' => $oAuthUser->token,
                'refresh_token' => $oAuthUser->refreshToken,
            ]);
            $user = $socialUser->user;
        }elseif($savedUser){
            SocialLogin::create([
                'driver' => $driver,
                'token' => $oAuthUser->token,
                'refresh_token' => $oAuthUser->refreshToken,
                'driver_id' => $oAuthUser->id,
                'user_id' => $savedUser->id,
            ]);
            $user = $savedUser;
        }else{
            $user = User::create([
                'name' => $oAuthUser->name,
                'email' => $oAuthUser->email,
                'user_name' => 'UN'.Str::random(9),
            ]);
            
            $role = Role::findOrCreate('Customer');
            $user->assignRole($role);

            SocialLogin::create([
                'driver' => $driver,
                'token' => $oAuthUser->token,
                'refresh_token' => $oAuthUser->refreshToken,
                'driver_id' => $oAuthUser->id,
                'user_id' => $user->id,
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}
