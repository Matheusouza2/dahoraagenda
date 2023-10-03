<?php

namespace App\Http\Controllers;

use App\Models\BarberShop;
use App\Models\ScheduleClose;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleCloseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(ScheduleClose $scheduleClose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScheduleClose $scheduleClose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScheduleClose $scheduleClose)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleClose $scheduleClose)
    {
        //
    }

    public function consultClosedBarber(BarberShop $barber)
    {
        $closes = [];

        $scheduleClose = ScheduleClose::select([
            DB::raw("DATE_FORMAT(date, '%m/%d/%Y %h:%m %p') as date")
        ])->where('barber_shop', $barber->id)->where('date', '>=', Carbon::now()->format('Y-m-d'))->get();

        $services = Services::where('barber_shop', $barber->id)->get();

        $professionals = DB::table('barber_shop_profissional')
            ->join('users', 'users.id', 'barber_shop_profissional.profissional')
            ->where('barber_shop', $barber->id)
            ->get();

        foreach ($scheduleClose as $key => $value) {
            $closes[] = $value->date;
        }

        return response()->json(['datesClosed' => $closes, 'professionals' => $professionals, 'services' => $services], 200);
    }
}
