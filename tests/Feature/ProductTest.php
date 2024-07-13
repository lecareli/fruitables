<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

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

    $categoryData = [
        'id' => (string) Str::uuid(),
        'is_active' => true,
        'name' => 'Vegetables',
    ];

    $category = Category::create($categoryData);

    $image = UploadedFile::fake()->image('brocoli.jpg');

    $productData = [
        'id' => (string) Str::uuid(),
        'is_active' => true,
        'name' => 'Brocoli',
        'price' =>  3.35,
        'description' => 'Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish.',
        'image' => $image,
        'weight' => 1,
        'min_weight' => 250,
        'country_origin' => 'Brazil',
        'quality' => 'Organic',
        'check' => 'Healthy',
        'category_id' => $category->id,
    ];

    $response = post(route('product.store'), $productData);
    $response->assertStatus(302);
    $response->assertRedirect(route('product.index'));

    $createProduct = Product::where('name', 'Brocoli')->first();

    expect($createProduct)->toBeInstanceOf(Product::class);
    expect($createProduct->category)->toBeInstanceOf(Category::class);
    expect($createProduct->name)->toBe('Brocoli');
    expect($createProduct->image)->not->toBeNull();
    expect($createProduct->image)->toBeString();
});

it('displays the show product page', function(){
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $response = get(route('product.show', $product->id));
    $response->assertStatus(200);
    $response->assertSee($product->name);
    $response->assertSee($product->price);
});

it('displays the edit product page', function(){
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $response = get(route('product.edit', $product->id));
    $response->assertStatus(200);
    $response->assertSee($product->name);
    $response->assertSee($product->price);
    $response->assertSee($product->category->name);
});

it('updates a product and their category successfully', function(){
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $updateCategory = [
        'is_active' => true,
        'name' => 'Fruits',
    ];

    $updateProduct = [
        'is_active' => true,
        'name' => 'Apple',
        'price' => 2.99,
        'description' => 'Lorem ipsum',
        'weight' => 0.236,
        'min_weight' => 0.100,
        'country_origin' => 'Japan',
        'quality' => 'Organic',
        'check' => 'Ok',
    ];

    $data = array_merge($updateCategory, $updateProduct);

    $response = put(route('product.update', $product->id), $data);
    $response->assertRedirect(route('product.index'));
    $response->assertSessionHas('message', 'Produto atualizado com sucesso.');

    assertDatabaseHas('products', ['name' => 'Apple']);
});
