<?php

namespace Database\Seeders;

use App\Models\DesignCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DesignCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Design Categories
        |--------------------------------------------------------------------------
        */

        $categories = [

            [
                'name' => 'Web Design',
                'slug' => 'web-design',
                'description' => 'Modern and responsive website interface designs.',
                'icon' => 'fa-solid fa-globe',
                'color' => '#6366f1',
                'sort_order' => 1,
                'is_active' => true,
            ],

            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'description' => 'User interface and user experience design projects.',
                'icon' => 'fa-solid fa-pen-ruler',
                'color' => '#8b5cf6',
                'sort_order' => 2,
                'is_active' => true,
            ],

            [
                'name' => 'Dashboard Design',
                'slug' => 'dashboard-design',
                'description' => 'Professional dashboard and admin panel interfaces.',
                'icon' => 'fa-solid fa-chart-line',
                'color' => '#06b6d4',
                'sort_order' => 3,
                'is_active' => true,
            ],

            [
                'name' => 'Landing Pages',
                'slug' => 'landing-pages',
                'description' => 'High-converting landing page and promotional designs.',
                'icon' => 'fa-solid fa-window-maximize',
                'color' => '#10b981',
                'sort_order' => 4,
                'is_active' => true,
            ],

            [
                'name' => 'Mobile App Design',
                'slug' => 'mobile-app-design',
                'description' => 'Modern mobile application interface designs.',
                'icon' => 'fa-solid fa-mobile-screen-button',
                'color' => '#f59e0b',
                'sort_order' => 5,
                'is_active' => true,
            ],

            [
                'name' => 'E-Commerce Design',
                'slug' => 'e-commerce-design',
                'description' => 'Online store, product catalog, and shopping experience designs.',
                'icon' => 'fa-solid fa-cart-shopping',
                'color' => '#ef4444',
                'sort_order' => 6,
                'is_active' => true,
            ],

            [
                'name' => 'Branding',
                'slug' => 'branding',
                'description' => 'Visual identity, branding, and digital brand experiences.',
                'icon' => 'fa-solid fa-palette',
                'color' => '#ec4899',
                'sort_order' => 7,
                'is_active' => true,
            ],

            [
                'name' => 'Figma Design',
                'slug' => 'figma-design',
                'description' => 'UI prototypes, wireframes, and interface designs created with Figma.',
                'icon' => 'fa-brands fa-figma',
                'color' => '#f97316',
                'sort_order' => 8,
                'is_active' => true,
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | Insert / Update Categories
        |--------------------------------------------------------------------------
        */

        foreach ($categories as $category) {

            DesignCategory::updateOrCreate(

                [
                    'slug' => $category['slug'],
                ],

                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'icon' => $category['icon'],
                    'color' => $category['color'],
                    'sort_order' => $category['sort_order'],
                    'is_active' => $category['is_active'],
                ]

            );
        }
    }
}
