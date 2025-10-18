<x-guest-layout>
    <div class="container mx-auto py-10 px-4">
        <!-- Header -->
        <section class="mb-8 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">🛒 Your Cart</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Review your selected items before checkout.
            </p>
        </section>

        <x-session-status :status="session('status')" />

        <!-- Empty Cart -->
        @if(empty($items) || count($items) === 0)
            <div class="text-center bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-10">
                <p class="text-gray-700 dark:text-gray-300 text-lg">Your cart is empty.</p>
                <a href="{{ route('home') }}"
                   class="mt-5 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Browse Products
                </a>
            </div>
        @else
            <!-- Cart with Alpine.js -->
            <div
                x-data="cart({
                    items: {
                        @foreach($products as $p)
                            {{ $p->id }}: {
                                id: {{ $p->id }},
                                name: @js($p->name),
                                price: {{ $p->price }},
                                qty: {{ $items[$p->id] }},
                                image: @js($p->image),
                                url: @js(route('guest.product.show', $p->id))
                            },
                        @endforeach
                    }
                })"
                class="grid md:grid-cols-3 gap-8"
            >
                <!-- Cart Items -->
                <div class="md:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Cart Items</h2>

                    <template x-for="(item, key) in items" :key="item.id">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between py-4 border-b border-gray-200 dark:border-gray-700 last:border-none">
                            <!-- Product Info -->
                            <div class="flex items-center gap-4">
                                <!-- Clickable Image -->
                                <a :href="item.url" class="block group">
                                    <img
                                        class="w-20 h-20 object-cover rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition-transform duration-200 group-hover:scale-105"
                                        :src="item.image"
                                        :alt="item.name"
                                    >
                                </a>
                                <div>
                                    <!-- Clickable Name -->
                                    <a :href="item.url"
                                       class="font-medium text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400 transition"
                                       x-text="item.name"></a>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        $<span x-text="item.price.toFixed(2)"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Quantity Control -->
                            <div class="flex items-center gap-3 mt-4 sm:mt-0">
                                <div class="flex items-center gap-2">
                                    <button type="button"
                                            @click="decrement(item)"
                                            class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                        −
                                    </button>
                                    <input type="number" min="1"
                                           x-model.number="item.qty"
                                           @change="update(item)"
                                           class="no-spinner w-16 text-center border border-gray-300 dark:border-gray-600 rounded-lg p-1 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                                    <button type="button"
                                            @click="increment(item)"
                                            class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                        +
                                    </button>
                                </div>

                                <!-- Item Total -->
                                <div class="font-medium text-gray-900 dark:text-gray-100 w-20 text-right">
                                    $<span x-text="(item.price * item.qty).toFixed(2)"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Summary -->
                <aside class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 h-fit">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Order Summary</h2>

                    <div class="space-y-2 text-gray-700 dark:text-gray-300">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>$<span x-text="subtotal().toFixed(2)"></span></span>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 my-3"></div>
                        <div class="flex justify-between font-semibold text-lg text-gray-900 dark:text-gray-100">
                            <span>Total</span>
                            <span>$<span x-text="subtotal().toFixed(2)"></span></span>
                        </div>
                    </div>

                    <form action="{{ route('guest.cart.checkout') }}" method="POST" class="mt-6">
                        @csrf
                        <button
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg text-lg font-medium transition shadow-sm"
                        >
                            Proceed to Checkout
                        </button>
                    </form>
                </aside>
            </div>
        @endif
    </div>

    <!-- Alpine.js Component -->
    <script>
        function cart({ items }) {
            return {
                items,
                increment(item) {
                    item.qty++;
                    this.sync(item);
                },
                decrement(item) {
                    if (item.qty > 1) {
                        item.qty--;
                        this.sync(item);
                    }
                },
                subtotal() {
                    return Object.values(this.items)
                        .reduce((sum, item) => sum + (item.price * item.qty), 0);
                },
                async sync(item) {
                    try {
                        await fetch("{{ route('guest.cart.update') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json",
                                "Accept": "application/json"
                            },
                            body: JSON.stringify({ product_id: item.id, qty: item.qty })
                        });
                    } catch (error) {
                        console.error('Update failed:', error);
                    }
                },
                update(item) {
                    if (item.qty < 1) item.qty = 1;
                    this.sync(item);
                }
            }
        }
    </script>

    <!-- Hide number input spinners -->
    <style>
        /* Chrome, Safari, Edge, Opera */
        input[type=number].no-spinner::-webkit-inner-spin-button,
        input[type=number].no-spinner::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number].no-spinner {
            -moz-appearance: textfield;
        }
    </style>
</x-guest-layout>
