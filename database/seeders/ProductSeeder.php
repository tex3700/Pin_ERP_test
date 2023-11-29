<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('products')->insert($this->getData());
    }

    private function getData(): array
    {
        $color = [
            'красный',
            'белый',
            'черный',
            'зеленый',
            'синий'
        ];

        $size = [
            'S',
            'M',
            'L',
            'XL',
            'XXL'
        ];

        $data = [];

        for ($i = 0; $i < 10; $i++) {
            if ($i % 3) {
                $status = 'available';
            } else {
                $status = 'unavailable';
            }

            $json = json_encode([
                "Цвет" => $color[rand(0, 4)],
                "Размер" => $size[rand(0, 4)]
            ], JSON_UNESCAPED_UNICODE);

            $data[] = [
                'article' => "mtokb$i",
                'name' => "MTOK-B$i/216-1KT3645-K",
                'status' => $status,
                'data' => $json,
            ];
        }

        return $data;
    }
}
