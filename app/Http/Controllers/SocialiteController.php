<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();

            $user = User::where('provider_id', $socialiteUser->getId())
                        ->where('provider_name', $provider)
                        ->first();

            if ($user) {
                Auth::login($user);
                return redirect('/dashboard');
            }

            session([
                'socialite_user' => [
                    'name' => $socialiteUser->getName() ?? $socialiteUser->getNickname(),
                    'email' => $socialiteUser->getEmail(),
                    'provider_name' => $provider,
                    'provider_id' => $socialiteUser->getId(),
                    'avatar' => $socialiteUser->getAvatar(),
                ]
            ]);

            return Redirect::route('auth.complete-registration');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Gagal melakukan autentikasi dengan ' . $provider);
        }
    }

    public function showCompleteRegistrationForm()
    {
        if (!session()->has('socialite_user')) {
            return redirect('/login')->withErrors('Sesi registrasi tidak valid. Silakan coba lagi.');
        }

        return Inertia::render('Auth/CompleteRegistration');
    }

    public function storeCompleteRegistration(Request $request)
    {
        if (!session()->has('socialite_user')) {
            return redirect('/login')->withErrors('Sesi registrasi tidak valid. Silakan coba lagi.');
        }

        $request->validate([
            'phone_number' => ['required', 'string', 'regex:/^628[0-9]{8,13}$/', 'unique:users'],
        ]);

        $socialiteData = session('socialite_user');

        $user = User::create([
            'name' => $socialiteData['name'],
            'email' => $socialiteData['email'],
            'provider_name' => $socialiteData['provider_name'],
            'provider_id' => $socialiteData['provider_id'],
            'phone_number' => $request->phone_number,
            'avatar' => $socialiteData['avatar'] ?? null,
            'email_verified_at' => now(),
        ]);

        session()->forget('socialite_user');

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function deleteRedirect(string $provider)
    {
        $callbackUrl = route('auth.delete.callback', $provider);

        return Socialite::driver($provider)
            ->with(['redirect_uri' => $callbackUrl])
            ->redirect();
    }

    public function deleteCallback(string $provider, Request $request)
    {

        $user = Auth::user();

        $callbackUrl = route('auth.delete.callback', $provider);

        $socialiteUser = Socialite::driver($provider)->redirectUrl($callbackUrl)->user();

        if (!$user || $user->provider_id !== $socialiteUser->getId()) {
            return redirect()->route('profile.edit')->withErrors(['delete' => 'Authentication failed. Could not delete account.']);
        }

        $userName = $user->name;

        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', "Account for {$userName} has been successfully deleted.");
    }
}
