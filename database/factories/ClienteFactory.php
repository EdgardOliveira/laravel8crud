<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'cpf_cnpj' => $this->faker->numerify('###########'),
            'contato' => $this->faker->firstName,
            'celular' => $this->faker->numerify('###########'),
            'email' => $this->faker->unique()->safeEmail()
        ];
    }
}
