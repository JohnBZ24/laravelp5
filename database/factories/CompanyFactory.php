<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        $companyNames = [
            'TechCorp', 'InnovateLab', 'GlobalTech', 'FutureSoft', 'SmartSystems',
            'DataFlow', 'CloudNine', 'ByteWorks', 'PixelForge', 'CodeCraft',
            'NetSolutions', 'WebDynamics', 'DigitalBridge', 'InfoMatrix', 'LogicLeap',
        ];

        $name = fake()->randomElement($companyNames).' '.fake()->randomElement(['Inc', 'LLC', 'Solutions', 'Technologies', 'Corp']).' '.fake()->numerify('###');

        return [
            'name' => $name,
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
