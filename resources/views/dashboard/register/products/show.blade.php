<x-app-layout>
    <p>
        {{ $product->id }}
        {{ $product->is_active }}
        {{ $product->name }}
        {{ $product->price }}
        {{ $product->description }}
        {{ $product->image }}
        {{ $product->weight }}
        {{ $product->min_weight }}
        {{ $product->country_origin }}
        {{ $product->quality }}
        {{ $product->check }}
        {{ $product->category_id }}
        {{ $product->category->is_active }}
        {{ $product->category->name }}
    </p>
</x-app-layout>
