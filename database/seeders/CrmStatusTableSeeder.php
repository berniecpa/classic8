<?php

namespace Database\Seeders;

use App\Models\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'id'         => 1,
                'name'       => 'Lead',
                'created_at' => '2021-06-03 16:11:02',
                'updated_at' => '2021-06-03 16:11:02',
            ],
            [
                'id'         => 2,
                'name'       => 'Customer',
                'created_at' => '2021-06-03 16:11:02',
                'updated_at' => '2021-06-03 16:11:02',
            ],
            [
                'id'         => 3,
                'name'       => 'Partner',
                'created_at' => '2021-06-03 16:11:02',
                'updated_at' => '2021-06-03 16:11:02',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}
