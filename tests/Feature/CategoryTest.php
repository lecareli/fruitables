<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

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
