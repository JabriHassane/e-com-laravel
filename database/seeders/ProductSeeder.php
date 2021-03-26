<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        [
            'name'=>'DeadPool',
            'price'=>'300',
            'category'=>'Hero Cosplay',
            'description'=>'funny But she is a hero!',
            'gallery'=>'https://cdn.shopify.com/s/files/1/0060/0218/0196/products/Lady_Deadpool_Cosplay_Costumes_Female_Deadpool_Leather_Suits.jpg?v=1575601380'
        ],
        [
            'name'=>'Taxi girl',
            'price'=>'300',
            'category'=>'Taxi',
            'description'=>'funny But she is a hero!',
            'gallery'=>'https://ae01.alicdn.com/kf/HTB1kmg1HVXXXXbvXVXXq6xXFXXXR/Jaune-Taxi-Driver-tenue-Halloween-Party-Cosplay-robe-carnaval-Costumes-pour-femmes-gaine-robe-S88884.jpg_Q90.jpg_.webp'
        ],
        [
            'name'=>'Wolf girl',
            'price'=>'700',
            'category'=>'Adventer',
            'description'=>'funny But she is a hero!',
            'gallery'=>'https://i.pinimg.com/originals/ef/6b/f6/ef6bf6f1c338eb16cdfd15e59b837980.jpg'
        ],
        [
            'name'=>'Captin girl',
            'price'=>'550',
            'category'=>'hero Cosplay',
            'description'=>'Goo Captin',
            'gallery'=>'https://ae01.alicdn.com/kf/Hadbf3a7e68f445ccac1408a32376c83dB/3D-Super-h-ros-capitaine-Costume-Cosplay-femmes-film-combinaison-Costumes-pour-femmes-fille-combinaison.jpg'
        ]
        ]);
    }
}
