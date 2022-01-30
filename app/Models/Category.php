<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'picture'
    ];
    protected $dates = ['deleted_at'];


    public function products ()
    {
        return $this->hasMany(Product::class);
    }
}
