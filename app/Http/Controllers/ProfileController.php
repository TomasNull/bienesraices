<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Rules\PhoneFormat;
use App\Rules\StrengthPassword;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index () {
        $user = auth()->user()->load('socialAccount');

        return view('profile.index', compact('user'));
    }

    public function update() {
        //dd($this);

        $this->validate(request(), [
            //Validación para el campo password. confirmed comprueba que las passwords sean iguales aunque estén vacias
            'password'  => ['confirmed', new StrengthPassword],
            'phone'     => ['required', new PhoneFormat]
        ]);


        $user = auth()->user();
        $client = auth()->user()->client;
        $user->password = bcrypt(request('password'));
        $client->phone_number = request('phone');
        $user->save();
        $client->save();

        return back()->with('message', ['success', __("Información de usuario actualizada correctamente.")]);
        
    }

    public function update_picture(Request $request) {

        if($request->hasFile('picture')) {
            $user = Auth::user();
            \Storage::delete('users/' . $user->picture);
            $picture = Helper::uploadPic("picture", 'users');

            $user->picture = $picture;
            $user->save();
        }

        return back()->with('message', ['success', __("Imagen de perfil actualizada.")]);

    }
}
