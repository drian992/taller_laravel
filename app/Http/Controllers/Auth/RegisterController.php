<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    /**
     * Where to redirect users after registration.
     */
    protected $redirectTo = '/'; // minimal change.

    public function __construct()
    {
        // minimal change.
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        // minimal change.
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // minimal change.
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        auth()->login($user);

        return redirect()->intended($this->redirectTo);
    }

    protected function validator(array $data)
    {
        // minimal change.
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string', 'max:255', 'unique:users,dni'],
            'fecha_nacimiento' => ['required', 'date'],
            'domicilio' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // minimal change.
        return User::create([
            'name' => $data['nombre'],
            'nombre' => $data['nombre'],
            'dni' => $data['dni'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'domicilio' => $data['domicilio'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'profile_locked' => true,
        ]);
    }
}
