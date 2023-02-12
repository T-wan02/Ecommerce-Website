<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'userOne',
            'image' => 'userone.png',
            'email' => 'userone@a.com',
            'password' => Hash::make('password'),
            'phone' => '09123456789',
            'address' => 'Address'
        ]);

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@a.com',
            'password' => Hash::make('password')
        ]);

        //Category
        $category = [
            [
                'T shirt',
                't-shirt.png'
            ], [
                'Hat',
                'hat.png'
            ], [
                'Jean',
                'jean.png'
            ], [
                'Belt',
                'belt.png'
            ], [
                'Mobile',
                'mobile.png'
            ], [
                'Electronic',
                'electronic.png'
            ],
            [
                'Laptop',
                'category.png'
            ]
        ];
        foreach ($category as $c) {
            Category::create([
                'slug' => Str::slug($c[0]),
                'name' => $c[0],
                'mm_name' => 'မြန်မာ',
                'image' => $c[1]
            ]);
        }

        //Brand
        $brand = ['Samsung', 'Huawei', 'Apple', 'Oppo', 'Asus', 'Lenovo', 'LV', 'Gucci', 'Levis'];
        foreach ($brand as $c) {
            Brand::create([
                'slug' => Str::slug($c),
                'name' => $c
            ]);
        }

        //Color
        $color = ['red', 'blue', 'black', 'green', 'white', 'purple'];
        foreach ($color as $c) {
            Color::create([
                'slug' => Str::slug($c),
                'name' => $c
            ]);
        }

        //supplier
        Supplier::create([
            'name' => 'Mg Mg',
            'image' => 'supplier.png'
        ]);

        Product::create([
            'category_id' => 7,
            'supplier_id' => 1,
            'brand_id' => 5,
            'slug' => uniqid() . Str::slug('Asus TUF Gaming F14'),
            'name' => "Asus TUF Gaming F14",
            'image' => "6340399ad1430w800.png",
            'discount_price' => 3200000,
            'buy_price' => 2500000,
            'sale_price' => 3000000,
            'total_quantity' => 10,
            'like_count' => 0,
            'view_count' => 0,
            'description' => 'Spec : 

            RAM - DDR4 16GB
            
            GPU - RTX 3060Ti
            
            CPU - Intel core i7 12th gen'
        ]);
        Product::create([
            'category_id' => 7,
            'supplier_id' => 1,
            'brand_id' => 5,
            'slug' => uniqid() . Str::slug('Asus Zenbook 14 OLED'),
            'name' => "Asus Zenbook 14 OLED",
            'image' => "ASUS_Zenbook_14_OLED_(UM3402YA-KM067W)_14-inch_Laptop_-_Jade_Black_(IMG_1) (1).avif",
            'discount_price' => 3200000,
            'buy_price' => 2500000,
            'sale_price' => 3000000,
            'total_quantity' => 10,
            'like_count' => 0,
            'view_count' => 0,
            'description' => 'Spec : 

            RAM - DDR4 16GB
            
            GPU - RTX 3060Ti
            
            CPU - Ryen 7'
        ]);
        Product::create([
            'category_id' => 7,
            'supplier_id' => 3,
            'brand_id' => 5,
            'slug' => uniqid() . Str::slug('Macbook M1'),
            'name' => "Macbook M1",
            'image' => "Macbook M1.webp",
            'discount_price' => 3200000,
            'buy_price' => 2500000,
            'sale_price' => 3000000,
            'total_quantity' => 10,
            'like_count' => 0,
            'view_count' => 0,
            'description' => 'Spec : 

            RAM - DDR4 16GB
            
            GPU - RTX 3060Ti
            
            CPU - M1 Chips'
        ]);
        Product::create([
            'category_id' => 5,
            'supplier_id' => 2,
            'brand_id' => 1,
            'slug' => uniqid() . Str::slug('Samsung Galaxy Z Flip 4'),
            'name' => "Samsung Galaxy Z Flip 4",
            'image' => "samsung-phone.jpg",
            'discount_price' => 3200000,
            'buy_price' => 2500000,
            'sale_price' => 3000000,
            'total_quantity' => 10,
            'like_count' => 0,
            'view_count' => 0,
            'description' => 'Good'
        ]);
        Product::create([
            'category_id' => 4,
            'supplier_id' => 3,
            'brand_id' => 8,
            'slug' => uniqid() . Str::slug('Gucci Belt'),
            'name' => "Gucci Belt",
            'image' => "gucci.jpg",
            'discount_price' => 3200000,
            'buy_price' => 2500000,
            'sale_price' => 3000000,
            'total_quantity' => 10,
            'like_count' => 0,
            'view_count' => 0,
            'description' => 'Good'
        ]);
        Product::create([
            'category_id' => 2,
            'supplier_id' => 3,
            'brand_id' => 7,
            'slug' => uniqid() . Str::slug('LV hat'),
            'name' => "LV hat",
            'image' => "lv-hat.jpg",
            'discount_price' => 3200000,
            'buy_price' => 2500000,
            'sale_price' => 3000000,
            'total_quantity' => 10,
            'like_count' => 0,
            'view_count' => 0,
            'description' => 'Good'
        ]);
        Product::create([
            'category_id' => 3,
            'supplier_id' => 3,
            'brand_id' => 9,
            'slug' => uniqid() . Str::slug('Levis Jean'),
            'name' => "Levis Jean",
            'image' => "levis-jean.jpg",
            'discount_price' => 3200000,
            'buy_price' => 2500000,
            'sale_price' => 3000000,
            'total_quantity' => 10,
            'like_count' => 0,
            'view_count' => 0,
            'description' => 'Good'
        ]);
    }
}
