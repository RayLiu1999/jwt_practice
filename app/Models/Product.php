<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function metadata()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function nameWithPrice()
    {
        return "{$this->name}: {$this->price}";
    }
}
