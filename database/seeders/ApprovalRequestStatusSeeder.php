<?php

namespace Database\Seeders;

use App\Models\ApprovalRequestStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovalRequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                "name" => "Pendiente"
            ],
            [
                "name" => "Aprobado"
            ],
            [
                "name" => "Denegado"
            ],
        ];

        ApprovalRequestStatus::insert($status);
    }
}
