<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

         \App\Models\User::factory()->create([
             'name' => 'Vendedor',
             'password' => '123456',
             'email' => 'vendedor@gmail.com',
             'tipo_usuario' => '2',
             'proyecto' => 'SANTO TOMAS',
             
         ]);
         \App\Models\User::factory()->create([
            'name' => 'Cliente',
            'password' => '123456',
            'email' => 'cliente@gmail.com',
            'tipo_usuario' => '3',
            'proyecto' => 'SANTO TOMAS',
        ]);
    }
}
