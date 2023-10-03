<?php

namespace App\Http\Controllers;

use App\Models\BarberShop;
use App\Models\ScheduleConfig;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SertSoft\Laradations\Laradator;

class BarberShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $return = [];
        $today = Carbon::now();
        $now = $today->format('h:i:s');
        $weekDay = $today->dayOfWeek;
        $barberShops = BarberShop::all();

        foreach ($barberShops as $barberShop) {
            $configs = ScheduleConfig::where('day', $weekDay)->where('barber_shop', $barberShop->id)->first();
            $open = false;

            if (($configs?->hour_1 <= $now && $configs?->hour_2 >= $now) || ($configs?->hour_3 <= $now && $configs?->hour_4 >= $now) || ($configs?->hour_5 <= $now && $configs?->hour_6 >= $now)) {
                $open = true;
            } else {
                $open = false;
            }

            $return[] = [
                'id' => $barberShop->id,
                'name' => $barberShop->name,
                'open' => $open,
            ];
        }

        return view('pages.barber_shop', compact('return'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.barber_shop_store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['phone'] = Laradator::sanitize($request->phone, 'telefone');
        $request['whatsapp'] = $request->whatsapp != '' ? Laradator::sanitize($request->whatsapp, 'telefone') : 0;
        $request['userphone'] = Laradator::sanitize($request->userphone, 'telefone');


        $request->validate([
            'phone' => 'unique:barber_shops,phone',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $owner = User::firstOrCreate(['phone' => $request->userphone], [
            'name' => $request->username,
            'user' => $request->userphone,
            'password' => Hash::make($request->userphone),
        ]);

        $request['owner'] = $owner->id;

        $barber = BarberShop::create($request->all());


        DB::table('barber_shop_profissional')->insert([
            "profissional" => $owner,
            "barber_shop" => $barber->id
        ]);

        $path = storage_path("logos/$barber->id/");
        !is_dir($path) &&
            mkdir($path, 0777, true);

        if ($file = $request->file('logo')) {
            $fileData = $this->uploads($file, $path);

            $barber->logo = $fileData['fileName'] . '.' . $fileData['fileType'];
            $barber->save();
        } else {
            $barber->logo = $barber->type == 0 ? "/images/barber/salon.svg" : "/images/barber/barber_shop.svg";
            $barber->save();
        }

        return response()->json(['message' => 'Barbearia criada com sucesso, a senha de acesso é o numero de telefone do responsável!'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(BarberShop $barberShop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarberShop $barberShop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarberShop $barberShop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarberShop $barberShop)
    {
        //
    }

    public function uploads($file, $path)
    {
        if ($file) {
            $fileName   = time() . $file->getClientOriginalName();
            Storage::disk('public')->put($path . $fileName, File::get($file));
            $file_name  = $file->getClientOriginalName();
            $file_type  = $file->getClientOriginalExtension();
            $filePath   = $path . $fileName;

            return $file = [
                'fileName' => $file_name,
                'fileType' => $file_type,
                'filePath' => $filePath,
            ];
        }
    }

    public function consultByPhone($barberShopPhone)
    {
        $barberShop = BarberShop::where('phone', $barberShopPhone)->first();

        return redirect()->route('schedule_client', ['barberShop' => $barberShop->id]);
    }
}
