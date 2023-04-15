<?php

namespace Database\Factories;

use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VentaFactory extends Factory
{
    protected $model = Venta::class;

    public function definition()
    {
        return [
			'descripcion' => $this->faker->name,
			'noarticulos' => $this->faker->name,
			'subtotal' => $this->faker->name,
			'total' => $this->faker->name,
			'fecha' => $this->faker->name,
        ];
    }
}
