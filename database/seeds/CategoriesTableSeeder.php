<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('categories')->truncate();

         if(env('APP_ENV') === 'local'){

            DB::table('categories')->insert([
    		 	[	
                    'title' => 'Uncategorized',
                    'slug' => 'uncategorized'
                ],
                [   
                    'title' => 'Web Design',
                    'slug' => 'web-design'
                ],
                [
                    'title' => 'Web Programming',
                    'slug' => 'web-web-programming'
                ],
                [
                    'title' => 'Internet',
                    'slug' => 'internet'
                ],
                [
                    'title' => 'Social Marketing',
                    'slug' => 'social-marketing'
                ],
                [
                    'title' => 'Photography',
                    'slug' => 'photography'
                ],

            ]);

            
         }else{

              DB::table('categories')->insert([
                [   
                    'title' => 'Uncategorized',
                    'slug' => 'uncategorized'
                ]

            ]);
         }


        for($post_id=1;$post_id<=10;$post_id++){

        	$category_id = rand(1,5);

        	DB::table('posts')->where('id',$post_id)->update(['category_id'=>$category_id]);
        }
    }
}
