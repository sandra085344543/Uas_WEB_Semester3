<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Kalsik',
                'keterangan' => 'Struktur kompleks, lirik puitis, melodi indah'
            ],
            [
                'nama_kategori' => 'Jazz',
                'keterangan' => 'Nasional'
            ],
            [
                'nama_kategori' => 'Rap',
                'keterangan' => 'Vokal cepat dan berirama, bercerita tentang kehidupan sehari-hari, politik, atau budaya'
            ],
            [
                'nama_kategori' => 'Pop',
                'keterangan'    =>'Melodi catchy, lirik mudah diingat, tempo cepat'

            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
