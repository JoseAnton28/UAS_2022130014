<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsSeeder extends Seeder
{
    public function run()
    {
        $materials = [
            
            [
                'name_mt' => 'Dragon Fang',
                'type_mt' => 'Bronze',
                'drop_location_mt' => 'Orleans',
                'img_mt' => 'dragon_fang.jpg'
            ],
            [
                'name_mt' => 'Voids Dust',
                'type_mt' => 'Bronze',
                'drop_location_mt' => 'London',
                'img_mt' => 'void_dust.jpg'
            ],
            [
                'name_mt' => 'Evil Bone',
                'type_mt' => 'Bronze',
                'drop_location_mt' => 'Salem',
                'img_mt' => 'evil_bone.jpg'
            ],

            
            [
                'name_mt' => 'Proof of Hero',
                'type_mt' => 'Bronze',
                'drop_location_mt' => 'Fuyuki',
                'img_mt' => 'proof_of_hero.jpg'
            ],
            [
                'name_mt' => 'Seed of Yggdrasil',
                'type_mt' => 'Silver',
                'drop_location_mt' => 'Okeanos',
                'img_mt' => 'seed_of_yggdrasil.jpg'
            ],
            [
                'name_mt' => 'Octuplet Crystals',
                'type_mt' => 'Silver',
                'drop_location_mt' => 'Camelot',
                'img_mt' => 'octuplet_crystals.jpg'
            ],
            [
                'name_mt' => 'Phoenix Feather',
                'type_mt' => 'Silver',
                'drop_location_mt' => 'Okeanos',
                'img_mt' => 'phoenix_feather.jpg'
            ],
            [
                'name_mt' => 'Eternal Gear',
                'type_mt' => 'Silver',
                'drop_location_mt' => 'London',
                'img_mt' => 'eternal_gear.jpg'
            ],

            
            [
                'name_mt' => 'Claw of Chaos',
                'type_mt' => 'Gold',
                'drop_location_mt' => 'Babylonia',
                'img_mt' => 'claw_of_chaos.jpg'
            ],
            [
                'name_mt' => 'Heart of the Foreign God',
                'type_mt' => 'Gold',
                'drop_location_mt' => 'Babylonia',
                'img_mt' => 'heart_of_foreign_god.jpg'
            ],
            [
                'name_mt' => 'Dragons Reverse Scale',
                'type_mt' => 'Gold',
                'drop_location_mt' => 'Camelot',
                'img_mt' => 'dragons_reverse_scale.jpg'
            ]
        ];

        DB::table('materials')->insert($materials);
    }
}