<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function categories()
    {
        return $this->hasMany('App\Models\ProductCategory','product_id','id');
    }
}
