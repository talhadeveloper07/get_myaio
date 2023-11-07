<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class closureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'closure_id' => '8847',
                'name' => 'Marc Walters',
                // Add more columns and values as needed for the first record
            ],
            [
                'closure_id' => '8849',
                'name' => 'Blake Wilson',
            ],
            [
                'closure_id' => '8850',
                'name' => 'Aaron Wood',
            ],
            [
                'closure_id' => '8851',
                'name' => 'Emilia Wilson',
            ],
            [
                'closure_id' => '8852',
                'name' => 'Ross Miller',
            ],
            [
                'closure_id' => '8853',
                'name' => 'Victor Hugo',
            ],
            [
                'closure_id' => '8854',
                'name' => 'Rich Richardson',
            ],
            [
                'closure_id' => '8855',
                'name' => 'Azymrh Jasper',
            ],
            [
                'closure_id' => '8856',
                'name' => 'Michelle Jones',
            ],
            [
                'closure_id' => '8857',
                'name' => 'Albert Hall',
            ],
            // Add more arrays for additional records
        ];

        foreach ($data as $record) {
            \App\Models\Closure::create($record);
        }
    }
}
