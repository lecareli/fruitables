<?php

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