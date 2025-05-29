@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8">
                <!-- Product Image -->
                <div class="lg:max-w-lg lg:self-end">
                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                        @if($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                        @else
                            <img src="https://source.unsplash.com/random/800x800/?{{ urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="mt-10 lg:mt-0 lg:col-start-2 lg:row-span-2 lg:self-center">
                    <div class="max-w-lg">
                        <div class="mt-4">
                            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>
                        </div>

                        <section aria-labelledby="information-heading" class="mt-4">
                            <h2 id="information-heading" class="sr-only">Product information</h2>

                            <div class="flex items-center">
                                <p class="text-lg text-gray-900 sm:text-xl">{{ $product->formatted_price }}</p>

                                <div class="ml-4 pl-4 border-l border-gray-300">
                                    <h2 class="sr-only">Category</h2>
                                    <div class="flex items-center">
                                        <div>
                                            <div class="flex items-center">
                                                <p class="text-sm text-gray-500">
                                                    Category: <span class="text-gray-900">{{ $product->category->category_name }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 space-y-6">
                                <p class="text-base text-gray-500">{{ $product->description }}</p>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-sm font-medium text-gray-900">Stock</h3>
                                <p class="mt-2 text-sm text-gray-500">
                                    @if($product->stock_quantity > 0)
                                        <span class="text-green-600">In Stock ({{ $product->stock_quantity }} available)</span>
                                    @else
                                        <span class="text-red-600">Out of Stock</span>
                                    @endif
                                </p>
                            </div>
                        </section>

                        <section aria-labelledby="options-heading" class="mt-8">
                            <h2 id="options-heading" class="sr-only">Product options</h2>

                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <div class="mt-6">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-medium text-gray-900">Variants</h3>
                                    </div>

                                    <fieldset class="mt-2">
                                        <legend class="sr-only">Choose a variant</legend>
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            @forelse($product->variants as $variant)
                                                <label class="relative block border border-gray-300 rounded-lg p-4 cursor-pointer focus:outline-none">
                                                    <input type="radio" name="variant_id" value="{{ $variant->variant_id }}" class="sr-only" required>
                                                    <span class="flex items-center">
                                                        <span class="text-sm flex flex-col">
                                                            <span class="font-medium text-gray-900">{{ $variant->variant_name }}</span>
                                                            <span class="text-gray-500 mt-1">{{ $variant->formatted_total_price }}</span>
                                                            <span class="text-gray-500 mt-1">
                                                                @if($variant->stock_quantity > 0)
                                                                    <span class="text-green-600">In Stock ({{ $variant->stock_quantity }})</span>
                                                                @else
                                                                    <span class="text-red-600">Out of Stock</span>
                                                                @endif
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <span class="absolute -inset-px rounded-lg border-2 pointer-events-none" aria-hidden="true"></span>
                                                </label>
                                            @empty
                                                <div class="col-span-2 text-sm text-gray-500">
                                                    No variants available for this product.
                                                </div>
                                            @endforelse
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="mt-8 flex">
                                    <div>
                                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                        <select id="quantity" name="quantity" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <button type="submit" class="w-full bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        {{ $product->variants->isEmpty() || $product->variants->sum('stock_quantity') <= 0 ? 'disabled' : '' }}>
                                        <button type="submit" class="w-full bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
    {{ $product->variants->isEmpty() || $product->variants->sum('stock_quantity') <= 0 ? 'disabled' : '' }}>
    Thêm vào giỏ hàng
</button>
                                    </button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection