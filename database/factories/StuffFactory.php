<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Stuff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StuffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stuff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'price' => rand(10, 1000),
            'counts' => rand(1, 100)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Stuff $stuff) {
            $properties = Property::all()->toArray();
            $stuff->properties()->create([
                'stuff_id' => $stuff->id,
                'property_id' => $properties[array_rand($properties)]['id'],
                'value' => $this->faker->word
            ]);
        });
    }

}
