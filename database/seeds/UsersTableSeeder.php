<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'admin' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        //owner 1 

        $owner1 = User::create([
            'name' => 'Mr. Owner 1',
            'email' => 'owner1@mail.com',
            'password' => bcrypt('password'),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $owner1->owner()->create([
            'phone' => '123456789',
            'city_id' => 3,
            'place_id' => 11,
            'link' => 'www.google.com',
            'description' => 'I am owner number one',
            'created_at' => \Carbon\Carbon::now()
        ]);

        //owner2
        $owner2 = User::create([
            'name' => 'Mr. Owner 2',
            'email' => 'owner2@mail.com',
            'password' => bcrypt('password'),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $owner2->owner()->create([
            'phone' => '123456789',
            'city_id' => 3,
            'place_id' => 11,
            'link' => 'www.google.com',
            'description' => 'I am owner number one',
            'created_at' => \Carbon\Carbon::now()
        ]);

        //seeker one
        $seeker1 = User::create([
            'name' => 'Mr. Seeker 1',
            'email' => 'seeker1@mail.com',
            'password' => bcrypt('password'),
            'role' => 2,
            'email_verified_at' => Carbon\Carbon::now()
        ]);

        $seeker1->seeker()->create([
            'phone' => '123456789',
            'link' => 'www.google.com',
            'alternate_phone' => '1234567',
            'place_id' => 1,
            'city_id' => 1,
            'description' => 'I am owner number one',
            'created_at' => \Carbon\Carbon::now()
        ]);

        //seeker 2
        $seeker2 = User::create([
            'name' => 'Mr. Seeker 2',
            'email' => 'seeker2@mail.com',
            'password' => bcrypt('password'),
            'role' => 2,
            'email_verified_at' => Carbon\Carbon::now()
        ]);
        
        $seeker2->seeker()->create([
            'phone' => '123456789',
            'link' => 'www.google.com',
            'alternate_phone' => '1234567',
            'place_id' => 5,
            'city_id' => 2,
            'description' => 'I am owner number one',
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
