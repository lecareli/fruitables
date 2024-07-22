<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function store(StoreCategoryRequest $storeCategoryRequest)
    {
        try{
            $category = $this->category->create($storeCategoryRequest->validated());

            return redirect()->route('category.index')->with('message', 'Categoria incluída com sucesso.');
        }
        catch(ModelNotFoundException $e){
            return redirect()->route()->with('error', 'Não foi possível incluir a categoria.');
        }
    }

    public function show(string $id)
    {
        try{
            return view('dashboard.register.categories.show', [
                'category' => $this->category->findOrFail($id),
            ]);
        }
        catch(ModelNotFoundException $e){
            return redirect()->route()->with('error', 'Não foi possível encontrar a categoria.');
        }
    }
}
