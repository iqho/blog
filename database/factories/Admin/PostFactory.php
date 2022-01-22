<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    protected $model = Post::class;

    public function definition()
    {

        $title = $this->faker->title;
        $slug = Str::slug($title, '-');
        $date = Carbon::parse(now())->format('Y-m-d H:i:s');

        return [
            'title' => $title,
            'title' => $slug,
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'meta_description' => $this->faker->sentence,
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
        ];
    }
}
