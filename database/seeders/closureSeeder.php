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
                'id' => '8847',
                'name' => 'Marc Walters',
                // Add more columns and values as needed for the first record
            ],
            [
                'id' => '8849',
                'name' => 'Blake Wilson',
            ],
            [
                'id' => '8850',
                'name' => 'Aaron Wood',
            ],
            [
                'id' => '8851',
                'name' => 'Emilia Wilson',
            ],
            [
                'id' => '8852',
                'name' => 'Ross Miller',
            ],
            [
                'id' => '8853',
                'name' => 'Victor Hugo',
            ],
            [
                'id' => '8854',
                'name' => 'Rich Richardson',
            ],
            [
                'id' => '8855',
                'name' => 'Azymrh Jasper',
            ],
            [
                'id' => '8856',
                'name' => 'Michelle Jones',
            ],
            [
                'id' => '8857',
                'name' => 'Albert Hall',
            ],
            // Add more arrays for additional records
        ];

        foreach ($data as $record) {
            \App\Models\Closer::create($record);
        }
    }
}
