<?php

namespace Database\Seeders;

use App\Models\TravelAddress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelAddressLatLngSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $travelAddresses = TravelAddress::all();

        foreach ($travelAddresses as $travelAddress) {
            if (!empty($travelAddress->coord)) {
                $coord = explode(',', $travelAddress->coord);
                DB::table('travel_address')->where('id', $travelAddress->id)->update([
                    'lat' => $coord[0],
                    'lng' => $coord[1],
                ]);
            }
        }

    }
}
