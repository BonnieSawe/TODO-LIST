<?php

namespace App\Http\Controllers;

use Exception;
    use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as ProviderUser;

class SocialAuthController extends Controller
{

    public function redirect($service)
    {
        // return $service;
        return Socialite::driver($service)->redirect();
    }


    public function callback(Request $request, $service)
    {
        try {
            
            $$oAuthUser = Socialite::driver($service)->stateless()->user();

            $existUser = User::where('email',$$oAuthUser->email)->first();
            

            if($existUser) {
                Auth::loginUsingId($existUser->id);
            }
            else {
                $name = $oAuthUser->getName();
                $exploded = explode(' ', trim($event->user->name));
                $last_name = end($exploded);
                $first_names = trim(str_replace((string) $last_name, '', (string) $event->user->name));
                
                $user = User::create([
                    'name' => $first_name.' '.$other_names,
                    'email' => $providerUser->getEmail(),
                ]);

                Auth::login($user);
            }
            return $this->sendResponse(null, 'Successful');
        } 
        catch (Exception $e) {
            return 'error';
        }
    }

    public function validateToken(Request $request, $provider)
    {
        $token = ($request->id_token);
        

        if ($provider == 'google') {

            $CLIENT_ID = config('services.google.client_id');
            $client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
            $payload = $client->verifyIdToken($token);
            if ($payload) {
                $first_name = $payload['given_name'];
                $other_names = !empty($payload['family_name']) ? $payload['family_name'] : '';
                $email = $payload['email'];
            } else {
                // Invalid ID token
                return $this->sendError('Invalid token, please try again!', null);
            }
            
        }else{
            try {
                $providerUser = Socialite::driver($provider)->userFromToken($token);
                if ($providerUser) {
                    $first_name = $providerUser->getName();
                    $other_names = '';
                    $email = $providerUser->getEmail();
                    $avatar = $providerUser->getAvatar();
                    $user_id = $providerUser->id;
                }
                else {
                    return $this->sendError('Invalid token, please try again!', null);
                }
            } 
            catch (Exception $e) {
                return $this->sendError('Invalid token, please try again!', null);
            }
        }

        $message = 'Login successful!';

        $provider = Provider::where('name', $provider)
                    ->where('provider_id', $user_id)
                    ->first();

        if ($provider) {
            $user = $provider->user;
        } else {
            $user = null;

            $user = User::where('email', $email)->first();

            if (! $user) {
                $user = User::create([
                    'name' => $first_name.' '.$other_names,
                    'email' => $providerUser->getEmail(),
                ]);
                $message = 'Registered successfully!';
            }

            $provider = Provider::create([
                'user_id' =>  $user->id,
                'provider_id' => $providerUser->id,
                'name' => $provider,
            ]);
        }

        $success['data']= new AuthUserResource($user);                    
        $success['data']->token =  $user->createToken('FaMobileCustomer')->accessToken; 
        return $this->sendResponse($success, $message);
    }

    public function findOrCreate(ProviderUser $providerUser, string $provider)
    {
        $message = 'Login successful!';
        $providerUser = Socialite::driver($provider)->stateless()->user();
        
        $provider = Provider::where('name', $provider)
            ->where('provider_id', $providerUser->id)
            ->first();

        if ($provider) {
            $user = $provider->user;
        } else {
            $user = null;

            if ($email = $providerUser->email) {
                $user = User::where('email', $email)->first();
            }

            if (! $user) {
                $user = new User;
                if ($provider == 'google') {
                    $first_name = $providerUser->user['given_name'];
                    $other_names = !empty($providerUser->user['family_name']) ? $providerUser->user['family_name'] : '';
                } else {
                    $first_name = $providerUser->getName();
                    $other_names = '';
                }
                
                $user = User::create([
                    'name' => $first_name.' '.$other_names,
                    'email' => $providerUser->getEmail(),
                ]);
                $message = 'Registered successfully!';
            }

            $provider = Provider::create([
                'user_id' =>  $user->id,
                'provider_id' => $providerUser->id,
                'name' => $provider,
            ]);
        }

        $success['data']= new AuthUserResource($user);                    
        $success['data']->token =  $user->createToken('TODOAppToken')->plainTextToken; 
        return $this->sendResponse($success, $message);
    }
}