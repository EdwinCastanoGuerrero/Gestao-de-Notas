<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement(['Personal', 'Work', 'Ideas']),
            'is_favorite' => $this->faker->boolean(20),
            'user_id' => User::factory(),
        ];
    }
}