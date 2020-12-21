<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $table = 'products';

    protected $primaryKey = '_id';

    protected $fillable = [
        'name',
        'group',
        'subscription',
        'month contract',
        'price',
        'info'
    ];

    public function _toArray()
    {
        $this;
    }
}
