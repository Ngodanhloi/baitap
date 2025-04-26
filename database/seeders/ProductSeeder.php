<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Tắt kiểm tra khóa ngoại để truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        Order::truncate();
        DB::table('product_order')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Tạo 5 sản phẩm mẫu
        $products = [
            ['name' => 'Product 1', 'image' => 'product1.jpg', 'price' => 100, 'description' => 'Description for product 1', 'quantity' => 50],
            ['name' => 'Product 2', 'image' => 'product2.jpg', 'price' => 150, 'description' => 'Description for product 2', 'quantity' => 30],
            ['name' => 'Product 3', 'image' => 'product3.jpg', 'price' => 200, 'description' => 'Description for product 3', 'quantity' => 10],
            ['name' => 'Product 4', 'image' => 'product4.jpg', 'price' => 120, 'description' => 'Description for product 4', 'quantity' => 40],
            ['name' => 'Product 5', 'image' => 'product5.jpg', 'price' => 180, 'description' => 'Description for product 5', 'quantity' => 25],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Lấy toàn bộ user
        $users = User::all();

        foreach ($users as $user) {
            // Mỗi user tạo 3 order
            for ($i = 0; $i < 3; $i++) {
                $selectedProducts = Product::inRandomOrder()->take(2)->get();

                $totalAmount = $selectedProducts->sum('price');

                // Tạo order mới
                $order = Order::create([
                    'user_id' => $user->id,
                    'total_amount' => $totalAmount,
                    'address' => '123 Example Address',
                ]);

                // Gắn products vào order kèm quantity + note
                foreach ($selectedProducts as $product) {
                    $order->products()->attach($product->id, [
                        'quantity' => rand(1, 5), // random số lượng
                        'note' => 'Ghi chú sản phẩm ' . $product->name,
                    ]);
                }
            }
        }
    }
}
