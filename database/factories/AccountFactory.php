<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Compte:John',
                'Compte:Pamela',
                'Dépense:Transport',
                'Dépense:Alimentaire',
                'Dépense:Santé',
                'Dépense:Restauration',
                'Dépense:Immobilier',
                'Dépense:Cadeau',
                'Dépense:Informatique',
                'Dépense:Gaming',
                'Dépense:Internet',
                'Dépense:Energie',
                'Dépense:Assurance',
                'Dépense:Impôts',
                'Dépense:Shopping',
                'Dépense:Travaux',
                'Dépense:Banque',
                'Dépense:Scolaire',
                'Dépense:Loisir',
                'Report:Néant',
                'Revenu:Salaire',
                'Revenu:Crédit',
                'Revenu:Mutuelle',
                'Revenu:CAF',
                'Revenu:Impôts',
                'Revenu:CPAM',
                'Epargne:John',
                'Epargne:Pamela',
            ]),
        ];
    }
}
