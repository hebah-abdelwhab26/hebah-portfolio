<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;
use Illuminate\Support\Str;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [

            /*
            |--------------------------------------------------------------------------
            | DEVELOPMENT
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'Web Development',
                'type' => 'development',
                'icon' => 'fa-solid fa-code',
                'color' => '#2563EB',
            ],


            [
                'name' => 'Mobile Applications',
                'type' => 'development',
                'icon' => 'fa-solid fa-mobile-screen',
                'color' => '#7C3AED',
            ],


            [
                'name' => 'Dashboard Systems',
                'type' => 'development',
                'icon' => 'fa-solid fa-chart-line',
                'color' => '#059669',
            ],


            /*
            |--------------------------------------------------------------------------
            | DESIGN
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'Web Design',
                'type' => 'design',
                'icon' => 'fa-solid fa-desktop',
                'color' => '#DB2777',
            ],


            [
                'name' => 'Mobile Design',
                'type' => 'design',
                'icon' => 'fa-solid fa-mobile-screen-button',
                'color' => '#EA580C',
            ],


            [
                'name' => 'Dashboard Design',
                'type' => 'design',
                'icon' => 'fa-solid fa-chart-pie',
                'color' => '#0891B2',
            ],


        ];


        foreach ($categories as $index => $category) {


            ProjectCategory::updateOrCreate(

                [

                    'slug' => Str::slug(
                        $category['name']
                    ),

                ],

                [

                    'name' => $category['name'],


                    'type' => $category['type'],


                    'description' =>
                        $category['name'] . ' Projects',


                    'icon' =>
                        $category['icon'],


                    'color' =>
                        $category['color'],


                    'sort_order' =>
                        $index + 1,


                    'is_active' =>
                        true,

                ]

            );


        }

    }
}
