<?php

namespace Database\Factories;

use App\Models\Addventaproduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddventaproductFactory extends Factory
{
    protected $model = Addventaproduct::class;

    public function definition()
    {
        return [
			'sales_id' => $this->faker->name,
			'units_id' => $this->faker->name,
			'cantidad' => $this->faker->name,
			'productos_id' => $this->faker->name,
        ];
    }
}
