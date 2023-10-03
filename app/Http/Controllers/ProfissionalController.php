<?php

namespace App\Http\Controllers;

use App\Models\BarberShop;
use App\Models\BarberShopProfissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfissionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barberShops = BarberShop::where('owner', Auth::user()->id)->get();
        $barberShopProfessional = BarberShopProfissional::where('barber_shop', $barberShops[0]->id)->get();
        session(['owner' => true]);
        return view('pages.home_barber', compact('barberShops', 'barberShopProfessional'));
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
        //
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
}
