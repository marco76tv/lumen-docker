<?php

namespace Database\Factories;

use App\Models\ProfileAttribute;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileAttributeFactory extends Factory
{
    protected $model = ProfileAttribute::class;

    public function definition()
    {
        return [
            'profile_id' => Profile::factory(),
            'attribute' => $this->faker->word,
        ];
    }
}
