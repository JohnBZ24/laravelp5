<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $productNames = [
            'Laptop', 'Desktop PC', 'Monitor', 'Keyboard', 'Mouse', 'Headphones', 'Webcam', 'Microphone',
            'USB Cable', 'HDMI Cable', 'Power Adapter', 'Docking Station', 'Graphics Card', 'RAM Module',
            'SSD Drive', 'Hard Drive', 'Router', 'Switch', 'Cable Modem', 'Printer', 'Scanner', 'Tablet',
            'Smartphone', 'Smart Watch', 'Fitness Tracker', 'Bluetooth Speaker', 'Charging Pad', 'Power Bank',
            'LED Light', 'Extension Cord', 'Surge Protector', 'Network Cable', 'Wireless Adapter',
        ];

        $name = fake()->randomElement($productNames).' '.fake()->randomElement(['Pro', 'Max', 'Plus', 'Ultra', 'Lite', 'Standard']);

        return [
            'warehouse_id' => Warehouse::factory(),
            'name' => $name,
            'sku' => strtoupper(fake()->lexify('???').fake()->numerify('####')),
            'price' => fake()->randomFloat(2, 10, 2000),
            'stock_quantity' => fake()->numberBetween(5, 500),
            'description' => fake()->sentence(),
        ];
    }

    public function forWarehouse($warehouseId): static
    {
        return $this->state(fn (array $attributes) => [
            'warehouse_id' => $warehouseId,
        ]);
    }
}
