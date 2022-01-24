<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Support\Str;
use App\Models\Admin\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
        $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

        DB::table("categories")->insert([
            'name' => $title,
            'slug' => $myslug,
            'parent_id' => NULL,
            'image' => NULL,
            'meta_description' => $faker->sentence(),
            'status' => 1,
            'created_by' => 1,
            'category_order' => 1,
        ]);

    }
}
