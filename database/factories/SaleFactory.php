<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
			'locations_id' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'noarticulos' => $this->faker->name,
			'subtotal' => $this->faker->name,
			'total' => $this->faker->name,
			'fecha' => $this->faker->name,
        ];
    }
}
