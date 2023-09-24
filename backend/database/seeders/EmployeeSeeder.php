<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'emp_id' => 'EMP001',
                'name' => 'John Doe',
                'location_id' => 1,
                'designation_id' => 1, // Add the designation_id field
                'company_id' => 1, // Add the company_id field
                'sub_company' => 1, // Add the sub_company field
                'working_hour_starting_time' => '08:00:00',
                'working_hour_end_time' => '17:00:00',
            ],
            [
                'emp_id' => 'EMP002',
                'name' => 'Jane Smith',
                'location_id' => 2,
                'designation_id' => 2, // Add the designation_id field
                'company_id' => 1, // Add the company_id field
                'sub_company' => 2, // Add the sub_company field
                'working_hour_starting_time' => '09:00:00',
                'working_hour_end_time' => '18:00:00',
            ],
        ]);
    }
}
