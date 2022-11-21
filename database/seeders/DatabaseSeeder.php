<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Paise::factory(10)->create();
        \App\Models\Ciudade::factory(30)->create();
        \App\Models\Persona::factory(40)->create();
        \App\Models\Residente::factory(20)->create();
        
    }
}
