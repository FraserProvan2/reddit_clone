<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $topics = ['oddlysatisfying', 'science', 'pcmasterrace', 'todayilearned', 'gaming'];
        
        foreach($topics as $topic) {
            DB::table('topics')->insert([
                'name' => $topic,
                'founder_id' => factory(App\User::class, 1)->create()->first()->id,
            ]);
            factory(App\Post::class, $faker->numberBetween(5, 15))->create();
        }
    }
}
