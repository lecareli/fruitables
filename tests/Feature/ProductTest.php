<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

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
