<?php

namespace Database\Seeders;

use App\Models\Musik;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class MusikSeeder extends Seeder
{
    public function run(): void
    {
        $musiks =  [
            [
                'id' => 'Ms001',
                'judul' => 'Interlude: Shadow',
                'sinopsis' => 'Interlude: Shadow" is a song by Suga of BTS. It was released on January 10, 2020 as the first comeback trailer and appears as the sixth track in their fourth studio album Map of the Soul: 7..',
                'tahun' => 2023,
                'category_id' => 1,
                'songwriter' => 'Suga, El Capitxn, Ghstloop',
                'foto_sampul' => 'maxresdefault.jpg',
            ],
            [
                'id' => 'Ms002',
                'judul' => 'Dynamite',
                'sinopsis' => '"Dynamite" by BTS, released on August 21, 2020, is their first all-English song. It topped the Billboard Hot 100 for three weeks, achieved a Perfect All-Kill in Korea, and received 1 billion views on YouTube by April 2021. The song also surpassed 1 billion streams on Spotify in July 2021, earning a Diamond certification in February 2022..',
                'tahun' => 1995,
                'category_id' => 1,
                'songwriter' => 'David Stewart, Jessica Agombar',
                'foto_sampul' => '51f058dc-e558-414a-8f7c-0042fbe5c21c.jpg',
            ],
        ];
        foreach ($musiks as $musik) {
            musik::create([
                'id' => $musik['id'],
                'judul' => $musik['judul'],
                'sinopsis' => $musik['sinopsis'],
                'tahun' => $musik['tahun'],
                'category_id' => $musik['category_id'],
                'songwriter' => $musik['songwriter'],
                'foto_sampul' => $musik['foto_sampul'],
            ]);
        }

    }
}
