<?php

namespace Database\Factories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->randomElement([
                'CB ' . $this->faker->company,
                'CHQ 000' . $this->faker->randomNumber(3),
                'PRVL ' . $this->faker->company,
            ]),
            'amount' => $this->faker->randomFloat(2, 0, 3000),
            'effected_at' => $this->faker->dateTimeBetween('2020-01-01'),
            'debit_account_id' => function (array $record) {
                return \App\Models\Account::all()->random()->id;
            },
            'credit_account_id' => function (array $record) {
                return \App\Models\Account::all()->random()->id;
            },
        ];
    }
}
