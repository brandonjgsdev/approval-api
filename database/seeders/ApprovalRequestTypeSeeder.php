<?php

namespace Database\Seeders;

use App\Models\ApprovalRequestType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovalRequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                "name" => "Vacaciones"
            ],
            [
                "name" => "Faltas"
            ],
            [
                "name" => "Permisos"
            ],
        ];

        ApprovalRequestType::insert($types);
    }
}
