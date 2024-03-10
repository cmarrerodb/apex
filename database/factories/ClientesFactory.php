<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // protected $model = Clientes::class;
        return [
            'nombre' => $this->faker->unique()->name." ".$this->faker->unique()->lastname,
            'rut' => (string)$this->faker->unique()->numberBetween(10000000,100000000),
            'fecha_nacimiento' => $this->faker->unique()->date($format = 'Y-m-d', $max = '2005-12-31'),
            'telefono' => $this->faker->unique()->phoneNumber(),
            'direccion' => $this->faker->unique()->address(),
            'comuna_id' => Comunas::all()->random()->id,

        ];
    }
}
