<?php

namespace App\Http\Requests;

use AuthException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LoginRequest extends BaseFormRequest
{
   public function rules(): array
    {
        return [
                "email" => ['required','max:100'],
                "password" => ['required','max:100'],
        ];  
    }


    public function authenticate(){
        $this->ensureIsNotRateLimited();
        $dataForAttempt = $this->validate($this->rules());
        // $dataForAttempt = array_merge($dataForAttempt, ["role" => "CANDIDATE"]);

        if (!Auth::attempt($dataForAttempt)) {
            RateLimiter::hit($this->throttleKey());
            throw new AuthException("Email atau password salah");
        }
        $user = Auth::user();
        // if($user->is_banned){
        //     // throw new CustomAuthException("Akun anda telah di banned. Alasan : " . $user->banned_reason);
        // }

        if(is_null($user->email_verified_at)){  
            return false;
        }

        RateLimiter::clear($this->throttleKey());
        return  $user;
    }



    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
        Log::info("Rate Limited : " . $this->throttleKey());

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw new AuthException("Terlalu banyak percobaan login. Silahkan coba lagi dalam $seconds detik");
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }

}


