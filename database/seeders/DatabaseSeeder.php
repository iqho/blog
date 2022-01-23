<?php

namespace Database\Seeders;

use App\Models\Admin\Tag;
use App\Models\Admin\Page;
use App\Models\Admin\Post;
use App\Models\Admin\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory(10)->create();
        Category::factory(10)->create();
        Post::factory(10)->create();
        Tag::factory(10)->create();
        Page::factory(10)->create();

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            TagSeeder::class,
            PageSeeder::class
        ]);
    }
}
