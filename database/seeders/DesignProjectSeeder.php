<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class DesignProjectSeeder extends Seeder
{
    public function run(): void
    {
        $categorySlugs = [
            'web-design',
            'mobile-design',
            'dashboard-design',
        ];

        $categories = ProjectCategory::query()
            ->where('type', 'design')
            ->whereIn('slug', $categorySlugs)
            ->get()
            ->keyBy('slug');

        foreach ($categorySlugs as $slug) {
            if (! $categories->has($slug)) {
                throw new RuntimeException(
                    "Missing design category: {$slug}. No projects were changed."
                );
            }
        }

        $projects = [
            // Dashboard designs
            [
                'slug' => 'digital-studio-dashboard-design',
                'title' => 'Hebah Digital Studio Dashboard UI',
                'category' => 'dashboard-design',
                'subtitle' => 'Admin Dashboard Design',
                'short_description' => 'UI/UX design for a web development studio administration dashboard.',
                'description' => 'A dashboard UI/UX concept for organizing digital studio content, projects, and administrative tasks.',
                'sort_order' => 1,
            ],
            [
                'slug' => 'education-dashboard-design',
                'title' => 'Hebah Education Dashboard UI',
                'category' => 'dashboard-design',
                'subtitle' => 'Education Management Dashboard',
                'short_description' => 'UI/UX design for an educational platform dashboard.',
                'description' => 'A dashboard UI/UX concept for managing educational content, lessons, and learning resources.',
                'sort_order' => 2,
            ],
            [
                'slug' => 'car-rental-dashboard-design',
                'title' => 'Car Rental Dashboard UI',
                'category' => 'dashboard-design',
                'subtitle' => 'Rental Management Dashboard',
                'short_description' => 'UI/UX design for a car rental administration dashboard.',
                'description' => 'A dashboard UI/UX concept for organizing vehicles, reservations, and rental operations.',
                'sort_order' => 3,
            ],

            // Real mobile designs
            [
                'slug' => 'food-order-mobile-design',
                'title' => 'Food Ordering App UI',
                'category' => 'mobile-design',
                'subtitle' => 'Food Ordering Mobile App',
                'short_description' => 'Mobile app UI/UX design for restaurant food ordering.',
                'description' => 'A Figma prototype for a food ordering mobile application.',
                'figma' => 'https://www.figma.com/proto/dvZh891ykStSpiTHc50leo/food-order?node-id=41-740&p=f&viewport=45%2C184%2C0.17&t=xZu6dRaZlQPD8eLr-1&scaling=scale-down&content-scaling=fixed&starting-point-node-id=41%3A713&page-id=41%3A712',
                'sort_order' => 1,
            ],
            [
                'slug' => 'coffee-shop-mobile-design',
                'title' => 'Coffee Shop App UI',
                'category' => 'mobile-design',
                'subtitle' => 'Coffee Shop Mobile App',
                'short_description' => 'Mobile app UI/UX design for a coffee shop.',
                'description' => 'A Figma prototype for a coffee shop mobile application.',
                'figma' => 'https://www.figma.com/proto/mEmDxanMqsFhxA7ZyIOmfS/coffee-shop-design?node-id=49-34835&p=f&viewport=152%2C213%2C0.33&t=IHDvy5O1klRCofbg-1&scaling=scale-down&content-scaling=fixed&starting-point-node-id=49%3A34835&page-id=49%3A34815',
                'sort_order' => 2,
            ],
            [
                'slug' => 'flight-booking-mobile-design',
                'title' => 'Flight Booking App UI',
                'category' => 'mobile-design',
                'subtitle' => 'Flight Booking Mobile App',
                'short_description' => 'Mobile app UI/UX design for flight reservations.',
                'description' => 'A Figma prototype for a flight booking mobile application.',
                'figma' => 'https://www.figma.com/proto/V3XupzBqNqTJfm4XLEfKvn/flight-booking-app?node-id=59-584&p=f&viewport=139%2C228%2C0.12&t=IRoamVeFrxRRwI0q-1&scaling=scale-down&content-scaling=fixed&starting-point-node-id=47%3A1196&page-id=1%3A2',
                'sort_order' => 3,
            ],
            [
                'slug' => 'coffee-shop-alternative-mobile-design',
                'title' => 'Coffee Shop App Design',
                'category' => 'mobile-design',
                'subtitle' => 'Coffee Shop UI/UX',
                'short_description' => 'Mobile app UI/UX design for a coffee shop.',
                'description' => 'A Figma prototype for a coffee shop application.',
                'figma' => 'https://www.figma.com/proto/c4ojIUntdaXv67ypcjl81q/coffe-shop?node-id=15-29&p=f&viewport=363%2C59%2C0.05&t=SLuBFhFAPG4nUtKf-1&scaling=scale-down&content-scaling=fixed&starting-point-node-id=15%3A161&page-id=1%3A2',
                'sort_order' => 4,
            ],

            // Website designs
            [
                'slug' => 'hebah-digital-studio-website-design',
                'title' => 'Hebah Digital Studio Website UI',
                'category' => 'web-design',
                'subtitle' => 'Website UI/UX Design',
                'short_description' => 'Website UI/UX design for Hebah Digital Studio.',
                'description' => 'A website UI/UX design entry for the digital studio, showcasing its visual direction and content layout.',
                'sort_order' => 1,
            ],
            [
                'slug' => 'hebah-education-website-design',
                'title' => 'Hebah Education Website UI',
                'category' => 'web-design',
                'subtitle' => 'Educational Website UI/UX Design',
                'short_description' => 'Website UI/UX design for Hebah Education.',
                'description' => 'A website UI/UX design entry for the educational platform, focused on presenting learning resources clearly.',
                'sort_order' => 2,
            ],
        ];

        DB::transaction(function () use ($projects, $categories) {
            $figmaTechnology = Technology::where('name', 'Figma')->first();

            foreach ($projects as $item) {
                $project = Project::updateOrCreate(
                    ['slug' => $item['slug']],
                    [
                        'project_category_id' => $categories[$item['category']]->id,
                        'title' => $item['title'],
                        'subtitle' => $item['subtitle'],
                        'short_description' => $item['short_description'],
                        'description' => $item['description'],
                        'cover_image' => 'cover.png',
                        'thumbnail' => null,
                        'live_demo' => null,
                        'github' => null,
                        'figma' => $item['figma'] ?? null,
                        'client' => null,
                        'project_date' => null,
                        'duration' => null,
                        'featured' => false,
                        'is_active' => true,
                        'sort_order' => $item['sort_order'],
                        'status' => 'published',
                    ]
                );

                if ($figmaTechnology) {
                    $project->technologies()->sync([
                        $figmaTechnology->id => ['sort_order' => 1],
                    ]);
                }
            }
        });
    }
}
