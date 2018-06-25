<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Member;
use App\Workout;

class WorkoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now_plus_an_hour = Carbon::now()->addHour();
        $plus_an_hour_plus_thirty_mins = $now_plus_an_hour->addHour();

        $workouts = [
            [
                'session_start' => Carbon::now(),
                'session_end' => $now_plus_an_hour,
                'user_id' => 1
            ],
            [
                'session_start' => $plus_an_hour_plus_thirty_mins,
                'session_end' => $plus_an_hour_plus_thirty_mins->addHour(),
                'user_id' => 1
            ],
        ];

        for ($i = 0; $i < count($workouts); $i++) {
            $workouts[$i] = Workout::create($workouts[$i]);
        }

        $members = Member::all();
        $member1 = $members->get(0);
        $member2 = $members->get(1);

        $newWorkouts = Workout::all();
        $newWorkouts->get(0)->members()->attach($member1);
        $newWorkouts->get(1)->members()->attach($member1);
        $newWorkouts->get(1)->members()->attach($member2);
    }
}
