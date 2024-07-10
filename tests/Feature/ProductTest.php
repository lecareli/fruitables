<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

//Routes
it('displays the product index page', function(){
    $response = get(route('product.index'));
    $response->assertStatus(200);
    $response->assertViewIs('dashboard.register.products.index');
});

it('displays the product create page', function(){
    $response = get(route('product.create'));
    $response->assertStatus(200);
    $response->assertViewIs('dashboard.register.products.create');
});

it('can create a product with an category', function(){
    $category = [
        'id' => (string) Str::uuid(),
        'is_active' => true,
        'name' => 'Vegetables',
    ];

    $product = [
        'id' => (string) Str::uuid(),
        'is_active' => true,
        'name' => 'Brocoli',
        'price' =>  3.35,
        'description' => 'Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish.',
        'image' => 'brocoli.jpg',
        'weight' => 1,
        'min_weight' => 250,
        'country_origin' => 'Brazil',
        'quality' => 'Organic',
        'check' => 'Healthy',
    ];

    $category = Category::create($category);
    $product['category_id'] = $category->id;
    $product = Product::create($product);

    expect($product)->toBeInstanceOf(Product::class);
    expect($product->category)->toBeInstanceOf(Category::class);
    expect($product->category->name)->toBe('Vegetables');
    expect($product->name)->toBe('Brocoli');
});

it('displays the show product page', function(){
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $response = get(route('product.show', $product->id));
    $response->assertStatus(200);
    $response->assertSee($product->name);
    $response->assertSee($product->price);
});
