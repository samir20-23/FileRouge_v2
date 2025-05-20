<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ValidationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('validations')->insert([
            [
                'document_id'   => 1,
                'validated_by'  => 1,
                'status'        => 'Pending',
                'commentaire'   => 'Waiting for manager approval.',
                'validated_at'  => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'document_id'   => 2,
                'validated_by'  => 2,
                'status'        => 'Approved',
                'commentaire'   => 'All good.',
                'validated_at'  => Carbon::now()->subDays(2),
                'created_at'    => Carbon::now()->subDays(2),
                'updated_at'    => Carbon::now()->subDays(2),
            ],
            [
                'document_id'   => 3,
                'validated_by'  => 1,
                'status'        => 'Rejected',
                'commentaire'   => 'Missing signature.',
                'validated_at'  => Carbon::now()->subDay(),
                'created_at'    => Carbon::now()->subDay(),
                'updated_at'    => Carbon::now()->subDay(),
            ],
        ]);
    }
}
