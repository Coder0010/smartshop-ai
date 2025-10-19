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
</div>
