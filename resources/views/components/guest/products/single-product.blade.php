@props(['product'])

<div {{ $attributes->merge([
    'class' => 'bg-gray-50 dark:bg-gray-800 p-5 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between border border-gray-200 dark:border-gray-700'
]) }}>
    <!-- Product Image -->
    <a href="{{ route('guest.product.show', $product->id) }}"
       class="text-sm text-gray-400 hover:text-blue-400 underline transition">
        <img
            class="w-full h-44 object-cover mb-4 rounded-md"
            alt="{{ $product->name }}"
             src="{{ $product->image }}"
        />
    </a>

    <!-- Product Info -->
    <div class="flex-1">
        <a href="{{ route('guest.product.show', $product->id) }}"
           class="text-sm text-gray-400 hover:text-blue-400 underline transition">
            <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-lg leading-snug">
                {{ $product->name }}
            </h3>
        </a>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">
            {{ $product->description }}
        </p>
    </div>

    <!-- Footer -->
    <div class="mt-4 flex items-center justify-between">
        <span class="font-semibold text-blue-400 dark:text-blue-300 text-lg">
            ${{ number_format($product->price, 2) }}
        </span>
        @if (Route::has('guest.cart.add'))
            <div class="flex items-center gap-2">
                <form action="{{ route('guest.cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-medium px-4 py-1.5 rounded-md shadow-sm hover:shadow-md transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5-4a2 2 0 11-4 0" />
                        </svg>
                        Add to Cart
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
