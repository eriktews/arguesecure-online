<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserEventTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Test that the user events are being sent properly
     *
     * @return void
     */
    public function testUserConnected()
    {
        //User is created and authenticated
        $credentials = [
            'name'     => 'Test Account',
            'email'    => 'testing@testing.com',
            'password' => 'testing'
        ];

        $user = \App\User::create([
            'name'     => $credentials['name'],
            'email'    => $credentials['email'],
            'password' => bcrypt($credentials['password'])
        ]);

        $this->assertTrue(Auth::attempt($credentials));        
    }

}
