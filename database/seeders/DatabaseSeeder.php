<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
 
        // Criar usuário de teste
        $testUser = User::factory()->create([
            // 
        ]);

        // Criar 3 notas para o usuário de teste
        Note::factory()->count(3)->create([
            'user_id' => $testUser->id
        ]);


        User::factory(3)
            ->has(Note::factory()->count(3))
            ->create();
    }
} 
