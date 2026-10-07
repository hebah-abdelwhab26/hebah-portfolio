<?php

namespace Database\Seeders;

use App\Models\TechnologyCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [

            [
                'name' => 'Backend',
                'icon' => 'fa-solid fa-server',
                'color' => '#2563EB',
            ],

            [
                'name' => 'Frontend',
                'icon' => 'fa-solid fa-display',
                'color' => '#14B8A6',
            ],

            [
                'name' => 'Database',
                'icon' => 'fa-solid fa-database',
                'color' => '#059669',
            ],

            [
                'name' => 'DevOps',
                'icon' => 'fa-solid fa-cloud',
                'color' => '#EA580C',
            ],

            [
                'name' => 'Design Tools',
                'icon' => 'fa-solid fa-palette',
                'color' => '#DB2777',
            ],

        ];

        foreach ($categories as $index => $category) {

            TechnologyCategory::create([

                'name'        => $category['name'],

                'slug'        => Str::slug($category['name']),

                'icon'        => $category['icon'],

                'color'       => $category['color'],

                'description' => $category['name'] . ' Technologies',

                'sort_order'  => $index + 1,

                'is_active'   => true,

            ]);

        }
    }
}
