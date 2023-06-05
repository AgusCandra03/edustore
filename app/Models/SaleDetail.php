<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'product_id', 'qty'];

    public function sales()
    {
        return $this->belongsTo('App\Models\Sales', 'sale_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
