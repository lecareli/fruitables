<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected Product $product;
    protected Category $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function index()
    {
        return view('dashboard.register.products.index');
    }

    public function create()
    {
        return view('dashboard.register.products.create');
    }

    public function store(StoreProductRequest $storeProductRequest, StoreCategoryRequest $storeCategoryRequest)
    {
        try{
            $category = $this->category->create($storeCategoryRequest->validated());
            $product = $this->product->create(
                array_merge($storeProductRequest->validated(),
                ['category_id' => $category->id]
            ));

            return redirect()->route('product.index')->with('message', 'Produto incluído com sucesso.');
        }
        catch(ModelNotFoundException $e){
            return redirect()->route()->with('error', 'Não foi possível incluir o produto.');
        }
    }

    public function show(string $id)
    {
        try{
            return view('dashboard.register.products.show', [
                'product' => $this->product->with('category')->findOrFail($id),
            ]);
        }
        catch(ModelNotFoundException $e){
            return redirect()->route()->with('error', 'Não foi possível encontrar o produto.');
        }
    }

    public function edit(string $id)
    {
        try{
            return view('dashboard.register.products.edit', [
                'product' => $this->product->with('category')->findOrFail($id),
            ]);
        }
        catch(ModelNotFoundException $e){
            return redirect()->route()->with('error', 'Não foi possível encontrar o produto.');
        }
    }
}
