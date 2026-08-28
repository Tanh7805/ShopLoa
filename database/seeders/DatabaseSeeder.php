<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tắt khóa ngoại để xóa dữ liệu cũ
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Tạo danh mục Loa chuẩn
        $catJbl = Category::create(['name' => 'Loa Bluetooth JBL']);
        $catMarshall = Category::create(['name' => 'Loa Marshall']);
        $catSony = Category::create(['name' => 'Loa Sony Extra Bass']);
        $catHarman = Category::create(['name' => 'Loa Harman Kardon']);

        // 3. Tạo danh sách Loa Vip
        $products = [
            [
                'name' => 'JBL Flip 6',
                'category_id' => $catJbl->id,
                'price' => 2990000,
                'description' => 'Loa Bluetooth chống nước IP67, âm thanh JBL Original Pro Sound công suất 30W.',
                'image' => null
            ],
            [
                'name' => 'JBL Charge 5',
                'category_id' => $catJbl->id,
                'price' => 3990000,
                'description' => 'Chống nước IP67, thời lượng pin 20 giờ, hỗ trợ sạc ngược cho điện thoại.',
                'image' => null
            ],
            [
                'name' => 'Marshall Emberton II',
                'category_id' => $catMarshall->id,
                'price' => 4290000,
                'description' => 'Thiết kế cổ điển sang trọng, âm thanh đa hướng 360 độ, pin hơn 30 giờ.',
                'image' => null
            ],
            [
                'name' => 'Marshall Stanmore III',
                'category_id' => $catMarshall->id,
                'price' => 9490000,
                'description' => 'Loa Bluetooth cắm điện cao cấp, công suất 80W, âm trường rộng hơn.',
                'image' => null
            ],
            [
                'name' => 'Sony SRS-XE200',
                'category_id' => $catSony->id,
                'price' => 2450000,
                'description' => 'Bộ khuếch đại Line-Shape Diffuser cho âm thanh lan tỏa rộng, pin 16 giờ.',
                'image' => null
            ],
            [
                'name' => 'Harman Kardon Aura Studio 4',
                'category_id' => $catHarman->id,
                'price' => 6990000,
                'description' => 'Thiết kế vỏ vòm trong suốt huyền thoại, hiệu ứng ánh sáng vòm 360 độ.',
                'image' => null
            ],
        ];

        foreach ($products as $item) {
            Product::create($item);
        }
    }
}