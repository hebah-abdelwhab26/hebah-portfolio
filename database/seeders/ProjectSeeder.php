<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Car Rental System',
                'slug' => 'car-rental-system',
                'subtitle' => 'Car Rental and Booking Platform',
                'category' => 'Web Development',
                'description' => 'A Laravel-based car rental project featuring vehicle listings, categories, locations, availability management, booking workflows, localization, and a responsive interface.',
                'demo' => 'https://carrental.hebahgift.com',
                'github' => 'https://github.com/hebah-abdelwhab26/car-rental',
                'technologies' => [
                    'Laravel', 'PHP', 'MySQL', 'Bootstrap',
                    'JavaScript', 'Git',
                ],
                'featured' => true,
            ],
            [
                'title' => 'Restaurant Management System',
                'slug' => 'restaurant-management-system',
                'subtitle' => 'Restaurant Website — Frontend Development',
                'category' => 'Dashboard Systems',
                'description' => 'A restaurant website frontend currently available as a live preview. The project is under development, with backend implementation, database integration, and API connectivity planned for a future phase.',
                'demo' => 'https://admirable-biscochitos-095565.netlify.app/',
                'github' => 'https://github.com/hebah-abdelwhab26/restuarant',
                'technologies' => [
                    'HTML5', 'CSS3', 'JavaScript', 'Bootstrap',
                ],
                'featured' => true,
            ],
            [
                'title' => 'Hebah Digital Studio',
                'slug' => 'hebah-digital-studio',
                'subtitle' => 'Personal Website and Digital Solutions',
                'category' => 'Web Development',
                'description' => 'A personal digital studio website showcasing web development and digital solutions. The website also introduces Hebah Education as a separate educational project for Quran Kareem and Arabic learning.',
                'demo' => 'https://hebahgift.com/tech',
                'github' => 'https://github.com/hebah-abdelwhab26/hebah-portfolio',
                'technologies' => [
                    'Laravel', 'PHP', 'MySQL', 'JavaScript',
                    'Bootstrap', 'Git',
                ],
                'featured' => true,
            ],
            [
                'title' => 'Hebah Education',
                'slug' => 'hebah-education',
                'subtitle' => 'Quran Kareem and Arabic Learning Platform',
                'category' => 'Web Development',
                'description' => 'A separate educational platform for Quran Kareem and Arabic learning, with educational lessons and resources, quizzes, and student-facing learning features. Its content and identity remain separate from the Digital Studio website.',
                'demo' => 'https://hebahgift.com/education',
                'github' => null,
                'technologies' => [
                    'Laravel', 'PHP', 'MySQL', 'JavaScript',
                    'Bootstrap',
                ],
                'featured' => true,
            ],
        ];

        DB::transaction(function () use ($projects) {
            foreach ($projects as $index => $item) {
                $category = ProjectCategory::where(
                    'name',
                    $item['category']
                )->first();

                if (!$category) {
                    throw new RuntimeException(
                        "Project category not found: {$item['category']}"
                    );
                }

                $project = Project::updateOrCreate(
                    ['slug' => $item['slug']],
                    [
                        'project_category_id' => $category->id,
                        'title' => $item['title'],
                        'subtitle' => $item['subtitle'],
                        'short_description' => $item['description'],
                        'description' => $item['description'],
                        'cover_image' => 'cover.png',
                        'thumbnail' => 'cover.png',
                        'live_demo' => $item['demo'],
                        'github' => $item['github'],
                        'figma' => null,
                        'client' => 'Personal Project',
                        'project_date' => null,
                        'duration' => null,
                        'featured' => $item['featured'],
                        'is_active' => true,
                        'sort_order' => $index + 1,
                        'status' => 'published',
                    ]
                );

                $technologyIds = Technology::whereIn(
                    'name',
                    $item['technologies']
                )->pluck('id', 'name');

                $syncData = [];

                foreach ($item['technologies'] as $order => $name) {
                    if ($technologyIds->has($name)) {
                        $syncData[$technologyIds[$name]] = [
                            'sort_order' => $order + 1,
                        ];
                    }
                }

                $project->technologies()->sync($syncData);
            }
        });
    }
}
