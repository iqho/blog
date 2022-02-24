<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\Admin\Page;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
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
        $slug = Str::slug($title);
        $count = Page::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

        $date = Carbon::parse(now())->format('Y-m-d H:i:s');

        DB::table("pages")->insert([
            'title' => $title,
            'slug' => $myslug,
            'description' => $faker->paragraph,
            'meta_description' => $faker->sentence,
            'tags' => null,
            'featured_image' => null,
            'user_id' => 1,
            'publish_status' => 1,
            'is_sticky' => 0,
            'views' => 1,
            'page_order' => 1,
        ]);
    }
}
