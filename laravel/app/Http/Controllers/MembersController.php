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
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveMembers()
    {

        return response()->json([
            'success' => true,
            'message' => 'Users were successfully saved'
        ]);
    }
}
