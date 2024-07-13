<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
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

            $imageName = null;

            if($storeProductRequest->hasFile('image')){
                $image = $storeProductRequest->file('image');
                $imageName = $image->hashName('uploads/products/'); //'hashName()', gera um nome único para o arquivo
                $image->move(public_path('uploads/products/'), $imageName);
            }

            $product = $this->product->create(
                array_merge($storeProductRequest->validated(),
                [
                    'category_id' => $category->id,
                    'image' => $imageName,
                ]
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

    public function update(string $id, UpdateProductRequest $updateProductRequest, UpdateCategoryRequest $updateCategoryRequest)
    {
        try{
            $product = $this->product->findOrFail($id);
            $product->update($updateProductRequest->validated());
            $product->category->update($updateCategoryRequest->validated());

            return redirect()->route('product.index')->with('message', 'Produto atualizado com sucesso.');
        }
        catch(ModelNotFoundException $e){
            return redirect()->route('product.index')->with('error', 'Não foi possível encontrar o produto.');
        }
        catch(\Exception $e){
            return redirect()->route('product.index')->with('error', 'Não foi possível concluir a atualização do produto.');
        }
    }
}
