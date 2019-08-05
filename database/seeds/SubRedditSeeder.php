<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SubRedditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $sub_reddits = ['oddlysatisfying', 'science', 'pcmasterrace', 'todayilearned', 'gaming'];
        
        foreach($sub_reddits as $sub_reddit) {
            DB::table('sub_reddits')->insert([
                'name' => $sub_reddit,
                'founder_id' => factory(App\User::class, 1)->create()->first()->id,
            ]);
            factory(App\Post::class, $faker->numberBetween(5, 15))->create();
        }
    }
}
