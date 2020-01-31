<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Faker\Factory;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('users')->truncate();

        $faker = Factory::create();

        DB::table('users')->insert([

        	[
        		'name' => "Avijit",
                'slug' => 'avijit',
	            'email' => Str::random(10).'@gmail.com',
	            'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
        	],
        	[
        		'name' => "Avi2",
                'slug' => 'avi2',
	            'email' => Str::random(10).'@gmail.com',
	            'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
        	],
        	[
        		'name' => "Avi3",
                'slug' => 'avi3',
	            'email' => Str::random(10).'@gmail.com',
	            'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
        	],
        	[
        		'name' => "John Doe",
                'slug' => 'john-doe',
	            'email' => Str::random(10).'@gmail.com',
	            'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
        	],
        	[
        		'name' => "Johnn Doee",
                'slug' => 'johnn-doee',
	            'email' => Str::random(10).'@gmail.com',
	            'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
        	]
            
        ]);
    }
}
