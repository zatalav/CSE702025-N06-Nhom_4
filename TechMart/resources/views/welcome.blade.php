@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gray-900">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1498049794561-7780e7231661?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80" alt="Tech devices">
            <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">TechMart</h1>
            <p class="mt-6 text-xl text-gray-300 max-w-3xl">Your one-stop shop for all your tech needs. From smartphones to laptops, we've got you covered with the latest technology at competitive prices.</p>
            <div class="mt-10">
                <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 py-3 px-8 border border-transparent rounded-md text-base font-medium text-white hover:bg-blue-700">
                    Shop Now
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center">Featured Categories</h2>
            <div class="mt-12 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach(\App\Models\Category::take(4)->get() as $category)
                    <div class="group relative">
                        <div class="w-full h-80 bg-gray-200 rounded-lg overflow-hidden">
                            <img src="https://source.unsplash.com/random/300x400/?{{ urlencode($category->category_name) }}" alt="{{ $category->category_name }}" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">
                            <a href="{{ route('products.index', ['category' => $category->category_id]) }}">
                                {{ $category->category_name }}
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">Explore our {{ $category->category_name }} collection</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center">Featured Products</h2>
            <div class="mt-12 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach(\App\Models\Product::with('category')->inRandomOrder()->take(4)->get() as $product)
                    <div class="group relative">
                        <div class="w-full h-80 bg-gray-200 rounded-lg overflow-hidden">
                            @if($product->image_url)
                                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                            @else
                                <img src="https://source.unsplash.com/random/300x400/?{{ urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                            @endif
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">
                            <a href="{{ route('products.show', $product) }}">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $product->category->category_name }}</p>
                        <p class="mt-2 text-lg font-medium text-gray-900">{{ $product->formatted_price }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-12 text-center">
                <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 py-3 px-8 border border-transparent rounded-md text-base font-medium text-white hover:bg-blue-700">
                    View All Products
                </a>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Why Shop with TechMart?</h2>
                <p class="mt-4 text-lg text-gray-500">We're committed to providing the best shopping experience for tech enthusiasts.</p>
            </div>
            <div class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-4 lg:gap-x-8">
                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg font-medium text-gray-900">Authentic Products</h3>
                        <p class="mt-2 text-base text-gray-500">All our products are 100% authentic with manufacturer warranty.</p>
                    </div>
                </div>

                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg font-medium text-gray-900">Fast Delivery</h3>
                        <p class="mt-2 text-base text-gray-500">Get your products delivered to your doorstep within 24-48 hours.</p>
                    </div>
                </div>

                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg font-medium text-gray-900">Secure Payment</h3>
                        <p class="mt-2 text-base text-gray-500">Multiple secure payment options for your convenience.</p>
                    </div>
                </div>

                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg font-medium text-gray-900">24/7 Support</h3>
                        <p class="mt-2 text-base text-gray-500">Our customer support team is available round the clock.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection