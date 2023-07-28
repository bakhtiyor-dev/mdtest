<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\TestCategory;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testCategories = TestCategory::all();

        Test::factory(1000)->create([
            'category_id' => $testCategories->random()->id
        ]);
    }
}
