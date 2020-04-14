<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MembersControllerTest extends TestCase
{
    /**
     * An example of web redirect
     */
    public function testGetMembersRedirectsToLoginWhenNotAuthed()
    {
        //$response = $this->get('/members');

        //$response->assertRedirect('login');
    }

    public function testGetMembersReturnsSOMETHIWhenNGNotAuthed()
    {
        $response = $this->get('/api/members');

        $response->assertStatus(200);
    }
}
