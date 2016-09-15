<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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

        $this->call('PostTableSeeder');
    }

}

class PostTableSeeder extends Seeder
{
    public function run()
    {
        App\Models\Post::truncate();
        factory(App\Models\Post::class, 20)->create();
    }
}
