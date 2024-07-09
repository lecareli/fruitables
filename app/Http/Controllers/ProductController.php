<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return view('dashboard.register.products.index');
    }

    public function create()
    {
        return view('dashboard.register.products.create');
    }
}
