 <?php

    use App\Rating;
    use Illuminate\Database\Seeder;

    class RatingSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $rooms = DB::table('rooms')->select(['id', 'title'])->get();

            foreach ($rooms as $room) {
                Rating::create([
                    'user_id' => rand(4, 5),
                    'room_id' => $room->id,
                    'title' => $room->title,
                    'rating' => rand(2, 5),
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
