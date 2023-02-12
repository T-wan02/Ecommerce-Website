<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'name', 'mm_name', 'image'];
    protected $appends = ['img_url'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function getImgUrlAttribute()
    {
        return asset('/images/' . $this->image);
    }
}
