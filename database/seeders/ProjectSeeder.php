<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {

            $projects = [

                [
                    'title' => 'Car Rental System',

                    'subtitle' => 'Modern Vehicle Booking Platform',

                    'category' => 'Web Applications',

                    'description' => 'A complete car rental platform developed using Laravel with online booking, payment integration, dashboard, localization and responsive design.',

                    'client' => 'HebahGift',

                    'duration' => '3 Months',

                    'featured' => true,

                    'cover_image' => 'project-01.webp',

                    'thumbnail' => 'project-01.webp',

                    'demo' => 'https://carrental.hebahgift.com',

                    'github' => 'https://github.com/hebah-abdelwhab26/car-rental',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'PHP',

                        'MySQL',

                        'Bootstrap',

                        'JavaScript',

                        'Git'

                    ]

                ],

                [
                    'title' => 'E-Learning Platform',

                    'subtitle' => 'Online Courses Management',

                    'category' => 'Educational Platforms',

                    'description' => 'Learning management system supporting courses, lessons, quizzes, certificates and student dashboard.',

                    'client' => 'Future Academy',

                    'duration' => '4 Months',

                    'featured' => true,

                    'cover_image' => 'project-02.webp',

                    'thumbnail' => 'project-02.webp',

                    'demo' => 'https://academy.hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'PHP',

                        'MySQL',

                        'React',

                        'Tailwind CSS',

                        'JavaScript'

                    ]

                ],

                [
                    'title' => 'Portfolio Website',

                    'subtitle' => 'Personal Brand Website',

                    'category' => 'Portfolio Websites',

                    'description' => 'Modern portfolio website showcasing projects, technologies and professional services.',

                    'client' => 'Hebah Abdelwahab',

                    'duration' => '2 Months',

                    'featured' => true,

                    'cover_image' => 'project-03.webp',

                    'thumbnail' => 'project-03.webp',

                    'demo' => 'https://hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'React',

                        'Tailwind CSS',

                        'MySQL',

                        'Figma'

                    ]

                ],
                                [
                    'title' => 'Restaurant Management System',

                    'subtitle' => 'Digital Restaurant Solution',

                    'category' => 'Dashboard Systems',

                    'description' => 'Restaurant management system including orders, tables, kitchen dashboard, invoices and customer management.',

                    'client' => 'Golden Restaurant',

                    'duration' => '3 Months',

                    'featured' => false,

                    'cover_image' => 'project-04.webp',

                    'thumbnail' => 'project-04.webp',

                    'demo' => 'https://restaurant.hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'PHP',

                        'MySQL',

                        'Bootstrap',

                        'JavaScript',

                        'Docker'

                    ]

                ],

                [
                    'title' => 'Hospital Management System',

                    'subtitle' => 'Medical Administration Platform',

                    'category' => 'Dashboard Systems',

                    'description' => 'Comprehensive hospital management platform with doctors, patients, appointments and reports.',

                    'client' => 'Life Hospital',

                    'duration' => '5 Months',

                    'featured' => true,

                    'cover_image' => 'project-05.webp',

                    'thumbnail' => 'project-05.webp',

                    'demo' => 'https://hospital.hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'MySQL',

                        'React',

                        'Tailwind CSS',

                        'Git'

                    ]

                ],

                [
                    'title' => 'Online Store',

                    'subtitle' => 'Modern E-Commerce Website',

                    'category' => 'E-Commerce',

                    'description' => 'Full-featured online shopping platform with payments, coupons, inventory and customer dashboard.',

                    'client' => 'Smart Store',

                    'duration' => '4 Months',

                    'featured' => true,

                    'cover_image' => 'project-06.webp',

                    'thumbnail' => 'project-06.webp',

                    'demo' => 'https://shop.hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'PHP',

                        'MySQL',

                        'Bootstrap',

                        'JavaScript',

                        'Git'

                    ]

                ],

                [
                    'title' => 'Real Estate Platform',

                    'subtitle' => 'Property Listing System',

                    'category' => 'Web Applications',

                    'description' => 'Modern property management platform with advanced search, maps and agent dashboard.',

                    'client' => 'Prime Estate',

                    'duration' => '4 Months',

                    'featured' => false,

                    'cover_image' => 'project-07.webp',

                    'thumbnail' => 'project-07.webp',

                    'demo' => 'https://estate.hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'MySQL',

                        'React',

                        'Tailwind CSS',

                        'Docker'

                    ]

                ],

                [
                    'title' => 'Inventory Management',

                    'subtitle' => 'Warehouse Dashboard',

                    'category' => 'Dashboard Systems',

                    'description' => 'Inventory and warehouse management with stock movement, reports and barcode support.',

                    'client' => 'Logistics Company',

                    'duration' => '3 Months',

                    'featured' => false,

                    'cover_image' => 'project-08.webp',

                    'thumbnail' => 'project-08.webp',

                    'demo' => 'https://inventory.hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'PHP',

                        'MySQL',

                        'Bootstrap',

                        'Git'

                    ]

                ],
                                [
                    'title' => 'Quran Academy',

                    'subtitle' => 'Online Quran Learning Platform',

                    'category' => 'Educational Platforms',

                    'description' => 'Interactive Quran academy for online memorization, Tajweed lessons, teacher management and student progress tracking.',

                    'client' => 'Quran Academy',

                    'duration' => '3 Months',

                    'featured' => true,

                    'cover_image' => 'project-09.webp',

                    'thumbnail' => 'project-09.webp',

                    'demo' => 'https://quran.hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'PHP',

                        'MySQL',

                        'React',

                        'Tailwind CSS',

                        'Figma'

                    ]

                ],

                [
                    'title' => 'CRM System',

                    'subtitle' => 'Customer Relationship Management',

                    'category' => 'Dashboard Systems',

                    'description' => 'CRM platform for managing customers, sales, support tickets and business reports.',

                    'client' => 'Business Company',

                    'duration' => '4 Months',

                    'featured' => false,

                    'cover_image' => 'project-10.webp',

                    'thumbnail' => 'project-10.webp',

                    'demo' => 'https://crm.hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'MySQL',

                        'Bootstrap',

                        'JavaScript',

                        'Docker'

                    ]

                ],

                [
                    'title' => 'Hotel Booking Platform',

                    'subtitle' => 'Hotel Reservation Website',

                    'category' => 'Web Applications',

                    'description' => 'Hotel reservation system supporting room booking, online payments and customer dashboard.',

                    'client' => 'Luxury Hotels',

                    'duration' => '4 Months',

                    'featured' => false,

                    'cover_image' => 'project-11.webp',

                    'thumbnail' => 'project-11.webp',

                    'demo' => 'https://hotel.hebahgift.com',

                    'github' => 'https://github.com/',

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Laravel',

                        'PHP',

                        'MySQL',

                        'React',

                        'Tailwind CSS',

                        'Git'

                    ]

                ],

                [
                    'title' => 'Fitness Mobile App UI',

                    'subtitle' => 'Professional Mobile UI Design',

                    'category' => 'UI / UX Design',

                    'description' => 'Complete mobile fitness application designed in Figma with modern user experience principles.',

                    'client' => 'FitLife',

                    'duration' => '1 Month',

                    'featured' => true,

                    'cover_image' => 'project-12.webp',

                    'thumbnail' => 'project-12.webp',

                    'demo' => 'https://dribbble.com/',

                    'github' => null,

                    'figma' => 'https://figma.com',

                    'technologies' => [

                        'Figma',

                        'Photoshop',

                        'Illustrator'

                    ]

                ],

            ];
                        /*
            |--------------------------------------------------------------------------
            | Save Projects
            |--------------------------------------------------------------------------
            */

            foreach ($projects as $index => $item) {

                $category = ProjectCategory::where(
                    'name',
                    $item['category']
                )->first();

                if (!$category) {
                    continue;
                }

                $project = Project::create([

                    'project_category_id' => $category->id,

                    'title' => $item['title'],

                    'slug' => Str::slug($item['title']),

                    'subtitle' => $item['subtitle'],

                    'short_description' => $item['description'],

                    'description' => $item['description'],

                    'cover_image' => $item['cover_image'],

                    'thumbnail' => $item['thumbnail'],

                    'live_demo' => $item['demo'],

                    'github' => $item['github'],

                    'figma' => $item['figma'],

                    'client' => $item['client'],

                    'project_date' => now()->subDays(rand(30, 700)),

                    'duration' => $item['duration'],

                    'featured' => $item['featured'],

                    'is_active' => true,

                    'sort_order' => $index + 1,

                    'status' => 'published',

                ]);

                /*
                |--------------------------------------------------------------------------
                | Attach Technologies
                |--------------------------------------------------------------------------
                */

                $technologyIds = Technology::whereIn(

                    'name',

                    $item['technologies']

                )->pluck('id');

                $syncData = [];

                foreach ($technologyIds as $order => $technologyId) {

                    $syncData[$technologyId] = [

                        'sort_order' => $order + 1,

                    ];

                }

                $project->technologies()->sync($syncData);

            }

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollBack();

            throw $e;

        }

    }
}
