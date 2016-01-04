<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
//use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TreeEventTest extends TestCase
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

        $owner = factory(App\User::class)->create();

        $this->be($owner);

        $tree = factory(App\Tree::class)->create();

        $this->assertEquals($tree->user->id, $owner->id);
        $this->assertEquals($tree->updatedBy->id, $owner->id);

        $editing_user = factory(App\User::class)->create();

        $this->be($editing_user);

        $tree->name = 'New Name';
        $tree->save();

        $tree->load('updatedBy');

        $this->assertEquals($tree->updatedBy->id, $editing_user->id);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testTreeWithoutAuth()
    {        
        $tree = factory(App\Tree::class)->create();
    }
   
    public function testTreeDelete()
    {
        //User should be able to edelete the tree

        $owner = factory(App\User::class)->create();

        $this->be($owner);

        $tree = factory(App\Tree::class)->create();

        $tree->delete();

    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testTreeDeleteException()
    {
        $owner = factory(App\User::class)->create();

        $this->be($owner);

        $tree = factory(App\Tree::class)->create();

        $editing_user = factory(App\User::class)->create();

        $this->be($editing_user);

        $tree->delete(); 
    }

    public function testTreeDeletesRisks()
    {
        $owner = factory(App\User::class)->create();

        $this->be($owner);

        $tree = factory(App\Tree::class)->create();
        $tree_id = $tree->id;

        $risk = factory(App\Risk::class)->create();
        $risk->tree()->associate($tree->id);

        $tree->delete();

        $this->assertEquals(\App\Risk::where('tree_id','=',$tree_id)->get()->count(),0);

    }

}
