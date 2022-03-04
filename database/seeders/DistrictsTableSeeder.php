<?php

namespace Database\Seeders;

use App\Models\Districts;
use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            [
                'id' => 1,
                'name' => 'Kecamatan Bangkinang',
            ],
            [
                'id' => 2,
                'name' => 'Kecamatan Bangkinang Barat',
            ],
            [
                'id' => 3,
                'name' => 'Kecamatan Bangkinang Seberang',
            ],
            [
                'id' => 4,
                'name' => 'Kecamatan Gunung Sahilan',
            ],
            [
                'id' => 5,
                'name' => 'Kecamatan Kampar',
            ],
            [
                'id' => 6,
                'name' => 'Kecamatan Kampar Kiri',
            ],
            [
                'id' => 7,
                'name' => 'Kecamatan Kampar Kiri Hilir',
            ],
            [
                'id' => 8,
                'name' => 'Kecamatan Kampar Kiri Hulu',
            ],
            [
                'id' => 9,
                'name' => 'Kecamatan Kampar Kiri Tengah',
            ],
            [
                'id' => 10,
                'name' => 'Kecamatan Kampar Timur',
            ],
            [
                'id' => 11,
                'name' => 'Kecamatan Kampar Utara',
            ],
            [
                'id' => 12,
                'name' => 'Kecamatan Perhentian Raja',
            ],
            [
                'id' => 13,
                'name' => 'Kecamatan Rumbio Jaya',
            ],
            [
                'id' => 14,
                'name' => 'Kecamatan Salo',
            ],
            [
                'id' => 15,
                'name' => 'Kecamatan Siak Hulu',
            ],
            [
                'id' => 16,
                'name' => 'Kecamatan Tambang',
            ],
            [
                'id' => 17,
                'name' => 'Kecamatan Tapung',
            ],
            [
                'id' => 18,
                'name' => 'Kecamatan Tapung Hilir',
            ],
            [
                'id' => 19,
                'name' => 'Kecamatan Tapung Hulu',
            ],
            [
                'id' => 20,
                'name' => 'Kecamatan XIII Koto Kampar',
            ],
        ];

        Districts::insert($districts);
    }
}
