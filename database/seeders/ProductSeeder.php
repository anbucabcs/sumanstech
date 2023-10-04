<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([[
            'name' => 'basic',
            'price' => 10,
            'stripe_plan' => 'price_1NxQjiSJOrLYMYt6pgYwTVC3',
            'description' => Str::random(100)
        ],
        [
            'name' => 'standard',
            'price' => 10,
            'stripe_plan' => 'price_1NxQjiSJOrLYMYt6pgYwTVC3',
            'description' => Str::random(100)
        ],
        [
            'name' => 'premium',
            'price' => 20,
            'stripe_plan' => 'price_1NxQjiSJOrLYMYt6pgYwTVC3',
            'description' => Str::random(100)
        ]
    ]);
    }
}
