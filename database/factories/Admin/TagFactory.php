<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Tag::class;

    public function definition()
    {

        $title = $this->faker->sentence();

        $slug = Str::slug($title);
        $count = Tag::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

        return [
            'title' => $title,
            'slug' => $myslug,
            'meta_description' => $this->faker->sentence(),
            'tag_order' => 1,
            'user_id' => 1,
        ];
    }
}
