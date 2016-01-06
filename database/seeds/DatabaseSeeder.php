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
        Model::unguard();

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
            'name' => 'new tree',
            'user_id' => $user->id,
            'updated_by' => $user->id
        ]);
    }

}