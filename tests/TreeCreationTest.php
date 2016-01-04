<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
//use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TreeCreationTest extends TestCase
{

    use DatabaseTransactions;
    use WithoutMiddleware;

    /**
     * Test that the parent/children relationships work properly on creation, update and on deletion
     *
     * @return void
     */
    public function testTreeWithAuth()
    {
        //User is created and authenticated

        $user = factory(App\User::class)->create();

        $this->be($user);

        $tree = factory(App\Tree::class)->create();

        $this->assertEquals($tree->user->id, $user->id);
        $this->assertEquals($tree->updatedBy->id, $user->id);

        $editing_user = factory(App\User::class)->create();

        $this->be($editing_user);

        $tree->name = 'New Name';
        $tree->save();

        $tree->load('updatedBy');

        $this->assertEquals($tree->updatedBy->id, $editing_user->id);

    }

    /**
     * Test creating a tree without authentification
     *
     * @return void
     */
    public function testTreeWithoutAuth()
    {        
        //User is not authenticated, thus he cannot create a model

        $this->assertHTTPExceptionStatus(401, function ($_this)
        {
            $tree = factory(App\Tree::class)->create();
        });        

    }


}
