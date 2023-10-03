<?php

namespace App\Http\Controllers;

use App\Models\BarberShop;
use App\Models\BarberShopProfissional;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SertSoft\Laradations\Laradator;
use Symfony\Component\HttpFoundation\Cookie;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home_client');
        }

        return view('hero_block');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['phone'] = Laradator::sanitize($request->phone, 'telefone');
        $request->validate([
            "name" => "required",
            "phone" => "required|unique:users,phone"
        ], [
            "phone.required" => "É preciso informar o telefone para se cadastrar",
            "phone.unique" => "O telefone informado já está cadastrado"
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'user' => $request->phone,
            'password' => Hash::make($request->phone)
        ]);

        if (Auth::attempt(['user' => $user->user, 'password' => $user->user], true)) {
            $token = Auth::user()->createToken('JWT');
        }
        $cookie = new Cookie('_user_token', $token->plainTextToken);
        return redirect()->route('home_client')->withCookie($cookie);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        $request['user'] = Laradator::sanitize($request->user, 'telefone');
        $client = false;

        if (!$request->exists('password')) {
            $request['password'] = $request->user;
            $client = true;
        }

        if (Auth::attempt(['user' => $request->user, 'password' => $request->password], true)) {
            $token = Auth::user()->createToken('user_token');

            $cookie = new Cookie('_user_token', $token->plainTextToken);
            if ($client) {
                return redirect()->route('home_client')->withCookie($cookie);
            } else {
                return redirect()->route('home_barber')->withCookie($cookie);;
            }
        } else {
            return redirect()->back()->withErrors(['login' => 'Usuário não encontrado, tente realizar seu cadastro ou entre em contato com o suporte !'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        Session::flush();
        Auth::logout();

        return redirect()->route('hero_block');
    }
}
