<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    protected Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return view('dashboard.register.categories.index');
    }

    public function create()
    {
        return view('dashboard.register.categories.create');
    }
}
