<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('displays the category index page', function(){
    $response = get(route('category.index'));
    $response->assertStatus(200);
    $response->assertViewIs('dashboard.register.categories.index');
});

it('displays the category create page', function(){
    $response = get(route('category.create'));
    $response->assertStatus(200);
    $response->assertViewIs('dashboard.register.categories.create');
});

it('can create a category successfully', function(){
    $category = [
        'id' => (string) Str::uuid(),
        'is_active' => true,
        'name' => 'Fruits',
    ];

    post(route('category.store'), $category)
        ->assertRedirect(route('category.index'))
        ->assertSessionHas('message', 'Categoria incluída com sucesso.');

    assertDatabaseHas('categories', ['name' => 'Fruits']);
});

it('displays the show category page', function(){
    $category = Category::factory()->create();

    $response = get(route('category.show', $category->id));
    $response->assertStatus(200);
    $response->assertSee($category->is_active);
    $response->assertSee($category->name);
});

it('displays the edit category page', function(){
    $category = Category::factory()->create();

    $response = get(route('category.edit', $category->id));
    $response->assertStatus(200);
    $response->assertSee($category->is_active);
    $response->assertSee($category->name);
});
