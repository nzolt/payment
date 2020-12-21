<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceIds extends Model
{
    use HasFactory;

    protected $table = 'invoice_ids';

    protected $fillable = [
        'order_id'
    ];
}
