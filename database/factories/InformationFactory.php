<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Enums\InformationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class InformationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(InformationType::cases()),
            'content' => $this->faker->word(),
            'contact_uuid' => Contact::factory(),
        ];
    }
}
