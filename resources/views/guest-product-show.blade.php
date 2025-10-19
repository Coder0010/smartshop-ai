<x-guest-layout>
    <div class="container mx-auto py-8 px-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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


        <section class="mt-20 border-t border-gray-200 dark:border-gray-700 pt-12">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-center justify-between p-6">
                <!-- Left: Icon + Text -->
                <div class="flex items-center gap-3">
                    <!-- Icon Glow -->
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-500/10 blur-md rounded-full"></div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7 relative text-blue-600 dark:text-blue-400"
                             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.25 7.5l5.25 5.25-5.25 5.25m-4.5 0L4.5 12.75 9 7.5" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                            You Might Also Like
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Personalized picks powered by Smart AI
                        </p>
                    </div>
                </div>

                <!-- Right: AI Badge -->
                <span
                    class="mt-4 sm:mt-0 text-xs font-semibold tracking-wide px-3 py-1.5 bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/50 dark:to-blue-800/30 text-blue-700 dark:text-blue-300 rounded-full border border-blue-200 dark:border-blue-700 uppercase shadow-sm">
            AI Recommended
        </span>
            </div>
            <!-- Recommendations Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($recommendations as $recommendedProduct)
                            <x-guest.products.recommanded.show-product :product="$recommendedProduct" />
                        @empty
                            <div class="col-span-full flex flex-col items-center justify-center text-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-12 h-12 text-gray-400 mb-4"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                     stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 20l-5.447-2.724A2 2 0 013 15.382V6a2 2 0 012-2h14a2 2 0 012 2v9.382a2 2 0 01-.553 1.894L15 20m-6 0V10m0 10h6m0 0V10m0 10l5.447-2.724" />
                                </svg>
                                <h3 class="text-gray-600 dark:text-gray-400 font-medium text-lg">
                                    No recommendations found
                                </h3>
                                <p class="text-gray-500 dark:text-gray-500 text-sm">
                                    Browse more products to get personalized AI suggestions.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
