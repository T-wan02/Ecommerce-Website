<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRemoveTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'description', 'total_quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
