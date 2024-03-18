<?php

namespace Database\Seeders;

use App\Models\Ticket\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::factory()->count(10)->create();
    }
}
