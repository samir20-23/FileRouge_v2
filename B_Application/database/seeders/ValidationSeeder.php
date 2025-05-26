<?php
// database/seeders/ValidationSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Validation;
use Illuminate\Support\Carbon;

class ValidationSeeder extends Seeder
{
    public function run()
    {
        Validation::insert([
            [
                'document_id'  => 1,
                'validated_by' => 1,
                'status'       => 'Approved',
                'commentaire'  => 'Looks good.',
                'validated_at' => Carbon::now()->subDays(2),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'document_id'  => 2,
                'validated_by' => 2,
                'status'       => 'Rejected',
                'commentaire'  => 'Please update section 3.',
                'validated_at' => Carbon::now()->subDay(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
