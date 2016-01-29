<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}


class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();
        
        $user = App\User::create([
            'name' => 'admin',
            'email' => 'admin@arsec.com',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'password' => bcrypt('password'),
        ]);

        Auth::attempt(['email'=>'admin@arsec.com','password'=>'password']);

        App\Tree::create([
            'title' => 'new tree',
            'description' => 'TinyDescription',
            'user_id' => $user->id,
            'updated_by' => $user->id,
            'locked' => 0,
        ]);

        App\Tree::create([
            'title' => 'new tree2',
            'description' => 'TinyDescription 2',
            'user_id' => $user->id,
            'updated_by' => $user->id,
            'locked' => 0,
        ]);

        App\Tag::create([
            'title' => 'social engineering',
            'slug' => 'social_engineering',
            'color' => '#FF0000'
        ]);

        $user2 = App\User::create([
            'name' => 'John Doe',
            'email' => 'nimda@arsec.com',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'password' => bcrypt('password'),
        ]);

        Auth::attempt(['email'=>'nimda@arsec.com','password'=>'password']);

        App\Tree::create([
            'title' => 'new tree3',
            'description' => 'TinyDescription 2',
            'user_id' => $user2->id,
            'updated_by' => $user2->id,
            'locked' => 0,
        ]);
    }

}