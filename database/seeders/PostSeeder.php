<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $title = $faker->sentence();
        $slug = Str::slug($title, '-');

        $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;



       // $slug = Str::slug($title, '-');
        $date = Carbon::parse(now())->format('Y-m-d H:i:s');

        DB::table("posts")->insert([
            'title' => $title,
            'slug' => $myslug,
            'short_description' => $faker->sentence(),
            'description' => $faker->paragraph(),
            'meta_description' => $faker->sentence(),
            'featured_image' => null,
            'category_id' => 1,
            'user_id' => 1,
            'publish_status' => 1,
            'is_sticky' => 0,
            'allow_comments' => 1,
            'views' => 1,
            'post_order' => 1,
            //'published_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'published_at' => $date,
        ]);
    }
}
