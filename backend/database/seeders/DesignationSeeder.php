<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample data into the "designations" table
        DB::table('designations')->insert([
            ['name' => 'Manager'],
            ['name' => 'Developer'],
            ['name' => 'Designer'],
        ]);
    }
}
