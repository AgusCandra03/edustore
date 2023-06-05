<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description', 'stock', 'price', 'category_id', 'supplier_id'];

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function suppliers()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }
}
