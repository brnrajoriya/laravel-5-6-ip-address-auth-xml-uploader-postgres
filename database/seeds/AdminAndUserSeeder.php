<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
    		[
    			'name' => 'Admin',
    			'email' => 'admin@example.com',
    			'password' => bcrypt('password'),
    			'is_admin' => true
    		],
    		[
    			'name' => 'Bhaskar Rajoriya',
    			'email' => 'brn.rajoriya@gmail.com',
    			'password' => bcrypt('password')
    		]
    	];

    	foreach ($users as $key => $user) {
    		User::firstOrCreate($user);
    	}
    }
}
