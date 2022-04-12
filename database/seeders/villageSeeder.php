<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $village = [
            [
                'id' => 1,
                'name' => 'Beringin Lestari',
            ],
            [
                'id' => 2,
                'name' => 'Cinta Damai',
            ],
            [
                'id' => 3,
                'name' => 'Gerbang Sari',
            ],
            [
                'id' => 4,
                'name' => 'Kijang Jaya',
            ],
            [
                'id' => 5,
                'name' => 'Kijang Makmur',
            ],
            [
                'id' => 6,
                'name' => 'Kota Baru',
            ],
            [
                'id' => 7,
                'name' => 'Kota Bangun',
            ],
            [
                'id' => 8,
                'name' => 'Kota Aman',
            ],
            [
                'id' => 9,
                'name' => 'Kota garo',
            ],
            [
                'id' => 10,
                'name' => 'Sekijang',
            ],
            [
                'id' => 11,
                'name' => 'Suka Maju',
            ],
            [
                'id' => 12,
                'name' => 'Tanah Tinggi',
            ],
            [
                'id' => 13,
                'name' => 'Tandan Sari',
            ],
            [
                'id' => 14,
                'name' => 'Tapung Lestari',
            ],
            [
                'id' => 15,
                'name' => 'Tapung Makmur',
            ],
            [
                'id' => 16,
                'name' => 'Tebing Lestari',
            ],
        ];
            Village::insert($village);
    }
}
