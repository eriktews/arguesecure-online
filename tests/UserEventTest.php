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

    /**
     * Test that the user deletion triggers deletion of trees
     *
     * @return void
     */
    public function testUserDeletion()
    {
        $owner = factory(App\User::class)->create();
        $owner_id = $owner->id;

        $this->be($owner);

        factory(App\Tree::class,2)->create();

        $owner->delete();

        $this->assertTrue(App\Tree::where('user_id','=',$owner_id)->get()->isEmpty());

    }

}
