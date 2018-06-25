<?php

use Illuminate\Database\Seeder;
use App\Member;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = [
            ['name' => 'Joe Soap'],
            ['name' => 'Piet Retief']
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
