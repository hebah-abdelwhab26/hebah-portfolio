<?php

namespace Database\Seeders;

use App\Models\Technology;
use App\Models\TechnologyCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [

            /*
            |--------------------------------------------------------------------------
            | Backend
            |--------------------------------------------------------------------------
            */

            'Backend' => [

                ['Laravel','fa-brands fa-laravel','#FF2D20','https://laravel.com'],

                ['PHP','fa-brands fa-php','#777BB4','https://www.php.net'],

                ['Node.js','fa-brands fa-node-js','#339933','https://nodejs.org'],

                ['ASP.NET Core','fa-solid fa-code','#512BD4','https://dotnet.microsoft.com'],

                ['Express.js','fa-solid fa-server','#444444','https://expressjs.com'],

            ],

            /*
            |--------------------------------------------------------------------------
            | Frontend
            |--------------------------------------------------------------------------
            */

            'Frontend' => [

                ['HTML5','fa-brands fa-html5','#E34F26','https://developer.mozilla.org'],

                ['CSS3','fa-brands fa-css3-alt','#1572B6','https://developer.mozilla.org'],

                ['JavaScript','fa-brands fa-js','#F7DF1E','https://developer.mozilla.org'],

                ['TypeScript','fa-solid fa-code','#3178C6','https://www.typescriptlang.org'],

                ['React','fa-brands fa-react','#61DAFB','https://react.dev'],

                ['Vue.js','fa-brands fa-vuejs','#42B883','https://vuejs.org'],

                ['Bootstrap','fa-brands fa-bootstrap','#7952B3','https://getbootstrap.com'],

                ['Tailwind CSS','fa-solid fa-wind','#38BDF8','https://tailwindcss.com'],

            ],

            /*
            |--------------------------------------------------------------------------
            | Database
            |--------------------------------------------------------------------------
            */

            'Database' => [

                ['MySQL','fa-solid fa-database','#4479A1','https://mysql.com'],

                ['PostgreSQL','fa-solid fa-database','#336791','https://postgresql.org'],

                ['SQLite','fa-solid fa-database','#003B57','https://sqlite.org'],

                ['MongoDB','fa-solid fa-leaf','#47A248','https://mongodb.com'],

            ],

            /*
            |--------------------------------------------------------------------------
            | DevOps
            |--------------------------------------------------------------------------
            */

            'DevOps' => [

                ['Git','fa-brands fa-git-alt','#F05032','https://git-scm.com'],

                ['Docker','fa-brands fa-docker','#2496ED','https://docker.com'],

                ['Linux','fa-brands fa-linux','#FCC624','https://kernel.org'],

                ['Nginx','fa-solid fa-server','#009639','https://nginx.org'],

            ],

            /*
            |--------------------------------------------------------------------------
            | Design Tools
            |--------------------------------------------------------------------------
            */

            'Design Tools' => [

                ['Figma','fa-brands fa-figma','#F24E1E','https://figma.com'],

                ['Adobe XD','fa-solid fa-pen-ruler','#FF61F6','https://adobe.com'],

                ['Photoshop','fa-solid fa-image','#31A8FF','https://adobe.com'],

                ['Illustrator','fa-solid fa-pen','#FF9A00','https://adobe.com'],

            ],

        ];

        foreach ($technologies as $categoryName => $items) {

            $category = TechnologyCategory::where(
                'name',
                $categoryName
            )->first();

            if (!$category) {
                continue;
            }

            foreach ($items as $index => $technology) {

                Technology::create([

                    'technology_category_id' => $category->id,

                    'name' => $technology[0],

                    'slug' => Str::slug($technology[0]),

                    'icon' => $technology[1],

                    'color' => $technology[2],

                    'description' => $technology[0] . ' Technology',

                    'website' => $technology[3],

                    'sort_order' => $index + 1,

                    'is_active' => true,

                ]);

            }

        }
    }
}
