<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(FacilitySeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(RatingSeeder::class);
        $this->call(ReportCategorySeeder::class);

    }
}
