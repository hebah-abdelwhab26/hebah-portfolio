<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gallery = [

            'gallery-01.webp',
            'gallery-02.webp',
            'gallery-03.webp',
            'gallery-04.webp',
            'gallery-05.webp',
            'gallery-06.webp',
            'gallery-07.webp',
            'gallery-08.webp',
            'gallery-09.webp',
            'gallery-10.webp',
            'gallery-11.webp',
            'gallery-12.webp',
            'gallery-13.webp',
            'gallery-14.webp',
            'gallery-15.webp',
            'gallery-16.webp',
            'gallery-17.webp',
            'gallery-18.webp',
            'gallery-19.webp',
            'gallery-20.webp',
            'gallery-21.webp',
            'gallery-22.webp',
            'gallery-23.webp',
            'gallery-24.webp',
            'gallery-25.webp',
            'gallery-26.webp',
            'gallery-27.webp',
            'gallery-28.webp',
            'gallery-29.webp',
            'gallery-30.webp',

        ];

        $projects = Project::all();

        $counter = 0;

        foreach ($projects as $project) {

            for ($i = 1; $i <= 4; $i++) {

                ProjectImage::create([

                    'project_id' => $project->id,

                    'image' => $gallery[$counter % count($gallery)],

                    'title' => $project->title . ' Image ' . $i,

                    'alt' => $project->title . ' Screenshot ' . $i,

                    'sort_order' => $i,

                    'is_active' => true,

                ]);

                $counter++;

            }

        }

    }
}
