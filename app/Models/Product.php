<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Chỉ định bảng trong cơ sở dữ liệu (nếu khác với tên mặc định)
    protected $table = 'products';

    // Các trường có thể được gán giá trị thông qua Mass Assignment
    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'quantity',
    ];

    /**
     * Mối quan hệ với bảng ProductOrder (Many-to-Many)
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order')
                    ->withPivot('quantity', 'note') // Thêm các cột bổ sung từ bảng pivot
                    ->withTimestamps(); // Thêm timestamps nếu cần thiết
    }
}
