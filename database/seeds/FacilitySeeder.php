<?php

use App\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{

    public function run()
    {
        Facility::create([
           'name' => 'Ample Water'
        ]);

        Facility::create([
            'name' => 'Hot Water'
        ]);

        Facility::create([
            'name' => 'Garden'
        ]);

        Facility::create([
            'name' => 'Laundry'
        ]);

        Facility::create([
            'name' => 'Security System'
        ]);

        Facility::create([
            'name' => 'Wifi'
        ]);

        Facility::create([
            'name' => 'Parking'
        ]);

        Facility::create([
            'name' => 'Attached Bathroom'
        ]);

        Facility::create([
            'name' => 'Balcony'
        ]);

        Facility::create([
            'name' => 'Gym'
        ]);

        Facility::create([
            'name' => 'Spacious Environment'
        ]);
    }
}
