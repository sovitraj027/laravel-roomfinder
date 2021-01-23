<?php

namespace Tests\Feature;

use App\City;
use App\Room;
use App\User;
use App\Place;
use App\Category;
use App\Applicant;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeekerActivityTest extends TestCase
{
    use RefreshDatabase;

    public function city()
    {
        $kathmandu = City::Create([
            'name' => 'Kathmandu',
            'latitude' => 27.700769,
            'longitude' => 85.300140,
        ]);

        return $kathmandu;
    }

    public function place()
    {
        $chabhil = Place::Create([
            'name' => 'Chabahil',
            'city_id' => $this->city()->id,
            'latitude' => 27.71678,
            'longitude' => 85.353674,
        ]);
        return $chabhil;
    }

    public function category()
    {
        $category = Category::create([
            'name' => 'Test Category'
        ]);
        return $category;
    }


    /** @test */
    public function seeker_can_create_application()
    {

        $this->withoutExceptionHandling();

        $owner = factory(User::class)->create([
            'name' => 'Test Owner',
            'email' => 'test_owner@mail.com',
            'password' => bcrypt('password'),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

         $this->actingAs($owner)->post('/room', [
            'title' => 'Test',
            'city_id' => $this->city()->id,
            'place_id' => $this->place()->id,
            'price' => 1000,
            'user_id' => $owner->id,
            'total_rooms' => 5,
            'category_id' => $this->category()->id,
            'description' => 'adasdadasdasdasd asdasdasd',
        ]);

        $owner_room = Room::first();

        //seeker can log in
        $seeker = factory(User::class)->create([
            'name' => 'Test Seeker',
            'email' => 'test_seeker@mail.com',
            'password' => bcrypt('password'),
            'role' => 2,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        
        Applicant::create([
            'user_id' => $seeker->id,
            'message' => "Random message",
            'room_id' => $owner_room->id,
        ]);

        $this->assertCount(1, Applicant::all());
    }
}
