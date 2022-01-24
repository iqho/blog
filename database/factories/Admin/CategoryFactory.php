<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Category::class;

    public function definition()
    {

        $title = $this->faker->sentence();

        $slug = Str::slug($title);
        $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

        return [
            'name' => $title,
            'slug' => $myslug,
            'parent_id' => NULL,
            'image' => NULL,
            'meta_description' => $this->faker->sentence(),
            'status' => 1,
            'created_by' => 1,
            'category_order' => 1,
        ];
    }
}
