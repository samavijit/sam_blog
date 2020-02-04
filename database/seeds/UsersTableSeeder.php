<?php

use Illuminate\Database\Seeder;

//use Illuminate\Support\Str;

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

        

        if(env('APP_ENV') === 'local'){

            $faker = \Faker\Factory::create();

            DB::table('users')->insert([

            [
                'name' => "Avijit",
                'slug' => 'avijit',
                'email' => 'avijit'.'@gmail.com',
                'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
            ],
            [
                'name' => "Avi2",
                'slug' => 'avi2',
                'email' => 'avi2'.'@gmail.com',
                'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
            ],
            [
                'name' => "Avi3",
                'slug' => 'avi3',
                'email' => 'avi3'.'@gmail.com',
                'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
            ],
            [
                'name' => "John Doe",
                'slug' => 'john-doe',
                'email' => 'johnDoe'.'@gmail.com',
                'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
            ],
            [
                'name' => "Johnn Doee",
                'slug' => 'johnn-doee',
                'email' => 'johnDoeee'.'@gmail.com',
                'password' => bcrypt('password'),
                'bio'=> $faker->text(rand(250, 300))
            ]
            
        ]);


        }else{

            DB::table('users')->insert([

            [
                'name' => "Avijit",
                'slug' => 'avijit',
                'email' => 'avijit@test.com',
                'password' => bcrypt('password'),
                'bio'=> "I am a Administrator."
            ]
            
        ]);
        

        }

        
    }
}
