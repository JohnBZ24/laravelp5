<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            [
                'name' => 'TechCorp Solutions',
                'address' => '123 Innovation Drive',
                'city' => 'San Francisco',
                'phone' => '+1-555-0101',
            ],
            [
                'name' => 'Global Retailers Inc',
                'address' => '456 Commerce Street',
                'city' => 'New York',
                'phone' => '+1-555-0102',
            ],
            [
                'name' => 'Manufacturing Plus',
                'address' => '789 Industrial Blvd',
                'city' => 'Detroit',
                'phone' => '+1-555-0103',
            ],
        ];

        foreach ($companies as $companyData) {
            $company = Company::create($companyData);

            $this->createUsersForCompany($company);
            $this->createWarehousesForCompany($company);
        }
    }

    private function createUsersForCompany(Company $company): void
    {
        $manager = User::create([
            'name' => "Manager {$company->name}",
            'email' => $this->generateEmail($company->name, 'manager'),
            'password' => Hash::make('123'),
            'role' => User::ROLE_MANAGER,
            'company_id' => $company->id,
            'email_verified_at' => now(),
        ]);

        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "Employee $i {$company->name}",
                'email' => $this->generateEmail($company->name, "employee$i"),
                'password' => Hash::make('123'),
                'role' => User::ROLE_EMPLOYEE,
                'company_id' => $company->id,
                'email_verified_at' => now(),
            ]);
        }
    }

    private function createWarehousesForCompany(Company $company): void
    {
        $warehouseNames = [
            'Main Warehouse',
            'Distribution Center',
            'Regional Storage',
            'North Branch',
            'South Branch',
        ];

        foreach ($warehouseNames as $index => $warehouseName) {
            $warehouse = Warehouse::create([
                'company_id' => $company->id,
                'name' => "$warehouseName - {$company->name}",
                'location' => "Location {$index}",
                'address' => "Address for {$warehouseName}",
            ]);

            $this->createProductsForWarehouse($warehouse);
        }
    }

    private function createProductsForWarehouse(Warehouse $warehouse): void
    {
        $products = [
            ['name' => 'Laptop Computer', 'sku' => 'LAP', 'price' => 999.99],
            ['name' => 'Wireless Mouse', 'sku' => 'MOU', 'price' => 29.99],
            ['name' => 'USB-C Cable', 'sku' => 'USB', 'price' => 15.99],
            ['name' => 'HD Monitor', 'sku' => 'MON', 'price' => 249.99],
            ['name' => 'Keyboard', 'sku' => 'KEY', 'price' => 49.99],
            ['name' => 'Webcam HD', 'sku' => 'WEB', 'price' => 79.99],
            ['name' => 'Headphones', 'sku' => 'HP', 'price' => 39.99],
            ['name' => 'Docking Station', 'sku' => 'DSK', 'price' => 129.99],
        ];

        foreach ($products as $product) {
            Product::create([
                'warehouse_id' => $warehouse->id,
                'name' => "{$product['name']} {$warehouse->name}",
                'sku' => "{$product['sku']}-".substr(md5($warehouse->name), 0, 8),
                'price' => $product['price'],
                'stock_quantity' => rand(10, 100),
                'description' => "Description for {$product['name']}",
            ]);
        }
    }

    private function generateEmail(string $companyName, string $role): string
    {
        $sanitized = strtolower(str_replace([' ', 'Inc', 'Solutions', 'Plus'], ['', '', '', ''], $companyName));

        return "{$role}@{$sanitized}.com";
    }
}
