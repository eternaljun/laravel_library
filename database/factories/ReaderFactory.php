<?php

namespace Database\Factories;

use App\Models\reader;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReaderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = reader::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date_reg' => $this -> faker ->date(),
            'FIO' => $this -> faker ->name(10),
            'date_birth' => $this -> faker ->date(),

        ];
    }
}
