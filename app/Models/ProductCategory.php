<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'category_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public function categoryName()
    {
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
