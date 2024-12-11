<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CraftessencesSeeder extends Seeder
{
     function run()
    {
        $craftessences = [
            [
                'name_ce' => 'Kaleidoscope',
                'rarity_ce' => 5,
                'max_level_ce' => 100,
                'base_attack_ce' => 50,
                'base_hp_ce' => 50,
                'effects_ce' => json_encode([
                    'type' => 'NP Charge',
                    'value' => '80%'
                ]),
                'img_ce' => 'uploads/craftessences/kaleidoscope.jpg'
            ],
            [
                'name_ce' => 'Black Grail',
                'rarity_ce' => 5,
                'max_level_ce' => 100,
                'base_attack_ce' => 200,
                'base_hp_ce' => 50,
                'effects_ce' => json_encode([
                    'type' => 'NP Damage Up',
                    'value' => '60%'
                ]),
                'img_ce' => 'uploads/craftessences/black_grail.jpg'
            ],
            [
                'name_ce' => 'LimitedZero Over',
                'rarity_ce' => 4,
                'max_level_ce' => 80,
                'base_attack_ce' => 150,
                'base_hp_ce' => 40,
                'effects_ce' => json_encode([
                    'type' => 'NP Damage Up',
                    'value' => '40%'
                ]),
                'img_ce' => 'uploads/craftessences/limited_zero_over.jpg'
            ],
            [
                'name_ce' => 'Heaven Feel',
                'rarity_ce' => 5,
                'max_level_ce' => 100,
                'base_attack_ce' => 250,
                'base_hp_ce' => 0,
                'effects_ce' => json_encode([
                    'type' => 'NP Damage Up',
                    'value' => '40%'
                ]),
                'img_ce' => 'uploads/craftessences/heaven_feel.jpg'
            ],
            [
                'name_ce' => 'Prisma Cosmos',
                'rarity_ce' => 5,
                'max_level_ce' => 100,
                'base_attack_ce' => 100,
                'base_hp_ce' => 100,
                'effects_ce' => json_encode([
                    'type' => 'NP Gain',
                    'value' => '8% per turn'
                ]),
                'img_ce' => 'uploads/craftessences/prisma_cosmos.jpg'
            ],
            [
                'name_ce' => 'A Fragment of 2030',
                'rarity_ce' => 5,
                'max_level_ce' => 100,
                'base_attack_ce' => 100,
                'base_hp_ce' => 100,
                'effects_ce' => json_encode([
                    'type' => 'Critical Stars',
                    'value' => '10 stars per turn'
                ]),
                'img_ce' => 'uploads/craftessences/fragment_of_2030.jpg'
            ],
            [
                'name_ce' => 'Imaginary Element',
                'rarity_ce' => 4,
                'max_level_ce' => 80,
                'base_attack_ce' => 50,
                'base_hp_ce' => 200,
                'effects_ce' => json_encode([
                    'type' => 'NP Charge',
                    'value' => '60%'
                ]),
                'img_ce' => 'uploads/craftessences/imaginary_element.jpg'
            ],
            [
                'name_ce' => 'Formal Craft',
                'rarity_ce' => 5,
                'max_level_ce' => 100,
                'base_attack_ce' => 150,
                'base_hp_ce' => 100,
                'effects_ce' => json_encode([
                    'type' => 'Arts Card Performance',
                    'value' => '25%'
                ]),
                'img_ce' => 'uploads/craftessences/formal_craft.jpg'
            ],
            [
                'name_ce' => 'Victor of the Moon',
                'rarity_ce' => 5,
                'max_level_ce' => 100,
                'base_attack_ce' => 200,
                'base_hp_ce' => 100,
                'effects_ce' => json_encode([
                    'type' => 'Critical Damage',
                    'value' => '25%'
                ]),
                'img_ce' => 'uploads/craftessences/victor_of_the_moon.jpg'
            ],
            [
                'name_ce' => 'Holy Night Supper',
                'rarity_ce' => 4,
                'max_level_ce' => 80,
                'base_attack_ce' => 150,
                'base_hp_ce' => 75,
                'effects_ce' => json_encode([
                    'type' => 'Mixed Effect',
                    'value' => 'NP Charge 50% + Crit Damage 15% + NP Damage 15%'
                ]),
                'img_ce' => 'uploads/craftessences/holy_night_supper.jpg'
            ],
            [
                'name_ce' => 'Golden Sumo',
                'rarity_ce' => 4,
                'max_level_ce' => 80,
                'base_attack_ce' => 100,
                'base_hp_ce' => 150,
                'effects_ce' => json_encode([
                    'type' => 'Mixed Effect',
                    'value' => 'Attack Up 15% + NP Charge 50%'
                ]),
                'img_ce' => 'uploads/craftessences/golden_sumo.jpg'
            ],
            [
                'name_ce' => 'Midsummer Moment',
                'rarity_ce' => 4,
                'max_level_ce' => 80,
                'base_attack_ce' => 120,
                'base_hp_ce' => 150,
                'effects_ce' => json_encode([
                    'type' => 'Critical Damage',
                    'value' => '15% + Quick Card Performance 10%'
                ]),
                'img_ce' => 'uploads/craftessences/midsummer_moment.jpg'
            ],
            [
                'name_ce' => 'Devilish Bodhisattva',
                'rarity_ce' => 5,
                'max_level_ce' => 100,
                'base_attack_ce' => 150,
                'base_hp_ce' => 150,
                'effects_ce' => json_encode([
                    'type' => 'NP Effect',
                    'value' => 'Overcharge Effect +2 Levels'
                ]),
                'img_ce' => 'uploads/craftessences/devilish_bodhisattva.jpg'
            ],
            [
                'name_ce' => 'Another Ending',
                'rarity_ce' => 5,
                'max_level_ce' => 100,
                'base_attack_ce' => 180,
                'base_hp_ce' => 100,
                'effects_ce' => json_encode([
                    'type' => 'Critical Damage',
                    'value' => '25% + Arts Card Performance 10%'
                ]),
                'img_ce' => 'uploads/craftessences/another_ending.jpg'
            ]
        ];

        DB::table('craftessences')->insert($craftessences);
    }
}
