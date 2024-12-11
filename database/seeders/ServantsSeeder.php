<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServantsSeeder extends Seeder
{
    public function run()
    {
        
        $servants = [
            [
                'name_sv' => 'Artoria Pendragon',
                'class_sv' => 'Saber',
                'rarity_sv' => 5,
                'base_hp_sv' => 2000,
                'base_atk_sv' => 1500,
                'img_sv' => 'uploads/servants/artoria.jpg'
            ],
            [
                'name_sv' => 'Gilgamesh',
                'class_sv' => 'Archer',
                'rarity_sv' => 5,
                'base_hp_sv' => 1800,
                'base_atk_sv' => 1800,
                'img_sv' => 'uploads/servants/gilgamesh.jpg'
            ],
            [
                'name_sv' => 'Cu Chulainn',
                'class_sv' => 'Lancer',
                'rarity_sv' => 3,
                'base_hp_sv' => 1500,
                'base_atk_sv' => 1300,
                'img_sv' => 'uploads/servants/cu_chulainn.jpg'
            ],
            [
                'name_sv' => 'Scathach',
                'class_sv' => 'Lancer',
                'rarity_sv' => 5,
                'base_hp_sv' => 1900,
                'base_atk_sv' => 1700,
                'img_sv' => 'uploads/servants/scathach.jpg'
            ],
            [
                'name_sv' => 'Merlin',
                'class_sv' => 'Caster',
                'rarity_sv' => 5,
                'base_hp_sv' => 2200,
                'base_atk_sv' => 1200,
                'img_sv' => 'uploads/servants/merlin.jpg'
            ],
            [
                'name_sv' => 'Hercules',
                'class_sv' => 'Berserker',
                'rarity_sv' => 4,
                'base_hp_sv' => 1300,
                'base_atk_sv' => 1700,
                'img_sv' => 'uploads/servants/hercules.jpg'
            ],
            [
                'name_sv' => 'Jeanne d Arc',
                'class_sv' => 'Ruler',
                'rarity_sv' => 5,
                'base_hp_sv' => 2500,
                'base_atk_sv' => 1000,
                'img_sv' => 'uploads/servants/jeanne_darc.jpg'
            ],
            [
                'name_sv' => 'Ishtar',
                'class_sv' => 'Archer',
                'rarity_sv' => 5,
                'base_hp_sv' => 1800,
                'base_atk_sv' => 1850,
                'img_sv' => 'uploads/servants/ishtar.jpg'
            ],
            [
                'name_sv' => 'Medusa',
                'class_sv' => 'Rider',
                'rarity_sv' => 3,
                'base_hp_sv' => 1400,
                'base_atk_sv' => 1350,
                'img_sv' => 'uploads/servants/medusa.jpg'
            ],
            [
                'name_sv' => 'Mysterious Heroine X',
                'class_sv' => 'Assassin',
                'rarity_sv' => 5,
                'base_hp_sv' => 1700,
                'base_atk_sv' => 1600,
                'img_sv' => 'uploads/servants/mysterious_heroine_x.jpg'
            ],
            [
                'name_sv' => 'Okita Souji',
                'class_sv' => 'Saber',
                'rarity_sv' => 5,
                'base_hp_sv' => 1900,
                'base_atk_sv' => 1650,
                'img_sv' => 'uploads/servants/okita_souji.jpg'
            ],
            [
                'name_sv' => 'Karna',
                'class_sv' => 'Lancer',
                'rarity_sv' => 5,
                'base_hp_sv' => 1850,
                'base_atk_sv' => 1750,
                'img_sv' => 'uploads/servants/karna.jpg'
            ],
            [
                'name_sv' => 'Mordred',
                'class_sv' => 'Saber',
                'rarity_sv' => 5,
                'base_hp_sv' => 2000,
                'base_atk_sv' => 1500,
                'img_sv' => 'uploads/servants/mordred.jpg'
            ],
            [
                'name_sv' => 'Tamamo no Mae',
                'class_sv' => 'Caster',
                'rarity_sv' => 5,
                'base_hp_sv' => 2300,
                'base_atk_sv' => 1100,
                'img_sv' => 'uploads/servants/tamamo_no_mae.jpg'
            ],
            [
                'name_sv' => 'Elizabeth Bathory',
                'class_sv' => 'Lancer',
                'rarity_sv' => 4,
                'base_hp_sv' => 1600,
                'base_atk_sv' => 1400,
                'img_sv' => 'uploads/servants/elizabeth_bathory.jpg'
            ]
        ];

        DB::table('servants')->insert($servants);
    }
}
