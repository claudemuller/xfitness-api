<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workout;
use JWTAuth;

class WorkoutsController extends Controller
{
    /**
     * Get all the workouts and return JSON
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWorkouts() {
        $workouts = Workout::all();

        return response()->json([
            'success' => true,
            'data' => $workouts
        ]);
    }

    /**
     * Save a new workout to DB
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function saveWorkout(Request $request)
    {
        $members = json_decode(urldecode($request->members));
        $session_start = date('Y-m-d H:i:s', $request->session_start / 1000);
        $session_end = date('Y-m-d H:i:s', $request->session_end / 1000);
        $user_id = JWTAuth::toUser($request->token)->id;

        $session = Workout::create([
            'user_id' => $user_id,
            'session_start' => $session_start,
            'session_end' => $session_end
        ]);
        $members = array_map(function ($member) {
            return $member->id;
        }, $members);
        $session->members()->attach($members);

        return response()->json([
            'success' => true,
            'message' => 'Workout was successfully saved'
        ]);
    }
}
