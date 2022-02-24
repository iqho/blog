<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Page;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Page::class;

    public function definition()
    {

        $title = $this->faker->sentence();

        $slug = Str::slug($title);
        $count = Page::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

        return [
            'title' => $title,
            'slug' => $myslug,
            'description' => $this->faker->paragraph(),
            'meta_description' => $this->faker->sentence(),
            'tags' => null,
            'featured_image' => null,
            'user_id' => 1,
            'publish_status' => 1,
            'is_sticky' => 0,
            'views' => 1,
        ];
    }
}
