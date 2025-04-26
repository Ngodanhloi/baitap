<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Các trường có thể được gán giá trị thông qua Mass Assignment
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
    ];

    /**
     * Mối quan hệ với bảng Product (Many-to-Many)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order');
    }

}
