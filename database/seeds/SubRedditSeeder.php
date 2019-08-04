<?php

use Illuminate\Database\Seeder;

class SubRedditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class, 1)->create()->first();

        DB::table('sub_reddits')->insert([
            'name' => 'cats',
            'founder_id' => $user->id,
        ]);

        factory(App\Post::class, 15)->create();
    }
}
