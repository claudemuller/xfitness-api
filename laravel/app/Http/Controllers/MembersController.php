<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

class MembersController extends Controller
{
    /**
     * Get all the members and return JSON
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMembers() {
        $members = Member::all();

        return response()->json([
            'success' => true,
            'data' => $members
        ]);
    }

    /**
     * Save all the members to DB
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function saveMembers(Request $request)
    {
        $members = json_decode($request->members);

        foreach ($members as $member) {
            if (!array_key_exists('id', $member)) {
                Member::create([
                    'name' => $member->name
                ]);
            }

            if (property_exists ($member, 'remove')) {
                Member::find($member->id)->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Members were successfully updated'
        ]);
    }
}
