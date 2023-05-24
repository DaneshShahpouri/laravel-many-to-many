<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Faker\Generator as Faker;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technologies = [
            ['name' => 'html', 'description' => 'è un linguaggio di formattazione che descrive le modalità di impaginazione di una pagina Web'],
            ['name' => 'css', 'description' => 'è un linguaggio di formattazione per lo stile delle pagine web.'],
            ['name' => 'Javascrip', 'description' => 'è un linguaggio di programmazione che permette di manipolare degli elementi e aggiungere una logica alla pagina'],
            ['name' => 'Vue', 'description' => 'è un framework di JavaScript'],
            ['name' => 'php', 'description' => 'è un linguaggio di programmazione indirizzato alla gestione del BackEnd.'],
            ['name' => 'Laravel', 'description' => 'è framework di Php.'],
        ];


        foreach ($technologies as $technology) {

            $newtechnology = new Technology();

            $newtechnology->name = $technology['name'];
            $newtechnology->description = $technology['description'];
            $newtechnology->slug = Str::slug($newtechnology->name);
            $newtechnology->color = $faker->hexColor();

            $newtechnology->save();
        }
    }
}
