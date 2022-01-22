<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\Admin\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
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
        $count = Tag::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

        DB::table("tags")->insert([
            'title' => $title,
            'slug' => $myslug,
            'meta_description' => $faker->sentence(),
            'tag_order' => 1,
        ]);
    }
}
