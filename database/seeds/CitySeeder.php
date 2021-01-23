<?php

use App\City;
use App\Place;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{

    public function run()
    {
        $kathmandu = City::Create([
            'name' => 'Kathmandu',
            'latitude' => 27.700769,
            'longitude' => 85.300140,
        ]);

        $lalitpur = City::Create([
            'name' => 'Lalitpur',
            'latitude' => 27.541967,
            'longitude' => 85.334297,
        ]);

        $bhaktapur = City::Create([
            'name' => 'Bhaktapur',
            'latitude' => 27.672968,
            'longitude' => 85.429291,
        ]);

        //Kathmandu
        Place::Create([
            'name' => 'Chabahil',
            'city_id' => $kathmandu->id,
            'latitude' => 27.71678,
            'longitude' => 85.353674,
        ]);

        Place::Create([
            'name' => 'Boudha',
            'city_id' => $kathmandu->id,
            'latitude' => 27.719549,
            'longitude' => 85.361023,
        ]);

        Place::Create([
            'name' => 'New Baneshwor',
            'city_id' => $kathmandu->id,
            'latitude' => 27.700704,
            'longitude' => 85.335951,
        ]);

        Place::Create([
            'name' => 'DilliBazar',
            'city_id' => $kathmandu->id,
            'latitude' => 27.705339,
            'longitude' => 85.326308,
        ]);

        //Lalitpur
        Place::Create([
            'name' => 'Jawalakhel',
            'city_id' => $lalitpur->id,
            'latitude' => 27.672355,
            'longitude' => 85.313642,
        ]);

        Place::Create([
            'name' => 'Sanepa',
            'city_id' => $lalitpur->id,
            'latitude' => 27.68368,
            'longitude' => 85.308285,
        ]);

        Place::Create([
            'name' => 'Pulchowk',
            'city_id' => $lalitpur->id,
            'latitude' => 27.678208,
            'longitude' => 85.320212,
        ]);

        Place::Create([
            'name' => 'Balkhu',
            'city_id' => $lalitpur->id,
            'latitude' => 27.672355,
            'longitude' => 85.313642,
        ]);

        //Bhakatapur
        Place::Create([
            'name' => 'Lokanthali',
            'city_id' => $bhaktapur->id,
            'latitude' => 27.679576,
            'longitude' => 85.356604,
        ]);

        Place::Create([
            'name' => 'Sano thimi',
            'city_id' => $bhaktapur->id,
            'latitude' => 27.682768,
            'longitude' => 85.371188,
        ]);

        Place::Create([
            'name' => 'Imadol',
            'city_id' => $bhaktapur->id,
            'latitude' => 27.667186,
            'longitude' => 85.345112,
        ]);

        Place::Create([
            'name' => 'BalKot',
            'city_id' => $bhaktapur->id,
            'latitude' => 27.669238,
            'longitude' => 85.359436,
        ]);

    }
}
