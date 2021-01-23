<?php

namespace Tests\Feature;

use App\City;
use App\Room;
use App\User;
use App\Owner;
use App\Place;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OwnerActivityTest extends TestCase
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
    public function owner_can_create_a_room()
    {
        $this->withoutExceptionHandling();

        //owner can log in
        $owner = factory(User::class)->create([
            'name' => 'Test Owner',
            'email' => 'test_owner@mail.com',
            'password' => bcrypt('password'),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $response = $this->actingAs($owner)->post('/room', [
            'title' => 'Test',
            'city_id' => $this->city()->id,
            'place_id' => $this->place()->id,
            'price' => 1000,
            'user_id' => $owner->id,
            'total_rooms' => 5,
            'category_id' => $this->category()->id,
            'description' => 'adasdadasdasdasd asdasdasd',

        ]);

        $this->assertCount(1, Room::all());
        $response->assertRedirect('/room');
    }

    /** @test */
    public function owner_can_update_a_room()
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

        $room = Room::first();

        $response = $this->actingAs($owner)->patch('/room/' . $room->id, [
            'title' => 'Test updated',
            'city_id' => $this->city()->id,
            'place_id' => $this->place()->id,
            'price' => 9000,
            'user_id' => $owner->id,
            'total_rooms' => 5,
            'category_id' => $this->category()->id,
            'description' => 'test updated description',
        ]);

        $this->assertEquals('Test updated', Room::first()->title);
        $response->assertRedirect('/room');
    }

    /** @test */
    public function owner_can_delete_a_room()
    {
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

        $this->assertCount(1, Room::all());

        $room = Room::first();

        $room->delete('/room/' . $room->id);

        $this->assertCount(0, Room::all());
    }

    /** @test */
    public function owner_can_create_update_delete_a_profile()
    {
        $this->withoutExceptionHandling();

        //owner can log in
        $owner = factory(User::class)->create([
            'name' => 'Test Owner',
            'email' => 'test_owner@mail.com',
            'password' => bcrypt('password'),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $this->actingAs($owner)->post('/owner', [
            'phone' => '123456789',
            'city_id' => $this->city()->id,
            'place_id' => $this->place()->id,
            'description' => 'hello world',
            'user_id' => $owner->id,
            'name' => $owner->name,
            'email' => $owner->email
        ]);

        $this->assertCount(1, Owner::all());

        $owner_profile = Owner::first();

        $this->actingAs($owner)->patch('/owner/' . $owner_profile->id, [
            'phone' => '987654321',
            'city_id' => $this->city()->id,
            'place_id' => $this->place()->id,
            'description' => 'hello world',
            'user_id' => $owner->id,
            'name' => $owner->name,
            'email' => $owner->email
        ]);

        $this->assertEquals('987654321', Owner::first()->phone);

        $owner_profile->delete('/owner/' . $owner_profile->id);

        $this->assertCount(0, Owner::all());
    }

    /** @test */
    public function owner_cannot_access_other_users_endpoint()
    {
        $this->withoutExceptionHandling();

        //owner can log in
        $owner = factory(User::class)->create([
            'name' => 'Test Owner',
            'email' => 'test_owner@mail.com',
            'password' => bcrypt('password'),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $response = $this->actingAs($owner)->get('/admin/all_users');
        $response->assertRedirect('/');
        $response = $this->actingAs($owner)->get('/seeker/dashboard');
        $response->assertRedirect('/');
    }
}
