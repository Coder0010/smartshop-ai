@props(['product'])

<div {{ $attributes->merge([
    'class' => 'mb-3 bg-gray-50 dark:bg-gray-800 p-5 rounded-xl shadow-sm'
]) }}>
    <a href="{{ route('guest.product.show', $product->id) }}"
       class="text-sm text-gray-400 hover:text-blue-400 underline transition">
        <img
            class="w-full h-28 object-cover rounded mb-2"
            alt="{{ $product->name }}"
            src="{{ $product->image }}"
        >
    </a>
    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $product->name }}</div>
    <div class="text-xs text-blue-400 dark:text-blue-300">${{ number_format($product->price,2) }}</div>
</div>
