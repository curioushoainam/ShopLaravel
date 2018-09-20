<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(userSeeder::class);
    }
}

class userSeeder extends Seeder {
	public function run(){
		DB::table('users')->insert([
			['full_name'=>'hnhd', 'email'=>'hnhd@gmail.com', 'password'=>bcrypt('123456'),'phone'=>'1234567890', 'address'=>'Thu Duc - HCMcity - Vietnam']
		]);
	}
}
