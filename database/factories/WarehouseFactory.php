<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition(): array
    {
        $warehouseTypes = ['Main Warehouse', 'Distribution Center', 'Regional Hub', 'Storage Facility', 'Logistics Center'];
        $locations = ['North', 'South', 'East', 'West', 'Central', 'Downtown', 'Industrial District', 'Business Park'];

        return [
            'company_id' => Company::factory(),
            'name' => fake()->randomElement($warehouseTypes).' - '.fake()->randomElement($locations),
            'location' => fake()->randomElement($locations),
            'address' => fake()->streetAddress(),
        ];
    }

    public function forCompany($companyId): static
    {
        return $this->state(fn (array $attributes) => [
            'company_id' => $companyId,
        ]);
    }
}
