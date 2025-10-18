<x-guest-layout>
    <div class="container mx-auto py-8 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Product Image -->
            <div>
                <img
                    class="w-full h-96 object-cover rounded-lg shadow-sm border border-gray-200 dark:border-gray-700"
                    alt="{{ $product->name }}"
                    src="{{ $product->image }}"
                >
            </div>

            <!-- Product Info -->
            <div class="space-y-4">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    {{ $product->name }}
                </h1>

                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ $product->description }}
                </p>

                <div class="font-semibold text-blue-400 dark:text-blue-300 text-lg">
                    ${{ number_format($product->price, 2) }}
                </div>

                <!-- Add to Cart Form -->
                <form action="{{ route('guest.cart.add') }}" method="POST" x-data="{ qty: 1 }" class="pt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            @click="qty = Math.max(1, qty - 1)"
                            class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                        >
                            −
                        </button>

                        <input
                            x-model.number="qty"
                            name="qty"
                            min="1"
                            class="w-16 text-center border border-gray-300 dark:border-gray-600 rounded-lg p-1 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        />

                        <button
                            type="button"
                            @click="qty++"
                            class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                        >
                            +
                        </button>
                    </div>

                    <div class="mt-6">
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow-sm transition dark:bg-blue-500 dark:hover:bg-blue-600"
                        >
                            Add to Cart
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
