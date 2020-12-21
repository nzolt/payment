<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;


class ProductsService
{
    /**
     * @return Collection
     */
    public static function getProducts(): Collection
    {
        return Product::orderBy('group')->get();
    }

    /**
     * @param string $_id
     * @return Product
     */
    public static function getProduct(string $_id): ?Product
    {
        return Product::find($_id);
    }
}
