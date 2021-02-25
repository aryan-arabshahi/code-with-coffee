<?php

namespace Database\Factories;

use App\Enums\PageStatus;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'name' => $name,
            'slug' => generate_slug($name),
            'content' => $this->faker->realText,
            'description' => $this->faker->realText(255),
            'status' => PageStatus::ENABLED,
        ];
    }
}
