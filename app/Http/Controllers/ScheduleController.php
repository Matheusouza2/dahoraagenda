<?php

namespace App\Http\Controllers;

use App\Models\BarberShop;
use App\Models\Schedule;
use App\Models\ScheduleConfig;
use App\Models\Services;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BarberShop $barberShop = null)
    {
        $unset = true;
        if ($barberShop == null) {
            $unset = false;
            $barberShop = BarberShop::all();
        }

        return view('schedule.index', compact('barberShop', 'unset'));
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
        Schedule::create([
            'barber_shop' => $request->barber_shop,
            'client' => Auth::user()->id,
            'barber' => $request->barber,
            'date' => $request->date,
            'hour' => $request->hour
        ]);

        return response()->json(['message' => 'Agendamento realizado com sucesso !'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    public function consultHour(Request $request)
    {
        $dayWeek = new Carbon($request->date);
        $config = ScheduleConfig::where('day', $dayWeek->dayOfWeek)->where('barber_shop', $request->barber_shop)->first();

        $avgDuration = Services::select([DB::raw('SEC_TO_TIME(AVG(TIME_TO_SEC(duration))) as duration')])->where('barber_shop', $request->barber_shop)->first();

        $hms = explode(":", $avgDuration->duration);
        $interval = ($hms[0] * 60 + ($hms[1]));

        $schedules = Schedule::where('barber', $request->barber)->where('date', $request->date)->get();

        return response()->json(['config' => $config, 'interval' => $interval, 'schedules' => $schedules], 200);
    }

    public function list()
    {
        $schedules = Schedule::select([
            'schedules.date',
            'schedules.hour',
            'barber_shops.name as barber_shop',
            'barber_shops.logo',
            'users.name',
            'schedule_status.description'
        ])
            ->join('barber_shops', 'barber_shops.id', 'schedules.barber_shop')
            ->join('users', 'users.id', 'schedules.barber')
            ->join('schedule_status', 'schedule_status.id', 'schedules.status')
            ->where('client', Auth::user()->id)
            ->simplePaginate(5);

        return response()->json(['schedules' => $schedules], 200);
    }

    public function listScheduleUser()
    {
        return view('pages.services_client');
    }
}
