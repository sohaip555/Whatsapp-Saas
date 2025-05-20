<?php

namespace Database\Seeders;

use App\Models\tokens;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class messages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Tokens::all() as $token) {
            \App\Models\messages::factory()->create([
                'created_at' => now()->subDays(rand(0, 5)),
                'tokens_id' => $token->id,
            ]);

            \App\Models\messages::factory()->create([
                'created_at' => now()->subDays(rand(0, 5)),
                'tokens_id' => $token->id,
            ]);

            \App\Models\messages::factory()->create([
                'created_at' => now()->subDays(rand(0, 5)),
                'tokens_id' => $token->id,
            ]);

            \App\Models\messages::factory()->create([
                'created_at' => now()->subDays(rand(0, 5)),
                'tokens_id' => $token->id,
            ]);
        }
    }
}
