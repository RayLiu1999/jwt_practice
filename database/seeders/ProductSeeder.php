<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductMeta;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product1 = Product::create([
            'name' => '牛肉麵',
            'price' => 120,
        ]);

        ProductMeta::create([
            'name' => '滷蛋',
            'price' => 10,
            'product_id' => $product1->id
        ]);

        ProductMeta::create([
            'name' => '麵加大',
            'price' => 15,
            'product_id' => $product1->id
        ]);

        ProductMeta::create([
            'name' => '肉兩倍',
            'price' => 50,
            'product_id' => $product1->id
        ]);


        $product2 = Product::create([
            'name' => '炸醬麵',
            'price' => 60,
        ]);

        ProductMeta::create([
            'name' => '麵加大',
            'price' => 15,
            'product_id' => $product2->id
        ]);
        
    }
}
