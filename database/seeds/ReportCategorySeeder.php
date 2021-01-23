<?php

use App\ReportCategory;
use Illuminate\Database\Seeder;

class ReportCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportCategory::create([
            'name' => 'Report',
        ]);

        ReportCategory::create([
            'name' => 'Request Feature',
        ]);

        ReportCategory::create([
            'name' => 'UnBan Request',
        ]);


    }
}
