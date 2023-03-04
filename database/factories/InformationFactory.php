<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class InformationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'content' => $this->faker->word(),
            'contact_uuid' => Contact::factory(),
        ];
    }
}
