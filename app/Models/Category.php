<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'parent'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function parent()
    {
        return $this->hasOne('App\Models\Category','id','parent');
    }
}
