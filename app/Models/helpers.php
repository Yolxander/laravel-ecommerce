<?php

use Carbon\Carbon;

function asDollars($value) {
    if ($value<0) return "-".asDollars(-$value);
    return '$' . number_format($value, 2);
  }

function presentPrice($price)
{
    return asDollars( $price / 100);
}

function presentDate($date)
{
    return Carbon::parse($date)->format('M d, Y');
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

function productImage($path)
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.jpg');
}

function getNumbers()
{
    $tax_config = config('cart.tax');
    $tax = floatval(implode(explode(',',$tax_config)));
    $newSubtotal = (Cart::subtotal());
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    // $newTax = $newSubtotal * $tax;
    // $newTotal = Cart::subtotal() * 1.3 ;

    return collect([
        'tax' => $tax,
        'newSubtotal' => $newSubtotal,
        // 'newTax' => $newTax,
        // 'newTotal' => $newTotal,
    ]);
}

function getStockLevel($quantity)
{
    if ($quantity > setting('site.stock_threshold', 5)) {
        $stockLevel = '<div class="badge badge-success">In Stock</div>';
    } elseif ($quantity <= setting('site.stock_threshold', 5) && $quantity > 0) {
        $stockLevel = '<div class="badge badge-warning">Low Stock</div>';
    } else {
        $stockLevel = '<div class="badge badge-danger">Not available</div>';
    }

    return $stockLevel;
}
