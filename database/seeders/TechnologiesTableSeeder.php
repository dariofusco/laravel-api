<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['Html', 'Css', 'Bootstrap', 'Javascript', 'Vue Js', 'Vite', 'Php', 'Mysql', 'Laravel'];

        foreach ($technologies as $technology) {
            
            $new_technology = new Technology();

            $new_technology->name = $technology;

            $new_technology->save();

        }
    }
}
