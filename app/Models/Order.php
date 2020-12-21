<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $table = 'orders';

    protected $primaryKey = '_id';

    protected $fillable = [
        'customerId',
        'date',
        'paymentMethodId',
        'stripeCardId',
        'paymentReference',
        'paymentIntent',
        'invoiceNo',
        'items',
        'price',
        'info'
    ];

    public function getTotal()
    {
        return (float)$this->price;
    }
}
